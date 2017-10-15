<?php

	$user = "*";
	if ( isset($_GET['user']) )
		$user = $_GET['user'];

	$pass = "*";
	if ( isset($_GET['pass']) )
		$pass = $_GET['pass'];


	require "mysql/mysql.php";
	$mysql_con->set_charset("utf8");

	$query = " SELECT * FROM alumno WHERE usuario = '$user' AND password = '$pass'; ";
	$result = $mysql_con->query($query);

	if ( $fila = $result->fetch_assoc() ) {

		//print_r($fila);

		echo json_encode($fila);
		//echo "compile 'com.loopj.android:android-async-http:1.4.9'";
		# code...
	}
	else {
		echo '{"id_alumno":"1","usuario":"ERROR","correo":"jair.mg.27@gmail.com","password":"SERVIDOR","nombre":"jair","genero":"masculino","localidad":"mexico","edad":"12","fecha_registro":"2017-05-01"}';
	}

	$mysql_con->close();
?>