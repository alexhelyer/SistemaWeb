<?php

	$nombre = "";
	if (isset($_POST['nombre']))
		$nombre = $_POST['nombre'];

	$apellido = "";
	if (isset($_POST['apellido']))
		$apellido = $_POST['apellido'];

	$usuario = "";
	if (isset($_POST['usuario']))
		$usuario = $_POST['usuario'];

	$correo = "";
	if (isset($_POST['correo']))
		$correo = $_POST['correo'];


	$localidad = "";
	if (isset($_POST['localidad']))
		$localidad = $_POST['localidad'];

	$edad = "";
	if (isset($_POST['edad']))
		$edad = $_POST['edad'];

	$genero = "";
	if (isset($_POST['genero']))
		$genero = $_POST['genero'];


	$password = "";
	if (isset($_POST['password']))
		$password = md5($_POST['password']);

	date_default_timezone_set('America/Mexico_City');
	$fecha_registro = date("Y-m-d");

	require "mysql/mysql.php";
	$mysql_con->set_charset("utf8");

	//Revisamos que el usuario no exista.
	$query = " SELECT * FROM alumno WHERE usuario = '$usuario'; ";
	$result = $mysql_con->query($query);

	if ( $row = $result->fetch_assoc() ) {
		//El usuario ya fue registrado.
		//echo "-1: !El usuario ya existe¡";
		echo "100";
	}
	else {
		//Verificamos el correo.
		$query = " SELECT * FROM alumno WHERE correo = '$correo'; ";
		$result = $mysql_con->query($query);
		if ( $row = $result->fetch_assoc() ) {
			//El correo ya fue registrado.
			echo "150";
			//echo "0";
		}
		else {			
			//El usuario no existe. Lo registramos.
			$query = " INSERT INTO alumno (usuario, correo, password, nombre, genero, localidad, edad, fecha_registro, activado) VALUES ('$usuario', '$correo', '$password', '$nombre', '$genero', '$localidad', '$edad', '$fecha_registro', 1); ";
			$insert = $mysql_con->query($query);

			//Le creamos la tabla donde guardaremos su progreso
			$query = " INSERT INTO datos (usuario, puntos, perfil, promedio, progreso, efectividad) VALUES ('$usuario', 0, 1, '0-0', '00-00-00-00-00', '0-0-0'); ";
			$insert = $mysql_con->query($query);
			echo "200";

			EnviarCorreo($correo);
			//echo "1";
		}
	}
	$mysql_con->close();



	function EnviarCorreo($to_email) {

		$correo = $to_email;
		
		require("includes/class.phpmailer.php");
		$mail = new PHPMailer();

		$my_email = "unlockhelyer@gmail.com";
		$my_pass = "alex123456";

		$mail->IsSMTP();
		$mail->Host = "smtp.gmail.com";
		$mail->SMTPDebug = 2;
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "tls";
		$mail->Port = 587;

		$mail->From  = $my_email; //Dirección desde la que se enviarán los mensajes.
		$mail->FromName = "Bienvenido a Mathe";
		$mail->AddAddress($correo); // Dirección a la que llegaran los mensajes.

		// Aquí van los datos que apareceran en el correo que reciba
		$mail->CharSet = "UTF-8";
		$mail->WordWrap = 50;
		$mail->IsHTML(true);
		$mail->Subject  =  "Comentario recibido a traves del Sitio Web";
		$mail->Body     =  '
			<!DOCTYPE html>
			<html lang="es_MX">
			<head>
				<meta charset="UTF-8">
				<title>Registro</title>
			</head>
			<body>

				<div class="container">
					<h1 class="titulo">¡Te damos la Bienvenida!</h1>
					<br><br>
					<p>Gracias por registrarte en Mathe, la aplicación que te permite realizar ejercicios matematicos para mejorar tus habilidades.</p>
					<!--<p>Gracias por registrarte en Mathe, la aplicación que te permite realizar ejercicios matematicos para mejorar tus habilidades. Presiona en el siguiente boton para activar tu cuenta.</p>-->

					<!--<a class="btn-activar" href="https://myappmate.000webhostapp.com/activarCuenta.php?email='.$correo.'&token='.md5($correo).'&flag=a89c4e9546c58a6bf0e96c634cd7faad">Activar Cuenta</a>-->

					<p>Recibe un saludo por parte del equipo de Mathe.</p>

					
				</div>
				
			</body>
			<style>
				* {
					padding: 0;
					margin: 0;
				}
				body {
					background-color: #fefefe;
				}
					.container {
						display: block;
						box-sizing: border-box;
						width: 80%;
						margin: 3% 10%;
					}
						.titulo {
							background-color: black;
							color: white;
							padding: 10px 20px;
						}
					.container p {
						padding: 10px 20px;

					}
						.btn-activar {
							display: inline-block;
							box-sizing: border-box;
							margin-left: 20px;
							padding: 10px 20px;

							background-color: #4CAF50;
							color: white;

							text-decoration: none;

							transition: all 0.3s ease;
						}
						.btn-activar:hover {
							background-color: #3e8e41;
						}
			</style>
			</html>
		';


		// Datos del servidor SMTP
		$mail->Username = $my_email;  // Correo Electrónico
		$mail->Password = $my_pass; // Contraseña

		if ($mail->Send()) {
			//Actualizar contraseña.
			echo "StatusCode=200";
		}
		else {
			echo "StatusCode=100";
		}

	}


?>




