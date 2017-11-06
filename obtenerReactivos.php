<?php
	include "mysql/mysql.php";
	$mysql_con->set_charset("utf8");

	$tipo = 0;
	if ( isset($_GET['tipo']) )
		$tipo = $_GET['tipo']*1;

	$grado = 0;
	if ( isset($_GET['grado']) )
		$grado = $_GET['grado']*1;

	$nivel = 0;
	if ( isset($_GET['nivel']) )
		$nivel = $_GET['nivel']*1;

	$subtema = "0";
	if ( isset($_GET['subtema']) )
		$subtema = $_GET['subtema'];

	echo "<script> console.log('tipo:'+$tipo+'   grado:'+$grado+'   nivel:'+$nivel+'   subtema:$subtema'); </script>";

	$query = " SELECT * FROM reactivo_abierto WHERE grado = 1 AND nivel = 1 AND subtema = 'enteros'; ";

	if ( $tipo == 1 ) {
		$query = " SELECT * FROM reactivo_multiple WHERE grado = $grado AND nivel = $nivel AND subtema = '$subtema'; ";
	}
	else if ( $tipo == 2 ) {
		$query = " SELECT * FROM reactivo_verdadero_falso WHERE grado = $grado AND nivel = $nivel AND subtema = '$subtema'; ";
	}

	$result = $mysql_con->query($query);

	$datos = array();
	$x=0;
	while ( $row = $result->fetch_assoc() ) {
		echo "<script> console.log('x:$x'); </script>";
		$datos[$x] = $row;
		$x++;
	}

	$json = json_encode($datos);

	echo $json;

	$mysql_con->close();

?>