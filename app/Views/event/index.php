<?php 
$login = new ModelLogin();
$concert = new Concert();

foreach ($concert->getConciertoAll(null,"aceptado") as $row) {
	echo HTML::open_div(array("class" => "col-lg-6"));
	echo HTML::title("h3","Concierto de " . $login->getUserDataCampo($row['musico_id'],"usuario_nombre") . " en " . $login->getUserDataCampo($row['local_id'],"usuario_nombre"));
	echo HTML::label("concierto_fecha","Fecha:");
	echo $row['concierto_fecha'];
	echo HTML::br(2);
	echo HTML::label("concierto_precio","Precio entrada:");
	echo $row['concierto_precio'] . "€";
	echo HTML::br(2);
	echo HTML::label("concierto_duracion","Duración concierto:");
	echo $row['concierto_duracion'] . " min";
	echo HTML::br(2);
	echo HTML::label("concierto_asistentes","Aforo:");
	echo $row['concierto_asistentes'];
	echo HTML::close_div();
}
 ?>