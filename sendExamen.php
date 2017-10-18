<?php

	require "mysql/mysql.php";

	$mysql_con->set_charset("utf8");



	$query = " SELECT * FROM examen WHERE 1; ";
	$result = $mysql_con->query($query);


	$data = array();
	$x=0;
	while ( $row = $result->fetch_assoc() ) {


		$data[$x] = $row;

		$x++;
	}


	$json = json_encode($data);


	echo $json;

	$mysql_con->close();

?>