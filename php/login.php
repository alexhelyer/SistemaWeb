<?php
//////////////////////////////////////////////////////////////////////////////////////////////////////

	/* VARIABLES INICIALES */
	include '../mysql/mysql.php';
	//Definimos la codificacion.
	//mysql_set_charset("utf8");

	//Inicializamos las variables a usar.
	$usuario 	= "NULL";
	$pass 		= "NULL";

	//Guardamos los datos enviados.
	//if ( isset($_POST['username']) )
		$usuario = $_POST['username'];

	//if ( isset($_POST['password']) )
		$pass = $_POST['password'];

/////////////////////////////////////////////////////////////////////////////////////////////////////
	
	/*CONSULTA EN LA BASE DE DATOS */
	$query = "SELECT * FROM administrador WHERE usuario_adm = '".$usuario."'";
	$result = $mysql_con->query($query);

////////////////////////////////////////////////////////////////////////////////////////////////////	

	if( $fila = $result->fetch_assoc() ) {

		if (strcmp($fila['pass_adm'],md5($pass)) != 0) {
			//echo "La contraseña es incorrecta";
			echo "<script>location.href = '../index.php?err=1';</script>";

		}
		else {
			//echo "La contraseña es CORRECTA";
			//Iniciamos una sesion

			$timea = 0.1;
			$timedb = 0.1;
			$dif = 0.1;

			session_start();

			//Generamos la fecha actual de ingreso.
			date_default_timezone_set("America/Mexico_City");
			$fecha_hora = date("Y-m-d H:i:s");
			//$fecha_en_bd = "2020-01-01 00:00:00";

			//Almacenamos la ultima fecha de desconexión.
			$query2 = "SELECT * FROM administrador WHERE usuario_adm = '".$usuario."'";
			$result2 = $mysql_con->query($query2);

			if ( $fila2 = $result2->fetch_assoc() )
				$fecha_en_bd = $fila2['date_logout'];


			$timea = strtotime($fecha_hora) + 0.1 ;
			
			$timedb = strtotime($fecha_en_bd) + 0.1 ;

			$dif = $timea - $timedb;

			$dif = $dif + 1.2 ;

			//echo "fhora: ".$timea."        fdb: ".$timedb."        dif: ".$dif;

			if ( $dif<0 ) {
				//SI ALGUIEN ESTA CONECTADO CON EL MISMO USUARIO:
				echo "<script>location.href = '../index.php?active=0';</script>";				
			}	
			else {
				$_SESSION['user'] =   $usuario;
				$_SESSION['tipo'] =   $fila['tipo'];
				$_SESSION['nombre'] = $fila['nombre_adm'];
				//SI EL INICIO DE SESION ES CORRECTO ACTUALIZAMOS LA BASE DE DATOS
				$query = "UPDATE administrador SET date_login='".date( "Y-m-d H:i:s", strtotime($fecha_hora) )."' WHERE usuario_adm = '".$usuario."'";
				$result = $mysql_con->query($query);

				$query = "UPDATE administrador SET date_logout='".date( "Y-m-d H:i:s", strtotime($fecha_hora)+1440 )."' WHERE usuario_adm = '".$usuario."'";
				$result = $mysql_con->query($query);

				echo "<script>location.href = '../subir.php';</script>";
				
			}
		}

	} 
	else {
		// SI EL NOMBRE DE USUARIO NO SE ENCUENTRA EN LA BASE DE DATOS REGRESAMOS AL INDEX
		//header( "Location: ../index.php?err=0" ) ;
		//echo "user:".$usuario."   pass:".$pass;
		echo "<script>location.href = '../index.php?err=0';</script>";

	}

	//Cerrar conexión a la base de datos.
	$mysql_con->close(); 

////////////////////////////////////////////////////////////////////////////////////////////////////
?>
