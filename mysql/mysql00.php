<?php
	$mysql_server = "https://myappmate.000webhostapp.com";
	$mysql_user = 'id2760148_appweb';
	$mysql_pass = 'myappmate';
	$mysql_db = "id2760148_base_web";

	//Conexion
	$mysql_con = new mysqli($mysql_server,$mysql_user,$mysql_pass,$mysql_db);

	//Probar
	if($mysql_con->connect_error){
		die("Conexion con base de datos fallida: ".$con->connect_error);
	}
?>
