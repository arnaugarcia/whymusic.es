<?php
/**
* Modelo para conseguir las fichas de los usuarios
*/
class showDataAccount
{

	public function getProfileData($usuario_id, $usuario_tipo)
	{
        $login = new ModelLogin();
        $DB = new DB();

		switch ($usuario_tipo) {

            case "musico":
                echo HTML::label("usuario_foto",WORDING_PROFILE_PICTURE);
                //echo WORDING_PROFILE_PICTURE . '<br/><img src="' . $login->user_gravatar_image_url . '" />;
                echo $login->user_gravatar_image_tag;
                echo HTML::br(2);

                echo HTML::label("usuario_nombre","Nombre banda: ");
                echo $login->getUserDataCampo($login->getUserId(),"usuario_nombre");
                echo HTML::br(2);

                echo HTML::label("usuario_nombre","Idioma  de la web:");
                echo $DB->getIdioma($login->getUserId());
                echo HTML::br(2);

                echo HTML::label("estilo_id","Estilo de música:");
                echo $DB->getUserDataEstilo($login->getUserDataCampo($login->getUserId(),"estilo_id"));
                echo HTML::br(2);

                echo HTML::a(ROUTER::create_action_url('account/edit'),WORDING_EDIT_USER_DATA, array("class" => "btn btn-default"));

                echo HTML::a(ROUTER::create_action_url('account/logout&logout'),WORDING_LOGOUT, array("class" => "btn btn-default"));
                break;


            case "fan":
                echo HTML::label("usuario_foto",WORDING_PROFILE_PICTURE);
                //echo WORDING_PROFILE_PICTURE . '<br/><img src="' . $login->user_gravatar_image_url . '" />;
                echo $login->user_gravatar_image_tag;
                echo HTML::br(2);

                echo HTML::label("usuario_nombre_usuario","Nombre de usuario: ");
                echo $login->getUserDataCampo($login->getUserId(),"usuario_nombre_usuario");
                echo HTML::br(2);

                echo HTML::label("usuario_tipo","Tipo de cuenta: ");
                echo $login->getUserDataCampo($login->getUserId(),"usuario_tipo");
                echo HTML::br(2);

                echo HTML::label("usuario_nombre","Nombre:");
                echo $login->getUserDataCampo($login->getUserId(),"usuario_nombre");
                echo HTML::br(2);

                echo HTML::label("usuario_apellido1","Apellido:");
                echo $login->getUserDataCampo($login->getUserId(),"usuario_apellido1");
                echo HTML::br(2);

                echo HTML::label("usuario_apellido2","Segundo apellido:");
                echo $login->getUserDataCampo($login->getUserId(),"usuario_apellido2");
                echo HTML::br(2);

                echo HTML::label("usuario_nombre","Idioma de la web:");
                echo $DB->getIdioma($login->getUserId());
                echo HTML::br(2);

                echo HTML::a(ROUTER::create_action_url('account/edit'),WORDING_EDIT_USER_DATA, array("class" => "btn btn-default"));

                echo HTML::a(ROUTER::create_action_url('account/logout&logout'),WORDING_LOGOUT, array("class" => "btn btn-default"));
                break;


                case "local":
                echo HTML::label("usuario_foto",WORDING_PROFILE_PICTURE);
                //echo WORDING_PROFILE_PICTURE . '<br/><img src="' . $login->user_gravatar_image_url . '" />;
                echo $login->user_gravatar_image_tag;
                echo HTML::br(2);

                echo HTML::label("usuario_nombre_usuario","Nombre de usuario: ");
                echo $login->getUserDataCampo($login->getUserId(),"usuario_nombre_usuario");
                echo HTML::br(2);

                echo HTML::label("usuario_tipo","Tipo de cuenta: ");
                echo $login->getUserDataCampo($login->getUserId(),"usuario_tipo");
                echo HTML::br(2);

                echo HTML::label("usuario_nombre","Idioma  de la web:");
                echo $DB->getIdioma($login->getUserId());
                echo HTML::br(2);

                echo HTML::label("usuario_nombre",WORDING_NOMBRE_LOCAL);
                echo $login->getUserDataCampo($login->getUserId(),"usuario_nombre");
                echo HTML::br(2);

                echo HTML::a(ROUTER::create_action_url('account/edit'),WORDING_EDIT_USER_DATA, array("class" => "btn btn-default"));

                echo HTML::a(ROUTER::create_action_url('account/logout&logout'),WORDING_LOGOUT, array("class" => "btn btn-default"));
                    break;


                case "administrador":
                echo HTML::label("usuario_foto",WORDING_PROFILE_PICTURE);
                //echo WORDING_PROFILE_PICTURE . '<br/><img src="' . $login->user_gravatar_image_url . '" />;
                echo $login->user_gravatar_image_tag;
                echo HTML::br(2);

                echo HTML::label("usuario_nombre_usuario","Nombre de usuario: ");
                echo $login->getUserDataCampo($login->getUserId(),"usuario_nombre_usuario");
                echo HTML::br(2);

                echo HTML::label("usuario_tipo","Tipo de cuenta: ");
                echo $login->getUserDataCampo($login->getUserId(),"usuario_tipo");
                echo HTML::br(2);

                echo HTML::label("usuario_nombre","Nombre:");
                echo $login->getUserDataCampo($login->getUserId(),"usuario_nombre");
                echo HTML::br(2);

                echo HTML::label("usuario_apellido1","Apellido:");
                echo $login->getUserDataCampo($login->getUserId(),"usuario_apellido1");
                echo HTML::br(2);

                echo HTML::label("usuario_apellido2","Segundo apellido:");
                echo $login->getUserDataCampo($login->getUserId(),"usuario_apellido2");
                echo HTML::br(2);

                echo HTML::label("usuario_nombre","Idioma  de la web:");
                echo $DB->getIdioma($login->getUserId());
                echo HTML::br(2);

                echo HTML::a(ROUTER::create_action_url('account/edit'),WORDING_EDIT_USER_DATA, array("class" => "btn btn-default"));

                echo HTML::a(ROUTER::create_action_url('account/logout&logout'),WORDING_LOGOUT, array("class" => "btn btn-default"));
                    break;
            default:
               echo "DA FUCK ARE YOU DOING HERE?";
                break;
        }
	}
}


class EditAccount
{
	public function usuarioEdit($usuario_id, $usuario_tipo)
	{
        $getDataDB = new DB();
        $login = new ModelLogin();
        $image = new ModelImage();
        switch ($usuario_tipo) {
            case "musico":
            if(isset($_POST['form_edit_account'])){
                if (empty($_POST['usuario_nombre'])) {
                echo MESSAGE_FORM_NOMBRE_EMPTY;
                echo HTML::br(2);
                echo "<a href='javascript:history.back()'> Volver Atrás</a>";
            } elseif (!preg_match('/^[a-z\d]{2,64}$/i', $_POST['usuario_telefono'])) {
                echo MESSAGE_FORM_TELEFONO_EMPTY;
                echo HTML::br(2);
                echo "<a href='javascript:history.back()'> Volver Atrás</a>";
            } elseif (strlen($_POST['usuario_telefono']) != 9) {
                echo MESSAGE_FORM_TELEFONO_INVALID;
                echo HTML::br(2);
                echo "<a href='javascript:history.back()'> Volver Atrás</a>";
            } elseif ($_POST['usuario_idioma']=="") {
                $_POST['usuario_idioma']==$login->getUserDataCampo($usuario_id, "usuario_idioma");
            } elseif ($_POST['usuario_idioma']!="ca" && $_POST['usuario_idioma']!="en" && $_POST['usuario_idioma']!="es") {
                echo MESSAGE_FORM_IDIOMA;
                echo HTML::br(2);
                echo "<a href='javascript:history.back()'> Volver Atrás</a>";
            } elseif ($_POST['usuario_idioma']!="ca" && $_POST['usuario_idioma']!="en" && $_POST['usuario_idioma']!="es") {
                echo MESSAGE_FORM_IDIOMA;
                echo HTML::br(2);
                echo "<a href='javascript:history.back()'> Volver Atrás</a>";
            } else{
                $query_mod_account = DB::connect()->prepare("UPDATE  `uqfhhbcn_whymusic`.`wm_usuarios` SET  `usuario_nombre` =  :usuario_nombre,
                `usuario_telefono` =  :usuario_telefono,
                `usuario_idioma` = :usuario_idioma,
                `usuario_descripcion` = :usuario_descripcion,
                `estilo_id` = :estilo_id WHERE  `wm_usuarios`.`usuario_id` = :usuario_id;");
                $query_mod_account->bindValue(':usuario_id', $usuario_id, PDO::PARAM_STR);
                $query_mod_account->bindValue(':usuario_nombre', $_POST['usuario_nombre'], PDO::PARAM_STR);
                $query_mod_account->bindValue(':usuario_idioma', $_POST['usuario_idioma'], PDO::PARAM_STR);
                $query_mod_account->bindValue(':usuario_telefono', $_POST['usuario_telefono'], PDO::PARAM_STR);
                $query_mod_account->bindValue(':usuario_descripcion', $_POST['usuario_descripcion'], PDO::PARAM_STR);
                $query_mod_account->bindValue(':estilo_id', $_POST['estilo_nombre'], PDO::PARAM_STR);
                $query_mod_account->execute();
                if ($query_mod_account) {
                    echo MESSAGE_CORRECT_MOD;
                    if ($login->getTypeOfUser()=="administrador") {
                        ROUTER::redirect_to_action("admin/admin",2);
                    }else{
                        ROUTER::redirect_to_action("account/edit",2);
                    }
                }else{
                    echo MESSAGE_ERROR_SQL;
                    echo HTML::br(2);
                    echo "<a href='javascript:history.back()'> Volver Atrás</a>";
                }
            }
            }else{
                echo HTML::open_form(ROUTER::create_action_url('account/edit'), "POST","form_edit_account");
                /*Guarrada provisional*/
                $_SESSION['usuario_id_edit']=$login->getUserDataCampo($usuario_id,"usuario_id");
                $_SESSION['usuario_tipo_edit']=$login->getUserDataCampo($usuario_id,"usuario_tipo");
                /*Fin de la gurrada*/
                echo HTML::label("usuario_nombre", WORDING_NOMBRE_MUSICO);
                echo HTML::input("text","usuario_nombre",$login->getUserDataCampo($usuario_id,"usuario_nombre"),array("placeholder" => "Su nombre"));
                echo HTML::br(2);

                echo HTML::label("usuario_idioma", WORDING_IDIOMA);
                echo HTML::select("usuario_idioma",array("Idioma por defecto" => $login->getUserDataCampo($usuario_id,'usuario_idioma'), "Inglés" => "en", "Castellano" => "es", "Catalán" => "ca"));
                echo HTML::br(2);

                echo HTML::label("usuario_telefono", WORDING_TELEFON);
                echo HTML::input("text","usuario_telefono",$login->getUserDataCampo($usuario_id,"usuario_telefono"),array("placeholder" => "9XXXXXXXX"));
                echo HTML::br(2);

                echo HTML::label("usuario_descripcion", "Descripción grupo:");
                echo HTML::textArea("4","50",$login->getUserDataCampo($usuario_id,"usuario_descripcion"),"usuario_descripcion");
                echo HTML::br(2);

                echo HTML::label("estilo_nombre","Estilo de música:");
                echo HTML::selectArray("estilo_nombre",$getDataDB->getFieldSQL("wm_estilo","estilo_nombre , estilo_id",""));
                echo HTML::br(2);

                echo HTML::button_HTML5("submit", BUTTON_MOD_DATA,"form_edit_account");
                echo HTML::close_form();
            }
                break;
            case "local":
                if(isset($_POST['form_edit_account'])){
                if (empty($_POST['usuario_nombre'])) {
                echo MESSAGE_FORM_NOMBRE_EMPTY;
                echo HTML::br(2);
                echo "<a href='javascript:history.back()'> Volver Atrás</a>";
            } elseif (!preg_match('/^[a-z\d]{2,64}$/i', $_POST['usuario_telefono'])) {
                echo MESSAGE_FORM_TELEFONO_EMPTY;
                echo HTML::br(2);
                echo "<a href='javascript:history.back()'> Volver Atrás</a>";
            } elseif (strlen($_POST['usuario_telefono']) != 9) {
                echo MESSAGE_FORM_TELEFONO_INVALID;
                echo HTML::br(2);
                echo "<a href='javascript:history.back()'> Volver Atrás</a>";
            } elseif ($_POST['usuario_idioma']=="") {
                $_POST['usuario_idioma']==$login->getUserDataCampo($usuario_id, "usuario_idioma");
            } elseif ($_POST['usuario_idioma']!="ca" && $_POST['usuario_idioma']!="en" && $_POST['usuario_idioma']!="es") {
                echo MESSAGE_FORM_IDIOMA;
                echo HTML::br(2);
                echo "<a href='javascript:history.back()'> Volver Atrás</a>";
            } else{
                $query_mod_account = DB::connect()->prepare("UPDATE  `uqfhhbcn_whymusic`.`wm_usuarios` SET  `usuario_nombre` =  :usuario_nombre,
                `usuario_telefono` =  :usuario_telefono,
                `usuario_direccion` =  :usuario_direccion,
                `usuario_lat` =  :usuario_lat,
                `usuario_lon` =  :usuario_lon,
                `usuario_idioma` = :usuario_idioma WHERE  `wm_usuarios`.`usuario_id` = :usuario_id;");
                $query_mod_account->bindValue(':usuario_id', $usuario_id, PDO::PARAM_STR);
                $query_mod_account->bindValue(':usuario_nombre', $_POST['usuario_nombre'], PDO::PARAM_STR);
                $query_mod_account->bindValue(':usuario_direccion', $_POST['usuario_direccion'], PDO::PARAM_STR);
                $query_mod_account->bindValue(':usuario_lon', $_POST['usuario_lon'], PDO::PARAM_STR);
                $query_mod_account->bindValue(':usuario_lat', $_POST['usuario_lat'], PDO::PARAM_STR);
                $query_mod_account->bindValue(':usuario_idioma', $_POST['usuario_idioma'], PDO::PARAM_STR);
                $query_mod_account->bindValue(':usuario_telefono', $_POST['usuario_telefono'], PDO::PARAM_STR);
                $query_mod_account->execute();
                if ($query_mod_account) {
                    echo MESSAGE_CORRECT_MOD;
                    if ($login->getTypeOfUser()=="administrador") {
                        ROUTER::redirect_to_action("admin/admin",2);
                    }else{
                        ROUTER::redirect_to_action("account/edit",2);
                    }
                }else{
                    echo MESSAGE_ERROR_SQL;
                    echo HTML::br(2);
                    echo "<a href='javascript:history.back()'> Volver Atrás</a>";
                }
            }
            }else{
                echo HTML::open_form(ROUTER::create_action_url('account/edit'), "POST","form_edit_account");
                /*Guarrada provisional*/
                $_SESSION['usuario_id_edit']=$login->getUserDataCampo($usuario_id,"usuario_id");
                $_SESSION['usuario_tipo_edit']=$login->getUserDataCampo($usuario_id,"usuario_tipo");
                /*Fin de la gurrada*/
                echo HTML::label("usuario_nombre", WORDING_NOMBRE_LOCAL);
                echo HTML::input("text","usuario_nombre",$login->getUserDataCampo($usuario_id,"usuario_nombre"),array("placeholder" => "Su nombre"));

                echo HTML::br(2);
                echo HTML::label("Gmaps","Selecciona tu ubicación:");
                echo HTML::open_div(array("id"  => "myMap"));
                echo HTML::close_div();

                echo HTML::br(2);
                echo HTML::label("usuario_direccion",WORDING_DIRECCION);
                echo HTML::input("text","usuario_direccion",$login->getUserDataCampo($usuario_id,'usuario_direccion'),array("id" => "address" , "style" => "width:600px;"));

                echo HTML::br(2);
                echo HTML::label("usuario_lat",WORDING_LATITUD);
                echo HTML::input("text","usuario_lat",$login->getUserDataCampo($usuario_id,'usuario_lat'),array("id" => "latitude"));

                echo HTML::br(2);
                echo HTML::label("usuario_lon",WORDING_LONGITUD);
                echo HTML::input("text","usuario_lon",$login->getUserDataCampo($usuario_id,'usuario_lon'),array("id" => "longitude"));

                echo HTML::br(2);
                echo HTML::label("usuario_idioma", WORDING_IDIOMA);
                echo HTML::select("usuario_idioma",array("Idioma por defecto" => $login->getUserDataCampo($usuario_id,'usuario_idioma'), "Inglés" => "en", "Castellano" => "es", "Catalán" => "ca"));
                echo HTML::br(2);

                echo HTML::label("usuario_telefono", WORDING_TELEFON);
                echo HTML::input("text","usuario_telefono",$login->getUserDataCampo($usuario_id,"usuario_telefono"),array("placeholder" => "9XXXXXXXX"));
                echo HTML::br(2);
                echo HTML::label("estilo_nombre",WORDING_PROFILE_ESTILO);
                echo HTML::selectArray("estilo_nombre",$getDataDB->getFieldSQL("wm_estilo","estilo_nombre , estilo_id",""));
                echo HTML::br(2);
                echo HTML::button_HTML5("submit", BUTTON_MOD_DATA,"form_edit_account");
                echo HTML::close_form();
            }
                break;
            case "Fan":
                echo "Form Fan";
                break;
            case "administrador":
                echo "FORM ADMIN";
                break;
            default:
                echo "No tienes permisos para estar aquí...";
                break;
        }
	}
}
 ?>