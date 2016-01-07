<?php 
	echo HTML::open_div(array("class" => "box"));
	echo HTML::open_div(array("class" => "box-izquierdo"));
	echo "<h1>Bienvenido a WhyMusic</h1>";
	echo "<p>¿Eres nuevo en WhyMusic? ¡Regístrate ".HTML::a( $_SERVER['SCRIPT_NAME'] . "?action=register","aquí")."!</p>";
	echo "<p>Conéctate con tus amigos, con los mejores grupos y otras personas aficionadas a la música. Obtén actualizaciones instantáneas de las cosas que te interesan. Mira los eventos que se están desarrollando, en tiempo real.</p>";
	echo HTML::close_div();
	echo HTML::open_div(array("class" => "box-derecho"));
	echo HTML::open_form(array(
    "method" => "POST",
    "name" => 	"loginform",
    "action" => ROUTER::create_action_url("login/login"),
    "enctype" => "multipart/form-data",
	));
	echo HTML::label("user_name", WORDING_USERNAME);
	echo HTML::input("text","user_name",null,array("placeholder" => WORDING_USERNAME));
	echo HTML::br(2);
	echo HTML::label("user_password", WORDING_PASSWORD);
	echo HTML::input("password","user_password",null, array("placeholder" => WORDING_PASSWORD));
	echo HTML::br(2);
	echo HTML::input("checkbox","user_rememberme",null);
	echo HTML::label("user_rememberme", WORDING_REMEMBER_ME);
	echo HTML::label("forgot",HTML::a("#","Ha olvidado la contraseña?"));
	echo HTML::br(2);
	echo HTML::button_HTML5("submit","Enviar!",array("name" => "login"));
	echo HTML::close_form();
	echo HTML::close_div();
	echo HTML::close_div();
 ?>