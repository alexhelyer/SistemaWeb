<?php

	$user = "*";
	if ( isset($_GET['user']) )
		$user = $_GET['user'];


	require "mysql/mysql.php";
	$mysql_con->set_charset("utf8");

	$query = " SELECT * FROM datos WHERE usuario = '$user' ";
	$result = $mysql_con->query($query);

	if ( $row = $result->fetch_assoc() ) {
		//echo "Se encontro al usuario";
		//echo "200";
		echo $row['puntos']."/".$row['perfil']."/".$row['promedio']."/".$row['progreso']."/".$row['efectividad'];
	}
	else {
		//echo "No se encontro al usuario";
		echo "0/1/0-0/00-00-00-00-00/0-0-0";
	}

	$mysql_con->close();

?>