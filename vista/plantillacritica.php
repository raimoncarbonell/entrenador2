<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width; initial-scale=1.0">
        <title>CINEMANIA-Crítico</title>
         <link rel="stylesheet" type="text/css" href="/Francesc/Practica-2/css/estilos.css">
          <style>
            body
            {
                background-image:url(/Francesc/Practica-2/vista/imatges/imagenescritico.jpg);
                background-size:auto;
            }
            th,td
              {
                  text-align: left;
                  padding: 5px 15px;
              }

        </style>
    </head>
    <body>
          
        
        
        <header>
            <H1>CINEMANIA</H1>
             <a href="../index.php"><img id="home" alt="Volver al inicio" src="/Francesc/Practica-2/vista/imatges/home2.png"></a>
        </header>
        
        <div id="contenedor">
        <?php
            
         if(isset($_POST["autor"]))
            
            
        {
            
      
        echo "<h2>Críticas de ".$_POST["autor"]."</h2>";
             
         }
         if(isset($data))
            
            
        {
            
      
        echo "<h2>Críticas de ".$data[0]["autor"]."</h2>";
             
         }
                  //  _________________________________________________   //
            
            
             try
                    {
                        $conexion = new PDO('mysql:host=localhost;dbname=cinemania', "root");
                    }
                catch(PDOException $e)
                    {
                        echo "Error:".$e->getMessage(); 
                        die();
                    }
    
    $sql="select  DISTINCT criticas.autor from criticas;";
    $res=$conexion->query($sql);
    
   
    echo "<div id='filtroautores'><p id='selectautores'>Autores:</p>";
    echo   '<form id="selectautores" method="post" action="/Francesc/Practica-2/vista/plantillacritica.php">
    <select name="autor">';
    foreach($res as $fila)
    {
        echo '<option value="'.$fila["autor"].'">'.$fila["autor"].'</option>';
     }
    echo '</select>
    <p id="selectautores"><input  type="submit" value="Ver Críticas"></p>
    </form>';
    
            
    // _-------------------------------------------------------------
            
            
        if(isset($data))
        {
            
      
        
        echo "<table>";
       foreach($data as $fila)
       {
           
           
           echo "<tr><th><a href='/Francesc/Practica-2/controlador.php/publicvistapeli?id=".$fila['id_pelicula']."'>".$fila["titulo"]."</a></th><td>".$fila["texto"]."</td><td class='notamedia'>".$fila["nota"]."</td></tr>";
       }
        echo "</table>";
        }
            
            
        if(isset($_POST["autor"]))
            
            
        {
            
      
       
        $sql="SELECT criticas.nota,criticas.autor,criticas.id,criticas.texto,criticas.id_pelicula,cinemania.titulo FROM cinemania join criticas on(cinemania.id=criticas.id_pelicula) WHERE criticas.autor='".$_POST["autor"]."';";
        echo "<table>";
        $res=$conexion->query($sql);
       foreach($res as $fila)
       {
           
           
           echo "<tr><th><a href='/Francesc/Practica-2/controlador.php/publicvistapeli?id=".$fila['id_pelicula']."'>".$fila["titulo"]."</a></th><td>".$fila["texto"]."</td><td class='notamedia'>".$fila["nota"]."</td></tr>";
       }
        echo "</table>";
        }
        ?> 
        
     
      </div>
    
    </body>




</html>