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
		echo json_encode($fila);
	}
	else {
		echo '{"id_alumno":"0","usuario":"ERROR","correo":"jair.mg.27@gmail.com","password":"SERVIDOR","nombre":"jair","genero":"masculino","localidad":"mexico","edad":"12","fecha_registro":"2017-05-01"}';
	}

	$mysql_con->close();
?>