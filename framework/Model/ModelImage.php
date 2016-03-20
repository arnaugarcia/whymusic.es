<?php
/**
* Clase para subir la imagenes
*/
class ModelImage
{
	function __construct()
	{
		$login = new ModelLogin();
		$db = new DB();
		if (isset($_POST['usuario_foto'])) {
			$this->uploadAccountImage($login->getUserId());
		}
	}
	public function UploadAccountImage($usuario_id)
	{
		if (!file_exists(ROOTPATH ."/../resources/ProfilePhoto/$usuario_id/")) {
			mkdir(ROOTPATH ."/../resources/ProfilePhoto/$usuario_id/", 0777, true);
		}
		$target_dir = ROOTPATH ."/../resources/ProfilePhoto/$usuario_id/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if(isset($_POST["usuario_foto"])) {
		    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		    if($check !== false) {
		        $uploadOk = 1;
		    } else {
		        echo "El archivo no es una imagen.";
		        $uploadOk = 0;
		    }
		}
		// Check if file already exists
		if (file_exists($target_file)) {
		    echo "Lo sentimos, el archivo ya existe";
		    $uploadOk = 0;
		}
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 500000) {
		    echo "Lo sentimos, el archivo es muy grande.";
		    $uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		    echo "Lo sentimos, solamente archivos JPG, JPEG, PNG & GIF están permitidos.";
		    $uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    echo "Lo sentimos, su imagen no se subió.";
		// if everything is ok, try to upload file
		} else {
		    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		        echo "El archivo ". basename( $_FILES["fileToUpload"]["name"]). " se ha subido correctamente.";
		        $query_mod_account = DB::connect()->prepare("UPDATE  `uqfhhbcn_whymusic`.`wm_usuarios` SET  
                `usuario_foto` = :usuario_foto 
                 WHERE  `wm_usuarios`.`usuario_id` = :usuario_id;");
                $query_mod_account->bindValue(':usuario_id', $usuario_id, PDO::PARAM_STR);
                $query_mod_account->bindValue(':usuario_foto', basename($_FILES["fileToUpload"]["name"]), PDO::PARAM_STR);
                $query_mod_account->execute();
                if ($query_mod_account) {
                	echo "La foto se subío correctamente";
                }else{
                	echo "hubo un error al procesar la imagen con la BBDD";
                }
		    } else {
		        echo "Lo sentimos, hubo un error al subir la imagen, intentalo más tarde.";
		    }
		}
	}
	public function localImage($local_id)
	{

	}
	public function bandImage($musico_id)
	{
		
	}
}
 ?>