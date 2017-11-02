<?php


	
	require "mysql/mysql.php";
	$mysql_con->set_charset("utf8");

	$correo = "alex@helyer.com";
	if ( isset($_POST['correo']) )
		$correo = $_POST['correo'];

	//Revisamos si el correo esta en nuestra base de datos.
	$query = " SELECT * FROM alumno WHERE correo = '$correo'; ";
	$result = $mysql_con->query($query);

	if ( $row = $result->fetch_assoc() ) {
		//echo "Existe ese correo.";
		EnviarCorreo($correo);
	}
	else {
		echo "StatusCode=404";
	}

	$mysql_con->close();

	//EnviarCorreo();

	function generarPassword(){
	    //Se define una cadena de caractares. Te recomiendo que uses esta.
	    $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
	    //Obtenemos la longitud de la cadena de caracteres
	    $longitudCadena=strlen($cadena);
	     
	    //Se define la variable que va a contener la contraseña
	    $pass = "";
	    //Se define la longitud de la contraseña, en mi caso 10, pero puedes poner la longitud que quieras
	    $longitudPass=10;
	     
	    //Creamos la contraseña
	    for($i=1 ; $i<=$longitudPass ; $i++){
	        //Definimos numero aleatorio entre 0 y la longitud de la cadena de caracteres-1
	        $pos=rand(0,$longitudCadena-1);
	     
	        //Vamos formando la contraseña en cada iteraccion del bucle, añadiendo a la cadena $pass la letra correspondiente a la posicion $pos en la cadena de caracteres definida.
	        $pass .= substr($cadena,$pos,1);
	    }
	    return $pass;
	}

	function RecuperarPassword($email, $password) {
		require "mysql/mysql.php";
		$mysql_con->set_charset("utf8");

		$query = " UPDATE alumno SET password = '$password' WHERE correo = '$email';  ";
		$update = $mysql_con->query($query);

		$mysql_con->close();
	}



	function EnviarCorreo($to_email) {

		$correo = $to_email;
		
		require("includes/class.phpmailer.php");
		$mail = new PHPMailer();

		$my_email = "unlockhelyer@gmail.com";
		$my_pass = "alex123456";

		$new_pass = generarPassword();


		$mail->IsSMTP();
		$mail->Host = "smtp.gmail.com";
		$mail->SMTPDebug = 2;
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "tls";
		$mail->Port = 587;

		$mail->From  = $my_email; //Dirección desde la que se enviarán los mensajes.
		$mail->FromName = "Mathe Recovery System";
		$mail->AddAddress($correo); // Dirección a la que llegaran los mensajes.

		// Aquí van los datos que apareceran en el correo que reciba
		$mail->CharSet = "UTF-8";
		$mail->WordWrap = 50;
		$mail->IsHTML(true);
		$mail->Subject  =  "Comentario recibido a traves del Sitio Web";
		$mail->Body     =  "Tu nueva contraseña es: $new_pass";


		// Datos del servidor SMTP
		$mail->Username = $my_email;  // Correo Electrónico
		$mail->Password = $my_pass; // Contraseña

		if ($mail->Send()) {
			//Actualizar contraseña.
			RecuperarPassword($correo, md5($new_pass) );
			echo "StatusCode=200";
		}
		else {
			echo "StatusCode=100";
		}

	}
		

?>