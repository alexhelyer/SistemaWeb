<?php

	$user = "*";
	if ( isset($_GET['user']) )
		$user = $_GET['user'];

	$puntos = 0;
	if ( isset($_GET['puntos']) )
		$puntos = $_GET['puntos'];

	$perfil = 0;
	if ( isset($_GET['perfil']) )
		$perfil = $_GET['perfil'];

	$promedio = "0-0";
	if ( isset($_GET['promedio']) )
		$promedio = $_GET['promedio'];

	$progreso = "00-00-00-00-00";
	if ( isset($_GET['progreso']) )
		$progreso = $_GET['progreso'];

	$efectividad = "0-0-0";
	if ( isset($_GET['efectividad']) )
		$efectividad = $_GET['efectividad'];

	require "mysql/mysql.php";
	$mysql_con->set_charset("utf8");

	$query = " SELECT * FROM datos WHERE usuario = '$user' ";
	$result = $mysql_con->query($query);

	if ( $row = $result->fetch_assoc() ) {
		//echo "Se encontro al usuario";
		$query = " UPDATE datos SET puntos = $puntos, perfil = $perfil, promedio = '$promedio', progreso = '$progreso', efectividad = '$efectividad' WHERE usuario = '$user'  " ;
		$update = $mysql_con->query($query);
		echo "200";
	}
	else {
		//echo "No se encontro al usuario";
		echo "404";
	}

	$mysql_con->close();

?>