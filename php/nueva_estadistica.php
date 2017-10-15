<?php
	//echo "Nueva estadistica <br><br>";

	$fechaini = "";
	if ( isset($_POST['fechaini']) )
		$fechaini = $_POST['fechaini'];

	$fechaend = "";
	if ( isset($_POST['fechaend']) )
		$fechaend = $_POST['fechaend'];

	//echo "INI: $fechaini       END: $fechaend";

	echo "<script>location.href = '../estadisticas.php?fini=$fechaini&fend=$fechaend';</script>";

?>