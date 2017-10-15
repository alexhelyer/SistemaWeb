<?php
	
	require '../mysql/mysql.php';

	if ( isset($_POST['btn-perfil'])) {
		//echo "Actualizar Perfil";
		$nombre = $_POST['nombre'];
		$apellidos = $_POST['apellidos'];
		$email = $_POST['email'];

		$query ="UPDATE administrador set nombre_adm = '".$nombre."', apellidos_adm = '".$apellidos."', correo_adm = '".$email."'  where id_adm=1;";
		$result = $mysql_con->query($query);
		$mysql_con->close();
		//echo "<a href='../ajustes.html'>Regresar</a>";

	}
	if ( isset($_POST['btn-pass'])) {
		//echo "Actualizar Pass";
		$pass = $_POST['password'];
		$nuevo_pass = $_POST['new_pass01'];
		$confirma_pass = $_POST['new_pass02'];

		//Verificamos que la contraseña sea correcta
		$query = "SELECT * FROM administrador;";
		$result = $mysql_con->query($query);
		$fila = $result->fetch_assoc();
		$password = $fila['pass_adm'];

		if ( strcmp(md5($pass), $password)==0 ) {
			//echo "contraseña correcta";
			if ( strcmp($nuevo_pass, $confirma_pass)==0 ) {
				//echo "Las contraseñas coinciden";
				$query ="UPDATE administrador set pass_adm = '".md5($nuevo_pass)."' where id_adm=1;";
				$result = $mysql_con->query($query);

				$mysql_con->close();
				echo "<script>location.href = '../ajustes.php';</script>";
			}
			else {
				$mysql_con->close();
				echo "<script>alert('¡Las contraseñas no coinciden!'); location.href = '../ajustes.php';</script>";
			}
		}
		else {
			$mysql_con->close();
			echo "<script>alert('¡La contraseña actual es incorrecta!'); location.href = '../ajustes.php';</script>";
		}

		//echo "PassWord: ".$password;

		//$query ="UPDATE administrador set nombre_adm = '".$nombre."', apellidos_adm = '".$apellidos."', correo_adm = '".$email."'  where id_adm=1;";
		//$result = $mysql_con->query($query);
		//$mysql_con->close();
		//echo "<a href='../ajustes.php'>Regresar</a>";

	}
	//header( "Location: ../ajustes.php" ) ;
	echo "<script>location.href = '../ajustes.php';</script>";

?>