<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width; initial-scale=1.0">
        <title>Entrenador pregunta aletoria</title>
      <link rel="stylesheet" type="text/css" href="../css/estilos.css">
    </head>


  <H1>Entrenador pregunta aleatoria</H1>
<div id="contenedor">

  <nav id="menu">
              <ul>

                  <li><a href="../index.php">Incio</a></li>
                  li><a href="../controlador.php/preguntaAleatoria">Pregunta Aleatoria</a></li>
                  <li><a href="#">dddddd</a></li>
              </ul>
          </nav>
          <main>
              <p>
          <?php if(isset($data))
          {
              //print_r($data);
              echo "<form id='preguntaAleatoria' method='post' action='../controlador.php/comprobarRespuestas'>";
              echo "<br>";
              $datosPregunta=$data['pregunta'];

              $pregunta=$datosPregunta[0];
              echo "<p>la pregunta aletoria del tema  </strong>".$pregunta['titulo']."</strong></p> ";

              ?>
                            <input type="text" style='visibility:hidden'  name="idPregunta" value="<?php echo $data['idPregunta']; ?>" >
                            <?php
              echo "<p><strong>¿".$pregunta['pregunta']."?</strong></p>";

                foreach ($data['respuestas'] as $value) {


                     echo "<input type='radio' name='idRespuesta' value=".$value['id']."><label>".$value['respuesta']."</label>";
                    echo "<br>";
                    //echo $value['id'];
                }
                echo "<br>";
                echo "<br>";
                  echo "<input type='submit' value='Validar repuestas'></form>";

          }
          ?>
          </p>
</main>
</div>
<footer> Web creada por Raimon Carbonell <footer>
</body>
</html>
