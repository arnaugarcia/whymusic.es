<h1>Hola desde Login</h1>

<?php
$login = new ModelLogin();
if(isset($login)) {
    if($login->errors) {
        foreach ($login->errors as $error) {
            echo HTML::open_div(array("class" => "form-group has-error"));
            echo HTML::label("usuario_nombre_usuario",$error, array("class" => "control-label"));
            echo HTML::close_div();
        }
    }
    if($login->messages) {
        foreach ($login->messages as $message) {
           echo HTML::open_div(array("class" => "form-group has-error"));
           echo HTML::label("usuario_nombre_usuario",$message, array("class" => "control-label"));
           echo HTML::close_div();
        }
    }
}
if ($login->isUserLoggedIn() == true) {
    ROUTER::redirect_to_action("account/user");
} else {

	echo ROUTER::create_action_url("account/login");
    echo HTML::open_div(array("id" => "login"));
	echo HTML::open_form( ROUTER::create_action_url('account/login'), "POST","form_login");

	echo HTML::label("usuario_nombre_usuario","Introduce tu nombre de usuario");
	echo HTML::input("text","usuario_nombre_usuario",null,array("placeholder" => "Introduce tu nombre de usuario"));

	echo HTML::label("usuario_contrasena","Introduce tu contraseña");
	echo HTML::input("password","usuario_contrasena",null,array("placeholder" => "········"));

	echo HTML::label("usuario_recuerdame","Recordar session?");
	echo HTML::checkbox("usuario_recuerdame","usuario_recuerdame",false);

	echo HTML::button_HTML5("submit","Entrar!","login");

	echo HTML::close_form();
	echo HTML::close_div();
	echo HTML::br(3);
}
?>