<?php
	session_start();

	if( !isset($_SESSION['user']))
		header( "Location: index.php" ) ;
?>


<?php
	require 'mysql/mysql.php';

	//Establecemos los valores por DEFAULT
	date_default_timezone_set("America/Mexico_City");
	$fechainicio = "2017-01-01";
	if ( isset($_GET['fini']) )
		$fechainicio = $_GET['fini'];

	$fechatermino = date("Y-m-d");
	if ( isset($_GET['fend']) )
		$fechatermino = $_GET['fend'];

	//echo "<br>".$fechainicio."      ".$fechatermino."<br>";

	// ============================ CONTAMOS EL NUMERO DE ALUMNOS POR GENERO ============================
	$num_mujeres = 0;
	$num_hombres = 0;

	$query = " SELECT COUNT(*) as 'total' FROM alumno WHERE genero = 'Masculino' AND fecha_registro>='".$fechainicio."'AND fecha_registro<='".$fechatermino."'; ";
	$result = $mysql_con->query($query);

	if ( $fila = $result->fetch_assoc() )
		$num_hombres = $fila['total'];

	$query = " SELECT COUNT(*) as 'total' FROM alumno WHERE genero = 'Femenino' AND fecha_registro>='".$fechainicio."'AND fecha_registro<='".$fechatermino."'; ";
	$result = $mysql_con->query($query);

	if ( $fila = $result->fetch_assoc() )
		$num_mujeres = $fila['total'];

	// ============================ CONTAMOS EL NUMERO DE ALUMNOS POR EDAD ============================
	$edad11 = 0;
	$edad12 = 0;
	$edad13 = 0;
	$edad14 = 0;
	$edad15 = 0;

	$query = " SELECT COUNT(*) as 'total' FROM alumno WHERE edad<12 AND fecha_registro>='".$fechainicio."'AND fecha_registro<='".$fechatermino."'; ";
	$result = $mysql_con->query($query);

	if ( $fila = $result->fetch_assoc() )
		$edad11 = $fila['total'];
	

	$query = " SELECT COUNT(*) as 'total' FROM alumno WHERE edad=12 AND fecha_registro>='".$fechainicio."'AND fecha_registro<='".$fechatermino."'; ";
	$result = $mysql_con->query($query);

	if ( $fila = $result->fetch_assoc() )
		$edad12 = $fila['total'];
	

	$query = " SELECT COUNT(*) as 'total' FROM alumno WHERE edad=13 AND fecha_registro>='".$fechainicio."'AND fecha_registro<='".$fechatermino."'; ";
	$result = $mysql_con->query($query);

	if ( $fila = $result->fetch_assoc() )
		$edad13 = $fila['total'];
	

	$query = " SELECT COUNT(*) as 'total' FROM alumno WHERE edad=14 AND fecha_registro>='".$fechainicio."'AND fecha_registro<='".$fechatermino."'; ";
	$result = $mysql_con->query($query);

	if ( $fila = $result->fetch_assoc() )
		$edad14 = $fila['total'];
	

	$query = " SELECT COUNT(*) as 'total' FROM alumno WHERE edad>14 AND fecha_registro>='".$fechainicio."'AND fecha_registro<='".$fechatermino."'; ";
	$result = $mysql_con->query($query);
	if ( $fila = $result->fetch_assoc() )
		$edad15 = $fila['total'];

	$mysql_con->close();
?>

<!DOCTYPE html>
<html lang="es-MX">
	<head>
		<meta charset="UTF-8">
		<title> ESTADISTICAS </title>
		<script src="js/jquery.min.js"></script>
		<link rel="stylesheet" href="css/iconos.css">
		<!--<link rel="stylesheet" href="estilos00.css">-->
		<link rel="stylesheet" href="css/style00.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.css" />

		<!-- MORRIS JS-->
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
		<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

		<link rel="stylesheet" href="css/style-chart_pro.css">
		<script src="js/script-chart_pro.js"></script>
		<script src="js/script-chart_pro2.js"></script>

		<script src="//cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>

		<script>
			webshims.polyfill('forms forms-ext');
		</script>

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

				<h1 class="main_titulo">Estadísticas</h1>

				<h1 class="main_spacing"></h1>

		<?php
			echo '
				<form class="form_type" action="php/nueva_estadistica.php" method="post">
					<label class="lab_form">Fecha Inicio</label><!--
				/--><input id="fecha_1" class="input_form" type="date" name="fechaini" value="'.$fechainicio.'">

					<label class="lab_form">Fecha Final</label><!--
				/--><input id="fecha_2" class="input_form" type="date" name="fechaend" value="'.$fechatermino.'">

					<br><br><input class="guardar_boton" type="submit" value="graficar" onclick="getQuery()">
				</form>
			';
		?>


				<h1 class="main_spacing"></h1>
				<div style="text-align: center;">
					<h1 class="txt-mapa">Identifica la Cantidad de Usuarios por GENERO</h1>
					<p  class="txt-mapa" style="color:black">(Selecciona una pedazo de la gráfica para ver los detalles)</p><br><br>
				</div>

				<div id="container" class="container">
					<canvas id="chart" class="chart" width="600" height="500"></canvas>
					<table id="chartData" class="chartData">
						<tr>
							<th> Género </th>
							<th> Usuarios </th>
						</tr>

						<?php
							echo '
								<tr style="color: #1E90FF">
									<td> Hombres </td><td>'.$num_hombres.'</td>
								</tr>

								<tr style="color: #FF69B4">
									<td> Mujeres </td><td>'.$num_mujeres.'</td>
								</tr>
							';
						?>
					</table>
				</div>

				<h1 class="main_spacing"></h1>
				<div style="text-align: center;">
					<h1 class="txt-mapa">Identifica la Cantidad de Usuarios por EDADES</h1>
					<p  class="txt-mapa" style="color:black">(Selecciona una pedazo de la gráfica para ver los detalles)</p><br><br>
				</div>

				<div id="container2" class="container">
					<canvas id="chart2" class="chart" width="600" height="500"></canvas>
					<table id="chartData2" class="chartData">
						<tr>
							<th> Edades </th>
							<th> Usuarios </th>
						</tr>

						<?php
							echo '
								<tr style="color: #E74C3C">
									<td> 11 o menos </td><td>'.$edad11.'</td>
								</tr>

								<tr style="color: #8E44AD">
									<td> 12 </td><td>'.$edad12.'</td>
								</tr>

								<tr style="color: #3498DB">
									<td> 13 </td><td>'.$edad13.'</td>
								</tr>

								<tr style="color: #1ABC9C">
									<td> 14 </td><td>'.$edad14.'</td>
								</tr>

								<tr style="color: #EB984E">
									<td> 15 o más </td><td>'.$edad15.'</td>
								</tr>
							';
						?>


					</table>
				</div>

				<h1 class="main_spacing"></h1>
				<div class="edo_mapas" id="gomapa">
					<h1 class="txt-mapa">Identifica la Cantidad de Usuarios por ESTADO</h1>
					<p  class="txt-mapa" style="color:black">(Pasa el cursor sobre el estado para conocer el número de usuarios)</p><br><br>

					<div class="mapa">
						<img class="img" src="img/mapa.png" usemap="#mexico" >
						<map id="map-republica" name="mexico">
							<area class="bajacalifornias" shape="poly" coords="91,132,95,139,102,148,107,156,112,165,117,167,119,178,122,186,127,196,131,205,132,213,133,224,141,230,142,226,152,232,159,242,160,253,153,254,150,261,143,247,138,240,129,233,120,225,114,219,111,215,102,210,104,197,103,186,98,176,91,172,85,165,82,156,75,160,65,155,56,148,53,140,44,135,57,134,67,141,68,132"  alt="Baja California Sur" title="Baja California Sur">
							<area class="bajacalifornia" shape="poly" coords="60,12,53,24,52,32,54,39,52,55,56,60,55,74,61,86,66,90,77,105,85,112,89,120,90,130,62,130,65,120,48,93,38,88,31,79,31,71,26,63,25,54,22,45,17,36,17,30,12,22,9,12" alt="Baja California" title="Baja California">
							<area class="sonora" shape="poly" coords="180,56,180,66,189,78,188,93,187,108,187,122,187,130,176,131,177,138,182,148,186,161,184,168,170,176,164,167,159,168,155,157,141,151,143,138,131,135,123,126,116,116,109,105,104,94,100,83,98,74,92,64,94,55,84,48,77,42,69,42,59,37,56,31,59,19,81,29,102,38,138,54" alt="Sonora" title="Sonora">
							<area class="chihuahua" shape="poly" coords="306,117,290,140,295,174,288,171,278,180,267,178,259,178,244,169,235,178,233,186,225,195,218,195,212,188,205,184,202,175,200,166,192,162,186,157,184,151,176,132,187,131,188,105,190,81,183,67,183,57,200,57,201,46,237,47,254,67,270,77,275,98,287,107" alt="Chihuahua" title="Chihuahua">
							<area class="coahuila" shape="poly" coords="383,148,376,147,372,153,365,159,362,164,368,165,366,172,359,174,354,181,358,188,359,195,363,201,365,206,372,207,365,210,363,215,362,226,352,219,345,221,343,216,333,211,323,210,317,215,314,220,306,214,302,206,301,201,304,190,304,184,303,178,296,174,296,166,292,141,306,116,314,113,317,105,322,98,332,97,342,96,354,103,362,115,366,122,372,133" alt="Coahuila" title="Coahuila">
							<area class="nuevol" shape="poly" coords="382,149,384,153,384,160,386,167,388,170,392,176,394,181,399,185,401,188,409,191,412,193,413,199,412,205,408,210,403,212,400,213,399,218,392,220,389,226,389,231,390,238,389,243,384,247,382,253,378,257,372,257,371,252,370,246,369,242,366,238,365,232,364,227,363,216,373,209,368,204,361,196,360,189,356,182,359,175,367,173,368,165,362,164,378,149" alt="Nuevo León" title="Nuevo León">
							<area class="tamaulipas" shape="poly" coords="447,191,441,201,441,209,440,217,434,205,433,215,432,223,430,229,429,240,430,247,432,259,430,266,431,276,422,274,416,278,409,276,400,275,396,270,387,270,383,266,381,257,384,247,391,241,390,232,391,226,396,220,404,215,410,210,415,206,414,200,414,194,409,190,403,188,397,183,391,175,389,171,386,162,385,153,390,153,394,165,400,175,405,180,414,182,422,187,430,187,435,191" alt="Tamaulipas" title="Tamaulipas">
							<area class="sinaloa" shape="poly" coords="188,161,184,170,176,173,173,176,172,181,166,182,166,188,171,192,178,197,183,202,190,206,195,214,199,220,206,226,211,232,215,236,221,242,226,252,233,259,239,265,248,273,252,274,251,268,254,261,248,257,243,248,244,239,241,232,238,229,231,231,227,226,226,221,222,216,217,212,217,206,218,196,204,186,200,167" alt="Sinaloa" title="Sinaloa">
							<area class="durango" shape="poly" coords="244,171,257,177,274,180,288,173,303,177,304,183,303,190,302,196,301,204,304,211,308,216,313,220,315,217,322,216,323,222,320,227,316,227,309,227,305,228,297,232,294,236,293,243,282,254,282,259,282,266,280,273,277,275,271,274,269,272,265,273,266,268,261,264,257,261,252,259,248,252,245,246,245,239,243,233,240,229,233,228,229,225,226,219,223,216,219,211,218,206,220,197,228,196,236,187,235,179" alt="Durango" title="Durango">
							<area class="zacatecas" shape="poly" coords="323,212,329,212,336,215,341,218,343,220,350,219,356,222,359,226,355,231,355,238,350,242,342,244,340,249,334,253,332,256,330,263,332,269,334,274,340,278,343,275,346,274,348,277,348,283,347,288,342,287,336,286,333,281,331,279,326,278,323,279,318,281,315,284,315,288,315,292,316,295,318,299,316,301,313,302,311,306,309,309,305,309,301,308,298,305,294,305,294,302,295,300,297,297,300,293,305,291,307,288,309,285,309,281,304,278,302,278,301,281,299,283,297,283,295,280,294,279,295,278,296,274,295,272,294,272,293,273,293,267,290,271,289,276,285,278,280,280,280,275,281,269,283,260,283,253,289,249,293,245,295,240,295,235,304,228,317,228,323,222" alt="Zacatecas" title="Zacatecas">
							<area class="aguascalientes" shape="poly" coords="336,286,333,290,330,293,323,294,319,294,315,292,314,287,315,281,319,279,323,279,331,279" alt="aguascalientes" title="Aguascalientes">
							<area class="sanluispotosi" shape="poly" coords="361,224,364,235,369,242,370,249,371,255,374,257,380,255,382,261,382,266,387,272,389,270,396,272,400,274,408,276,414,278,417,279,417,286,412,287,414,292,413,295,416,300,411,307,404,305,402,303,401,297,395,299,393,301,389,300,387,300,382,301,377,297,371,294,367,299,361,296,358,293,354,292,346,290,349,284,350,278,348,273,342,274,337,276,334,270,331,264,332,255,336,251,340,248,344,242,350,242,356,238,355,229" alt="sanluispotosi" title="San Luis Potosi">
							<area class="guanajuato" shape="poly" coords="347,291,356,291,361,295,366,298,372,294,376,299,381,299,387,300,384,306,381,307,378,312,374,314,369,313,367,320,369,325,374,332,370,336,362,338,355,335,349,336,347,328,340,331,332,328,335,323,331,315,340,310,345,304,344,297" alt="guanajuato" title="Guanajuato">
							<area class="nayarit" shape="poly" coords="253,260,266,267,265,271,269,272,274,275,277,276,279,279,277,283,279,287,283,288,283,295,285,299,287,303,283,305,283,311,283,317,277,316,273,312,267,311,260,314,253,315,249,315,257,307,258,301,254,296,250,290,248,283,250,272,252,272" alt="nayarit" title="Nayarit">
							<area class="jalisco" shape="poly" coords="291,267,292,271,296,271,294,276,294,281,298,282,302,277,307,278,307,283,307,287,302,292,298,294,295,300,295,304,299,305,304,309,310,307,313,304,314,301,316,299,316,293,319,293,323,294,329,293,334,290,339,286,346,288,346,293,344,295,346,300,342,307,336,310,332,312,334,321,332,327,326,327,318,330,310,332,310,335,316,338,316,343,316,346,319,350,319,355,311,357,303,360,298,360,296,351,291,350,286,349,282,351,279,353,271,355,265,352,262,347,257,341,253,337,251,333,250,328,247,324,257,322,258,315,264,311,270,311,276,315,282,316,283,311,284,306,286,302,283,297,282,294,284,289,278,286,278,280,286,279" alt="jalisco" title="Jalisco">
							<area class="colima" shape="poly" coords="297,360,292,366,286,361,281,360,274,355,278,353,282,350,287,350,295,350" alt="colima" title="Colima">
							<area class="michoacan" shape="poly" coords="376,330,378,338,377,346,374,352,373,356,369,362,366,365,365,374,359,374,349,374,344,373,338,371,337,375,336,380,326,386,319,382,311,380,304,378,297,374,293,368,299,361,319,355,320,350,317,348,316,338,309,333,331,327,339,331,346,329,350,334,358,334,363,337,370,335" alt="michoacan" title="Michoacán">
							<area class="queretaro" shape="poly" coords="401,296,401,301,405,307,402,308,398,308,395,311,391,315,390,319,387,322,385,327,384,330,381,334,378,337,376,330,372,328,367,322,366,317,368,313,374,314,379,312,383,307,386,303,387,299,394,300" alt="queretaro" title="Quéretaro">
							<area class="hidalgo" shape="poly" coords="416,301,418,307,423,306,424,308,422,313,419,316,418,321,417,325,418,326,420,325,421,323,424,320,428,319,429,326,426,330,426,334,426,339,424,342,420,343,416,342,409,338,406,335,403,335,399,337,397,339,394,336,394,331,389,329,386,326,387,321,390,318,393,313,398,308,406,307,412,307" alt="hidalgo" title="Hidalgo">
							<area class="tlaxcala" shape="poly" coords="425,342,431,345,436,347,437,352,433,354,429,355,426,356,423,354,419,352,416,352,413,349,414,344,416,342" alt="tlaxcala" title="Tlaxcala">
							<area class="puebla" shape="poly" coords="429,319,433,316,439,322,435,327,437,330,445,328,448,334,446,342,446,348,448,354,447,362,448,367,451,369,458,369,467,368,460,376,455,380,445,382,443,384,437,376,436,384,427,384,423,388,413,386,408,381,406,375,414,373,416,366,414,360,415,352,425,355,435,352,436,347,427,342,426,330" alt="puebla" title="Puebla">
							<area class="morelos" shape="poly" coords="415,361,411,359,407,358,403,359,398,358,396,362,393,367,395,371,400,371,405,373,413,372,415,366" alt="morelos" title="Morelos">
							<area class="edomex" shape="poly" coords="414,359,409,358,408,352,406,349,402,348,401,352,401,356,396,362,393,367,386,368,380,371,374,375,372,370,369,362,370,356,374,351,376,345,378,337,382,333,386,328,393,330,395,337,400,336,405,335,409,338,415,340,413,346,415,351" alt="edomex" title="Estado de México">
							<area class="cdmx" shape="poly" coords="409,358,405,359,400,358,399,354,400,348,406,348,407,351" alt="cdmx" title="Ciudad de México">
							<area class="guerrero" shape="poly" coords="422,388,422,395,428,406,429,415,425,420,423,424,416,421,407,418,397,416,387,414,381,410,365,405,358,402,351,398,345,395,338,386,332,384,336,379,337,371,363,372,369,365,374,373,385,369,394,368,402,372,407,375,412,384" alt="guerrero" title="Guerrero">
							<area class="oaxaca" shape="poly" coords="467,368,458,376,450,380,443,382,437,376,435,382,429,384,424,385,421,390,424,397,427,406,429,413,422,424,427,426,432,428,437,432,446,432,455,433,460,437,476,437,484,435,493,433,498,429,502,425,508,419,515,423,520,421,529,424,528,416,528,411,533,400,504,401,496,390,489,393,483,391,485,382,479,380,474,379,472,375" alt="oaxaca" title="Oaxaca">
							<area class="veracruz" shape="poly" coords="430,275,420,275,417,276,417,280,417,284,414,286,414,295,415,300,418,305,420,305,423,305,421,310,418,315,418,322,420,321,423,320,426,320,430,317,433,316,437,321,435,327,440,328,446,328,449,333,447,338,447,347,447,356,447,363,451,368,461,368,466,368,469,372,475,377,478,379,484,382,483,389,489,392,493,390,504,399,533,401,537,399,540,394,538,388,531,387,525,385,523,376,513,375,509,369,502,365,498,365,491,364,485,365,481,370,477,366,477,360,473,353,469,346,467,340,461,330,454,321,448,313,444,304,435,294,433,283" alt="veracruz" title="Veracruz">
							<area class="tabasco" shape="poly" coords="563,361,550,369,541,369,535,370,532,373,524,373,524,378,527,384,530,385,536,390,540,383,543,380,551,380,550,388,559,392,570,385,577,382,581,383,591,393,599,392,601,381,598,378,586,375,586,378,577,376,574,373,571,367" alt="tabasco" title="Tabasco">
							<area class="chiapas" shape="poly" coords="550,379,540,380,538,386,540,390,539,395,536,399,532,400,527,410,527,424,532,430,542,435,553,442,562,445,562,448,576,460,578,450,574,443,587,424,616,422,615,415,612,408,595,398,591,393,579,382,559,390,550,387" alt="chiapas" title="Chiapas">
							<area class="campeche" shape="poly" coords="635,332,636,377,602,380,595,376,587,375,580,377,574,372,564,362,572,361,579,368,594,361,589,355,603,344,603,334,608,329,608,305,613,313,621,315" alt="campeche" title="Campeche">
							<area class="quintanaroo" shape="poly" coords="635,332,635,378,642,377,646,373,650,374,658,365,661,360,664,359,668,351,669,357,676,364,680,341,677,340,682,332,675,331,678,324,680,315,684,307,689,301,692,295,691,286,685,280,676,282,677,293,676,302,668,311" alt="quintanaroo" title="Quintana Roo">
							<area class="yucatan" shape="poly" coords="675,284,676,299,671,310,656,318,635,331,621,314,613,313,609,304,615,297,630,292,646,289,653,284" alt="yucatan" title="Yucatán">
						</map>
					</div>

					<table class="chartData">
						<tr>
							<th> NOMBRE Estado </th>
							<th> Usuarios </th>
						</tr>

						<tr>
							<td class="nom_estado"> --- </td>
							<td class="num_hombre"> --- </td>
						</tr>
					</table>

					<style>
						.edo_mapas {
							width: 100%;
							box-sizing: border-box;
							text-align: center;
							cursor: pointer;

						}
						.mapa {
							display: inline-block;
							border: 1px solid black;

							background-image: url("css/images/gradient.png");
						}
						.tabla_numero {
							display: inline-block;
							box-sizing: border-box;
							width: 250px;
							text-align: left;
						}
					</style>

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
	<?php

	require 'mysql/mysql.php';


	/*			GRÁFICA DE LOCALIDADES     */

	$num_localidad = 0;
	$query = " SELECT COUNT(*) as 'total' FROM alumno WHERE localidad='bajacalifornias' AND fecha_registro>='".$fechainicio."'AND fecha_registro<='".$fechatermino."'; ";
	$result = $mysql_con->query($query);
    if( $fila = $result->fetch_assoc() ) 
    	$num_localidad = $fila['total'];

    echo 'num_est01='.$num_localidad.';';


	$num_localidad = 0;
	$query = " SELECT COUNT(*) as 'total' FROM alumno WHERE localidad='bajacalifornia' AND fecha_registro>='".$fechainicio."'AND fecha_registro<='".$fechatermino."'; ";
	$result = $mysql_con->query($query);
    if( $fila = $result->fetch_assoc() ) 
    	$num_localidad = $fila['total'];

    echo 'num_est02='.$num_localidad.';';


	$num_localidad = 0;
	$query = " SELECT COUNT(*) as 'total' FROM alumno WHERE localidad='sonora' AND fecha_registro>='".$fechainicio."'AND fecha_registro<='".$fechatermino."'; ";
	$result = $mysql_con->query($query);
    if( $fila = $result->fetch_assoc() ) 
    	$num_localidad = $fila['total'];

    echo 'num_est03='.$num_localidad.';';


	$num_localidad = 0;
	$query = " SELECT COUNT(*) as 'total' FROM alumno WHERE localidad='chihuahua' AND fecha_registro>='".$fechainicio."'AND fecha_registro<='".$fechatermino."'; ";
	$result = $mysql_con->query($query);
    if( $fila = $result->fetch_assoc() ) 
    	$num_localidad = $fila['total'];

    echo 'num_est04='.$num_localidad.';';


	$num_localidad = 0;
	$query = " SELECT COUNT(*) as 'total' FROM alumno WHERE localidad='coahuila' AND fecha_registro>='".$fechainicio."'AND fecha_registro<='".$fechatermino."'; ";
	$result = $mysql_con->query($query);
    if( $fila = $result->fetch_assoc() ) 
    	$num_localidad = $fila['total'];

    echo 'num_est05='.$num_localidad.';';


	$num_localidad = 0;
	$query = " SELECT COUNT(*) as 'total' FROM alumno WHERE localidad='nuevoleon' AND fecha_registro>='".$fechainicio."'AND fecha_registro<='".$fechatermino."'; ";
	$result = $mysql_con->query($query);
    if( $fila = $result->fetch_assoc() ) 
    	$num_localidad = $fila['total'];

    echo 'num_est06='.$num_localidad.';';


	$num_localidad = 0;
	$query = " SELECT COUNT(*) as 'total' FROM alumno WHERE localidad='tamaulipas' AND fecha_registro>='".$fechainicio."'AND fecha_registro<='".$fechatermino."'; ";
	$result = $mysql_con->query($query);
    if( $fila = $result->fetch_assoc() ) 
    	$num_localidad = $fila['total'];

    echo 'num_est07='.$num_localidad.';';


	$num_localidad = 0;
	$query = " SELECT COUNT(*) as 'total' FROM alumno WHERE localidad='sinaloa' AND fecha_registro>='".$fechainicio."'AND fecha_registro<='".$fechatermino."'; ";
	$result = $mysql_con->query($query);
    if( $fila = $result->fetch_assoc() ) 
    	$num_localidad = $fila['total'];

    echo 'num_est08='.$num_localidad.';';


	$num_localidad = 0;
	$query = " SELECT COUNT(*) as 'total' FROM alumno WHERE localidad='durango' AND fecha_registro>='".$fechainicio."'AND fecha_registro<='".$fechatermino."'; ";
	$result = $mysql_con->query($query);
    if( $fila = $result->fetch_assoc() ) 
    	$num_localidad = $fila['total'];

    echo 'num_est09='.$num_localidad.';';


	$num_localidad = 0;
	$query = " SELECT COUNT(*) as 'total' FROM alumno WHERE localidad='zacatecas' AND fecha_registro>='".$fechainicio."'AND fecha_registro<='".$fechatermino."'; ";
	$result = $mysql_con->query($query);
    if( $fila = $result->fetch_assoc() ) 
    	$num_localidad = $fila['total'];

    echo 'num_est10='.$num_localidad.';';


	$num_localidad = 0;
	$query = " SELECT COUNT(*) as 'total' FROM alumno WHERE localidad='aguascalientes' AND fecha_registro>='".$fechainicio."'AND fecha_registro<='".$fechatermino."'; ";
	$result = $mysql_con->query($query);
    if( $fila = $result->fetch_assoc() ) 
    	$num_localidad = $fila['total'];

    echo 'num_est11='.$num_localidad.';';


	$num_localidad = 0;
	$query = " SELECT COUNT(*) as 'total' FROM alumno WHERE localidad='sanluispotosi' AND fecha_registro>='".$fechainicio."'AND fecha_registro<='".$fechatermino."'; ";
	$result = $mysql_con->query($query);
    if( $fila = $result->fetch_assoc() ) 
    	$num_localidad = $fila['total'];

    echo 'num_est12='.$num_localidad.';';


	$num_localidad = 0;
	$query = " SELECT COUNT(*) as 'total' FROM alumno WHERE localidad='guanajuato' AND fecha_registro>='".$fechainicio."'AND fecha_registro<='".$fechatermino."'; ";
	$result = $mysql_con->query($query);
    if( $fila = $result->fetch_assoc() ) 
    	$num_localidad = $fila['total'];

    echo 'num_est13='.$num_localidad.';';


	$num_localidad = 0;
	$query = " SELECT COUNT(*) as 'total' FROM alumno WHERE localidad='nayarit' AND fecha_registro>='".$fechainicio."'AND fecha_registro<='".$fechatermino."'; ";
	$result = $mysql_con->query($query);
    if( $fila = $result->fetch_assoc() ) 
    	$num_localidad = $fila['total'];

    echo 'num_est14='.$num_localidad.';';


	$num_localidad = 0;
	$query = " SELECT COUNT(*) as 'total' FROM alumno WHERE localidad='jalisco' AND fecha_registro>='".$fechainicio."'AND fecha_registro<='".$fechatermino."'; ";
	$result = $mysql_con->query($query);
    if( $fila = $result->fetch_assoc() ) 
    	$num_localidad = $fila['total'];

    echo 'num_est15='.$num_localidad.';';


	$num_localidad = 0;
	$query = " SELECT COUNT(*) as 'total' FROM alumno WHERE localidad='colima' AND fecha_registro>='".$fechainicio."'AND fecha_registro<='".$fechatermino."'; ";
	$result = $mysql_con->query($query);
    if( $fila = $result->fetch_assoc() ) 
    	$num_localidad = $fila['total'];

    echo 'num_est16='.$num_localidad.';';


	$num_localidad = 0;
	$query = " SELECT COUNT(*) as 'total' FROM alumno WHERE localidad='michoacan' AND fecha_registro>='".$fechainicio."'AND fecha_registro<='".$fechatermino."'; ";
	$result = $mysql_con->query($query);
    if( $fila = $result->fetch_assoc() ) 
    	$num_localidad = $fila['total'];

    echo 'num_est17='.$num_localidad.';';


	$num_localidad = 0;
	$query = " SELECT COUNT(*) as 'total' FROM alumno WHERE localidad='queretaro' AND fecha_registro>='".$fechainicio."'AND fecha_registro<='".$fechatermino."'; ";
	$result = $mysql_con->query($query);
    if( $fila = $result->fetch_assoc() ) 
    	$num_localidad = $fila['total'];

    echo 'num_est18='.$num_localidad.';';


	$num_localidad = 0;
	$query = " SELECT COUNT(*) as 'total' FROM alumno WHERE localidad='hidalgo' AND fecha_registro>='".$fechainicio."'AND fecha_registro<='".$fechatermino."'; ";
	$result = $mysql_con->query($query);
    if( $fila = $result->fetch_assoc() ) 
    	$num_localidad = $fila['total'];

    echo 'num_est19='.$num_localidad.';';


	$num_localidad = 0;
	$query = " SELECT COUNT(*) as 'total' FROM alumno WHERE localidad='tlaxcala' AND fecha_registro>='".$fechainicio."'AND fecha_registro<='".$fechatermino."'; ";
	$result = $mysql_con->query($query);
    if( $fila = $result->fetch_assoc() ) 
    	$num_localidad = $fila['total'];

    echo 'num_est20='.$num_localidad.';';


	$num_localidad = 0;
	$query = " SELECT COUNT(*) as 'total' FROM alumno WHERE localidad='puebla' AND fecha_registro>='".$fechainicio."'AND fecha_registro<='".$fechatermino."'; ";
	$result = $mysql_con->query($query);
    if( $fila = $result->fetch_assoc() ) 
    	$num_localidad = $fila['total'];

    echo 'num_est21='.$num_localidad.';';


	$num_localidad = 0;
	$query = " SELECT COUNT(*) as 'total' FROM alumno WHERE localidad='morelos' AND fecha_registro>='".$fechainicio."'AND fecha_registro<='".$fechatermino."'; ";
	$result = $mysql_con->query($query);
    if( $fila = $result->fetch_assoc() ) 
    	$num_localidad = $fila['total'];

    echo 'num_est22='.$num_localidad.';';


	$num_localidad = 0;
	$query = " SELECT COUNT(*) as 'total' FROM alumno WHERE localidad='mexico' AND fecha_registro>='".$fechainicio."'AND fecha_registro<='".$fechatermino."'; ";
	$result = $mysql_con->query($query);
    if( $fila = $result->fetch_assoc() ) 
    	$num_localidad = $fila['total'];

    echo 'num_est23='.$num_localidad.';';


	$num_localidad = 0;
	$query = " SELECT COUNT(*) as 'total' FROM alumno WHERE localidad='cdmx' AND fecha_registro>='".$fechainicio."'AND fecha_registro<='".$fechatermino."'; ";
	$result = $mysql_con->query($query);
    if( $fila = $result->fetch_assoc() ) 
    	$num_localidad = $fila['total'];

    echo 'num_est24='.$num_localidad.';';


	$num_localidad = 0;
	$query = " SELECT COUNT(*) as 'total' FROM alumno WHERE localidad='guerrero' AND fecha_registro>='".$fechainicio."'AND fecha_registro<='".$fechatermino."'; ";
	$result = $mysql_con->query($query);
    if( $fila = $result->fetch_assoc() ) 
    	$num_localidad = $fila['total'];

    echo 'num_est25='.$num_localidad.';';


	$num_localidad = 0;
	$query = " SELECT COUNT(*) as 'total' FROM alumno WHERE localidad='oaxaca' AND fecha_registro>='".$fechainicio."'AND fecha_registro<='".$fechatermino."'; ";
	$result = $mysql_con->query($query);
    if( $fila = $result->fetch_assoc() ) 
    	$num_localidad = $fila['total'];

    echo 'num_est26='.$num_localidad.';';


	$num_localidad = 0;
	$query = " SELECT COUNT(*) as 'total' FROM alumno WHERE localidad='veracruz' AND fecha_registro>='".$fechainicio."'AND fecha_registro<='".$fechatermino."'; ";
	$result = $mysql_con->query($query);
    if( $fila = $result->fetch_assoc() ) 
    	$num_localidad = $fila['total'];

    echo 'num_est27='.$num_localidad.';';


	$num_localidad = 0;
	$query = " SELECT COUNT(*) as 'total' FROM alumno WHERE localidad='tabasco' AND fecha_registro>='".$fechainicio."'AND fecha_registro<='".$fechatermino."'; ";
	$result = $mysql_con->query($query);
    if( $fila = $result->fetch_assoc() ) 
    	$num_localidad = $fila['total'];

    echo 'num_est28='.$num_localidad.';';


	$num_localidad = 0;
	$query = " SELECT COUNT(*) as 'total' FROM alumno WHERE localidad='chiapas' AND fecha_registro>='".$fechainicio."'AND fecha_registro<='".$fechatermino."'; ";
	$result = $mysql_con->query($query);
    if( $fila = $result->fetch_assoc() ) 
    	$num_localidad = $fila['total'];

    echo 'num_est29='.$num_localidad.';';


	$num_localidad = 0;
	$query = " SELECT COUNT(*) as 'total' FROM alumno WHERE localidad='campeche' AND fecha_registro>='".$fechainicio."'AND fecha_registro<='".$fechatermino."'; ";
	$result = $mysql_con->query($query);
    if( $fila = $result->fetch_assoc() ) 
    	$num_localidad = $fila['total'];

    echo 'num_est30='.$num_localidad.';';


	$num_localidad = 0;
	$query = " SELECT COUNT(*) as 'total' FROM alumno WHERE localidad='quintanaroo' AND fecha_registro>='".$fechainicio."'AND fecha_registro<='".$fechatermino."'; ";
	$result = $mysql_con->query($query);
    if( $fila = $result->fetch_assoc() ) 
    	$num_localidad = $fila['total'];

    echo 'num_est31='.$num_localidad.';';


	$num_localidad = 0;
	$query = " SELECT COUNT(*) as 'total' FROM alumno WHERE localidad='yucatan' AND fecha_registro>='".$fechainicio."'AND fecha_registro<='".$fechatermino."'; ";
	$result = $mysql_con->query($query);
    if( $fila = $result->fetch_assoc() ) 
    	$num_localidad = $fila['total'];

    echo 'num_est32='.$num_localidad.';';

	?>

	$(function(){

    		$(".img").hover(function(){
    			$(".img").attr("src","img/mapa.png");
    		});
    		$(".bajacalifornias").hover(function(){
    			$(".img").attr("src","img/mapa01.png");
    			$(".num_hombre").text(num_est01);
    			
    			$(".nom_estado").text("Baja California Sur");
    		});
    		$(".bajacalifornia").hover(function(){
    			$(".img").attr("src","img/mapa02.png");
    			$(".num_hombre").text(num_est01);
    			
    			$(".nom_estado").text("Baja California");
    		});
    		$(".sonora").hover(function(){
    			$(".img").attr("src","img/mapa03.png");
    			$(".num_hombre").text(num_est03);
    			
    			$(".nom_estado").text("Sonora");
    		});
    		$(".chihuahua").hover(function(){
    			$(".img").attr("src","img/mapa04.png");
    			$(".num_hombre").text(num_est04);
    			
    			$(".nom_estado").text("Chihuahua");
    		});
    		$(".coahuila").hover(function(){
    			$(".img").attr("src","img/mapa05.png");
    			$(".num_hombre").text(num_est05);
    			
    			$(".nom_estado").text("Coahuila");
    		});
    		$(".nuevol").hover(function(){
    			$(".img").attr("src","img/mapa06.png");
    			$(".num_hombre").text(num_est06);
    			
    			$(".nom_estado").text("Nuevo León");
    		});
    		$(".tamaulipas").hover(function(){
    			$(".img").attr("src","img/mapa07.png");
    			$(".num_hombre").text(num_est07);
    			
    			$(".nom_estado").text("Tamaulipas");
    		});
    		$(".sinaloa").hover(function(){
    			$(".img").attr("src","img/mapa08.png");
    			$(".num_hombre").text(num_est08);
    			
    			$(".nom_estado").text("Sinaloa");
    		});
    		$(".durango").hover(function(){
    			$(".img").attr("src","img/mapa09.png");
    			$(".num_hombre").text(num_est09);
    			
    			$(".nom_estado").text("Durango");
    		});
    		$(".zacatecas").hover(function(){
    			$(".img").attr("src","img/mapa10.png");
    			$(".num_hombre").text(num_est10);
    			
    			$(".nom_estado").text("Zacatecas");
    		});
    		$(".aguascalientes").hover(function(){
    			$(".img").attr("src","img/mapa11.png");
    			$(".num_hombre").text(num_est11);
    			
    			$(".nom_estado").text("Aguascalientes");
    		});
    		$(".sanluispotosi").hover(function(){
    			$(".img").attr("src","img/mapa12.png");
    			$(".num_hombre").text(num_est12);
    			
    			$(".nom_estado").text("San Luis Potosí");
    		});
    		$(".guanajuato").hover(function(){
    			$(".img").attr("src","img/mapa13.png");
    			$(".num_hombre").text(num_est13);
    			
    			$(".nom_estado").text("Guanajuato");
    		});
    		$(".nayarit").hover(function(){
    			$(".img").attr("src","img/mapa14.png");
    			$(".num_hombre").text(num_est14);
    			
    			$(".nom_estado").text("Nayarit");
    		});
    		$(".jalisco").hover(function(){
    			$(".img").attr("src","img/mapa15.png");
    			$(".num_hombre").text(num_est15);
    			
    			$(".nom_estado").text("Jalisco");
    		});
    		$(".colima").hover(function(){
    			$(".img").attr("src","img/mapa16.png");
    			$(".num_hombre").text(num_est16);
    			
    			$(".nom_estado").text("Colima");
    		});
    		$(".michoacan").hover(function(){
    			$(".img").attr("src","img/mapa17.png");
    			$(".num_hombre").text(num_est17);
    			
    			$(".nom_estado").text("Michoacán");
    		});
    		$(".queretaro").hover(function(){
    			$(".img").attr("src","img/mapa18.png");
    			$(".num_hombre").text(num_est18);
    			
    			$(".nom_estado").text("Quéretaro");
    		});
    		$(".hidalgo").hover(function(){
    			$(".img").attr("src","img/mapa19.png");
    			$(".num_hombre").text(num_est19);
    			
    			$(".nom_estado").text("Hidalgo");
    		});
    		$(".tlaxcala").hover(function(){
    			$(".img").attr("src","img/mapa20.png");
    			$(".num_hombre").text(num_est20);
    			
    			$(".nom_estado").text("Tlaxcala");
    		});
    		$(".puebla").hover(function(){
    			$(".img").attr("src","img/mapa21.png");
    			$(".num_hombre").text(num_est21);
    			
    			$(".nom_estado").text("Puebla");
    		});
    		$(".morelos").hover(function(){
    			$(".img").attr("src","img/mapa22.png");
    			$(".num_hombre").text(num_est22);
    			
    			$(".nom_estado").text("Morelos");
    		});
    		$(".edomex").hover(function(){
    			$(".img").attr("src","img/mapa23.png");
    			$(".num_hombre").text(num_est23);
    			
    			$(".nom_estado").text("Estado de México");
    		});
    		$(".cdmx").hover(function(){
    			$(".img").attr("src","img/mapa24.png");
    			$(".num_hombre").text(num_est24);
    			
    			$(".nom_estado").text("Ciudad de México");
    		});
    		$(".guerrero").hover(function(){
    			$(".img").attr("src","img/mapa25.png");
    			$(".num_hombre").text(num_est25);
    			
    			$(".nom_estado").text("Guerrero");
    		});
    		$(".oaxaca").hover(function(){
    			$(".img").attr("src","img/mapa26.png");
    			$(".num_hombre").text(num_est26);
    			
    			$(".nom_estado").text("Oaxaca");
    		});
    		$(".veracruz").hover(function(){
    			$(".img").attr("src","img/mapa27.png");
    			$(".num_hombre").text(num_est27);
    			
    			$(".nom_estado").text("Veracruz");
    		});
    		$(".tabasco").hover(function(){
    			$(".img").attr("src","img/mapa28.png");
    			$(".num_hombre").text(num_est28);
    			
    			$(".nom_estado").text("Tabasco");
    		});
    		$(".chiapas").hover(function(){
    			$(".img").attr("src","img/mapa29.png");
    			$(".num_hombre").text(num_est29);
    			
    			$(".nom_estado").text("Chiapas");
    		});
    		$(".campeche").hover(function(){
    			$(".img").attr("src","img/mapa30.png");
    			$(".num_hombre").text(num_est30);
    			
    			$(".nom_estado").text("Campeche");
    		});
    		$(".quintanaroo").hover(function(){
    			$(".img").attr("src","img/mapa31.png");
    			$(".num_hombre").text(num_est31);
    			
    			$(".nom_estado").text("Quintana Roo");
    		});
    		$(".yucatan").hover(function(){
    			$(".img").attr("src","img/mapa32.png");
    			$(".num_hombre").text(num_est32);
    			
    			$(".nom_estado").text("Yucatán");
    		});

	});

    </script>

    <script src="js/bootstrap.min.js"></script>

    <!--<script>history.pushState(null, "", "estadisticas.php");</script>-->
  
  </body>

</html>