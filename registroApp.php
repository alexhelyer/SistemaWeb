<?php

	$nombre = "";
	if (isset($_POST['nombre']))
		$nombre = $_POST['nombre'];

	$apellido = "";
	if (isset($_POST['apellido']))
		$apellido = $_POST['apellido'];

	$usuario = "";
	if (isset($_POST['usuario']))
		$usuario = $_POST['usuario'];

	$correo = "";
	if (isset($_POST['correo']))
		$correo = $_POST['correo'];


	$localidad = "";
	if (isset($_POST['localidad']))
		$localidad = $_POST['localidad'];

	$edad = "";
	if (isset($_POST['edad']))
		$edad = $_POST['edad'];

	$genero = "";
	if (isset($_POST['genero']))
		$genero = $_POST['genero'];


	$password = "";
	if (isset($_POST['password']))
		$password = md5($_POST['password']);

	date_default_timezone_set('America/Mexico_City');
	$fecha_registro = date("Y-m-d");

	require "mysql/mysql.php";
	$mysql_con->set_charset("utf8");

	//Revisamos que el usuario no exista.
	$query = " SELECT * FROM alumno WHERE usuario = '$usuario'; ";
	$result = $mysql_con->query($query);

	if ( $row = $result->fetch_assoc() ) {
		//El usuario ya fue registrado.
		echo "-1: !El usuario ya existe¡";
		//echo "-1";
	}
	else {
		//Verificamos el correo.
		$query = " SELECT * FROM alumno WHERE correo = '$correo'; ";
		$result = $mysql_con->query($query);
		if ( $row = $result->fetch_assoc() ) {
			//El correo ya fue registrado.
			echo "0: !El correo ya fue registrado¡";
			//echo "0";
		}
		else {			
			//El usuario no existe. Lo registramos.
			$query = " INSERT INTO alumno (usuario, correo, password, nombre, genero, localidad, edad, fecha_registro) VALUES ('$usuario', '$correo', '$password', '$nombre', '$genero', '$localidad', '$edad', '$fecha_registro'); ";
			$insert = $mysql_con->query($query);
			echo "1: Se registro nuevo usuario";
			//echo "1";
		}
	}



	$mysql_con->close();


?>