<?php
require "vendor/autoload.php";
require "estadistica.php";


$app=new Slim\App();
$c=$app->getContainer();


$c["bd"]=function()
{
    $pdo=new PDO("mysql:host=localhost;dbname=bd","root");
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
    return $pdo;
};

$c["view"]=new \Slim\Views\PhpRenderer("vista/");
$app->add(new \Slim\Middleware\SafeURLMiddleware());

$app->add(new \Slim\Middleware\HttpBasicAuthentication([
  "users" => [
    "admin" => "admin",
    "rodolfo" => "contraseñaderodolfo"

  ],
    "path" => "/crearpregunta"
]));

$app->add (new Estadistica());

$app->get("/crearpregunta", function($request,$response,$args)
          {
          $this->view->render($response, "nuevaPregunta.php", []);
          });


$app->get("/preguntaAleatoria", function($request,$response,$args)
        {
          $con=$this->bd;
          $sql="SELECT id FROM preguntas order by rand () limit 1";
          $res=$con->query($sql);
          foreach($res as $fila)
          {
            $idPregunta=$fila['id'];
          }

          $sql="SELECT preguntas.pregunta ,temas.titulo FROM preguntas ,temas WHERE preguntas.tema=temas.id and preguntas.id=$idPregunta";


          $res=$con->query($sql);
          $datosPregunta=$res->fetchAll();

          $sql="SELECT respuesta ,id from respuestas WHERE pregunta=$idPregunta";

          $res=$con->query($sql);
          $datosRespuestas=$res->fetchAll();

          $datos['pregunta']=$datosPregunta;
          $datos ['respuestas']=$datosRespuestas;
          $datos['idPregunta']=$idPregunta;

        $this->view->render($response, "preguntaAleatoria.php",$datos);
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
                    // el tema ya existe si inserta la prengunta'.$idTema.';";

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


$app->post("/comprobarRespuestas", function($request,$response,$args)
      {
        $con=$this->bd;
        $params=$request->getParsedBody();



          $idPregunta=$con->quote($params['idPregunta']);
          $idRespuesta=$con->quote($params['idRespuesta']);

          $sql="SELECT pregunta FROM preguntas WHERE id =$idPregunta;";
          $res=$con->query($sql);

          foreach($res as $fila)
          {
              $datos['pregunta']=$fila['pregunta'];
          }

          $sql="SELECT respuesta,verdadera FROM respuestas WHERE id=$idRespuesta and pregunta=$idPregunta";
          $res=$con->query($sql);

          $respuestasEscogida=$res->fetchAll();

          foreach ($respuestasEscogida as  $respuesta) {

            if ($respuesta['verdadera']==1)
             {
              $datos['estado']="correcta";

            }
            else {
              $datos['estado']="error";
            }
              $datos['respuesta']=$respuesta['respuesta'];

               $sql="SELECT * FROM respuestas where pregunta=$idPregunta";
              $res=$con->query($sql);


              $datos['llistaRespuestas']=$res->fetchAll();
              //print_r($datos);

              $this->view->render($response, "validarRepuesta.php",$datos);
          }


      });


$app->run();


?>
