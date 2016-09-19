<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width; initial-scale=1.0">
        <title>CINEMANIA-Categoría</title>
         <link rel="stylesheet" type="text/css" href="/Francesc/Practica-2/css/estilos.css">
        <style>
            body
            {
              background-image:url(/Francesc/Practica-2/vista/imatges/<?php echo $data[0]["nombre"]; ?>.jpg);
                background-image:url(/Francesc/Practica-2/vista/imatges/<?php echo $_GET["nombre"]; ?>.jpg);              
            }        
        </style>  
    </head>
      
    <body>
          
      <header>
        <H1>CINEMANIA</H1>
         <a href="../index.php"><img id="home" alt="volver al inicio" src="/Francesc/Practica-2/vista/imatges/home2.png"></a>
    </header>
        
    <div id="contenedor">
       
        
    <?php
    if(!isset($data[0]["nombre"]) && !isset($_GET['cadena']))
        {
          echo "<h2>No hay películas de esta categoría</h2>" ;
        }
 
    if(isset($data[0]["nombre"]))
        {    
        echo "<h2>".$data[0]["nombre"]."</h2>";  
        
        
        echo '<form method="get" action="/Francesc/Practica-2/vista/plantillacat.php" id="busquedapelis">
            <input type="hidden" name="nombre" value="'.$data[0]["nombre"].'">
            <label>Búsqueda Película</label>
            <input type="text" name="cadena">
            
             <label>Ordenar por: </label><select name="order"> 
                    <option value="id">Fecha de aparición en Cinemania</option>
                    <option value="titulo">Título</option>
                   <option value="anyo">Año</option>
                   <option value="avg(criticas.nota)">Nota Media</option>
                   
                    </select>
            <button type="submit">Buscar</button>
            
        </form>';
        
        
        echo "<table>";
        foreach($data as $fila)
        {
            $nota_media=$fila['nota_media'];
            $nota_media=floatval($nota_media);
            $nota_media=round($nota_media,2);
            echo "<tr><td><img alt='carátula' class='caratula'  src='/Francesc/Practica-2/${fila['foto']}'></td><th><a href='/Francesc/Practica-2/controlador.php/publicvistapeli?id=".$fila["idpeli"]."'>".$fila["titulo"]."</a></th><td>".$fila["anyo"]."</td><td class='notamedia'>".$nota_media."</td></tr>";
        }
        echo "</table>"; 
        
        }
        
        
   if(isset($_GET['cadena']))
        {    
        echo "<h2>Películas de ".$_GET["nombre"]."</h2>";  
        
        
        echo '<form method="get" action="/Francesc/Practica-2/vista/plantillacat.php" id="busquedapelis">
            <label>Búsqueda Película</label>
            <input type="text" name="cadena">
            <input type="hidden" name="nombre" value="'.$_GET["nombre"].'">
             <label>Ordenar por: </label><select name="order"> 
                    <option value="id">Fecha de aparición en Cinemania</option>
                    <option value="titulo">Título</option>
                   <option value="anyo">Año</option>
                   <option value="avg(criticas.nota)">Nota Media</option>
                   
                    </select>
            <button type="submit">Buscar</button>
            
        </form>';
        $sel = "SELECT categorias.nombre,cinemania.id,cinemania.foto,cinemania.titulo,avg(criticas.nota) as nota_media, cinemania.anyo FROM cinemania left join criticas on(cinemania.id=criticas.id_pelicula),categorias WHERE  cinemania.categoria_id=categorias.id and categorias.nombre='".$_GET['nombre']."' and (cinemania.titulo LIKE ('".$_GET['cadena']."%') or cinemania.titulo LIKE ('%".$_GET['cadena']."%') or cinemania.titulo LIKE ('%".$_GET['cadena']."'))  group by cinemania.id order by ".$_GET['order'].";";
        
     
        
        try{
            $con = new PDO('mysql:host=localhost;dbname=cinemania', "root"); 
        }catch(PDOException $e){
            echo "<div class='error'>".$e->getMessage()."</div>"; 
            die();
        }
            
        $res = $con->query($sel); 
        
        
     
      
        echo "<table>";
        
         if($res->rowCount()>0)
        {     
        foreach($res as $fila)
        {
            $nota_media=$fila['nota_media'];
            $nota_media=floatval($nota_media);
            $nota_media=round($nota_media,2);
            echo "<tr><td><img class='caratula' src='/Francesc/Practica-2/${fila['foto']}'></td><td><a href='/Francesc/Practica-2/controlador.php/publicvistapeli?id=".$fila["id"]."'>".$fila["titulo"]."</a></td><td>".$fila["anyo"]."</td><td class='notamedia'>".$nota_media."</td></tr>";
        }
         }
        else echo "<tr><th>No hay películas que cumplan los criterios de búsqueda</th></tr>";
        echo "</table>";
             
         }
        ?> 
        
   
        </div>  
    
    </body>




</html>