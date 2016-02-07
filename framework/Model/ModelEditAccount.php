<?php
/**
* Clase encargada de que lo usuarios rellenen sus datos según su tipo de cuenta
*/
class EditAccount
{
	public function formMusico()
	{
        $login = new ModelLogin();
		if(isset($_POST['form_edit_account'])){
			if (empty($_POST['usuario_nombre'])) {
            echo MESSAGE_FORM_NOMBRE_EMPTY;
            echo HTML::br(2);
            echo "<a href='javascript:history.back()'> Volver Atrás</a>";
        } elseif (empty($_POST['usuario_apellido1']) || empty($_POST['usuario_apellido2'])) {
            echo MESSAGE_FORM_APELLIDO_EMPTY;
            echo HTML::br(2);
            echo "<a href='javascript:history.back()'> Volver Atrás</a>";
        } elseif (strlen($_POST['usuario_nombre']) > 64 || strlen($_POST['usuario_nombre']) < 2) {
            echo MESSAGE_FROM_NOMBRE_LENGHT;
            echo HTML::br(2);
            echo "<a href='javascript:history.back()'> Volver Atrás</a>";
        } elseif (!preg_match('/^[a-z\d]{2,64}$/i', $_POST['usuario_nombre'])) {
           	echo MESSAGE_FORM_TELEFONO_EMPTY;
            echo HTML::br(2);
            echo "<a href='javascript:history.back()'> Volver Atrás</a>";
        } elseif (strlen($_POST['usuario_telefono']) != 9) {
            echo MESSAGE_FORM_TELEFONO_INVALID;
            echo HTML::br(2);
            echo "<a href='javascript:history.back()'> Volver Atrás</a>";
        } elseif ($_POST['usuario_idioma']=="") {
            $_POST['usuario_idioma']==$login->getFormData($_SESSION['usuario_nombre_usuario'], "usuario_idioma");
        } elseif ($_POST['usuario_idioma']!="ca" && $_POST['usuario_idioma']!="en" && $_POST['usuario_idioma']!="es") {
            echo MESSAGE_FORM_IDIOMA;
            echo HTML::br(2);
            echo "<a href='javascript:history.back()'> Volver Atrás</a>";
        } else{
            $query_mod_account = DB::connect()->prepare("UPDATE  `uqfhhbcn_whymusic`.`wm_usuarios` SET  `usuario_nombre` =  :usuario_nombre,
			`usuario_apellido1` =  :usuario_apellido1,
			`usuario_apellido2` =  :usuario_apellido2,
			`usuario_telefono` =  :usuario_telefono,
            `usuario_idioma` = :usuario_idioma WHERE  `wm_usuarios`.`usuario_nombre_usuario` =:usuario_nombre_usuario;");
            $query_mod_account->bindValue(':usuario_nombre_usuario', $_SESSION['usuario_nombre_usuario'], PDO::PARAM_STR);
            $query_mod_account->bindValue(':usuario_nombre', $_POST['usuario_nombre'], PDO::PARAM_STR);
            $query_mod_account->bindValue(':usuario_apellido1', $_POST['usuario_apellido1'], PDO::PARAM_STR);
            $query_mod_account->bindValue(':usuario_apellido2', $_POST['usuario_apellido2'], PDO::PARAM_STR);
            $query_mod_account->bindValue(':usuario_idioma', $_POST['usuario_idioma'], PDO::PARAM_STR);
            $query_mod_account->bindValue(':usuario_telefono', $_POST['usuario_telefono'], PDO::PARAM_STR);
            $query_mod_account->execute();
            // if username or/and email find in the database
            // TODO: this is really awful!
            if ($query_mod_account) {
                echo MESSAGE_CORRECT_MOD;
                ROUTER::redirect_to_action("account/edit",2);
            }else{
            	echo MESSAGE_ERROR_SQL;
                echo HTML::br(2);
                echo "<a href='javascript:history.back()'> Volver Atrás</a>";
            }
        }
		}else{
			echo HTML::open_form(ROUTER::create_action_url('account/edit'), "POST","form_edit_account");

			echo HTML::label("usuario_nombre", WORDING_USERNAME);
			echo HTML::input("text","usuario_nombre",$login->getFormData($_SESSION['usuario_nombre_usuario'],"usuario_nombre"),array("placeholder" => "Su nombre"));
			echo HTML::br(2);

			echo HTML::label("usuario_apellido1",WORDING_APELLIDO1);
			echo HTML::input("text","usuario_apellido1",$login->getFormData($_SESSION['usuario_nombre_usuario'],"usuario_apellido1"),array("placeholder" => "Su apellido"));
			echo HTML::br(2);

			echo HTML::label("usuario_apellido2",WORDING_APELLIDO2);
			echo HTML::input("text","usuario_apellido2",$login->getFormData($_SESSION['usuario_nombre_usuario'],"usuario_apellido2"),array("placeholder" => "Su segundo apellido"));
			echo HTML::br(2);

			echo HTML::label("usuario_idioma",WORDING_IDIOMA);
			echo HTML::select("usuario_idioma",array("Idioma por defecto" => $login->getFormData($_SESSION['usuario_nombre_usuario'],'usuario_idioma'), "Inglés" => "en", "Castellano" => "es", "Catalán" => "ca"));
			echo HTML::br(2);

			echo HTML::label("usuario_telefono",WORDING_TELEFON);
			echo HTML::input("text","usuario_telefono",$login->getFormData($_SESSION['usuario_nombre_usuario'],"usuario_telefono"),array("placeholder" => "9XXXXXXXX"));
			echo HTML::br(2);

			echo HTML::button_HTML5("submit",BUTTON_MOD_DATA,"form_edit_account");
			echo HTML::close_form();
		}
	}
    public function formLocal()
    {
        $login = new ModelLogin();
        if(isset($_POST['form_edit_account'])){
            if (empty($_POST['usuario_nombre'])) {
            echo MESSAGE_FORM_NOMBRE_EMPTY;
            echo HTML::br(2);
            echo "<a href='javascript:history.back()'> Volver Atrás</a>";
        } elseif (empty($_POST['usuario_apellido1']) || empty($_POST['usuario_apellido2'])) {
            echo MESSAGE_FORM_APELLIDO_EMPTY;
            echo HTML::br(2);
            echo "<a href='javascript:history.back()'> Volver Atrás</a>";
        } elseif (strlen($_POST['usuario_nombre']) > 64 || strlen($_POST['usuario_nombre']) < 2) {
            echo MESSAGE_FROM_NOMBRE_LENGHT;
            echo HTML::br(2);
            echo "<a href='javascript:history.back()'> Volver Atrás</a>";
        } elseif (!preg_match('/^[a-z\d]{2,64}$/i', $_POST['usuario_nombre'])) {
            echo MESSAGE_FORM_NOMBRE_CARACTER;
            echo HTML::br(2);
            echo "<a href='javascript:history.back()'> Volver Atrás</a>";
        } elseif (empty($_POST['usuario_telefono'])) {
            echo MESSAGE_FORM_TELEFONO_EMPTY;
            echo HTML::br(2);
            echo "<a href='javascript:history.back()'> Volver Atrás</a>";
        } elseif (strlen($_POST['usuario_telefono']) != 9) {
            echo MESSAGE_FORM_TELEFONO_INVALID;
            echo HTML::br(2);
            echo "<a href='javascript:history.back()'> Volver Atrás</a>";
        } elseif ($_POST['usuario_idioma']=="") {
            $_POST['usuario_idioma']==$login->getFormData($_SESSION['usuario_nombre_usuario'], "usuario_idioma");
        } elseif ($_POST['usuario_idioma']!="ca" && $_POST['usuario_idioma']!="en" && $_POST['usuario_idioma']!="es") {
            echo MESSAGE_FORM_IDIOMA;
            echo HTML::br(2);
            echo "<a href='javascript:history.back()'> Volver Atrás</a>";
        } else{
            $query_mod_account = DB::connect()->prepare("UPDATE  `uqfhhbcn_whymusic`.`wm_usuarios` SET  `usuario_nombre` =  :usuario_nombre,
            `usuario_apellido1` =  :usuario_apellido1,
            `usuario_apellido2` =  :usuario_apellido2,
            `usuario_telefono` =  :usuario_telefono,
            `usuario_idioma` = :usuario_idioma WHERE  `wm_usuarios`.`usuario_nombre_usuario` =:usuario_nombre_usuario;");
            $query_mod_account->bindValue(':usuario_nombre_usuario', "musico" , PDO::PARAM_STR);
            $query_mod_account->bindValue(':usuario_nombre', $_POST['usuario_nombre'], PDO::PARAM_STR);
            $query_mod_account->bindValue(':usuario_apellido1', $_POST['usuario_apellido1'], PDO::PARAM_STR);
            $query_mod_account->bindValue(':usuario_apellido2', $_POST['usuario_apellido2'], PDO::PARAM_STR);
            $query_mod_account->bindValue(':usuario_idioma', $_POST['usuario_idioma'], PDO::PARAM_STR);
            $query_mod_account->bindValue(':usuario_telefono', $_POST['usuario_telefono'], PDO::PARAM_STR);
            $query_mod_account->execute();
            // if username or/and email find in the database
            // TODO: this is really awful!
            if ($query_mod_account) {
                echo MESSAGE_CORRECT_MOD;
                ROUTER::redirect_to_action("account/edit",2);
            }else{
                echo MESSAGE_ERROR_SQL;
                echo HTML::br(2);
                echo "<a href='javascript:history.back()'> Volver Atrás</a>";
            }
        }
        }else{
            echo HTML::open_form(ROUTER::create_action_url('account/edit'), "POST","form_edit_account");

            echo HTML::label("usuario_nombre", WORDING_USERNAME);
            echo HTML::input("text","usuario_nombre",$login->getFormData($_SESSION['usuario_nombre_usuario'],"usuario_nombre"),array("placeholder" => "Su nombre"));
            echo HTML::br(2);

            echo HTML::label("usuario_apellido1",WORDING_APELLIDO1);
            echo HTML::input("text","usuario_apellido1",$login->getFormData($_SESSION['usuario_nombre_usuario'],"usuario_apellido1"),array("placeholder" => "Su apellido"));
            echo HTML::br(2);

            echo HTML::label("usuario_apellido2",WORDING_APELLIDO2);
            echo HTML::input("text","usuario_apellido2",$login->getFormData($_SESSION['usuario_nombre_usuario'],"usuario_apellido2"),array("placeholder" => "Su segundo apellido"));
            echo HTML::br(2);

            echo HTML::label("usuario_idioma",WORDING_IDIOMA);
            echo HTML::select("usuario_idioma",array("Idioma por defecto" => $login->getFormData($_SESSION['usuario_nombre_usuario'],'usuario_idioma'), "Inglés" => "en", "Castellano" => "es", "Catalán" => "ca"));
            echo HTML::br(2);

            echo HTML::label("usuario_telefono",WORDING_TELEFON);
            echo HTML::input("text","usuario_telefono",$login->getFormData($_SESSION['usuario_nombre_usuario'],"usuario_telefono"),array("placeholder" => "9XXXXXXXX"));
            echo HTML::br(2);

            echo HTML::button_HTML5("submit",BUTTON_MOD_DATA,"form_edit_account");
            echo HTML::close_form();
        }
    }
}
 ?>