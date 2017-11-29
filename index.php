<?php
	session_start();
	if(isset($_SESSION['user'])) {
		header( "Location: subir.php" );
	}
?>
<!DOCTYPE html>
<html lang="es-MX">
<head>
	<meta charset="UTF-8">
  <link rel="shortcut icon" href="favicon.png"/>
	<title>Iniciar Sesión</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
	<link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
	<link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Montserrat:400,700'>
	<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
	<link rel="stylesheet" href="css/style.css">

</head>
<body>

	<div class="container">
		<div class="info">
			<h1>Inicio de Sesión</h1>
		</div>
  	</div>

  	<div class="form">
  		<div class="thumbnail"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/169963/hat.svg"/></div>

  		<form class="login-form" action="php/login.php" method="post">
  			<input type="text" placeholder="usuario" name="username" />
  			<input type="password" placeholder="contraseña" name="password"/>
        <?php
          if ( isset($_GET['err']) ) {
            echo '<p style="display:inline-block; padding: 5px 0px; text-align: center; color: red;">¡Los datos introducidos son incorrectos!</p>';
          }
          else if ( isset($_GET['active']) ) {
            echo '<p style="display:inline-block; padding: 5px 0px; text-align: center; color: orange;">¡Ya existe una sesion abierta!</p>';
          }
        ?>
  			<br><br><button>ENTRAR</button>
  		</form>
  		
  	</div>

  	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script>history.pushState(null, "", "index.php");</script>
</body>
</html>