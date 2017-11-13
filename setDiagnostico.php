<?php
	
	require "mysql/mysql.php";
	$mysql_con->set_charset("utf8");

	$correo = "null";
	if ( isset($_GET['correo']) )
		$correo = $_GET['correo'];

	$nivel = 0;
	if ( isset($_GET['nivel']) )
		$nivel = $_GET['nivel']*1;

	$query = " UPDATE alumno SET nivel = $nivel WHERE correo = '$correo' ; ";
	$set = $mysql_con->query($query);

	$mysql_con->close();

?>