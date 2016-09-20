<?php
require "vendor/autoload.php";


$app=new Slim\App();
$c=$app->getContainer();

$c["bd"]=function()
{
    $pdo=new PDO("mysql:host=localhost;dbname=bd","root");
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
    return $pdo;
};

$c["view"]=new \Slim\Views\PhpRenderer("vista/");

$app->get("/crearpregunta", function($request,$response,$args)
          {
          $this->view->render($response, "nuevaPregunta.php", []);
          });

$app->post("/ncrearpregunta", function($request,$response,$args)
            {
              $con=$this->bd;
              $params=$request->getParsedBody();

                // comprovar que exsita el tema
                $tema=$con->quote($params['tema']);
                  $sql="SELECT id FROM temas WHERE titulo =$tema;";
                  $res=$con->query($sql);

                  foreach($res as $fila)
                  {
                    $idTema=$fila['id'];
                  }
                 if($res->rowCount()>0)
                  {
                      // el tema ya existe se inserta la prengunta
                    $pregunta=$con->quote($params['pregunta']);
                    $sql="  INSERT INTO `preguntas` (`id`, `pregunta`, `tema`) VALUES (NULL, $pregunta, '.$idTema.');";
                    $res=$con->exec($sql);

                  }
                  else
                  {
                    // en el caso que no extista el tema lo creamos
                    $tema=$con->quote($params['tema']);
                    $sql="INSERT INTO `temas` (`id`, `titulo`, `titulo_url`) VALUES (NULL,$tema,$tema);";
                    $res=$con->exec($sql);


                    $sql="SELECT id FROM temas WHERE titulo =$tema;";
                    $res=$con->query($sql);

                    foreach($res as $fila)
                    {
                      $idTema=$fila['id'];
                    }
                    // el tema ya existe si inserta la prengunta'.$idTema.');";

                    $pregunta=$con->quote($params['pregunta']);
                    $sql="  INSERT INTO `preguntas` (`id`, `pregunta`, `tema`) VALUES (NULL, $pregunta, '.$idTema.');";
                    $res=$con->exec($sql);

                  }

                                      // recogue el identicador de la respuesta correcta
                                     $respuestacorrecta=$params['R'];
                                                      // busca el id de la pregunta

                                                    $pregunta=$con->quote($params['pregunta']);
                                                    $sql="SELECT id FROM preguntas WHERE pregunta =$pregunta;";
                                                    $res=$con->query($sql);


                                                    foreach($res as $fila)
                                                    {
                                                      $idPregunta=$fila['id'];
                                                    }


                                                      $repuesta1=$con->quote($params['respuesta1']);
                                                        $repuesta2=$con->quote($params['respuesta2']);
                                                        $repuesta3=$con->quote($params['respuesta3']);


                                                      // inserta las preguntas falsas i cierta segun los selecinado
                                                      // verdadera == 1 cierto
                                                      // verdadera ==2 falso
                                                    if ($respuestacorrecta=='r1')
                                                    {
                                                      // insertamos opcion r1 com repuesta correcta i falsas el respuesta opciones
                                                      $sql="  INSERT INTO `respuestas` (`id`, `respuesta`, `verdadera`,`pregunta`) VALUES (NULL,$repuesta1 , '1',$idPregunta);";
                                                      $res=$con->exec($sql);
                                                      $sql="  INSERT INTO `respuestas` (`id`, `respuesta`, `verdadera`,`pregunta`) VALUES (NULL, $repuesta2, '0',$idPregunta);";
                                                      $res=$con->exec($sql);
                                                      $sql="  INSERT INTO `respuestas` (`id`, `respuesta`, `verdadera`,`pregunta`) VALUES (NULL,$repuesta3 , '0',$idPregunta);";
                                                      $res=$con->exec($sql);

                                                    }

                                                    if ($respuestacorrecta=='r2')
                                                    {
                                                      // insertamos opcion r1 com repuesta correcta i falsas las otras opciones
                                                      $sql="  INSERT INTO `respuestas` (`id`, `respuesta`, `verdadera`,`pregunta`) VALUES (NULL,$repuesta1  , '0',$idPregunta);";
                                                      $res=$con->exec($sql);
                                                      $sql="  INSERT INTO `respuestas` (`id`, `respuesta`, `verdadera`,`pregunta`) VALUES (NULL, $repuesta2', '1',$idPregunta);";
                                                      $res=$con->exec($sql);
                                                      $sql="  INSERT INTO `respuestas` (`id`, `respuesta`, `verdadera`,`pregunta`) VALUES (NULL, $repuesta3 , '0',$idPregunta);";
                                                      $res=$con->exec($sql);

                                                    }

                                                    if ($respuestacorrecta=='r3')
                                                    {
                                                      // insertamos opcion r1 com repuesta correcta i falsas las otras opciones
                                                      $sql="  INSERT INTO `respuestas` (`id`, `respuesta`, `verdadera`,`pregunta`) VALUES (NULL, $repuesta1, '0',$idPregunta);";
                                                      $res=$con->exec($sql);
                                                      $sql="  INSERT INTO `respuestas` (`id`, `respuesta`, `verdadera`,`pregunta`) VALUES (NULL, $repuesta2, '0',$idPregunta);";
                                                      $res=$con->exec($sql);
                                                      $sql="  INSERT INTO `respuestas` (`id`, `respuesta`, `verdadera`, `pregunta`) VALUES (NULL, $repuesta3, '1',$idPregunta);";
                                                      $res=$con->exec($sql);


                                                    }

            $this->view->render($response,"nuevaPregunta.php",$params);
            });


$app->run();


?>
