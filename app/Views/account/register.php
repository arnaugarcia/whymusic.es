<h1>Hola desde Register</h1>
<?php
$registration = new ModelRegistration();
if (isset($registration)) {
    if ($registration->errors) {
        foreach ($registration->errors as $error) {
            echo "Error" . $error;
        }
    }
    if ($registration->messages) {
        foreach ($registration->messages as $message) {
            echo "Mensaje: " . $message;
        }
    }
}
echo ROUTER::create_action_url("account/register");
if (!$registration->registration_successful && !$registration->verification_successful) {
	echo HTML::open_div(array("id" => "login"));
	echo HTML::open_form( ROUTER::create_action_url('account/register'), "POST","registerform");

	echo HTML::label("fan","Fan");
	echo HTML::input("radio","usuario_tipo", "fan", array("checked" => "checked"));

	echo HTML::label("musico","Musico");
	echo HTML::input("radio","usuario_tipo", "musico");

	echo HTML::label("local","Local");
	echo HTML::input("radio","usuario_tipo", "local");
	echo HTML::br(2);

	echo HTML::label("usuario_nombre_usuario","Nick:");
	echo HTML::input("text","usuario_nombre_usuario",null,array("placeholder" => "Introduce tu nombre de usuario", "required" => "required"));
	echo HTML::br(2);

	echo HTML::label("usuario_email","Introduce tu email:");
	echo HTML::input("email","usuario_email",null,array("required" => "required"));
	echo HTML::br(2);

	echo HTML::label("usuario_contrasena","Introduce tu contraseña:");
	echo HTML::input("password","usuario_contrasena",null,array("placeholder" => "········"));
	echo HTML::br(2);

	echo HTML::label("usuario_contrasena_repeat","Repite tu contraseña:");
	echo HTML::input("password","usuario_contrasena_repeat",null,array("placeholder" => "········"));
	echo HTML::br(2);

	echo HTML::button_HTML5("submit","Regístrame!","register");
	echo HTML::close_form();
	echo HTML::close_div();
	echo HTML::br(3);

 }?>
