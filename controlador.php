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


$app->get("/crearpreguntas", function($request,$response,$args)
          {
            return $response->withRedirect('/vista/nuevaPregunta.php');
          });


$app->get("/publicvistapeli",function($request,$response,$args)  // sacamos el listado de la búsqueda
          {
              $con=$this->bd;
              $params=$request->getQueryParams();
              $sql="SELECT cinemania.director, cinemania.affinity,cinemania.sinopsis,cinemania.id,cinemania.foto,cinemania.titulo,avg(criticas.nota) as nota_media, cinemania.anyo FROM cinemania left join criticas on(cinemania.id=criticas.id_pelicula) WHERE cinemania.id=".$params['id']." group by cinemania.id ;";
              $res1=$con->query($sql);
              $sql2="SELECT * FROM criticas where criticas.id_pelicula=".$params['id'].";";
              $res2=$con->query($sql2);
              $datos["info"] = $res1->fetchAll();
              $datos["criticas"] = $res2->fetchAll();


              $response=$this->view->render($response,"plantilla2.php",$datos);
              return $response;

          });


$app->get("/publicautor",function($request,$response,$args)
          {
              $con=$this->bd;
              $params=$request->getQueryParams();
              $sql="SELECT criticas.nota,criticas.autor,criticas.id,criticas.texto,criticas.id_pelicula,cinemania.titulo FROM cinemania join criticas on(cinemania.id=criticas.id_pelicula) WHERE criticas.autor='".$params['autor']."';";
              $res=$con->query($sql);

              $datos=$res->fetchAll();



             $response=$this->view->render($response,"plantillacritica.php",$datos);
              return $response;

          });

$app->get("/publicat",function($request,$response,$args)
          {
              $con=$this->bd;
              $params=$request->getQueryParams();
              $sql="SELECT categorias.id,categorias.nombre,avg(criticas.nota) as nota_media,cinemania.id as idpeli,cinemania.foto,cinemania.titulo, cinemania.anyo FROM cinemania left join criticas on(cinemania.id=criticas.id_pelicula),categorias where cinemania.categoria_id=categorias.id and categorias.id=".$params["id"]." group by cinemania.id;";

              $res=$con->query($sql);

              $datos=$res->fetchAll();




          $response=$this->view->render($response,"plantillacat.php",$datos);

              return $response;

          });


$app->run();
?>
