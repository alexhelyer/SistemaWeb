<?php
	
	require '../mysql/mysql.php';
	$mysql_con->set_charset("utf8");

	if(isset($_POST["enviar_verdadero_falso"])){

		$tema = $_POST["tema"];
		$subtema = $_POST["subtema"];
		$grado = $_POST["grado"];
		$nivel = $_POST["nivel"];
		$reactivo = $_POST["reactivo"];
		$respuesta = $_POST["respuesta"];
		$visto = 0;
		date_default_timezone_set('America/Mexico_City');
		$fecha = date("Y-m-d");
		//echo $tema.",".$subtema.",".$grado.",".$nivel.",".$reactivo.",".$respuesta;

		$query ="INSERT INTO reactivo_verdadero_falso (tema,subtema,grado,nivel,reactivo,respuesta,visto,fecha) VALUES ('".$tema."', '".$subtema."', ".$grado.", ".$nivel.", '".$reactivo."', ".$respuesta.", ".$visto.", '".$fecha."');";



			$result = $mysql_con->query($query);

			$mysql_con->close();
			//echo "<a href='../subir.html'>Regresar</a>";
	   		//header( "Location: ../subir.html" ) ;
		

	}

	if(isset($_POST["enviar_opcion_multiple"])){

		$tema = $_POST["tema"];
		$subtema = $_POST["subtema"];
		$grado = $_POST["grado"];
		$nivel = $_POST["nivel"];
		$reactivo = $_POST["reactivo"];
		$respuesta = $_POST["respuesta"];
		$incorrecta1 = $_POST["inco_1"];
		$incorrecta2 = $_POST["inco_2"];
		$incorrecta3 = $_POST["inco_3"];
		$visto = 0;
		date_default_timezone_set('America/Mexico_City');
		$fecha = date("Y-m-d");
		//echo $tema.",".$subtema.",".$grado.",".$nivel.",".$reactivo.",".$respuesta;

		$query ="INSERT INTO reactivo_multiple (tema,subtema,grado,nivel,reactivo,respuesta,incorrecta1,incorrecta2,incorrecta3,visto,fecha) VALUES ('".$tema."', '".$subtema."', ".$grado.", ".$nivel.", '".$reactivo."', '".$respuesta."', '".$incorrecta1."', '".$incorrecta2."', '".$incorrecta3."', ".$visto.", '".$fecha."');";



			$result = $mysql_con->query($query);

			$mysql_con->close();
			//echo "<a href='../subir.html'>Regresar</a>";
	   		//header( "Location: ../subir.html" ) ;



	}

	if(isset($_POST["enviar_opcion_abierta"])){

		$tema = $_POST["tema"];
		$subtema = $_POST["subtema"];
		$grado = $_POST["grado"];
		$nivel = $_POST["nivel"];
		$reactivo = $_POST["reactivo"];
		$respuesta = $_POST["respuesta"];
		$visto = 0;
		date_default_timezone_set('America/Mexico_City');
		$fecha = date("Y-m-d");
		//echo $tema.",".$subtema.",".$grado.",".$nivel.",".$reactivo.",".$respuesta;

		$query ="INSERT INTO reactivo_abierto (tema,subtema,grado,nivel,reactivo,respuesta,visto,fecha) VALUES ('".$tema."', '".$subtema."', ".$grado.", ".$nivel.", '".$reactivo."', ".$respuesta.", ".$visto.", '".$fecha."');";



			$result = $mysql_con->query($query);

			$mysql_con->close();
			//echo "<a href='../subir.html'>Regresar</a>";
	   		//header( "Location: ../subir.html" ) ;

	}

	//header( "Location: ../subir.php" ) ;

	echo "<script>alert('¡Se ha añadido un nuevo reactivo a la base de datos!');  location.href = '../subir.php';</script>";
	

?>