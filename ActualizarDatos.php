<?php

	$user = "*";
	if ( isset($_GET['user']) )
		$user = $_GET['user'];
	
	$nombre = "*";
	if ( isset($_GET['nombre']) )
		$nombre = $_GET['nombre'];

	$correo = "*";
	if ( isset($_GET['correo']) )
		$correo = $_GET['correo'];

	$genero = "*";
	if ( isset($_GET['genero']) )
		$genero = $_GET['genero'];

	$localidad = "*";
	if ( isset($_GET['localidad']) )
		$localidad = $_GET['localidad'];

	$edad = 0;
	if ( isset($_GET['edad']) )
		$edad = $_GET['edad'];

	$pass = "*";
	if ( isset($_GET['pass']) )
		$pass = $_GET['pass'];

	$cpass = "*";
	if ( isset($_GET['cpass']) )
		$cpass = $_GET['cpass'];

	$mipass = md5($pass);


	require "mysql/mysql.php";
	$mysql_con->set_charset("utf8");

	$query = " SELECT * FROM alumno WHERE usuario = '$user' ";
	$result = $mysql_con->query($query);

	if ( $row = $result->fetch_assoc() ) {
		//echo "Se encontro al usuario";

		if ( empty($pass) ) {
			$query = " UPDATE alumno SET nombre = '$nombre', correo = '$correo', genero = '$genero', localidad = '$localidad', edad = $edad WHERE usuario = '$user'  " ;
			$update = $mysql_con->query($query);
			echo "201";
		}
		else {
			$query = " UPDATE alumno SET nombre = '$nombre', correo = '$correo', genero = '$genero', localidad = '$localidad', edad = $edad, password = '$mipass' WHERE usuario = '$user'  " ;
			$update = $mysql_con->query($query);
			echo "202";
		}
		
	}
	else {
		//echo "No se encontro al usuario";
		echo "404";
	}

	$mysql_con->close();

?>