<h1>Edición del perfil</h1>
<?php $login = new ModelLogin();  ?>
Tipo de cuenta: <?php echo $login->getTypeOfUser(); echo HTML::br(1);?>
<?php
echo $error;
$EditAccount= new EditAccount();
if ($login->isUserLoggedIn()=="true" && ($login->getTypeOfUser()=="musico" || $login->getTypeOfUser()=="fan" || $login->getTypeOfUser()=="local")) {
	$EditAccount->usuarioEdit($login->getUserId(),$login->getTypeOfUser());
}else if ($login->getTypeOfUser()=="administrador") {
	$EditAccount->usuarioEdit($_SESSION['usuario_id_edit'],$_SESSION['usuario_tipo_edit']);
}else {
	echo "No tienes permisos para estar aquí";
}
?>