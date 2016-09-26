<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width; initial-scale=1.0">
        <title>Entrenador</title>
      <link rel="stylesheet" type="text/css" href="../css/estilos.css">
    </head>

    <style>

    </style>
<body>
  <H1>Entrenador validar respuesta</H1>
<div id="contenedor">

  <nav id="menu">
              <ul>

                  <li><a href="../index.php">Incio</a></li>
                  <li><a href="../controlador.php/preguntaAleatoria">pregunta Aleatoria</a></li>
                  <li><a href="../vista/estaditicas.php">Estadisticas</a></li>

              </ul>
          </nav>
<main>
  <?php
?>
<p><strong><?php  echo "¿".$data['pregunta']."?";?></strong><p>
<br>
 <?php
   if ($data['estado']=='error')
   {
     echo "<div id ='cajaInfoError'> Has fallado la respuesta. La pregunta correcta esta destacada en negrita</div>";

     $respuestaUsuario=$data['respuesta'];
     echo "<ul>";

     foreach ($data['llistaRespuestas'] as $res )
     {

        if($res['verdadera']==1)
        {
          echo "<li><strong>".$res['respuesta']."</strong></li>";
        }
        else {
        echo "<li>".$res['respuesta']."</li>";
        }
      }
    }
      else {
        echo "respuesta correcta";
      }
?>
<br>
<a href="../controlador.php/preguntaAleatoria">Siguiente Pregunta Aleatoria</a>
</main>
</div>
</body>
<footer> Web creada por Raimon Carbonell <footer>
</html>
