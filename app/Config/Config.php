<?php
class Config{
    public $appName = "WhyMusic";
    public $layout = "layouts/layout";
    public $debug = true;
    public $db = array(
        'mysql' => array(
            'driver' => 'mysql',
            'dbname' => 'uqfhhbcn_whymusic',
            'host' => 'localhost:3306',
            'user' => 'uqfhhbcn',
            'password' => 'soserexo',
        ),
        'pgsql' => array(
            'driver' => 'pgsql',
            'dbname' => '',
            'host' => '',
            'port' => 5432,
            'user' => '',
            'password' => '',
        ),
    );
    public $mailer = array(
        'whymusic' => array(
            'isSMTP' => true,
            'SMTPAuth' => true,
            'SMTPSecure' => 'tls',
            'Host' => 'hl308.hosteurope.es',
            'Port' => 465,
            'Username' => 'no-reply@whymusic.es',
            'Password' => 'soserexo',
            'From' => 'no-reply@whymusic.es',
            'FromName' => 'Administrador',
        ),
        'whymuisc' => array(
            'isSMTP' => true,
            'SMTPAuth' => true,
            'SMTPSecure' => 'tls',
            'Host' => 'smtp.live.com',
            'Port' => 25,
            'Username' => 'user@hotmail.com',
            'Password' => 'password',
            'From' => 'user@hotmail.com',
            'FromName' => 'Administrator',
        ),
    );
    public $DirectoryIndex = "index.php?r=demo/index";
    public $ErrorPage = "index.php?r=demo/error";
    public $rules = array(
        "demo/index" => array(
             "?r=demo/index" => "index",
             "?r=demo/index&id=$1" => "index/id/([0-9]+)",
             "?r=demo/index&id=$1&title=$2" => "index/id/([0-9]+)/title/([a-zA-Z]+)",
        ),
        "login/login" => array(
            "?r=login/login" => "login",
        ),
        "login/register" => array(
            "?r=login/register" => "register",
        ),
        "admin/admin" => array(
            "?r=admin/admin" => "admin",
        ),
    );
}

define("DB_HOST", "localhost:3306");
define("DB_NAME", "uqfhhbcn_whymusic");
define("DB_USER", "uqfhhbcn");
define("DB_PASS", "soserexo");

define("COOKIE_RUNTIME", 1209600);
define("COOKIE_DOMAIN", ".whymusic.es");
define("COOKIE_SECRET_KEY", ")=$8h@TMPasfS{+$a98'¡*^sdf78sfpMJFe-92s");

define("EMAIL_USE_SMTP", true);
define("EMAIL_SMTP_HOST", "hl308.hosteurope.es");
define("EMAIL_SMTP_AUTH", true);
define("EMAIL_SMTP_USERNAME", "no-reply@whymusic.es");
define("EMAIL_SMTP_PASSWORD", "soserexo");
define("EMAIL_SMTP_PORT", 465);
define("EMAIL_SMTP_ENCRYPTION", "ssl");

define("EMAIL_PASSWORDRESET_URL", "http://whymusic.es/login");//http://whymusic.es/php-login-advanced/password_reset.php
define("EMAIL_PASSWORDRESET_FROM", "no-reply@whymusic.es");
define("EMAIL_PASSWORDRESET_FROM_NAME", "WhyMusic");
define("EMAIL_PASSWORDRESET_SUBJECT", "Reseteo de contraseña para WhyMusic");
define("EMAIL_PASSWORDRESET_CONTENT", "Por favor haz click en este email para resetear su contraseña:");

define("EMAIL_VERIFICATION_URL", "http://whymusic.es/login"); //http://whymusic.es/php-login-advanced/register.php
define("EMAIL_VERIFICATION_FROM", "no-reply@whymusic.es");
define("EMAIL_VERIFICATION_FROM_NAME", "WhyMusic");
define("EMAIL_VERIFICATION_SUBJECT", "Activar la cuenta en WhyMusic");
define("EMAIL_VERIFICATION_CONTENT", "Haz click en este enlace para activar la cuenta:");
define("HASH_COST_FACTOR", "10");