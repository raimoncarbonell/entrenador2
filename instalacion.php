<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>crear bd</title>
        <link href="estilos.css" rel="stylesheet">

    </head>
    <body>
        <h1>INSTALACION</h1>

        <?php

          try
            {
                $conexion = new PDO('mysql:host=localhost', "root");
            }
          catch(PDOException $e)
            {
                echo "Error:".$e->getMessage();
                die();
            }

        // borramos la base de datos antes que nada para no tener que borrarla en myadmin


          $sql="drop database if exists bd;";
          $res=$conexion->exec($sql);


        // creamos la base de datos cinemania

          $sql="create database bd;";
          $res=$conexion->exec($sql); //exec nos devuelve el número de filas afectadas o "false" (o "0") si no ha podido crear la BD
          if($res===FALSE)
              {
                  echo "<p>No se ha podido crear la base de datos</p>";
                  echo "<p>".$conexion->errorInfo()[2]."</p>";
              }
          else
              {
                  echo "<p>Base de Datos creada</p>";
              }


                        // nos conectamos a la base de datos que hemos creado

                        $sql="use bd;";

                        $res=$conexion->exec($sql);
                        if($res===FALSE)
                            {
                                echo "<p>No se ha podido crear la base de datos</p>";
                                echo "<p>".$conexion->errorInfo()[2]."</p>";
                            }
                        else
                            {
                                echo "<p>Conectados a bd</p>";
                            }

                                     //creamos tabla categorias

                                      $sql= "CREATE TABLE `temas` (
                              `id` int(11) primary key auto_increment NOT NULL,
                              `titulo` varchar(40) NOT NULL,
                              `titulo_url` varchar(40) DEFAULT NULL
                            );";
                                   $res=$conexion->exec($sql);
                                      if($res===FALSE)
                                          {
                                              echo "<p>No se ha podido crear la tabla temas</p>";
                                              echo "<p>".$conexion->errorInfo()[2]."</p>";
                                          }
                                      else
                                          {
                                              echo "<p>Tabla temas creada!!!</p>";
                                          }


                                   //insertamos en categorias

                                     $sql="CREATE TABLE `preguntas` ( `id` int(11) primary key auto_increment NOT NULL,
                            `pregunta` text NOT NULL,
                             `tema` int DEFAULT NULL,
                             foreign key (tema) references temas(id));";

                                      $res=$conexion->exec($sql);
                                      if($res===FALSE)
                                          {
                                              echo "<p>Error al añadir datos en preguntas</p>";
                                              echo "<p>".$conexion->errorInfo()[2]."</p>";
                                          }
                                      else
                                          {
                                              echo "<p>Se han añadido $res filas en la tabla preguntas</p>";
                                          }


                                    // creamos tabla cinemania

                                       $sql="CREATE TABLE `respuestas` ( `id` int(11) primary key auto_increment NOT NULL,
                            `respuesta` text NOT NULL,
                             `verdadera` int DEFAULT NULL,
                             `pregunta` int DEFAULT NULL,
                             foreign key (pregunta) references preguntas(id));";

                                      $res=$conexion->exec($sql);
                                      if($res===FALSE)
                                          {
                                              echo "<p>No se ha podido crear la tabla cinemania</p>";
                                              echo "<p>".$conexion->errorInfo()[2]."</p>";
                                          }
                                      else
                                          {
                                              echo "<p>Tabla respuestas creada!!!</p>";
                                          }

                                            // creacion de la tabla Estadistica
                                          $sql="CREATE TABLE `estadistica` ( `id` int(11) primary key auto_increment NOT NULL,
                                          `ruta` varchar(40) NOT NULL,
                                        `clics` int DEFAULT NULL);";

                                         $res=$conexion->exec($sql);
                                          // insertamos la ruta de la web con el contador de vistas a 0

                                         $sql="INSERT INTO `estadistica` (`id`, `ruta`, `clics`) VALUES (NULL, 'crearpregunta', '0')";
                                         $res=$conexion->exec($sql);

                                         $sql="INSERT INTO `estadistica` (`id`, `ruta`, `clics`) VALUES (NULL, 'preguntaAleatoria', '0')";
                                          $res=$conexion->exec($sql);

                                      $sql="INSERT INTO `estadistica` (`id`, `ruta`, `clics`) VALUES (NULL, 'comprobarRespuestas', '0');";
                                        $res=$conexion->exec($sql);

                                          // insertamos tema de ejemplo

                                          $sql="INSERT INTO `temas` (`id`, `titulo`, `titulo_url`) VALUES (NULL, 'mates', 'mates')";
                                          $res=$conexion->exec($sql);

                                          // insertamos pregunta de ejemplo

                                           $sql="INSERT INTO `preguntas` (`id`, `pregunta`, `tema`) VALUES (NULL, 'suma 2+2', '1')";
                                            $res=$conexion->exec($sql);

                                            // insertamos las respuestas
                                             $sql="INSERT INTO `respuestas` (`id`, `respuesta`, `verdadera`, `pregunta`) VALUES (NULL, '4', '1', '1');";
                                            $res=$conexion->exec($sql);

                                             $sql="INSERT INTO `respuestas` (`id`, `respuesta`, `verdadera`, `pregunta`) VALUES (NULL, '5', '0', '1');";
                                            $res=$conexion->exec($sql);

                                            $sql="INSERT INTO `respuestas` (`id`, `respuesta`, `verdadera`, `pregunta`) VALUES (NULL, '6', '0', '1');";
                                            $res=$conexion->exec($sql);


        ?>
    </body>
</html>
