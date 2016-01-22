<h1>Hola desde mi Framework de PHP</h1>
<?php
if (isset($_POST["usuario_nombre"])) {
	echo "Has eviado un nombre de usuario" . $_POST['usuario_nombre'];
}else{
	echo HTML::open_form(ROUTER::create_action_url("demo/index"), "POST","form");
	echo HTML::label("usuario_nombre","Introduce tu nombre");
	echo HTML::input("text","usuario_nombre");
	echo HTML::button_HTML5("submit","Enviar!");
	echo $_POST['usuario_nombre'];
	echo HTML::close_form();
}
 ?>