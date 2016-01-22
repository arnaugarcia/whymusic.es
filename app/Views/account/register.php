<h1>Hola desde Register</h1>
<?php
$registration = new ModelRegistration();
if (isset($registration)) {
    if ($registration->errors) {
        foreach ($registration->errors as $error) {
            echo $error;
        }
    }
    if ($registration->messages) {
        foreach ($registration->messages as $message) {
            echo $message;
        }
    }
}
echo ROUTER::create_action_url("account/register");
if (!$registration->registration_successful && !$registration->verification_successful) {
	echo HTML::open_div(array("id" => "login"));
	echo HTML::open_form( ROUTER::create_action_url('account/register'), "POST","registerform");

	echo HTML::label("user_name","Introduce tu nombre de usuario");
	echo HTML::input("text","user_name",null,array("placeholder" => "Introduce tu nombre de usuario", "required" => "required"));

	echo HTML::label("user_email","Introduce tu email");
	echo HTML::input("email","user_email",null,array("required" => "required"));

	echo HTML::label("user_password_new","Introduce tu contraseña");
	echo HTML::input("password","user_password_new",null,array("placeholder" => "········"));

	echo HTML::label("user_password_repeat","Introduce tu contraseña");
	echo HTML::input("password","user_password_repeat",null,array("placeholder" => "········"));
	
	echo HTML::button_HTML5("submit","Entrar!",array("name" => "register"));
	echo HTML::close_form();
	echo HTML::close_div();
	echo HTML::br(3);
	echo $_GET['id'];
	echo $_GET['verifiaction_code'];
 }?>
