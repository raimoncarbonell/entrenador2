<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>crear bd Contactos</title>
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


        ?>
    </body>
</html>
