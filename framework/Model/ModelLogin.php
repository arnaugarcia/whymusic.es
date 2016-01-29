<?php
class ModelLogin{
    /**
     * @var object $db_connection The database connection
     */
    private $db_connection = null;
    /**
     * @var int $usuario_id The user's id
     */
    private $usuario_id = null;
    /**
     * @var string $usuario_nombre_usuario The user's name
     */
    private $usuario_nombre_usuario = "";
    /**
     * @var string $usuario_email The user's mail
     */
    private $usuario_email = "";
    /**
     * @var boolean $user_is_logged_in The user's login status
     */
    private $user_is_logged_in = false;
    /**
     * @var string $user_gravatar_image_url The user's gravatar profile pic url (or a default one)
     */
    public $user_gravatar_image_url = "";
    /**
     * @var string $user_gravatar_image_tag The user's gravatar profile pic url with <img ... /> around
     */
    public $user_gravatar_image_tag = "";
    /**
     * @var boolean $password_reset_link_is_valid Marker for view handling
     */
    private $password_reset_link_is_valid  = false;
    /**
     * @var boolean $password_reset_was_successful Marker for view handling
     */
    private $password_reset_was_successful = false;
    /**
     * @var array $errors Collection of error messages
     */
    public $errors = array();
    /**
     * @var array $messages Collection of success / neutral messages
     */
    public $messages = array();

    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$login = new Login();"
     */
    public function __construct()
    {
        // create/read session
        //session_start();

        // TODO: organize this stuff better and make the constructor very small
        // TODO: unite Login and Registration classes ?

        // check the possible login actions:
        // 1. logout (happen when user clicks logout button)
        // 2. login via session data (happens each time user opens a page on your php project AFTER he has successfully logged in via the login form)
        // 3. login via cookie
        // 4. login via post data, which means simply logging in via the login form. after the user has submit his login/password successfully, his
        //    logged-in-status is written into his session data on the server. this is the typical behaviour of common login scripts.

        // if user tried to log out
        if (isset($_GET["logout"])) {
            $this->doLogout();

        // if user has an active session on the server
        } elseif (!empty($_SESSION['usuario_nombre_usuario']) && ($_SESSION['user_logged_in'] == 1)) {
            $this->loginWithSessionData();

            // checking for form submit from editing screen
            // user try to change his username
            if (isset($_POST["user_edit_submit_name"])) {
                // function below uses use $_SESSION['usuario_id'] et $_SESSION['usuario_email']
                $this->editUserName($_POST['usuario_nombre_usuario']);
            // user try to change his email
            } elseif (isset($_POST["user_edit_submit_email"])) {
                // function below uses use $_SESSION['usuario_id'] et $_SESSION['usuario_email']
                $this->editUserEmail($_POST['usuario_email']);
            // user try to change his password
            } elseif (isset($_POST["user_edit_submit_password"])) {
                // function below uses $_SESSION['usuario_nombre_usuario'] and $_SESSION['usuario_id']
                $this->editUserPassword($_POST['usuario_contrasena_old'], $_POST['usuario_contrasena_new'], $_POST['usuario_contrasena_repeat']);
            }

        // login with cookie
        } elseif (isset($_COOKIE['rememberme'])) {
            $this->loginWithCookieData();

        // if user just submitted a login form
        } elseif (isset($_POST["login"])) {
            if (!isset($_POST['usuario_recuerdame'])) {
                $_POST['usuario_recuerdame'] = null;
            }
            $this->loginWithPostData($_POST['usuario_nombre_usuario'], $_POST['usuario_contrasena'], $_POST['usuario_recuerdame']);
        }

        // checking if user requested a password reset mail
        if (isset($_POST["request_password_reset"]) && isset($_POST['usuario_nombre_usuario'])) {
            $this->setPasswordResetDatabaseTokenAndSendMail($_POST['usuario_nombre_usuario']);
        } elseif (isset($_GET["usuario_nombre_usuario"]) && isset($_GET["verification_code"])) {
            $this->checkIfEmailVerificationCodeIsValid($_GET["usuario_nombre_usuario"], $_GET["verification_code"]);
        } elseif (isset($_POST["submit_new_password"])) {
            $this->editNewPassword($_POST['usuario_nombre_usuario'], $_POST['usuario_contrasena_reset_hash'], $_POST['usuario_contrasena_new'], $_POST['usuario_contrasena_repeat']);
        }

        // get gravatar profile picture if user is logged in
        if ($this->isUserLoggedIn() == true) {
            $this->getGravatarImageUrl($this->usuario_email);
        }
    }

    /**
     * Checks if database connection is opened. If not, then this method tries to open it.
     * @return bool Success status of the database connecting process
     */
    private function databaseConnection()
    {
        // if connection already exists
        if ($this->db_connection != null) {
            return true;
        } else {
            try {
                // Generate a database connection, using the PDO connector
                // @see http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
                // Also important: We include the charset, as leaving it out seems to be a security issue:
                // @see http://wiki.hashphp.org/PDO_Tutorial_for_MySQL_Developers#Connecting_to_MySQL says:
                // "Adding the charset to the DSN is very important for security reasons,
                // most examples you'll see around leave it out. MAKE SURE TO INCLUDE THE CHARSET!"
                $this->db_connection = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
                return true;
            } catch (PDOException $e) {
                $this->errors[] = MESSAGE_DATABASE_ERROR . $e->getMessage();
            }
        }
        // default return
        return false;
    }
    /**
     * Search into database for the user data of usuario_nombre_usuario specified as parameter
     * @return user data as an object if existing user
     * @return false if usuario_nombre_usuario is not found in the database
     * TODO: @devplanete This returns two different types. Maybe this is valid, but it feels bad. We should rework this.
     * TODO: @devplanete After some resarch I'm VERY sure that this is not good coding style! Please fix this.
     */
    public function getUserData($usuario_nombre_usuario)
    {
        // if database connection opened
        if ($this->databaseConnection()) {
            // database query, getting all the info of the selected user
            $query_user = $this->db_connection->prepare('SELECT * FROM wm_usuarios WHERE usuario_nombre_usuario = :usuario_nombre_usuario');
            $query_user->bindValue(':usuario_nombre_usuario', $usuario_nombre_usuario, PDO::PARAM_STR);
            $query_user->execute();
            // get result row (as an object)
            return $query_user->fetchObject();
        } else {
            return false;
        }
    }

    /**
     * Logs in with S_SESSION data.
     * Technically we are already logged in at that point of time, as the $_SESSION values already exist.
     */
    private function loginWithSessionData()
    {
        $this->usuario_nombre_usuario = $_SESSION['usuario_nombre_usuario'];
        $this->usuario_email = $_SESSION['usuario_email'];

        // set logged in status to true, because we just checked for this:
        // !empty($_SESSION['usuario_nombre_usuario']) && ($_SESSION['user_logged_in'] == 1)
        // when we called this method (in the constructor)
        $this->user_is_logged_in = true;
    }

    /**
     * Logs in via the Cookie
     * @return bool success state of cookie login
     */
    private function loginWithCookieData()
    {
        if (isset($_COOKIE['rememberme'])) {
            // extract data from the cookie
            list ($usuario_id, $token, $hash) = explode(':', $_COOKIE['rememberme']);
            // check cookie hash validity
            if ($hash == hash('sha256', $usuario_id . ':' . $token . COOKIE_SECRET_KEY) && !empty($token)) {
                // cookie looks good, try to select corresponding user
                if ($this->databaseConnection()) {
                    // get real token from database (and all other data)
                    $sth = $this->db_connection->prepare("SELECT usuario_id, usuario_nombre_usuario, usuario_email FROM wm_usuarios WHERE usuario_id = :usuario_id
                                                      AND usuario_recuerdame_token = :usuario_recuerdame_token AND usuario_recuerdame_token IS NOT NULL");
                    $sth->bindValue(':usuario_id', $usuario_id, PDO::PARAM_INT);
                    $sth->bindValue(':usuario_recuerdame_token', $token, PDO::PARAM_STR);
                    $sth->execute();
                    // get result row (as an object)
                    $result_row = $sth->fetchObject();

                    if (isset($result_row->usuario_id)) {
                        // write user data into PHP SESSION [a file on your server]
                        $_SESSION['usuario_id'] = $result_row->usuario_id;
                        $_SESSION['usuario_nombre_usuario'] = $result_row->usuario_nombre_usuario;
                        $_SESSION['usuario_email'] = $result_row->usuario_email;
                        $_SESSION['user_logged_in'] = 1;

                        // declare user id, set the login status to true
                        $this->usuario_id = $result_row->usuario_id;
                        $this->usuario_nombre_usuario = $result_row->usuario_nombre_usuario;
                        $this->usuario_email = $result_row->usuario_email;
                        $this->user_is_logged_in = true;

                        // Cookie token usable only once
                        $this->newRememberMeCookie();
                        return true;
                    }
                }
            }
            // A cookie has been used but is not valid... we delete it
            $this->deleteRememberMeCookie();
            $this->errors[] = MESSAGE_COOKIE_INVALID;
        }
        return false;
    }

    /**
     * Logs in with the data provided in $_POST, coming from the login form
     * @param $usuario_nombre_usuario
     * @param $usuario_contrasena
     * @param $usuario_recuerdame
     */
    private function loginWithPostData($usuario_nombre_usuario, $usuario_contrasena, $usuario_recuerdame)
    {
        if (empty($usuario_nombre_usuario)) {
            $this->errors[] = MESSAGE_USERNAME_EMPTY;
        } else if (empty($usuario_contrasena)) {
            $this->errors[] = MESSAGE_PASSWORD_EMPTY;

        // if POST data (from login form) contains non-empty usuario_nombre_usuario and non-empty usuario_contrasena
        } else {
            // user can login with his username or his email address.
            // if user has not typed a valid email address, we try to identify him with his usuario_nombre_usuario
            if (!filter_var($usuario_nombre_usuario, FILTER_VALIDATE_EMAIL)) {
                // database query, getting all the info of the selected user
                $result_row = $this->getUserData(trim($usuario_nombre_usuario));

            // if user has typed a valid email address, we try to identify him with his usuario_email
            } else if ($this->databaseConnection()) {
                // database query, getting all the info of the selected user
                $query_user = $this->db_connection->prepare('SELECT * FROM wm_usuarios WHERE usuario_email = :usuario_email');
                $query_user->bindValue(':usuario_email', trim($usuario_nombre_usuario), PDO::PARAM_STR);
                $query_user->execute();
                // get result row (as an object)
                $result_row = $query_user->fetchObject();
            }

            // if this user not exists
            if (! isset($result_row->usuario_id)) {
                // was MESSAGE_USER_DOES_NOT_EXIST before, but has changed to MESSAGE_LOGIN_FAILED
                // to prevent potential attackers showing if the user exists
                $this->errors[] = MESSAGE_LOGIN_FAILED;
            } else if (($result_row->usuario_login_fails >= 3) && ($result_row->usuario_last_failed_login > (time() - 30))) {
                $this->errors[] = MESSAGE_PASSWORD_WRONG_3_TIMES;
            // using PHP 5.5's password_verify() function to check if the provided passwords fits to the hash of that user's password
            } else if (! password_verify($usuario_contrasena, $result_row->usuario_contrasena)) {
                // increment the failed login counter for that user
                $sth = $this->db_connection->prepare('UPDATE wm_usuarios '
                        . 'SET usuario_login_fails = usuario_login_fails+1, usuario_last_failed_login = :usuario_last_failed_login '
                        . 'WHERE usuario_nombre_usuario = :usuario_nombre_usuario OR usuario_email = :usuario_nombre_usuario');
                $sth->execute(array(':usuario_nombre_usuario' => $usuario_nombre_usuario, ':usuario_last_failed_login' => time()));

                $this->errors[] = MESSAGE_PASSWORD_WRONG;
            // has the user activated their account with the verification email
            } else if ($result_row->usuario_active_ahora != 1) {
                $this->errors[] = MESSAGE_ACCOUNT_NOT_ACTIVATED;
            } else {
                // write user data into PHP SESSION [a file on your server]
                $_SESSION['usuario_id'] = $result_row->usuario_id;
                $_SESSION['usuario_nombre_usuario'] = $result_row->usuario_nombre_usuario;
                $_SESSION['usuario_email'] = $result_row->usuario_email;
                $_SESSION['user_logged_in'] = 1;

                // declare user id, set the login status to true
                $this->usuario_id = $result_row->usuario_id;
                $this->usuario_nombre_usuario = $result_row->usuario_nombre_usuario;
                $this->usuario_email = $result_row->usuario_email;
                $this->user_is_logged_in = true;

                // reset the failed login counter for that user
                $sth = $this->db_connection->prepare('UPDATE wm_usuarios '
                        . 'SET usuario_login_fails = 0, usuario_last_failed_login = NULL '
                        . 'WHERE usuario_id = :usuario_id AND usuario_login_fails != 0');
                $sth->execute(array(':usuario_id' => $result_row->usuario_id));

                // if user has check the "remember me" checkbox, then generate token and write cookie
                if (isset($usuario_recuerdame)) {
                    $this->newRememberMeCookie();
                } else {
                    // Reset remember-me token
                    $this->deleteRememberMeCookie();
                }

                // OPTIONAL: recalculate the user's password hash
                // DELETE this if-block if you like, it only exists to recalculate wm_usuarios's hashes when you provide a cost factor,
                // by default the script will use a cost factor of 10 and never change it.
                // check if the have defined a cost factor in config/hashing.php
                if (defined('HASH_COST_FACTOR')) {
                    // check if the hash needs to be rehashed
                    if (password_needs_rehash($result_row->usuario_contrasena, PASSWORD_DEFAULT, array('cost' => HASH_COST_FACTOR))) {

                        // calculate new hash with new cost factor
                        $usuario_contrasena = password_hash($usuario_contrasena, PASSWORD_DEFAULT, array('cost' => HASH_COST_FACTOR));

                        // TODO: this should be put into another method !?
                        $query_update = $this->db_connection->prepare('UPDATE wm_usuarios SET usuario_contrasena = :usuario_contrasena WHERE usuario_id = :usuario_id');
                        $query_update->bindValue(':usuario_contrasena', $usuario_contrasena, PDO::PARAM_STR);
                        $query_update->bindValue(':usuario_id', $result_row->usuario_id, PDO::PARAM_INT);
                        $query_update->execute();

                        if ($query_update->rowCount() == 0) {
                            // writing new hash was successful. you should now output this to the user ;)
                        } else {
                            // writing new hash was NOT successful. you should now output this to the user ;)
                        }
                    }
                }
            }
        }
    }

    /**
     * Create all data needed for remember me cookie connection on client and server side
     */
    private function newRememberMeCookie()
    {
        // if database connection opened
        if ($this->databaseConnection()) {
            // generate 64 char random string and store it in current user data
            $random_token_string = hash('sha256', mt_rand());
            $sth = $this->db_connection->prepare("UPDATE wm_usuarios SET usuario_recuerdame_token = :usuario_recuerdame_token WHERE usuario_id = :usuario_id");
            $sth->execute(array(':usuario_recuerdame_token' => $random_token_string, ':usuario_id' => $_SESSION['usuario_id']));

            // generate cookie string that consists of userid, randomstring and combined hash of both
            $cookie_string_first_part = $_SESSION['usuario_id'] . ':' . $random_token_string;
            $cookie_string_hash = hash('sha256', $cookie_string_first_part . COOKIE_SECRET_KEY);
            $cookie_string = $cookie_string_first_part . ':' . $cookie_string_hash;

            // set cookie
            setcookie('rememberme', $cookie_string, time() + COOKIE_RUNTIME, "/", COOKIE_DOMAIN);
        }
    }

    /**
     * Delete all data needed for remember me cookie connection on client and server side
     */
    private function deleteRememberMeCookie()
    {
        // if database connection opened
        if ($this->databaseConnection()) {
            // Reset rememberme token
            $sth = $this->db_connection->prepare("UPDATE wm_usuarios SET usuario_recuerdame_token = NULL WHERE usuario_id = :usuario_id");
            $sth->execute(array(':usuario_id' => 7));
        }
        // set the rememberme-cookie to ten years ago (3600sec * 365 days * 10).
        // that's obivously the best practice to kill a cookie via php
        // @see http://stackoverflow.com/a/686166/1114320
        setcookie('rememberme', false, time() - (3600 * 3650), '/', COOKIE_DOMAIN);
    }
    /**
     * Perform the logout, resetting the session
     */
    public function doLogout()
    {
        $this->deleteRememberMeCookie();
        $_SESSION = array();
        session_destroy();
        $this->user_is_logged_in = false;
        $this->messages[] = "Has salido con exito";
    }

    /**
     * Simply return the current state of the user's login
     * @return bool user's login status
     */
    public function isUserLoggedIn()
    {
        return $this->user_is_logged_in;
    }

    /**
     * Edit the user's name, provided in the editing form
     */
    public function editUserName($usuario_nombre_usuario)
    {
        // prevent database flooding
        $usuario_nombre_usuario = substr(trim($usuario_nombre_usuario), 0, 64);

        if (!empty($usuario_nombre_usuario) && $usuario_nombre_usuario == $_SESSION['usuario_nombre_usuario']) {
            $this->errors[] = MESSAGE_USERNAME_SAME_LIKE_OLD_ONE;

        // username cannot be empty and must be azAZ09 and 2-64 characters
        // TODO: maybe this pattern should also be implemented in Registration.php (or other way round)
        } elseif (empty($usuario_nombre_usuario) || !preg_match("/^(?=.{2,64}$)[a-zA-Z][a-zA-Z0-9]*(?: [a-zA-Z0-9]+)*$/", $usuario_nombre_usuario)) {
            $this->errors[] = MESSAGE_USERNAME_INVALID;

        } else {
            // check if new username already exists
            $result_row = $this->getUserData($usuario_nombre_usuario);

            if (isset($result_row->usuario_id)) {
                $this->errors[] = MESSAGE_USERNAME_EXISTS;
            } else {
                // write user's new data into database
                $query_edit_usuario_nombre_usuario = $this->db_connection->prepare('UPDATE wm_usuarios SET usuario_nombre_usuario = :usuario_nombre_usuario WHERE usuario_id = :usuario_id');
                $query_edit_usuario_nombre_usuario->bindValue(':usuario_nombre_usuario', $usuario_nombre_usuario, PDO::PARAM_STR);
                $query_edit_usuario_nombre_usuario->bindValue(':usuario_id', $_SESSION['usuario_id'], PDO::PARAM_INT);
                $query_edit_usuario_nombre_usuario->execute();

                if ($query_edit_usuario_nombre_usuario->rowCount()) {
                    $_SESSION['usuario_nombre_usuario'] = $usuario_nombre_usuario;
                    $this->messages[] = MESSAGE_USERNAME_CHANGED_SUCCESSFULLY . $usuario_nombre_usuario;
                } else {
                    $this->errors[] = MESSAGE_USERNAME_CHANGE_FAILED;
                }
            }
        }
    }

    /**
     * Edit the user's email, provided in the editing form
     */
    public function editUserEmail($usuario_email)
    {
        // prevent database flooding
        $usuario_email = substr(trim($usuario_email), 0, 64);

        if (!empty($usuario_email) && $usuario_email == $_SESSION["usuario_email"]) {
            $this->errors[] = MESSAGE_EMAIL_SAME_LIKE_OLD_ONE;
        // user mail cannot be empty and must be in email format
        } elseif (empty($usuario_email) || !filter_var($usuario_email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = MESSAGE_EMAIL_INVALID;

        } else if ($this->databaseConnection()) {
            // check if new email already exists
            $query_user = $this->db_connection->prepare('SELECT * FROM wm_usuarios WHERE usuario_email = :usuario_email');
            $query_user->bindValue(':usuario_email', $usuario_email, PDO::PARAM_STR);
            $query_user->execute();
            // get result row (as an object)
            $result_row = $query_user->fetchObject();

            // if this email exists
            if (isset($result_row->usuario_id)) {
                $this->errors[] = MESSAGE_EMAIL_ALREADY_EXISTS;
            } else {
                // write wm_usuarios new data into database
                $query_edit_usuario_email = $this->db_connection->prepare('UPDATE wm_usuarios SET usuario_email = :usuario_email WHERE usuario_id = :usuario_id');
                $query_edit_usuario_email->bindValue(':usuario_email', $usuario_email, PDO::PARAM_STR);
                $query_edit_usuario_email->bindValue(':usuario_id', $_SESSION['usuario_id'], PDO::PARAM_INT);
                $query_edit_usuario_email->execute();

                if ($query_edit_usuario_email->rowCount()) {
                    $_SESSION['usuario_email'] = $usuario_email;
                    $this->messages[] = MESSAGE_EMAIL_CHANGED_SUCCESSFULLY . $usuario_email;
                } else {
                    $this->errors[] = MESSAGE_EMAIL_CHANGE_FAILED;
                }
            }
        }
    }

    /**
     * Edit the user's password, provided in the editing form
     */
    public function editUserPassword($usuario_contrasena_old, $usuario_contrasena_new, $usuario_contrasena_repeat)
    {
        if (empty($usuario_contrasena_new) || empty($usuario_contrasena_repeat) || empty($usuario_contrasena_old)) {
            $this->errors[] = MESSAGE_PASSWORD_EMPTY;
        // is the repeat password identical to password
        } elseif ($usuario_contrasena_new !== $usuario_contrasena_repeat) {
            $this->errors[] = MESSAGE_PASSWORD_BAD_CONFIRM;
        // password need to have a minimum length of 6 characters
        } elseif (strlen($usuario_contrasena_new) < 6) {
            $this->errors[] = MESSAGE_PASSWORD_TOO_SHORT;

        // all the above tests are ok
        } else {
            // database query, getting hash of currently logged in user (to check with just provided password)
            $result_row = $this->getUserData($_SESSION['usuario_nombre_usuario']);

            // if this user exists
            if (isset($result_row->usuario_contrasena)) {

                // using PHP 5.5's password_verify() function to check if the provided passwords fits to the hash of that user's password
                if (password_verify($usuario_contrasena_old, $result_row->usuario_contrasena)) {

                    // now it gets a little bit crazy: check if we have a constant HASH_COST_FACTOR defined (in config/hashing.php),
                    // if so: put the value into $hash_cost_factor, if not, make $hash_cost_factor = null
                    $hash_cost_factor = (defined('HASH_COST_FACTOR') ? HASH_COST_FACTOR : null);

                    // crypt the user's password with the PHP 5.5's password_hash() function, results in a 60 character hash string
                    // the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using PHP 5.3/5.4, by the password hashing
                    // compatibility library. the third parameter looks a little bit shitty, but that's how those PHP 5.5 functions
                    // want the parameter: as an array with, currently only used with 'cost' => XX.
                    $usuario_contrasena = password_hash($usuario_contrasena_new, PASSWORD_DEFAULT, array('cost' => $hash_cost_factor));

                    // write wm_usuarios new hash into database
                    $query_update = $this->db_connection->prepare('UPDATE wm_usuarios SET usuario_contrasena = :usuario_contrasena WHERE usuario_id = :usuario_id');
                    $query_update->bindValue(':usuario_contrasena', $usuario_contrasena, PDO::PARAM_STR);
                    $query_update->bindValue(':usuario_id', $_SESSION['usuario_id'], PDO::PARAM_INT);
                    $query_update->execute();

                    // check if exactly one row was successfully changed:
                    if ($query_update->rowCount()) {
                        $this->messages[] = MESSAGE_PASSWORD_CHANGED_SUCCESSFULLY;
                    } else {
                        $this->errors[] = MESSAGE_PASSWORD_CHANGE_FAILED;
                    }
                } else {
                    $this->errors[] = MESSAGE_OLD_PASSWORD_WRONG;
                }
            } else {
                $this->errors[] = MESSAGE_USER_DOES_NOT_EXIST;
            }
        }
    }

    /**
     * Sets a random token into the database (that will verify the user when he/she comes back via the link
     * in the email) and sends the according email.
     */
    public function setPasswordResetDatabaseTokenAndSendMail($usuario_nombre_usuario)
    {
        $usuario_nombre_usuario = trim($usuario_nombre_usuario);

        if (empty($usuario_nombre_usuario)) {
            $this->errors[] = MESSAGE_USERNAME_EMPTY;

        } else {
            // generate timestamp (to see when exactly the user (or an attacker) requested the password reset mail)
            // btw this is an integer ;)
            $temporary_timestamp = time();
            // generate random hash for email password reset verification (40 char string)
            $usuario_contrasena_reset_hash = sha1(uniqid(mt_rand(), true));
            // database query, getting all the info of the selected user
            $result_row = $this->getUserData($usuario_nombre_usuario);

            // if this user exists
            if (isset($result_row->usuario_id)) {

                // database query:
                $query_update = $this->db_connection->prepare('UPDATE wm_usuarios SET usuario_contrasena_reset_hash = :usuario_contrasena_reset_hash,
                                                               usuario_contrasena_reset_timestamp = :usuario_contrasena_reset_timestamp
                                                               WHERE usuario_nombre_usuario = :usuario_nombre_usuario');
                $query_update->bindValue(':usuario_contrasena_reset_hash', $usuario_contrasena_reset_hash, PDO::PARAM_STR);
                $query_update->bindValue(':usuario_contrasena_reset_timestamp', $temporary_timestamp, PDO::PARAM_INT);
                $query_update->bindValue(':usuario_nombre_usuario', $usuario_nombre_usuario, PDO::PARAM_STR);
                $query_update->execute();

                // check if exactly one row was successfully changed:
                if ($query_update->rowCount() == 1) {
                    // send a mail to the user, containing a link with that token hash string
                    $this->sendPasswordResetMail($usuario_nombre_usuario, $result_row->usuario_email, $usuario_contrasena_reset_hash);
                    return true;
                } else {
                    $this->errors[] = MESSAGE_DATABASE_ERROR;
                }
            } else {
                $this->errors[] = MESSAGE_USER_DOES_NOT_EXIST;
            }
        }
        // return false (this method only returns true when the database entry has been set successfully)
        return false;
    }

    /**
     * Sends the password-reset-email.
     */
    public function sendPasswordResetMail($usuario_nombre_usuario, $usuario_email, $usuario_contrasena_reset_hash)
    {
        $mail = new PHPMailer;

        // please look into the config/config.php for much more info on how to use this!
        // use SMTP or use mail()
        if (EMAIL_USE_SMTP) {
            // Set mailer to use SMTP
            $mail->IsSMTP();
            //useful for debugging, shows full SMTP errors
            //$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
            // Enable SMTP authentication
            $mail->SMTPAuth = EMAIL_SMTP_AUTH;
            // Enable encryption, usually SSL/TLS
            if (defined(EMAIL_SMTP_ENCRYPTION)) {
                $mail->SMTPSecure = EMAIL_SMTP_ENCRYPTION;
            }
            // Specify host server
            $mail->Host = EMAIL_SMTP_HOST;
            $mail->Username = EMAIL_SMTP_USERNAME;
            $mail->Password = EMAIL_SMTP_PASSWORD;
            $mail->Port = EMAIL_SMTP_PORT;
        } else {
            $mail->IsMail();
        }

        $mail->From = EMAIL_PASSWORDRESET_FROM;
        $mail->FromName = EMAIL_PASSWORDRESET_FROM_NAME;
        $mail->AddAddress($usuario_email);
        $mail->Subject = EMAIL_PASSWORDRESET_SUBJECT;

        $link    = EMAIL_PASSWORDRESET_URL.'?usuario_nombre_usuario='.urlencode($usuario_nombre_usuario).'&verification_code='.urlencode($usuario_contrasena_reset_hash);
        $mail->Body = EMAIL_PASSWORDRESET_CONTENT . ' ' . $link;

        if(!$mail->Send()) {
            $this->errors[] = MESSAGE_PASSWORD_RESET_MAIL_FAILED . $mail->ErrorInfo;
            return false;
        } else {
            $this->messages[] = MESSAGE_PASSWORD_RESET_MAIL_SUCCESSFULLY_SENT;
            return true;
        }
    }

    /**
     * Checks if the verification string in the account verification mail is valid and matches to the user.
     */
    public function checkIfEmailVerificationCodeIsValid($usuario_nombre_usuario, $verification_code)
    {
        $usuario_nombre_usuario = trim($usuario_nombre_usuario);

        if (empty($usuario_nombre_usuario) || empty($verification_code)) {
            $this->errors[] = MESSAGE_LINK_PARAMETER_EMPTY;
        } else {
            // database query, getting all the info of the selected user
            $result_row = $this->getUserData($usuario_nombre_usuario);

            // if this user exists and have the same hash in database
            if (isset($result_row->usuario_id) && $result_row->usuario_contrasena_reset_hash == $verification_code) {

                $timestamp_one_hour_ago = time() - 3600; // 3600 seconds are 1 hour

                if ($result_row->usuario_contrasena_reset_timestamp > $timestamp_one_hour_ago) {
                    // set the marker to true, making it possible to show the password reset edit form view
                    $this->password_reset_link_is_valid = true;
                } else {
                    $this->errors[] = MESSAGE_RESET_LINK_HAS_EXPIRED;
                }
            } else {
                $this->errors[] = MESSAGE_USER_DOES_NOT_EXIST;
            }
        }
    }

    /**
     * Checks and writes the new password.
     */
    public function editNewPassword($usuario_nombre_usuario, $usuario_contrasena_reset_hash, $usuario_contrasena_new, $usuario_contrasena_repeat)
    {
        // TODO: timestamp!
        $usuario_nombre_usuario = trim($usuario_nombre_usuario);

        if (empty($usuario_nombre_usuario) || empty($usuario_contrasena_reset_hash) || empty($usuario_contrasena_new) || empty($usuario_contrasena_repeat)) {
            $this->errors[] = MESSAGE_PASSWORD_EMPTY;
        // is the repeat password identical to password
        } else if ($usuario_contrasena_new !== $usuario_contrasena_repeat) {
            $this->errors[] = MESSAGE_PASSWORD_BAD_CONFIRM;
        // password need to have a minimum length of 6 characters
        } else if (strlen($usuario_contrasena_new) < 6) {
            $this->errors[] = MESSAGE_PASSWORD_TOO_SHORT;
        // if database connection opened
        } else if ($this->databaseConnection()) {
            // now it gets a little bit crazy: check if we have a constant HASH_COST_FACTOR defined (in config/hashing.php),
            // if so: put the value into $hash_cost_factor, if not, make $hash_cost_factor = null
            $hash_cost_factor = (defined('HASH_COST_FACTOR') ? HASH_COST_FACTOR : null);

            // crypt the user's password with the PHP 5.5's password_hash() function, results in a 60 character hash string
            // the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using PHP 5.3/5.4, by the password hashing
            // compatibility library. the third parameter looks a little bit shitty, but that's how those PHP 5.5 functions
            // want the parameter: as an array with, currently only used with 'cost' => XX.
            $usuario_contrasena = password_hash($usuario_contrasena_new, PASSWORD_DEFAULT, array('cost' => $hash_cost_factor));

            // write wm_usuarios new hash into database
            $query_update = $this->db_connection->prepare('UPDATE wm_usuarios SET usuario_contrasena = :usuario_contrasena,
                                                           usuario_contrasena_reset_hash = NULL, usuario_contrasena_reset_timestamp = NULL
                                                           WHERE usuario_nombre_usuario = :usuario_nombre_usuario AND usuario_contrasena_reset_hash = :usuario_contrasena_reset_hash');
            $query_update->bindValue(':usuario_contrasena', $usuario_contrasena, PDO::PARAM_STR);
            $query_update->bindValue(':usuario_contrasena_reset_hash', $usuario_contrasena_reset_hash, PDO::PARAM_STR);
            $query_update->bindValue(':usuario_nombre_usuario', $usuario_nombre_usuario, PDO::PARAM_STR);
            $query_update->execute();

            // check if exactly one row was successfully changed:
            if ($query_update->rowCount() == 1) {
                $this->password_reset_was_successful = true;
                $this->messages[] = MESSAGE_PASSWORD_CHANGED_SUCCESSFULLY;
            } else {
                $this->errors[] = MESSAGE_PASSWORD_CHANGE_FAILED;
            }
        }
    }

    /**
     * Gets the success state of the password-reset-link-validation.
     * TODO: should be more like getPasswordResetLinkValidationStatus
     * @return boolean
     */
    public function passwordResetLinkIsValid()
    {
        return $this->password_reset_link_is_valid;
    }

    /**
     * Gets the success state of the password-reset action.
     * TODO: should be more like getPasswordResetSuccessStatus
     * @return boolean
     */
    public function passwordResetWasSuccessful()
    {
        return $this->password_reset_was_successful;
    }

    /**
     * Gets the username
     * @return string username
     */
    public function getUsername()
    {
        return $this->usuario_nombre_usuario;
    }
    public function getTypeOfUser()
    {
        if ($this->databaseConnection()) {
            // get real token from database (and all other data)
            $sth = $this->db_connection->prepare("SELECT usuario_id, usuario_tipo FROM wm_usuarios WHERE usuario_id = :usuario_id");
            $sth->bindValue(':usuario_id', $_SESSION['usuario_id'], PDO::PARAM_INT);
            $sth->execute();
            // get result row (as an object)
            $result_row = $sth->fetchObject();
            return $result_row->usuario_tipo;
        }
    }

    /**
     * Get either a Gravatar URL or complete image tag for a specified email address.
     * Gravatar is the #1 (free) provider for email address based global avatar hosting.
     * The URL (or image) returns always a .jpg file !
     * For deeper info on the different parameter possibilities:
     * @see http://de.gravatar.com/site/implement/images/
     *
     * @param string $email The email address
     * @param string $s Size in pixels, defaults to 50px [ 1 - 2048 ]
     * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
     * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
     * @param array $atts Optional, additional key/value attributes to include in the IMG tag
     * @source http://gravatar.com/site/implement/images/php/
     */
    public function getGravatarImageUrl($email, $s = 50, $d = 'mm', $r = 'g', $atts = array() )
    {
        $url = 'http://www.gravatar.com/avatar/';
        $url .= md5(strtolower(trim($email)));
        $url .= "?s=$s&d=$d&r=$r&f=y";

        // the image url (on gravatarr servers), will return in something like
        // http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=80&d=mm&r=g
        // note: the url does NOT have something like .jpg
        $this->user_gravatar_image_url = $url;

        // build img tag around
        $url = '<img src="' . $url . '"';
        foreach ($atts as $key => $val)
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';

        // the image url like above but with an additional <img src .. /> around
        $this->user_gravatar_image_tag = $url;
    }
}
