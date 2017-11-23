<?php

	$user = "*";
	if ( isset($_GET['user']) )
		$user = $_GET['user'];

	$pass = "*";
	if ( isset($_GET['pass']) )
		$pass = md5($_GET['pass']);


	require "mysql/mysql.php";
	$mysql_con->set_charset("utf8");

	$query = " SELECT * FROM alumno WHERE usuario = '$user' AND password = '$pass' OR correo = '$user' AND password = '$pass'; ";
	$result = $mysql_con->query($query);

	if ( $fila = $result->fetch_assoc() ) {

		$activado = $fila['activado']*1;

		if ( $activado ) {
			echo json_encode($fila);
		}
		else {
			echo '{"id_alumno":"12","usuario":"300","correo":"alexhelyer7@gmail.com","password":"827ccb0eea8a706c4c34a16891f84e7b","nombre":"Alejandro","genero":"Masculino","localidad":"CDMX","edad":"11","fecha_registro":"2017-11-05","nivel":"1","activado":"1"}';
		}
	}
	else {
		echo '{"id_alumno":"12","usuario":"100","correo":"alexhelyer7@gmail.com","password":"827ccb0eea8a706c4c34a16891f84e7b","nombre":"Alejandro","genero":"Masculino","localidad":"CDMX","edad":"11","fecha_registro":"2017-11-05","nivel":"1","activado":"1"}';
	}

	$mysql_con->close();
?>