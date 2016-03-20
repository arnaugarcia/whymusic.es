<link rel="stylesheet"  href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/rating/star-rating.css" media="all" rel="stylesheet" type="text/css"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="js/rating/star-rating.js" type="text/javascript"></script>
<script>
    jQuery(document).ready(function () {
        $("#input-21f").rating({
            starCaptions: function(val) {
                if (val < 3) {
                    return val;
                } else {
                    return 'high';
                }
            },
            starCaptionClasses: function(val) {
                if (val < 3) {
                    return 'label label-danger';
                } else {
                    return 'label label-success';
                }
            },
            hoverOnClear: false
        });
        $('#rating-input').rating({
              min: 0,
              max: 5,
              step: 1,
              size: 'lg',
              showClear: false
           });
        $('#btn-rating-input').on('click', function() {
            $('#rating-input').rating('refresh', {
                showClear:true,
                disabled: !$('#rating-input').attr('disabled')
            });
        });
        $('.btn-danger').on('click', function() {
            $("#kartik").rating('destroy');
        });
        $('.btn-success').on('click', function() {
            $("#kartik").rating('create');
        });
        $('#rating-input').on('rating.change', function() {
            alert($('#rating-input').val());
        });
        $('.rb-rating').rating({'showCaption':true, 'stars':'3', 'min':'0', 'max':'3', 'step':'1', 'size':'xs', 'starCaptions': {0:'status:nix', 1:'status:wackelt', 2:'status:geht', 3:'status:laeuft'}});
    });
    </script>
<?php
/**
* Model Local
*/
class Local
{
	public function getLocalAll($limit,$reverse)
	{
		$db = new DB();
		$login = new ModelLogin();
			$query = DB::connect()->prepare("SELECT * FROM wm_usuarios WHERE usuario_tipo = 'local' LIMIT 0 , :limite");
			$query->bindValue(':limite', $limit, PDO::PARAM_INT);
			$query->execute();
			switch ($reverse) {
			case true:
				$reverse = false;
            foreach ($query as $row) {
                if ($reverse == false) {
                    $reverse=true;
                    echo HTML::open_div(array("class" => "col-lg-12"));
                    echo HTML::title("h2",$row['usuario_nombre'],array("class" => "page-header"));
                    echo HTML::close_div();
                    echo HTML::open_div(array("class" => "col-md-6"));
                    echo HTML::p($row['usuario_nombre']);
                    echo HTML::label("usuario_direccion",WORDING_DIRECCION) . $row['usuario_direccion'];
                    echo HTML::br(2);
                    echo HTML::label("usuario_email",WORDING_PROFILE_EMAIL) . $row['usuario_email'];
                    echo HTML::br(2);
                    if ($row['usuario_descripcion']=="") {
                        echo HTML::p("Descripción del local aún no insertada");
                    }else{
                        echo HTML::p($row['usuario_descripcion']);
                    }
                    echo HTML::input("number","local_puntuacion",0,array("id" => "input-21e" , "class" => "rating" , "min" => "0" , "max" => "5" , "step" => "0.5" , "data-size" => "xs"));
                    echo HTML::close_div();
                    echo HTML::open_div(array("class" => "col-md-6"));
                	echo '<a href="'.ROUTER::create_action_url("event/local&local_id=".$row['usuario_id']."").'">';
                    if ($row['usuario_foto']=="") {
                        echo '<img class="img-responsive" src="http://placehold.it/600x250" alt="'.$row['usuario_nombre'].'">';
                    }else{
                        echo '<img class="img-responsive" src="'.$login->getProfileImage($row['usuario_id']).'" alt="'.$row['usuario_nombre'].'" height="250" width="650">';
                    }
                    echo '</a>';
                    echo HTML::close_div();
                }else {
                    echo HTML::open_div(array("class" => "col-lg-12"));
                    echo HTML::title("h2",$row['usuario_nombre'],array("class" => "page-header"));
                    echo HTML::close_div();
                    echo HTML::open_div(array("class" => "col-md-6"));
                    echo '<a href="'.ROUTER::create_action_url("event/local&local_id=".$row['usuario_id']."").'">';
                    if ($row['usuario_foto']=="") {
                        echo '<img class="img-responsive" src="http://placehold.it/600x250" alt="'.$row['usuario_nombre'].'">';
                    }else{
                        echo '<img class="img-responsive" src="'.$login->getProfileImage($row['usuario_id']).'" alt="'.$row['usuario_nombre'].'" height="250" width="650">';
                    }
                    echo '</a>';
                    echo HTML::close_div();
                    echo HTML::open_div(array("class" => "col-md-6"));
                    echo HTML::p($row['usuario_nombre']);
                    echo HTML::label("usuario_direccion",WORDING_DIRECCION) . $row['usuario_direccion'];
                    echo HTML::br(2);
                    echo HTML::label("usuario_email",WORDING_PROFILE_EMAIL) . $row['usuario_email'];
                    echo HTML::br(2);
                    if ($row['usuario_descripcion']=="") {
                        echo HTML::p("Descripción del local aún no insertada");
                    }else{
                        echo HTML::p($row['usuario_descripcion']);
                    }
                    echo HTML::input("number","local_puntuacion",0,array("id" => "input-21e" , "class" => "rating" , "min" => "0" , "max" => "5" , "step" => "0.5" , "data-size" => "xs"));
                    echo HTML::close_div();
                    $reverse=false;
                }
            }
				break;
			case false:
            foreach ($query as $row) {
                echo HTML::open_div(array("class" => "col-lg-12"));
                echo HTML::title("h2",$row['usuario_nombre'],array("class" => "page-header"));
                echo HTML::close_div();
                echo HTML::open_div(array("class" => "col-md-6"));
                echo '<a href="'.ROUTER::create_action_url("event/local&local_id=".$row['usuario_id']."").'">';
               if ($row['usuario_foto']=="") {
                        echo '<img class="img-responsive" src="http://placehold.it/600x250" alt="'.$row['usuario_nombre'].'">';
                    }else{
                        echo '<img class="img-responsive" src="'.$login->getProfileImage($row['usuario_id']).'" alt="'.$row['usuario_nombre'].'" height="250" width="650">';
                    }
                echo '</a>';
                echo HTML::close_div();
                echo HTML::open_div(array("class" => "col-md-6"));
                echo HTML::p($row['usuario_nombre']);
                echo HTML::label("usuario_direccion",WORDING_DIRECCION) . $row['usuario_direccion'];
                echo HTML::br(2);
                echo HTML::label("usuario_email",WORDING_PROFILE_EMAIL) . $row['usuario_email'];
                echo HTML::br(2);
                if ($row['usuario_descripcion']=="") {
                    echo HTML::p("Descripción del local aún no insertada");
                }else{
                    echo HTML::p($row['usuario_descripcion']);
                    }
                echo HTML::input("number","local_puntuacion",0,array("id" => "input-21e" , "class" => "rating" , "min" => "0" , "max" => "5" , "step" => "0.5" , "data-size" => "xs"));
                echo HTML::close_div();
                }
				break;
			default:
				echo "DA FAK R U DOING WHERE?";
				break;
		}
	}
	public function getLocal($local_id)
	{
		$db = new DB();
		$login = new ModelLogin();
			$query = DB::connect()->prepare("SELECT * FROM wm_usuarios WHERE usuario_tipo = 'local' AND usuario_id=:local_id");
			$query->bindValue(':local_id', $local_id, PDO::PARAM_STR);
			$query->execute();
			foreach ($query as $row) {
                echo HTML::open_div(array("class" => "col-lg-12"));
                echo HTML::title("h2",$row['usuario_nombre'],array("class" => "page-header"));
                echo HTML::close_div();
                echo HTML::open_div(array("class" => "col-md-6"));
                echo '<a href="'.ROUTER::create_action_url("event/local&local_id=".$row['usuario_id']."").'">';
                if ($row['usuario_foto']=="") {
                        echo '<img class="img-responsive" src="http://placehold.it/600x250" alt="'.$row['usuario_nombre'].'">';
                    }else{
                        echo '<img class="img-responsive" src="'.$login->getProfileImage($row['usuario_id']).'" alt="'.$row['usuario_nombre'].'" height="250" width="650">';
                    }
                echo '</a>';
                echo HTML::close_div();
                echo HTML::open_div(array("class" => "col-md-6"));
                echo HTML::p($row['usuario_nombre']);
                echo HTML::label("usuario_direccion",WORDING_DIRECCION) . $row['usuario_direccion'];
                echo HTML::br(2);
                echo HTML::label("usuario_email",WORDING_PROFILE_EMAIL) . $row['usuario_email'];
                echo HTML::br(2);
                if ($row['usuario_descripcion']=="") {
                    echo HTML::p("Descripción del local aún no insertada");
                }else{
                    echo HTML::p($row['usuario_descripcion']);
                    }
                echo HTML::input("number","local_puntuacion",0,array("id" => "input-21e" , "class" => "rating" , "min" => "0" , "max" => "5" , "step" => "0.5" , "data-size" => "xs"));
                echo HTML::close_div();
                if ($login->isUserLoggedIn()) {
                    if ($login->isMusico() && $_GET['ruta']=="event/local") {
                        echo HTML::open_div(array("class" => "col-md-8"));
                        echo HTML::close_div();
                        echo HTML::open_div(array("class" => "col-md-4"));
                        $_SESSION['local_id_concierto']=$_GET['local_id'];
                        echo HTML::a(ROUTER::create_action_url("event/concert"),"Contactar con este local",array("class" => "btn btn-success"));
                        echo HTML::close_div();
                    }
                    if ($login->isLocal() && $_GET['ruta']=="event/band") {
                        echo HTML::open_div(array("class" => "col-md-8"));
                        echo HTML::close_div();
                        echo HTML::open_div(array("class" => "col-md-4"));
                       $_SESSION['local_id_concierto']=$_GET['local_id'];
                        echo HTML::a(ROUTER::create_action_url("event/concert"),"Contactar con este músico",array("class" => "btn btn-success"));
                        echo HTML::close_div();
                    }
                }else{
                    echo HTML::open_div(array("class" => "col-md-8"));
                    echo HTML::close_div();
                    echo HTML::open_div(array("class" => "col-md-4"));
                    echo HTML::p("Debes iniciar sessión para crear un concierto");
                    echo HTML::close_div();
                }
                echo HTML::br(2);
	            echo '<input type="hidden" id="latitude" value="'.$row['usuario_lat'].'">';
	            echo '<input type="hidden" id="longitude" value="'.$row['usuario_lon'].'">';
                echo HTML::open_div(array("class" => "col-lg-12"));
                echo HTML::title("h3","Dirección:");
                echo HTML::label("Gmaps","");
                echo HTML::open_div(array("id"  => "myMap"));
                echo HTML::close_div();
                echo HTML::close_div();
                echo HTML::close_div();
    		}
	}
}
/**
* Model Banda
*/
class Band
{
	public function getBandAll($limit)
	{
		$db = new DB();
		$login = new ModelLogin();
			$query = DB::connect()->prepare("SELECT * FROM wm_usuarios WHERE usuario_tipo = 'musico' LIMIT 0 , :limite");
			$query->bindValue(':limite', $limit, PDO::PARAM_INT);
			$query->execute();
			foreach ($query as $row) {
	        echo '<div class="col-md-4 col-sm-6">';
	        echo '<a href="'.ROUTER::create_action_url("event/band&band_id=".$row['usuario_id']."").'">';
	        if ($row['usuario_foto']=="") {
                        echo '<img class="img-responsive" src="http://placehold.it/600x250" alt="'.$row['usuario_nombre'].'">';
                    }else{
                        echo '<img class="img-responsive" src="'.$login->getProfileImage($row['usuario_id']).'" alt="'.$row['usuario_nombre'].'" height="250" width="650">';
                    }
	        echo '</a>';
	        echo '<h4>'.$row['usuario_nombre'].'</h4>';
	   		//echo '<div class="col-md-8"><input id="input-21e" value="4" type="number" class="rating" min=0 max=5 step=0.5 data-size="xs" ></div>';
	        echo HTML::a(ROUTER::create_action_url("event/band&band_id=".$row['usuario_id'].""),"Más info sobre ".$row['usuario_nombre']."");
	        echo '</div>';
    		}
	}
	public function getBand($banda_id, $limit)
	{
		$db = new DB();
		$login = new ModelLogin();
			$query = DB::connect()->prepare("SELECT * FROM wm_usuarios WHERE usuario_tipo = 'musico' AND usuario_id=:musico_id");
			$query->bindValue(':musico_id', $banda_id, PDO::PARAM_STR);
			$query->execute();
			foreach ($query as $row) {
			echo HTML::title("h1",$row['usuario_nombre']);
	        echo '<div class="col-md-4">';
	        if ($row['usuario_foto']=="") {
                        echo '<img class="img-responsive" src="http://placehold.it/600x250" alt="'.$row['usuario_nombre'].'">';
                    }else{
                        echo '<img class="img-responsive" src="'.$login->getProfileImage($row['usuario_id']).'" alt="'.$row['usuario_nombre'].'" height="250" width="650">';
                    }
	        echo '</div>';
            echo '<div class="col-md-8">';
            if ($row['usuario_foto']=="") {
                        echo '<img class="img-responsive" src="http://placehold.it/600x250" alt="'.$row['usuario_nombre'].'">';
                    }else{
                        echo '<img class="img-responsive" src="'.$login->getProfileImage($row['usuario_id']).'" alt="'.$row['usuario_nombre'].'" height="250" width="650">';
                    }
            echo '</div>';
            if ($login->isUserLoggedIn()) {
                    if ($login->isLocal() && $_GET['ruta']=="event/band") {
                        echo HTML::open_div(array("class" => "col-md-8"));
                        echo HTML::close_div();
                        echo HTML::open_div(array("class" => "col-md-4"));
                        $_SESSION['band_id_concierto']=$_GET['band_id'];
                        echo HTML::a(ROUTER::create_action_url("event/concert"),"Contactar con este músico",array("class" => "btn btn-success"));
                        echo HTML::close_div();
                    }
                }else{
                    echo HTML::open_div(array("class" => "col-md-8"));
                    echo HTML::close_div();
                    echo HTML::open_div(array("class" => "col-md-4"));
                    echo HTML::p("Debes iniciar sessión para crear un concierto");
                    echo HTML::close_div();
                }
    		}
	}
}

/**
* Clase Concierto
*/
class Concert
{
    function __construct()
    {
        if (isset($_GET['verification_code'])) {
            $this->newConcertPOST($_GET['verification_code']);
        }
    }
    public function newConcert($local_id, $banda_id, $fecha, $precio, $duracion, $aforo)
    {
        $login = new ModelLogin();
        $notifications = new Notifications();
        if($login->isUserLoggedIn() && ($login->isMusico() || $login->isLocal())){
            $query_new_concierto = DB::connect()->prepare("INSERT INTO  wm_concierto (concierto_id ,concierto_fecha , concierto_precio ,concierto_asistentes , concierto_duracion , concierto_verification , concierto_estado , concierto_creado, local_id , musico_id) VALUES (NULL , :fecha, :precio, :aforo, :duracion, :verification, :estado, :concierto_creado, :local_id, :banda_id)");
            $query_new_concierto->bindValue(':fecha', $fecha, PDO::PARAM_STR);
            $query_new_concierto->bindValue(':precio', $precio, PDO::PARAM_INT);
            $query_new_concierto->bindValue(':aforo', $aforo, PDO::PARAM_INT);
            $query_new_concierto->bindValue(':duracion', $duracion, PDO::PARAM_INT);
            $verification=sha1(uniqid(mt_rand(), true));
            $query_new_concierto->bindValue(':verification', $verification, PDO::PARAM_STR);
            $query_new_concierto->bindValue(':estado', "pendiente", PDO::PARAM_STR);
            if ($login->isLocal()) {
                    $query_new_concierto->bindValue(':concierto_creado', $local_id, PDO::PARAM_INT);
                }
            if($login->isMusico()){
                    $query_new_concierto->bindValue(':concierto_creado', $banda_id, PDO::PARAM_INT);
            }
            $query_new_concierto->bindValue(':local_id', $local_id, PDO::PARAM_INT);
            $query_new_concierto->bindValue(':banda_id', $banda_id, PDO::PARAM_INT);
            $query_new_concierto->execute();
            if ($query_new_concierto) {
                    if ($login->isLocal()) {
                            $this->sendMail($login->getUserDataCampo($banda_id,"usuario_email"),$verification);
                            $notifications->newNotification($login->getUserId(),"Concierto","Ha creado un nuevo concierto. Le avisaremos cuando haya novedades!", date('Y-m-d'));
                            $notifications->newNotification($banda_id,"Concierto","Hay una nueva proposición de concierto del local " . $login->getUserDataCampo($login->getUserId(),"usuario_nombre") . ". Haga click aquí para saber más", date('Y-m-d'));
                    }
                    if($login->isMusico()){
                            $this->sendMail($login->getUserDataCampo($local_id,"usuario_email"),$verification);
                            $notifications->newNotification($login->getUserId(),"Concierto","Ha creado un nuevo concierto. Le avisaremos cuando haya novedades!", date('Y-m-d'));
                            $notifications->newNotification($local_id,"Concierto","Hay una nueva proposición de concierto del los musico/s " . $login->getUserDataCampo($login->getUserId(),"usuario_nombre") . ". Haga click aquí para saber más", date('Y-m-d'));
                    }
                }else{
                    echo MESSAGE_ERROR_SQL;
                }
        }
    }
    public function newConcertPOST($verification_code)
    {
            $notifications = new Notifications();
            $login = new ModelLogin();
            if ($this->checkConcertExists($verification_code)) {
                $query_new_concierto = DB::connect()->prepare("UPDATE  `uqfhhbcn_whymusic`.`wm_concierto` SET  `concierto_estado` =  'aceptado' WHERE  `wm_concierto`.`concierto_verification` =:concierto_verification;");
                $query_new_concierto->bindValue(':concierto_verification', $verification_code, PDO::PARAM_STR);
                $query_new_concierto->execute();
            if ($query_new_concierto) {
                    echo "El concierto se ha creado con exito";
                    $notifications->newNotification($login->getUserId(),"Concierto","El concierto se ha creado con exito!", date('Y-m-d'));
                    ROUTER::redirect_to_action("demo/index",2);
                }else{
                    echo "Algo ha salido mal, vuelve a intentar lo más tarde";
                }
            }else{
                echo "El código de verificación no existe";
            }
    }
    public function checkConcertExists($verification_code)
    {
        $query_check_concert = DB::connect()->prepare("SELECT * FROM wm_concierto WHERE concierto_verification = :concierto_verification");
        $query_check_concert->bindValue(':concierto_verification', $verification_code, PDO::PARAM_STR);
        $query_check_concert->execute();
        if ($query_check_concert->rowCount() > 0) {
            return true;
        }else{
            return false;
        }
    }
    public function sendMail($usuario_email, $verification)
    {
        $mail = new PHPMailer;
        if (EMAIL_USE_SMTP) {
            $mail->IsSMTP();
            $mail->SMTPAuth = EMAIL_SMTP_AUTH;
            if (defined(EMAIL_SMTP_ENCRYPTION)) {
                $mail->SMTPSecure = EMAIL_SMTP_ENCRYPTION;
            }
            $mail->Host = EMAIL_SMTP_HOST;
            $mail->Username = EMAIL_SMTP_USERNAME;
            $mail->Password = EMAIL_SMTP_PASSWORD;
            $mail->Port = EMAIL_SMTP_PORT;
        } else {
            $mail->IsMail();
        }

        $mail->From = EMAIL_EVENT_FROM;
        $mail->FromName = EMAIL_EVENT_FROM_NAME;
        $mail->AddAddress($usuario_email);
        $mail->Subject = EMAIL_EVENT_SUBJECT . "Usuario ";
        $link    = ROUTER::create_action_url("event/concert").'&verification_code='.urlencode($verification);
        echo $link;
        $mail->Body = EMAIL_EVENT_CONTENT . ' ' . $link;

        if(!$mail->Send()) {
            echo "ERROR AL ENVIAR EL EMAIL DE CONFIRMACIÓN";
            return false;
        } else {
            echo "Todo correcto, recibirás un correo cuando tu evento tenga novedades";
            return true;
        }
    }
    public function getConciertoAll($concierto_id)
    {
        if (!$concierto_id==null) {
            $query_get_concierto = DB::connect()->prepare("SELECT * FROM wm_concierto WHERE concierto_id = :concierto_id AND concierto_estado = 'aceptado'");
            $query_get_concierto->bindValue(':concierto_id', $concierto_id, PDO::PARAM_INT);
        }else{
            $query_get_concierto = DB::connect()->prepare("SELECT * FROM wm_concierto WHERE concierto_estado = 'aceptado'");
        }
        $query_get_concierto->execute();
        $result_row = $query_get_concierto->fetchAll();
        return $result_row;
    }
}
 ?>