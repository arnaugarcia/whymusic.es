<?php
session_start();
class Config{
    public $debug = true;
    public $layout = "layouts/layout";
    /*public $rules = array(
         "demo/index" => array(
             "?r=demo/index" => "index",
             "?r=demo/index&id=$1" => "index/id/([0-9]+)",
             "?r=demo/index&id=$1&title=$2" => "index/id/([0-9]+)/title/([a-zA-Z]+)",
         ),
         "demo/login" => array(
             "?r=demo/login" => "login",
         ),
     );
    ^
    |
    |
    |
    LA PUTA MIERDA DE ARRAY PARA EL MÉTODO GET NO SIRVE PARA NADA. ATT: TU PUTO CEREBRO*/
}
?>
<?php
/*Conexion con la base de datos*/
define("DB_HOST", "localhost:3306");
define("DB_NAME", "uqfhhbcn_whymusic");
define("DB_USER", "uqfhhbcn");
define("DB_PASS", "soserexo");

/*Cookies y histórias*/
define("COOKIE_RUNTIME", 1209600);
define("COOKIE_DOMAIN", ".whymusic.es");
define("COOKIE_SECRET_KEY", "1gpasdgg4@TMPa42sdfS{+$78616331sfpMJFe-92s");

/*Email config*/
define("EMAIL_USE_SMTP", true);
define("EMAIL_SMTP_HOST", "mail.whymusic.es");
define("EMAIL_SMTP_AUTH", true);
define("EMAIL_SMTP_USERNAME", "no-reply@whymusic.es");
define("EMAIL_SMTP_PASSWORD", "whymusic.2015");
define("EMAIL_SMTP_PORT", 26);
define("EMAIL_SMTP_ENCRYPTION", null);
/**
 * Configuration for: password reset email data
 * Set the absolute URL to password_reset.php, necessary for email password reset links
 */
define("EMAIL_PASSWORDRESET_URL", URL::base_url().ROUTER::create_action_url("account/register"));
define("EMAIL_PASSWORDRESET_FROM", "no-reply@whymusic.es");
define("EMAIL_PASSWORDRESET_FROM_NAME", "WhyMusic");
define("EMAIL_PASSWORDRESET_SUBJECT", "Password reset for WhyMusic");
define("EMAIL_PASSWORDRESET_CONTENT", "Please click on this link to reset your password:");
/**
 * Configuration for: verification email data
 * Set the absolute URL to register.php, necessary for email verification links
 */
define("EMAIL_VERIFICATION_URL", URL::base_url().ROUTER::create_action_url("account/register"));
define("EMAIL_VERIFICATION_FROM", "no-reply@whymusic.es");
define("EMAIL_VERIFICATION_FROM_NAME", "Whymusic - Activación");
define("EMAIL_VERIFICATION_SUBJECT", "Activación de la cuenta en WhyMusic");
define("EMAIL_VERIFICATION_CONTENT", "Haz click en este enlace en activar tu cuenta:");
/*Hash Factor*/
define("HASH_COST_FACTOR", "10");
