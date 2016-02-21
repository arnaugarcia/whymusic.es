<h1>Panel de usuario</h1>
<?php
$login = new ModelLogin();
// if you need the user's information, just put them into the $_SESSION variable and output them here
echo HTML::label("usuario_foto","Foto de perfil: ");
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

echo HTML::a(ROUTER::create_action_url('account/edit'),"Editar datos", array("class" => "btn btn-default"));

echo HTML::a(ROUTER::create_action_url('account/logout&logout'),"Finalizar sessión", array("class" => "btn btn-default"));

?>