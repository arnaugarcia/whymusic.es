<?php
/**
* Clase para administrar la web y sus usuarios
*/
class AdminPanel
{
	public static function showUsers($usuario_tipo)
	{
		$db = new DB();
		$login = new ModelLogin();
		if($usuario_tipo==null){
			$query = DB::connect()->prepare("SELECT * FROM wm_usuarios");
		}else{
			$query = DB::connect()->prepare("SELECT * FROM wm_usuarios WHERE usuario_tipo=:usuario_tipo");
			$query->bindValue(':usuario_tipo', $usuario_tipo, PDO::PARAM_STR);
		}
		$query->execute();
		$result = $query->fetchAll();
			switch ($usuario_tipo) {
				case "musico":
					foreach ($result as $row) {
						echo "<tr>";
						echo "<td>" . $row['usuario_id'] . "</td>";
						echo "<td>" . $row['usuario_nombre'] . "</td>";
						echo "<td>" . $row['usuario_nombre_usuario'] . "</td>";
						echo "<td>" . $row['usuario_email'] . "</td>";
						echo "<td>" . $db->getUserDataEstilo($login->getUserDataCampo($row['usuario_id'],"estilo_id")) . "</td>";
						echo "<td>" . HTML::a(ROUTER::create_action_url("admin/edit&usuario_id=". $row['usuario_id'] ."&usuario_tipo=". $row['usuario_tipo'] .""),"Editar") . "</td>";
						echo "</tr>";
					}
					break;
				case "local":
					foreach ($result as $row) {
						echo "<tr>";
						echo "<td>" . $row['usuario_id'] . "</td>";
						echo "<td>" . $row['usuario_nombre'] . "</td>";
						echo "<td>" . $row['usuario_nombre_usuario'] . "</td>";
						echo "<td>" . $row['usuario_email'] . "</td>";
						echo "<td>" . $row['usuario_direccion'] . "</td>";
						echo "<td>" . HTML::a(ROUTER::create_action_url("admin/edit&usuario_id=". $row['usuario_id'] ."&usuario_tipo=". $row['usuario_tipo'] .""),"Editar") . "</td>";
						echo "</tr>";
					}
					break;
				case "fan":
					foreach ($result as $row) {
						echo "<tr>";
						echo "<td>" . $row['usuario_id'] . "</td>";
						echo "<td>" . $row['usuario_nombre'] . "</td>";
						echo "<td>" . $row['usuario_apellido1'] . "</td>";
						echo "<td>" . $row['usuario_apellido2'] . "</td>";
						echo "<td>" . $row['usuario_nombre_usuario'] . "</td>";
						echo "<td>" . $row['usuario_email'] . "</td>";
						echo "<td>" . HTML::a(ROUTER::create_action_url("admin/edit&usuario_id=". $row['usuario_id'] ."&usuario_tipo=". $row['usuario_tipo'] .""),"Editar") . "</td>";
						echo "</tr>";
					}
					break;
				default:
					echo "Error en AdminPanel";
					break;
		}
	}
	public static function editUser()
	{
		$EditAccount = new EditAccount();
		$EditAccount->usuarioEdit($_GET['usuario_id'],$_GET['usuario_tipo']);
	}
}
?>