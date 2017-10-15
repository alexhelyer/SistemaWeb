<?php
	$mysql_server = "localhost";
	$mysql_user = 'root';
	$mysql_pass = '';
	$mysql_db = "base_web";

	//Conexion
	$mysql_con = new mysqli($mysql_server,$mysql_user,$mysql_pass,$mysql_db);

	//Probar
	if($mysql_con->connect_error){
		die("Conexion con base de datos fallida: ".$con->connect_error);
	}
?>
