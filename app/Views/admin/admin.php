<?php $login = new ModelLogin();
$admin = new AdminPanel();?>
<table style="width:100%">
<h1><?php echo  WORDING_NOM_USUARIOS ?></h1>
<h3><?php echo WORDING_NOM_LOCAL ?></h3>
<tr>
    <th>ID</th>
    <th><?php echo WORDING_PROFILE_NOMBRE_LOCAL ?></th>
    <th><?php echo WORDING_PROFILE_USERNAME ?></th>
    <th><?php echo WORDING_PROFILE_EMAIL ?></th>
    <th><?php echo WORDING_PROFILE_DIRECCION ?></th>
    <th>Editar</th>
  </tr>
  <tr>
    <?php $admin->showUsers("local"); ?>
  </tr>
</table>
<table style="width:100%">
<h3><?php echo WORDING_NOM_MUSICOS ?></h3>
<tr>
    <th>ID</th>
    <th>Nombre</th>
    <th><?php echo WORDING_PROFILE_APELLIDO1 ?></th>
    <th><?php echo WORDING_PROFILE_APELLIDO2 ?></th>
    <th><?php echo WORDING_PROFILE_USERNAME ?></th>
    <th>Email</th>
    <th>Editar</th>
  </tr>
  <tr>
    <?php $admin->showUsers("musico"); ?>
  </tr>
</table>
<table style="width:100%">
<h3><?php echo WORDING_NOM_FAN ?></h3>
<tr>
    <th>ID</th>
    <th>Nombre</th>
    <th><?php echo WORDING_PROFILE_APELLIDO1 ?></th>
    <th><?php echo WORDING_PROFILE_APELLIDO2 ?></th>
    <th><?php echo WORDING_PROFILE_USERNAME ?></th>
    <th><?php echo WORDING_PROFILE_EMAIL ?></th>
    <th>Editar</th>
  </tr>
  <tr>
    <?php $admin->showUsers("fan"); ?>
  </tr>
</table>