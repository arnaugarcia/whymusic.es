<?php
echo HTML::open_form(array(
    "method" => "POST",
    "name" => 	"loginform",
    "action" => ROUTER::create_action_url("login/register"),
    "enctype" => "multipart/form-data",
	));
	echo HTML::label("user_name", WORDING_USERNAME);
	echo HTML::input("text","usuario_nombre",null,array("placeholder" => WORDING_USERNAME));
	echo HTML::br(2);
	echo HTML::label("text","Email");
	echo HTML::input("email","usuario_email",null,array("placeholder" => "nombre@host.com"));
	echo HTML::br(2);
	echo HTML::label("user_password", WORDING_PASSWORD);
	echo HTML::input("password","usuario_contrasena",null, array("placeholder" => WORDING_PASSWORD));
	echo HTML::br(2);
	echo HTML::label("user_password_repeat", WORDING_PASSWORD);
	echo HTML::input("password","usuario_contrasena_repeat",null, array("placeholder" => WORDING_PASSWORD));
	echo HTML::br(2);
	echo HTML::button_HTML5("submit","Enviar!",array("name" => "register"));
	echo HTML::close_form();
 ?>