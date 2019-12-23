<?php
	ob_start();
	//verificación del parametro
	$view = isset($_GET['view']) ? $_GET['view'] : 'index';
	//cargo la vista
	if (file_exists('view/'.$view.'-view.php')) {
		
		include("view/".$view."-view.php");
	}else{
		include("view/error-view.php");
		//echo "No existe";
	}
?> 