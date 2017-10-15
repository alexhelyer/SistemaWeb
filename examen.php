<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>EXAMEN</title>
</head>
<body>

	<header>
		<h1>Examen</h1>
	</header>

	<section>
		<table>
			<tr>
				<th style="width: 5%"><span style="display: inline-block;padding: 10px 0px;">ID</span></th>
				<th style="width: 5%">Tipo</th>
				<th style="width: 25%">Reactivo</th>
				<th style="width: 15%">Respuesta</th>
				<th style="width: 10%">Opc1</th>
				<th style="width: 10%">Opc2</th>
				<th style="width: 10%">Opc3</th>
				<th style="width: 10%">Opc4</th>
				<th style="width: 10%"> </th>
			</tr>

		<?php

		require "mysql/mysql.php";
		$mysql_con->set_charset("utf8");

		$query = " SELECT * FROM examen WHERE 1; ";
		$result = $mysql_con->query($query);

		$x=0;
		while ( $row = $result->fetch_assoc() ) {
			$x++;
echo '
			<tr>
				<td><span style="display: inline-block;padding: 10px 0px;">'.$x.'</span></td>
				<td>'.$row['tipo'].'</td>
				<td>'.$row['reactivo'].'</td>
				<td>'.$row['respuesta'].'</td>
				<td>'.$row['opc1'].'</td>
				<td>'.$row['opc2'].'</td>
				<td>'.$row['opc3'].'</td>
				<td>'.$row['opc4'].'</td>
				<td> <a href="examen.php?id='.$row['id'].'">Editar</a> </td>
			</tr>
';
		}
echo 	'</table>';

if ( isset($_GET['id']) ) {
	$myid = $_GET['id'];

	$query1 = " SELECT * FROM examen WHERE id=$myid; ";
	$result1 = $mysql_con->query($query1);
	$row1 = $result1->fetch_assoc();

echo '

		<div class="modal">
			<div class="container">
				<span class="x" onclick="cerrar()">&times;</span>
				<form class="formulario" action="php/EditarExamen.php" method="post">

					<br><br><label>ID:</label>
					<br><input type="text" name="id" value="'.$row1['id'].'" disabled><input style="width:2%; visibility:hidden;" type="text" name="id" value="'.$row1['id'].'">

					<br><br><label>Tipo:</label>
					<br><select id="tipo" name="tipo" required>
						<option value="">-</option>
						<option value="0">Multiple</option>
						<option value="1">Abierta</option>
						<option value="2">Verdadero - Falso</option>
					</select>

					<br><br><label>Reactivo:</label>
					<br><input type="text" name="reactivo" value="'.$row1['reactivo'].'" required>

					<br><br><label>Respuesta</label>
					<br><input type="text" name="respuesta" value="'.$row1['respuesta'].'" required>

					<br><br><label>Opcion 1</label>
					<br><input type="text" name="opc1" value="'.$row1['opc1'].'" required>

					<br><br><label>Opcion 2</label>
					<br><input type="text" name="opc2" value="'.$row1['opc2'].'" required>

					<br><br><label>Opcion 3</label>
					<br><input type="text" name="opc3" value="'.$row1['opc3'].'" required>

					<br><br><label>Opcion 4</label>
					<br><input type="text" name="opc4" value="'.$row1['opc4'].'" required>

					<br><br><input class="send" type="submit" name="Guardar">


				</form>

				<script> document.getElementById("tipo").value = '.$row1['tipo'].' </script>
			</div>
		</div>

';
}



		$mysql_con->close();
		?>
		





	</section>

	<footer>
		<p>footer</p>
	</footer>

	<style type="text/css">
		* {
			padding: 0;
			margin: 0;
		}
		body {
			width: 100%;
		}

		section {
			display: block;
			box-sizing: border-box;
			width: 100%;
			padding: 20px;
		}
			table {
				width: 100%;
				text-align: center;
			}
			table tr {
				border: 1px solid black;
			}
			table tr {
				background-color: #EEEEEE;
			}
			table tr:nth-child(1) {
				background-color: #CCCCCC;
			}

		header, footer {
			background-color: black;
			color: white;
		}

		.modal {
			display: block;
			box-sizing: border-box;
			width: 100%;
			height: 100%;

			padding: 50px;
			
			position: absolute;
			top: 0;
			left: 0;

			background-color: rgba(1,1,1,0.2);

		}
			.container {
				display: inline-block;
				box-sizing: border-box;
				width: 100%;
				max-width: 500px;
				height: 100%;

				position: relative;

				padding: 10px 10px;

				background-color: white;

				left: 50%;

				transform: translateX(-50%);
			}
			.container .x {
				display: inline-block;
				box-sizing: border-box;

				position: absolute;
				top: 0px;
				right: 0px;
				padding: 6px 10px;

				background-color: red;
				color: white;

				text-align: right;

				cursor: pointer;

				opacity: 0.75;

				text-align: right;
			}
			.container .x:hover {
				opacity: 1;
			}

				.formulario {
					display: block;
					box-sizing: border-box;
					padding: 10px 10%;
					border: 1px solid transparent;
					overflow-y: auto;

					width: 100%;
					height: 100%;

					text-align: center;
				}
				.formulario::-webkit-scrollbar {
					width: 2px;
				}
				.formulario::-moz-scrollbar {
					width: 2px;
				}
				.formulario * {
					width: 98%;
				}
				.formulario .send {
					display: inline-block;
					box-sizing: border-box;
					width: auto;
					padding: 10px;

					background-color: black;
					color: white;

					border: none;

					cursor: pointer;

					opacity: 0.75;

					transition: opacity 0.3s linear;

				}
				.formulario .send:hover {
					opacity: 1;
				}

	</style>

	<script>
		function cerrar() {
			location.href = "examen.php";
		}
	</script>
	
</body>
</html>