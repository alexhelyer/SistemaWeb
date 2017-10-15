<?php

	$id = "1";
	if (isset($_POST['id']))
		$id = $_POST['id'];

	$tipo = "1";
	if (isset($_POST['tipo']))
		$tipo = $_POST['tipo'];

	$reactivo = "1";
	if (isset($_POST['reactivo']))
		$reactivo = $_POST['reactivo'];

	$respuesta = "1";
	if (isset($_POST['respuesta']))
		$respuesta = $_POST['respuesta'];

	$opc1 = "1";
	if (isset($_POST['opc1']))
		$opc1 = $_POST['opc1'];

	$opc2 = "1";
	if (isset($_POST['opc2']))
		$opc2 = $_POST['opc2'];

	$opc3 = "1";
	if (isset($_POST['opc3']))
		$opc3 = $_POST['opc3'];

	$opc4 = "1";
	if (isset($_POST['opc4']))
		$opc4 = $_POST['opc4'];

	require "../mysql/mysql.php";
	$mysql_con->set_charset("utf8");

	$query = " UPDATE examen SET tipo = $tipo, reactivo = '$reactivo', respuesta = '$respuesta', opc1 = '$opc1', opc2 = '$opc2', opc3 = '$opc3', opc4 = '$opc4' WHERE id=$id; ";

	$result=$mysql_con->query($query);


	$mysql_con->close();

?>

<script type="text/javascript">
	location.href = "../examen.php"
</script>