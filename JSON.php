<?php
	//echo "Aqui voy a hacer lo del JSON";

	$data[0] = "Alex";
	$data[1] = "Martinez";
	$data[2] = "Barragan";

	require "mysql/mysql.php";
	$mysql_con->set_charset("utf8");




	$id = 1;
	if ( isset($_GET['token']) ) {

		if ( is_numeric($_GET['token']) )
			$id = $_GET['token'];

		//echo "ID:".$id;
		$query = " SELECT * FROM reactivo_verdadero_falso WHERE id_reactivo_vf=$id ; ";
		$result = $mysql_con->query($query);

		$datos = array();
		if ( $fila = $result->fetch_assoc() ) {
			//echo "string";
			$datos[] = $fila;
			echo json_encode($datos);
		}


	//$datos = array();
	//while ( $fila = $result->fetch_assoc() ) {
	//$datos[] = $fila;
	//}
		//echo json_encode($datos);

	}


	





	$mysql_con->close();
?>