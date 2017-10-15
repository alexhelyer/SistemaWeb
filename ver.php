<?php
	session_start();

	if( !isset($_SESSION['user']))
		header( "Location: index.php" ) ;
?>
<!DOCTYPE html>
<html lang="es-MX">
	<head>
		<meta charset="UTF-8">
		<title> VER </title>
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

				<h1 class="main_titulo">Ver Reactivo</h1>
				<h1 class="main_spacing"></h1>

				<div class="form_type">
					<label class="lab_form"> Tipos de Reactivos </label><!--
				/--><select class="sel_form btn-primario" name="nivel" onchange="filtrar(value)">
						<option value="0"> Todos los Reactivos</option>
						<option value="1"> Verdadero - Falso </option>
						<option value="2"> Opción Multiple </option>
						<option value="3"> Opcion Abierta </option>
					</select>
				</div>

				<div id="form_1" class="div_type" style="padding: 40px 0%;">
					<h3 class="main_subtitulo">Reactivos Verdadero Falso</h3><br><br>
					<table class="tablas-ver">
						<tr>
							<th style="width: 30%; display: inline-block; padding: 10px 5px;">Reactivo</th>
							<th style="width: 20%; ">Respuesta</th> 
							<th style="width: 5%; ">Grado</th>
							<th style="width: 10%; ">Tema</th>
							<th style="width: 20%; ">Subtema</th>
							<th style="width: 5%; ">Nivel</th> 
							<th style="width: 10%; ">Fecha</th>
						</tr>

					<?php
						//CONSULTA DE TODAS LAS CUENTAS EXISTENTES:
						require 'mysql/mysql.php';
						$mysql_con->set_charset("utf8");

						$query = "SELECT * FROM reactivo_verdadero_falso;";
						$result = $mysql_con->query($query);

						//POR CADA CUENTA IMPRIMIR UNA FILA EN LA TABLA:
						$x = 1;

						while( $fila = $result->fetch_assoc() ){
							echo '
								<tr>
									<td>'.$fila['reactivo'].'</td>
									<td>'.$fila['respuesta'].'</td>
									<td style="text-align: center;">'.$fila['grado'].'</td>
									<td>'.$fila['tema'].'</td>
									<td>'.$fila['subtema'].'</td>
									<td style="text-align: center;"">'.$fila['nivel'].'</td>
									<td style="text-align: center;"">'.$fila['fecha'].'</td>
								</tr>
							';

							$x = $x+1;

						}

						//Cerramos la base de datos.
						$mysql_con->close();
					?>

					</table>
				</div>


				<div id="form_2" class="div_type" style="padding: 40px 0%;">
					<h3 class="main_subtitulo">Reactivos Opción Múltiple</h3><br><br>
					<table class="tablas-ver">
						<tr>
							<th style="width: 30%; display: inline-block; padding: 10px 5px;">Reactivo</th>
							<th style="width: 20%; ">Respuesta</th> 
							<th style="width: 5%; ">Grado</th>
							<th style="width: 10%; ">Tema</th>
							<th style="width: 20%; ">Subtema</th>
							<th style="width: 5%; ">Nivel</th> 
							<th style="width: 10%; ">Fecha</th>
						</tr>



					<?php
						//CONSULTA DE TODAS LAS CUENTAS EXISTENTES:
						require 'mysql/mysql.php';

						$query = "SELECT * FROM reactivo_multiple;";
						$result = $mysql_con->query($query);

						//POR CADA CUENTA IMPRIMIR UNA FILA EN LA TABLA:
						$x = 1;

						while( $fila = $result->fetch_assoc() ) {
							echo '
								<tr>
									<td>'.$fila['reactivo'].'</td>
									<td>'.$fila['respuesta'].'</td>
									<td style="text-align: center;">'.$fila['grado'].'</td>
									<td>'.$fila['tema'].'</td>
									<td>'.$fila['subtema'].'</td>
									<td style="text-align: center;"">'.$fila['nivel'].'</td>
									<td style="text-align: center;"">'.$fila['fecha'].'</td>
								</tr>
							';

							$x = $x+1;

						}

						//Cerramos la base de datos.
						$mysql_con->close();
					?>
					</table>
				</div>

				<div id="form_3" class="div_type" style="padding: 40px 0%;">
					<h3 class="main_subtitulo">Reactivos Opción Abierta</h3><br><br>
					<table class="tablas-ver">
						<tr>
							<th style="width: 30%; display: inline-block; padding: 10px 5px;">Reactivo</th>
							<th style="width: 20%; ">Respuesta</th> 
							<th style="width: 5%; ">Grado</th>
							<th style="width: 10%; ">Tema</th>
							<th style="width: 20%; ">Subtema</th>
							<th style="width: 5%; ">Nivel</th> 
							<th style="width: 10%; ">Fecha</th>
						</tr>

					<?php
						//CONSULTA DE TODAS LAS CUENTAS EXISTENTES:
						require 'mysql/mysql.php';

						$query = "SELECT * FROM reactivo_abierto;";
						$result = $mysql_con->query($query);

						//POR CADA CUENTA IMPRIMIR UNA FILA EN LA TABLA:
						$x = 1;

						while( $fila = $result->fetch_assoc() ) {
							echo '
								<tr>
									<td>'.$fila['reactivo'].'</td>
									<td>'.$fila['respuesta'].'</td>
									<td style="text-align: center;">'.$fila['grado'].'</td>
									<td>'.$fila['tema'].'</td>
									<td>'.$fila['subtema'].'</td>
									<td style="text-align: center;"">'.$fila['nivel'].'</td>
									<td style="text-align: center;"">'.$fila['fecha'].'</td>
								</tr>
							';

							$x = $x+1;

						}

						//Cerramos la base de datos.
						$mysql_con->close();
					?>
					</table>
				</div>







				<style>
					.main_subtitulo {
						display: block;
						width: 98%;
						padding: 10px;
						margin: 0 auto;
						text-align: center;

						background-color: #222222;
						color: white;

						border-radius: 4px;
					}
					.tablas-ver {
						width: 100%;
					}
					.tablas-ver tr {
						background-color: #EEEEEE;
					}
					.tablas-ver tr:nth-child(1) {
						background-color: #CCCCCC;
					}
					.tablas-ver tr td {
						padding: 10px 5px;
					}
					.tablas-ver tr td:nth-child(1) {
						display: inline-block;
						width: 99%;
						padding: 10px 5px;
					}
				</style>
			</section>

		</div>

		<script src="js/script-selects.js"></script>
		<script src="js/script-toggle.js"></script>

		<script>
			function filtrar(val) {

				if ( val == 1) {
					$('.div_type').hide();
					$('#form_1').show();
				}
				else if ( val == 2) {
					$('.div_type').hide();
					$('#form_2').show();
				}
				else if ( val == 3) {
					$('.div_type').hide();
					$('#form_3').show();
				}
				else {
					$('.div_type').show();
				}
			}
		</script>


		<!-- EFECT CARGANDO PAGINA -->
		<script>
			$(function(){
				$('#loading').delay(600).fadeOut(200);
			});
		</script>
  
  </body>

</html>