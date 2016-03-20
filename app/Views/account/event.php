<?php 
$login = new ModelLogin();
$concert = new Concert();
echo HTML::title("h3","Todos tus eventos");
 ?>
 <table class="table table-hover">
 	<thead>
 		<tr>
 			<th>Fecha</th>
 			<?php if ($login->isLocal()): ?>
 				<th>Musico</th>
 			<?php else: ?>
 				<th>Local</th>
 			<?php endif ?>
 			<th>Precio</th>
 			<th>Aforo</th>
 			<th>Estado</th>
 			<th>Opciones</th>
 		</tr>
 	</thead>
 	<tbody>
 		<?php 
 			foreach ($concert->getConciertoUser($login->getUserId()) as $row) {
 				echo "<tr>";
	 				echo "<td>" . $row['concierto_fecha'] . "</td>";
	 				echo "<td>" . $login->getUserDataCampo($row['musico_id'],"usuario_nombre") . "</td>";
	 				echo "<td>" . $row['concierto_precio'] . "</td>";
	 				echo "<td>" . $row['concierto_asistentes'] . "</td>";
	 				echo "<td>" . $row['concierto_estado'] . "</td>";
	 				if ($concert->isPendiente($row['concierto_id'])) {
	 					echo "<td>" . HTML::a(ROUTER::create_action_url("account/event&verification_code=".$row['concierto_verification'].""),"Aprobar concierto") . "</td>";
	 				}
	 				if ($concert->isAccepted($row['concierto_id'])) {
	 					echo "<td>" . HTML::a(ROUTER::create_action_url("account/event&deny_code=".$row['concierto_verification'].""),"Denegar concierto") . "</td>";
	 				}
	 				if ($concert->isDeny($row['concierto_id'])) {
	 					echo "<td>" . HTML::a(ROUTER::create_action_url("account/event&verification_code=".$row['concierto_verification'].""),"Aprobar concierto") . "</td>";
	 				}
	 			echo "</tr>";
 			}
 		 ?>
 		</tr>
 	</tbody>
 </table>