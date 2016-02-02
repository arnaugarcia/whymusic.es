<h1>Edición del perfil</h1>
<?php $login = new ModelLogin();  ?>
Tipo de cuenta: <?php echo $login->getTypeOfUser(); echo HTML::br(1);?>
<br>Cambiar tipo de cuenta:
<select>
	<option title="Seleciona una opción">Seleciona una opción</option>
	<option title="Musico">Musico</option>
	<option title="Fan">Fan</option>
	<option title="Local">Local</option>
</select>
<?php
echo HTML::br(2);
$registro = new EditAccount();
if($login->getTypeOfUser()=="musico"){
	$registro->formMusico();
	}elseif ($login->getTypeOfUser()=="fan") {
		formFan();
	}elseif ($login->getTypeOfUser()=="local") {
		formLocal();
	}elseif ($login->getTypeOfUser()=="administrador") {
		formAdmin();
	}else{
		echo "What the duck?";
	}
?>