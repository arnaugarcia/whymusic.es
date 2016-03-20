<h1>Información de la cuenta</h1>
<h3>Datos del usuario</h3>
<?php
$login = new ModelLogin();
$account = new showDataAccount();
$image = new ModelImage();
if ($login->getTypeOfUser()=="administrador" || $login->getTypeOfUser()=="musico" || $login->getTypeOfUser()=="fan" || $login->getTypeOfUser()=="local" ) {
	$account->getProfileData($login->getUserId(),$login->getTypeOfUser());
}else{
 	echo("No tienes permisos para estar aquí... ('account/user')");
}
?>
<h3>Modificar contraseña</h3>
<form method="post" action="<?php echo ROUTER::create_action_url('account/user'); ?>" name="new_password_form">

    <label for="user_password_new"><?php echo WORDING_NEW_PASSWORD; ?></label>
    <input id="user_password_new" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" />

    <label for="user_password_repeat"><?php echo WORDING_NEW_PASSWORD_REPEAT; ?></label>
    <input id="user_password_repeat" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />
    <input type="submit" name="submit_new_password" value="<?php echo WORDING_SUBMIT_NEW_PASSWORD; ?>" />
</form>
<h3>Eliminar cuenta</h3>
<?php
echo HTML::a(ROUTER::create_action_url("account/delete"),"Eliminar cuenta",array("class"=>"btn btn-danger"));
?>