<?php
/**
* Model Local
*/
class Local
{
	public function getLocalAll($limit)
	{
		$db = new DB();
		$login = new ModelLogin();
			$query = DB::connect()->prepare("SELECT * FROM wm_usuarios WHERE usuario_tipo = 'local' LIMIT 0 , :limite");
			$query->bindValue(':limite', $limit, PDO::PARAM_INT);
			$query->execute();
			foreach ($query as $row) {
	        echo '<div class="col-md-4 col-sm-6">';
	        echo '<a href="'.ROUTER::create_action_url("event/locales&local_id=".$row['usuario_id']."").'">';
	        echo '<img class="img-responsive img-portfolio img-hover" src="http://placehold.it/700x450" alt="">';
	        echo '</a>';
	        echo '<div><h4>'.$row['usuario_nombre'].'</h4></div>';
	        echo HTML::a(ROUTER::create_action_url("event/locales&local_id=".$row['usuario_id'].""),"Más info sobre ".$row['usuario_nombre']."");
	        echo '</div>';
    		}
	}
	public function getLocal($local_id, $limit)
	{
		$db = new DB();
		$login = new ModelLogin();
			$query = DB::connect()->prepare("SELECT * FROM wm_usuarios WHERE usuario_tipo = 'local' AND usuario_id=:local_id");
			$query->bindValue(':local_id', $local_id, PDO::PARAM_STR);
			$query->execute();
			foreach ($query as $row) {
			echo "<h1>".$row['usuario_nombre']."</h1>";
	        echo '<div class="col-md-4 col-sm-6">';
	        echo '<a href="#">';
	        echo '<img class="img-responsive img-portfolio img-hover" src="http://placehold.it/700x450" alt="">';
	        echo '</a>';
	        echo '<div><h4>'.$row['usuario_nombre'].'</h4></div>';
	        echo HTML::a(ROUTER::create_action_url("event/locales&local_id=".$row['usuario_id'].""),"Más info sobre ".$row['usuario_nombre']."");
	        echo '</div>';
    		}
	}
}
/**
* Model Banda
*/
class Banda
{
	public function getBanda($banda_id)
	{
		$db = new DB();
		$login = new ModelLogin();
		if($banda_id==null){
			$query = DB::connect()->prepare("SELECT * FROM wm_usuarios WHERE usuario_tipo = 'musico' LIMIT 0 , 4");
		}else{
			$query = DB::connect()->prepare("SELECT * FROM wm_usuarios WHERE usuario_tipo = 'musico' AND usuario_id=:banda_id");
			$query->bindValue(':banda_id', $banda_id, PDO::PARAM_STR);
		}
		$query->execute();
		return $result = $query->fetchAll();
	}
}
 ?>