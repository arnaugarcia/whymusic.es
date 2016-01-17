<h1>Hola desde Login</h1>
<a href="<?php echo ROUTER::create_action_url('demo/index'); ?>">Inicio</a>
<a href="<?php echo ROUTER::create_action_url('account/login'); ?>">Login</a>
<?php 
echo HTML::open_div(array("id" => "login"));
echo HTML::open_form( ROUTER::create_action_url('account/login'), "POST","form_login");
echo HTML::label("usuario_nombre","Introduce tu nombre de usuario");
echo HTML::input("text","usuario_nombre",null,array("placeholder" => "Introduce tu nombre de usuario"));
echo HTML::label("usuario_password","Introduce tu contraseña");
echo HTML::input("password","usuario_password",null,array("placeholder" => "········"));
echo HTML::button_HTML5("submit","Entrar!");
echo HTML::close_form();
echo HTML::close_div();
echo HTML::br(3);
 ?>