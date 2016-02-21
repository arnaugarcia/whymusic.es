<?php $login = new ModelLogin();
$admin = new AdminPanel();?>
<table style="width:100%">
<tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>Primer apellido</th>
    <th>Segundo Apellido</th>
    <th>Nombre de usuario</th>
    <th>Tipo de cuenta</th>
    <th>Email</th>
    <th>Editar</th>
  </tr>
  <tr>
    <?php $admin->showUsers(); ?>
  </tr>
</table>