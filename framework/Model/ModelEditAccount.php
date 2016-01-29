<?php
/**
* Clase encargada de que lo usuarios rellenen sus datos según su tipo de cuenta
*/
class EditAccount
{
	public function formMusico()
	{
		echo "<h1>Formulario Musico:</h1>";
		echo HTML::open_form(ROUTER::create_action_url('account/edit'), "POST","form_edit_account");

		echo HTML::label("usuario_nombre","Nombre:");
		echo HTML::input("text","usuario_nombre",null,array("placeholder" => "Su nombre"));
		echo HTML::br(2);

		echo HTML::label("usuario_apellido1","Primer Apellido:");
		echo HTML::input("text","usuario_apellido1",null,array("placeholder" => "Su apellido"));
		echo HTML::br(2);

		echo HTML::label("usuario_apellido2","Segundo Apellido:");
		echo HTML::input("text","usuario_apellido2",null,array("placeholder" => "Su segundo apellido"));
		echo HTML::br(2);

		echo HTML::label("usuario_idioma","Idioma:");
		echo HTML::select("usuario_idioma",array("ingles" => "en", "castellano" => "es", "catalan" => "ca"));
		echo HTML::br(2);

		echo HTML::button_HTML5("submit","Modifica los datos!");
		echo HTML::close_form();
	}
}
 ?>