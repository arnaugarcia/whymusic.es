<?php 
$login = new ModelLogin();
$concert = new Concert();
if ($login->isUserLoggedIn() && ($login->isMusico() || $login->isLocal())) {
	if ($login->isLocal()) {
 		echo HTML::title("h3","Concierto de " . $login->getUserDataCampo($_SESSION['band_id_concierto'],"usuario_nombre"));
 	}
 	if($login->isMusico()){
 		echo HTML::title("h3","Concierto en el local " . $login->getUserDataCampo($_SESSION['local_id_concierto'],"usuario_nombre"));
 	}
	echo HTML::open_form(ROUTER::create_action_url("event/concert"),"POST","form_new_concert");
	echo HTML::label("concierto_precio","Precio de concierto");
	echo HTML::input("text","concierto_precio",null,array("placeholder" => "xx€"));
	echo HTML::br(2);

	echo HTMl::label("concierto_fecha","Fecha del concierto:");
	echo HTML::input("text","concierto_fecha",null, array("placeholder" => "dia/mes/año"));
	echo HTML::br(2);

	echo HTML::label("concierto_duracion","Duración del concierto");
	echo HTML::input("text","concierto_duracion",null,array("placeholder" => "minutos"));
	echo HTML::br(2);

	echo HTML::label("concierto_aforo", "Aforo");
	echo HTML::input("text","concierto_aforo",null);
	echo HTML::br(2);
	
	echo HTML::input("submit","form_new_concert","Crear concierto");
	echo HTML::close_form();
}else{
	if (isset($_GET['verification_code'])) {
		
	}else{
		echo "Loggeate como músico o local para crear un concierto!";
	}
}
if (isset($_POST['form_new_concert'])) {
 	if ($login->isLocal()) {
 		$concert->newConcert($login->getUserId(),$_SESSION['band_id_concierto'],$_POST['concierto_fecha'],$_POST['concierto_precio'],$_POST['concierto_duracion'],$_POST['concierto_aforo']);
 	}
 	if($login->isMusico()){
 		$concert->newConcert($_SESSION['local_id_concierto'],$login->getUserId(),$_POST['concierto_fecha'],$_POST['concierto_precio'],$_POST['concierto_duracion'],$_POST['concierto_aforo']);
 	}
}
?>