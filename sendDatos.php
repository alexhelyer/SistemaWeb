<?php

	require "mysql/mysql.php";
	$mysql_con->set_charset("utf8");


	$abierta = 1;
	if ( isset($_GET['abierta']) )
		$abierta = $_GET['abierta'];

	$multiple = 1;
	if ( isset($_GET['multiple']) )
		$multiple = $_GET['multiple'];

	$vf = 1;
	if ( isset($_GET['vf']) )
		$vf = $_GET['vf'];

	$datos = array();

	$x=0;
	$query = " SELECT * FROM reactivo_abierto WHERE 1 ";
	$result = $mysql_con->query($query);

	for ($i=0; $i < $abierta; $i++) { 
		$fila = $result->fetch_assoc();
		$datos[$x] = $fila;
		$x++;
	}

	$query = " SELECT * FROM reactivo_multiple WHERE 1 ";
	$result = $mysql_con->query($query);

	for ($i=0; $i < $multiple; $i++) { 
		$fila = $result->fetch_assoc();
		$datos[$x] = $fila;
		$x++;
	}

	$query = " SELECT * FROM reactivo_verdadero_falso WHERE 1 ";
	$result = $mysql_con->query($query);

	for ($i=0; $i < $vf; $i++) { 
		$fila = $result->fetch_assoc();
		$datos[$x] = $fila;
		$x++;
	}

	echo json_encode($datos);



	$mysql_con->close();
?>