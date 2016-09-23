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
  <H1>Entrenador añadir pregunta</H1>
<div id="contenedor">

  <nav id="menu">
              <ul>

                  <li><a href="../index.php">Incio</a></li>
                  <li><a href="../controlador.php/preguntaAleatoria">pregunta Aleatoria</a></li>

              </ul>
          </nav>
<main>
  <?php
print_r($data);

?>
<p><strong><?php  echo $data['pregunta'];?></strong><p>
<br>
 <?php
   if ($data['estado']=='error')
   {
     echo "<div id ='cajaInfoError'> Has fallado la respuesta</div>";

     $respuestaUsuario=$data['respuesta'];

     foreach ($data['llistaRespuestas'] as $res )
     {
        if($res['verdadera']==1)
        {
          echo "<p><strong>".$res['respuesta']."</strong></p>";
        }
        else {
        echo "<p>".$res['respuesta']."</p>";
        }

      }
    }
      else {
        echo "respuesta correcta";
      }
?>
</main>
</div>

</body>
<footer> Web creada por Raimon Carbonell <footer>
</html>
