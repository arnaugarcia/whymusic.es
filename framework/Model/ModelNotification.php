<?php 
/**
* Model Notification
*/
class Notifications
{
	
	public function checkNotification($usuario_id)
	{
		$query_check_notification = DB::connect()->prepare("SELECT * FROM  `wm_notificaciones` WHERE  usuario_id = :usuario_id ORDER BY notificacion_fecha ASC");
        $query_check_notification->bindValue(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $query_check_notification->execute();
        if ($query_check_notification->rowCount() > 0) {
            return $query_check_notification;
        }else{
            echo "No tienes notificaciones nuevas!";
        }
	}
	public function newNotification($usuario_id, $titulo, $contenido, $time)
	{
		$query_new_notification = DB::connect()->prepare("INSERT INTO `uqfhhbcn_whymusic`.`wm_notificaciones` (`notificacion_id`, `notificacion_titulo`, `notificacion_contenido`, `notificacion_fecha`, `usuario_id`) VALUES (NULL, :titulo, :contenido, :fecha, :usuario_id);");
		$query_new_notification->bindValue(':titulo', $titulo, PDO::PARAM_STR);
		$query_new_notification->bindValue(':contenido', $contenido, PDO::PARAM_STR);
		$query_new_notification->bindValue(':fecha', $time);
		$query_new_notification->bindValue(':usuario_id', $usuario_id, PDO::PARAM_INT);
		$query_new_notification->execute();
		if($query_new_notification->rowCount() > 0){
			return true;
		}else{
			return false;
		}
	}
	/*INSERT INTO `uqfhhbcn_whymusic`.`wm_notificaciones` (`notificacion_id`, `notificacion_titulo`, `notificacion_contenido`, `notificacion_fecha`, `notificacion_de`, `notificacion_para`, `notificacion_de_leida`, `notificacion_para_leida`) VALUES (NULL, 'Concierto', 'Se ha creado un nuevo concierto de Los Eagles en el Local Razzmatazz', '2016-03-25', '27', '23', '0', '0');*/


	/*SELECT * 
FROM  `wm_notificaciones` 
WHERE  `notificacion_de` =27
OR  `notificacion_para` =27
AND (
`notificacion_de_leida` =0
AND  `notificacion_para_leida` =0
)*/
	
}
 ?>