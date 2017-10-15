<?php
	session_start();

	if( !isset($_SESSION['user']))
		header( "Location: index.php" ) ;
?>
<!DOCTYPE html>
<html lang="es-MX">
	<head>
		<meta charset="UTF-8">
		<title> AJUSTES </title>
		<script src="js/jquery.min.js"></script>
		<link rel="stylesheet" href="css/iconos.css">
		<link rel="stylesheet" href="css/style00.css">
	</head>

	<body>

		<section id="loading">
			<p>cargando...</p>
		</section>

		<div id="main">
			<!-- Barra Lateral de Menu -->
			<header class="barra-lateral" style="left: -20%;">
				<nav class="menu">
					<ul>
						<li class="li-m"><a href="subir.php" style="margin-top: 80px;"><span class="icon-box-remove"></span>Subir</a></li>
						<li class="li-m"><a href="ver.php"><span class="icon-list-numbered"></span>Ver</a></li>
						<li class="li-m"><a href="estadisticas.php"><span class="icon-pie-chart"></span>Estadísticas</a></li>
						<li class="li-m"><a href="ajustes.php"><span class="icon-cog"></span>Ajustes</a></li>
						<li class="li-m"><a href="php/cerrar_sesion.php"><span class="icon-exit"></span>Cerrar Sesión</a></li>
					</ul>
				</nav>
			</header>
			
			<!-- Seccion principal aqui es donde se pone todo el contenido -->
			<section class="main_section">
				<div id="toggle-menu"> ☰ </div>
				<h1 class="main_spacing"></h1>

				<div class="type-content">
					<h1 class="main_titulo">Ajustes</h1>


					<div class="radio-tipo" style="width: 50%">
						<input type="radio" class="tipo_reactivo" name="tipo_reactivo" id="tipo01" checked></input>
						<label for="tipo01">Editar Perfil</label>
					</div><!--

				/--><div class="radio-tipo" style="width: 50%">
						<input type="radio" class="tipo_reactivo" name="tipo_reactivo" id="tipo02"></input>
						<label for="tipo02">Cambiar Contraseña</label>
					</div>
				</div>

				<!-- DATOS DEL ADMINISTRADOR-->
				<form id="form_perfil01" class="form_type" action="php/actualizar_datos.php" method="post">
					<?php
						//CONSULTA DE TODAS LAS CUENTAS EXISTENTES:
						require 'mysql/mysql.php';

						$query = "SELECT * FROM administrador;";
						$result = $mysql_con->query($query);

						$fila = $result->fetch_assoc();

						echo '
							<label class="lab_form">Nombre</label><!--
						/--><input class="input_form edit_info" type="text" value="'.$fila['nombre_adm'].'" name="nombre" disabled>

							<label class="lab_form">Apellidos</label><!--
						/--><input class="input_form edit_info" type="text" value="'.$fila['apellidos_adm'].'" name="apellidos" disabled>

							<label class="lab_form">Correo</label><!--
						/--><input class="input_form edit_info" type="text" value="'.$fila['correo_adm'].'" name="email" disabled>
						';

						//Cerramos la base de datos.
						$mysql_con->close();
					?>
					<br><br><a id="btn_editar" class="editar_boton">Editar</a>
					<br><br><input id="btn-guardar" class="guardar_boton" type="submit" value="Guardar" name="btn-perfil">
				</form>

				<!-- DATOS CONTRASEÑAS ADMINSTRADOR -->
				<form id="form_perfil02" class="form_type" action="php/actualizar_datos.php" method="post">
					<label class="lab_form">Escriba su contraseña</label><!--
				/--><input class="input_form" type="password" name="password" required>

					<label class="lab_form">Nueva Contraseña</label><!--
				/--><input class="input_form" type="password" name="new_pass01" required>

					<label class="lab_form">Confirma Nueva Contraseña</label><!--
				/--><input class="input_form" type="password" name="new_pass02" required>

					<br><br><input class="guardar_boton" type="submit" value="Cambiar Contraseña" name="btn-pass">
				</form>
			</section>
		</div>

		<script src="js/script-selects.js"></script>
		<script src="js/script-toggle.js"></script>

		<!-- EFECT CARGANDO PAGINA -->
		<script>
			$(function(){
				$('#loading').delay(600).fadeOut(200);
			});
		</script>

<script>
	
$(function() {

	$('.form_type').hide();
	$('#form_perfil01').show();
	$('#tipo01').click(function(){
		$('.form_type').hide();
		$('#form_perfil01').show();

	});
	$('#tipo02').click(function(){
		$('.form_type').hide();
		$('#form_perfil02').show();

		$('.edit_info').attr('disabled',true);
		$('.edit_info').css('background-color','lightgray');

		$('#btn-guardar').hide();

		$('#btn_editar').css('visibility', 'visible');


	});

});

</script>

<!-- SCRIPT BOTONES EDITAR-ENVIAR-->
<script>

$(function() {
	$('#btn-guardar').hide();
	$('#btn_editar').show();

	$('#btn_editar').click(function(){
		$('#btn-guardar').show();
		$('#btn_editar').css("visibility","hidden");
	});
	
});
	
</script>

<script>
	
$(function(){

	$('#btn_editar').click(function(){
		$('.edit_info').attr('disabled',false);
		$('.edit_info').css('background-color','white');
	});

});

</script>
  
  </body>

</html>