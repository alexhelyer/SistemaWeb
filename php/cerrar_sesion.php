<?php
	session_start();
	include "../mysql/mysql.php";
	//Restablecemos los tiempos
	$fecha_hora = "2017-08-01 00:00:00";

	$query = "UPDATE administrador SET date_logout='".$fecha_hora."' WHERE usuario_adm = '".$_SESSION['user']."'";
	$result = $mysql_con->query($query);
	$mysql_con->close();

	//Destruimos la sesion
	


	//print_r($_SESSION);

	session_unset();
	//echo "<br>session_unset<br>";
	//print_r($_SESSION);
	session_destroy();
	//Cerramos la base de datos
	//echo "<br>session_destroy<br>";
	//print_r($_SESSION);

	echo "<script>location.href = '../index.php';</script>";
?>