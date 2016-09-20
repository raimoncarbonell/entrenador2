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
                  <li><a href="#">cc c c cc</a></li>
                  <li><a href="#">dddddd</a></li>
              </ul>
          </nav>

          <?php if(isset($data['pregunta']))
          {
            ?>
             <div id="cajaInfo"><strong>Se ha creado la pregunta <?php echo  $data['pregunta']; ?></strong></div>
             <?php
          }
          ?>
          <br>
<p>seleciona con el check del lateral la respuesta correcta</p>

<form id='anadirPregunta' method='post' action="../controlador.php/ncrearpregunta">"

<label>Pregunta</label><br><input type='text' name='pregunta'><br>
<label>Repuesta1</label><br><input type='text' name='respuesta1'></input><input type="radio"  name="R" value="r1"><br>
<label>Repuesta2</label><br><input type='text' name='respuesta2'><input type="radio"  name="R" value="r2"><br>
<label>Repuesta3</label><br><input type='text' name='respuesta3'><input type="radio" name="R" value="r3"><br><br>
<label>Tema</label><br><input type='text' name='tema'><br><br>
<input type='submit' value='Crear nueva pregunta'></form>

</div>

</body>
<footer> Web creada por Raimon Carbonell <footer>
</html>
