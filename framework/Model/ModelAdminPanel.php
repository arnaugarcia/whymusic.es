<?php
/**
* Clase para administrar la web y sus usuarios
*/
class AdminPanel
{
	public static function showUsers()
	{
		$db = new DB();
		$query = DB::connect()->prepare("SELECT * FROM wm_usuarios");
		$query->execute();
		$result = $query->fetchAll();
		foreach ($result as $row) {
		echo "<tr>";
		echo "<td>" . $row['usuario_id'] . "</td>";
		echo "<td>" . $row['usuario_nombre'] . "</td>";
		echo "<td>" . $row['usuario_apellido1'] . "</td>";
		echo "<td>" . $row['usuario_apellido2'] . "</td>";
		echo "<td>" . $row['usuario_nombre_usuario'] . "</td>";
		echo "<td>" . $row['usuario_tipo'] . "</td>";
		echo "<td>" . $row['usuario_email'] . "</td>";
		echo "<td>" . HTML::a(ROUTER::create_action_url("admin/edit&usuario_id=". $row['usuario_id'] ."&usuario_tipo=". $row['usuario_tipo'] .""),"Editar") . "</td>";
		echo "</tr>";
		}
	}
	public static function editUser()
	{
		$EditAccount = new EditAccount();
		$EditAccount->usuarioEdit($_GET['usuario_id'],$_GET['usuario_tipo']);
	}
}
?>