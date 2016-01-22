<h1>Hola desde Login</h1>
<?php
$login = new ModelLogin();
if(isset($login)) {
    if($login->errors) {
        foreach ($login->errors as $error) {
            echo $error;
        }
    }
    if($login->messages) {
        foreach ($login->messages as $message) {
            echo $message;
        }
    }
}
if ($login->isUserLoggedIn() == true) {
    ROUTER::redirect_to_action("account/user");
} else {
	echo ROUTER::create_action_url("account/login");
    echo HTML::open_div(array("id" => "login"));
	echo HTML::open_form( ROUTER::create_action_url('account/login'), "POST","form_login");
	echo HTML::label("user_name","Introduce tu nombre de usuario");
	echo HTML::input("text","user_name",null,array("placeholder" => "Introduce tu nombre de usuario"));
	echo HTML::label("user_password","Introduce tu contraseña");
	echo HTML::input("password","user_password",null,array("placeholder" => "········"));
	echo HTML::label("user_rememberme","Recordar session?");
	echo HTML::checkbox("user_rememberme","user_rememberme",false);
	echo HTML::button_HTML5("submit","Entrar!",array("name" => "login"));
	echo HTML::close_form();
	echo HTML::close_div();
	echo HTML::br(3);
	echo $_GET['user_name'];
}
?>