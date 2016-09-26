<?php
  class Estadistica{


    public function __invoke($request, $response, $next){

      // informacion de la url de $request

      $url=$request->getUri();
      $url=$url->getPath();
       try{
          $con = new PDO('mysql:host=localhost;dbname=bd', "root");
      }catch(PDOException $e){
          echo "<div class='error'>".$e->getMessage()."</div>";
          die();
        }

      $sql="SELECT * FROM estadistica WHERE ruta ='$url'";
      $res=$con->query($sql);


      foreach($res as $fila)
      {
        $contador=$fila['clics'];
       $contador++;


      }

       $sql= "UPDATE `estadistica` SET `clics` = '$contador' WHERE `estadistica`.`ruta` = '$url';";
      $res=$con->exec($sql);

  

      //die();

      return $next($request, $response);
    }
  }
?>
