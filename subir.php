<?php
  session_start();
  
  if( !isset($_SESSION['user']))
    header( "Location: index.php" ) ;

?>
<!DOCTYPE html>
<html lang="es-MX">

  <head>
    <meta charset="UTF-8">
      <title> SUBIR </title>
      <script src="js/jquery.min.js"></script>
      <link rel="stylesheet" href="css/iconos.css">
      <link rel="stylesheet" href="css/style00.css">
  </head>

  <body>

    <section id="loading">
      <p>cargando...</p>
    </section>


    <div id="main">
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

      <section class="main_section">
        <div id="toggle-menu"> ☰ </div>
        <div class="type-content">
          <h1 class="main_titulo">Subir Reactivo</h1>
          <h1 class="main_spacing"></h1>

          <div class="radio-tipo">
            <input type="radio" class="tipo_reactivo" name="tipo_reactivo" id="tipo01" checked></input>
            <label for="tipo01">Verdadero - Falso</label>
          </div><!--

        /--><div class="radio-tipo">
            <input type="radio" class="tipo_reactivo" name="tipo_reactivo" id="tipo02" ></input>
            <label for="tipo02">Opción Múltiple</label>
          </div><!--

        /--><div class="radio-tipo">
            <input type="radio" class="tipo_reactivo" name="tipo_reactivo" id="tipo03"></input>
            <label for="tipo03">Abierto</label>
          </div>
        </div>

        <div class="form-content">
          <form class="form_type" action="php/subir_reactivo.php" method="post" id="form_1">
            <label class="lab_form"> Seleccione el tema </label><!--
          /--><select id="sel01" class="sel_form btn-primario" name="tema" onchange="populate(this.id,'sel02')">
              <option value="aritmetica">Aritmética</option>
              <option value="algebra">Álgebra</option>
              <option value="geometria">Geometría</option>
              <option value="trigonometria">Trigonometría</option>
              <option value="probabilidad">Probabilidad</option>
            </select>

            <label class="lab_form"> Seleccione el subtema </label><!--
          /--><select id="sel02" class="sel_form btn-secundario" name="subtema">
              <option selected value="naturales">Naturales</option>
              <option selected value="enteros">Enteros</option>
              <option selected value="fraccionarios">Fraccionarios</option>
              <option selected value="decimales">Decimales</option>
            </select>

            <label class="lab_form"> Seleccione el grado </label><!--
          /--><select class="sel_form btn-primario" name="grado">
              <option value="1">Primer Grado</option>
              <option value="2">Segundo Grado</option>
              <option value="3">Tercer Grado</option>
            </select>

            <label class="lab_form"> Seleccione el Nivel </label><!--
          /--><select class="sel_form btn-secundario" name="nivel">
              <option value="1"> Nivel I</option>
              <option value="2"> Nivel II</option>
              <option value="3"> Nivel III</option>
            </select>

            <label class="lab_form"> Reactivo </label><!--
          /--><textarea class="txtarea_form" name="reactivo" required></textarea>

            <label class="lab_form"> Respuesta </label><!--
          /--><select class="sel_form btn-primario" name="respuesta" required>
              <option value="">-----</option>
              <option value="1">Verdadero</option>
              <option value="0">Falso</option>
            </select>

            <br><br><input type="submit" value="Guardar Reactivo" class="guardar_boton" name="enviar_verdadero_falso">
          </form>

          <style>

          </style>

          <!-- FORM 2-->
          <form class="form_type" action="php/subir_reactivo.php" method="post" id="form_2">


            <label class="lab_form"> Seleccione el tema </label><!--
          /--><select id="sel11" class="sel_form btn-primario" name="tema" onchange="populate(this.id,'sel12')">
              <option value="aritmetica">Aritmética</option>
              <option value="algebra">Álgebra</option>
              <option value="geometria">Geometría</option>
              <option value="trigonometria">Trigonometría</option>
              <option value="probabilidad">Probabilidad</option>
            </select>

            <label class="lab_form"> Seleccione el subtema </label><!--
          /--><select id="sel12" class="sel_form btn-secundario" name="subtema">
              <option selected value="naturales">Naturales</option>
              <option selected value="enteros">Enteros</option>
              <option selected value="fraccionarios">Fraccionarios</option>
              <option selected value="decimales">Decimales</option>
            </select>

            <label class="lab_form"> Seleccione el grado </label><!--
          /--><select class="sel_form btn-primario" name="grado">
              <option value="1">Primer Grado</option>
              <option value="2">Segundo Grado</option>
              <option value="3">Tercer Grado</option>
            </select>

            <label class="lab_form"> Seleccione el Nivel </label><!--
          /--><select class="sel_form btn-secundario" name="nivel">
              <option value="1"> Nivel I</option>
              <option value="2"> Nivel II</option>
              <option value="3"> Nivel III</option>
            </select>

            <label class="lab_form"> Reactivo </label><!--
          /--><textarea class="txtarea_form" name="reactivo" required></textarea>

            <label class="lab_form"> Respuesta </label><!--
          /--><input class="input_form" type="text" name="respuesta" required>

            <label class="lab_form"> Incorrecta 1 </label><!--
          /--><input class="input_form" type="text" name="inco_1" required>

            <label class="lab_form"> Incorrecta 2 </label><!--
          /--><input class="input_form" type="text" name="inco_2" required>

            <label class="lab_form"> Incorrecta 3 </label><!--
          /--><input class="input_form" type="text" name="inco_3" required>

            <br><br><input type="submit" value="Guardar Reactivo" class="guardar_boton" name="enviar_opcion_multiple">
          </form>

          <!-- FORM 3-->
          <form class="form_type" action="php/subir_reactivo.php" method="post" id="form_3">

            <label class="lab_form"> Seleccione el tema </label><!--
          /--><select id="sel11" class="sel_form btn-primario" name="tema" onchange="populate(this.id,'sel12')">
              <option value="aritmetica">Aritmética</option>
              <option value="algebra">Álgebra</option>
              <option value="geometria">Geometría</option>
              <option value="trigonometria">Trigonometría</option>
              <option value="probabilidad">Probabilidad</option>
            </select>

            <label class="lab_form"> Seleccione el subtema </label><!--
          /--><select id="sel12" class="sel_form btn-secundario" name="subtema">
              <option selected value="naturales">Naturales</option>
              <option selected value="enteros">Enteros</option>
              <option selected value="fraccionarios">Fraccionarios</option>
              <option selected value="decimales">Decimales</option>
            </select>

            <label class="lab_form"> Seleccione el grado </label><!--
          /--><select class="sel_form btn-primario" name="grado">
              <option value="1">Primer Grado</option>
              <option value="2">Segundo Grado</option>
              <option value="3">Tercer Grado</option>
            </select>

            <label class="lab_form"> Seleccione el Nivel </label><!--
          /--><select class="sel_form btn-secundario" name="nivel">
              <option value="1"> Nivel I</option>
              <option value="2"> Nivel II</option>
              <option value="3"> Nivel III</option>
            </select>

            <label class="lab_form"> Reactivo </label><!--
          /--><textarea class="txtarea_form" name="reactivo" required></textarea>

            <label class="lab_form"> Respuesta </label><!--
          /--><input class="input_form" type="text" name="respuesta" required>

            <br><br><input type="submit" value="Guardar Reactivo" class="guardar_boton" name="enviar_opcion_abierta">
          </form>
        </div>
      </section>

    </div>

    <script src="js/script-selects.js"></script>
    <script src="js/script-tabss.js"></script>
    <script src="js/script-toggle.js"></script>

    <!-- EFECT CARGANDO PAGINA -->
    <script>
      $(function(){
        $('#loading').delay(600).fadeOut(200);
      });
    </script>

  </body>

</html>