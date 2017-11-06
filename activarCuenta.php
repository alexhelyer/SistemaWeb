<?php
	

	$flag = "*";
	if ( isset($_GET['flag']) )
		$flag = $_GET['flag'];


	if ( $flag == "a89c4e9546c58a6bf0e96c634cd7faad" ) {
		//echo "Activar Cuenta";

		$token = "*";
		if ( isset($_GET['token']) )
			$token = $_GET['token'];

		$email = "*";
		if ( isset($_GET['email']) )
			$email = $_GET['email'];


		//echo "<br>".$email."->$token<br>";
		//echo "<br>".md5($email)."->$token<br>";



		if ( md5($email) == $token ) {
			//echo "Cohinciden";

			require "mysql/mysql.php";
			$mysql_con->set_charset("utf8");

			$query = " UPDATE alumno SET activado = 1 WHERE correo = '$email'; ";
			$execute = $mysql_con->query($query);


			$mysql_con->close();

			echo '
				<!DOCTYPE html>
				<html lang="ens_MX">
				<head>
					<meta charset="UTF-8">
					<title>Gracias</title>
				</head>
				<body>

					<div>
						<h1>¡Tu cuenta ha sido activada!</h1>
					</div>
					
				</body>
				<style>
					
					body {
						background-color: lightblue;
						text-align: center;
					}
					h1 {
						color: white;
					}
				</style>
				</html>
			';

		}
		else {
			echo "NO Cohiciden";
		}
	}
	else {
		echo "URL Corrupto";
	}

?>

