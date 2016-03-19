<?php
    $local = new Local();
    if (isset($_GET['local_id'])) {
    	$local->getLocal($_GET['local_id'],10);
    }else{
    	$local->getLocalAll(90,false);
    }
?>