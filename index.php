<?php
require "vendor/autoload.php";

$app = new Slim\App();

$app->get('/', function($request, $response, $args){
    $response->write("<h1>Benvenido a la aplicacion entrenador</h1>");
    return $response;
});

$app->get('/{nombre}', function($request, $response, $args){
    $response->write("<h1>Benvenido a la aplicacion entrenador ".$args['nombre']."</h1>");
    return $response;
});
$app->run();
?>
