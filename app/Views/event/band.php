<?php
    $band = new Band();
    if (isset($_GET['band_id'])) {
    	$band->getBand($_GET['band_id'],10);
    }else{
    	$band->getBandAll(90,false);
    }
?>