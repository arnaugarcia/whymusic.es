<?php $login = new ModelLogin();
$admin = new AdminPanel();?>
<?php if (isset($_GET['show'])): ?>
  <?php if ($_GET['show']=="local"): ?>
    <table style="width:100%" class='table-responsive table-hover'>
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
  <?php endif ?>
  <?php if ($_GET['show']=="musico"): ?>
    <table style="width:100%" class='table-responsive table-hover'>
<h3><?php echo WORDING_NOM_MUSICOS ?></h3>
<tr>
    <th>ID</th>
    <th><?php echo WORDING_NOMBRE_MUSICO ?></th>
    <th><?php echo WORDING_PROFILE_USERNAME ?></th>
    <th><?php echo WORDING_PROFILE_ESTILO ?></th>
    <th><?php echo WORDING_PROFILE_ESTILO ?></th>
    <th>Editar</th>
</tr>
  <tr>
    <?php $admin->showUsers("musico"); ?>
  </tr>
</table>
  <?php endif ?>
  <?php if ($_GET['show']=="fan"): ?>
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
  <?php endif ?>
<?php else: ?>
  <table style="width:100%" class='table-responsive table-hover'>
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
<h3><?php echo WORDING_NOM_MUSICOS ?></h3>
<table style="width:100%" class='table-responsive table-hover'>
<thead>
  <tr>
      <th>ID</th>
      <th><?php echo WORDING_NOMBRE_MUSICO ?></th>
      <th><?php echo WORDING_PROFILE_USERNAME ?></th>
      <th><?php echo WORDING_PROFILE_EMAIL ?></th>
      <th><?php echo WORDING_PROFILE_ESTILO ?></th>
      <th>Editar</th>
  </tr>
    <tbody>
      <tr>
        <?php $admin->showUsers("musico"); ?>
      </tr>
    </tbody>
  </thead>
</table>
<table style="width:100%" class='table-responsive table-hover'>
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
<?php endif ?>