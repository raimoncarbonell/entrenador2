<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>película</title>
        <script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
          <script>
          tinymce.init({
            selector: '#mytextarea'
          });
  </script>
        <style>
            body
            {
              
                margin: 0;
                
            }
            #contenedor
            {
                
                width: 80%;
                background-image: url(/Francesc/Practica-2/<?php echo $data["info"][0]["foto"]; ?>);
                background-size:contain;
                background-position:0px 0px;
                margin: auto;
                
            }
              header
            {
                background-color: brown;
                background-image: url(Francesc/Practica-2/vista/imatges/degradado.jpg);
                background-size: cover;
                color: white;
                height: 120px;
                margin: 0;
            }
             header h1
            {
                color:black;
                text-align: center;
                margin: 0;
                font-size: 80px;
            }
            h2
            {
               font-size: 40px; 
                border-bottom: 2px solid red;
                margin: 30px;
            }
             table
            {
                padding: 20px;
                max-width: 95%;
                width: 60%;
                
            }
            a
            {
                font-weight: bold;
            }
            table,th,td
            {
                border: 1px solid green;
                
                box-sizing: border-box;
                margin: 20px auto;
                background-color: rgba(240, 255, 255, 0.51);
                
            }
            th,td
            {
                width: auto;
            }
            
           
            #info
            {
               
               border: 2px solid green;
                width: 60%;
                color:#094e0c;
               background-color: rgba(245, 245, 245, 0.69);
                box-sizing: border-box;
                margin: auto;
                padding: 10px;
                text-align: center;
            }
             h3
        {
            border: 1px solid green;
            background-color: rgba(240, 255, 255, 0.81);
        }
             h4
        {
            border: 1px solid green;
            background-color: rgba(240, 255, 255, 0.81);
        }
            #formescondido
            {
                display:none;
                float: left;
                
                
            }
            label
            {
                display: block;
                color: crimson;
                font-weight: bold;
                
            }
            button
            {
            color:red;
                font-weight: bold;
                margin-left: 42%;
            }
            span
            {
                color:red;
                font-weight: bold;
            }
            #nota
            {
                text-align: center;
                width: 10%;
            }
            #home
            {
                width: 40px;
                height: 40px;
                position: relative;
                bottom: 15px;
            }
            #textocritica
            {
                border: 15px solid green;
                padding: 15px;
                border-image: url(/Francesc/Practica-2/vista/imatges/film.png) 20% stretch;
                background-image: url(/Francesc/Practica-2/vista/imatges/degradado.jpg);
                background-size: cover;
                color:white;
                
            }
        </style>
    </head>
    <body>
          
        
        
        <header>
            <H1>CINEMANIA</H1>
            <a href="../index.php"><img id="home" src="/Francesc/Practica-2/vista/imatges/home2.png"></a>
        </header>
        <div id="contenedor">
        <div id="info">
        <?php
            
      
        if (isset($data["info"]))
      
        {echo '<h2>'.$data["info"][0]["titulo"].' ('.$data["info"][0]["anyo"].')</h2>';
            echo '<h3>Nota media de las críticas: '.$data["info"][0]["nota_media"].'</h3>';
           
            echo '<h4>Sinopsis:<br> '.$data["info"][0]["sinopsis"].'</h4>';
            
       echo "</div>";
 
       
         echo "<table><tr>";
        
       
         echo "<th>Críticas</th><th id='nota'>Valoración</th>";
            
         echo "</tr>";
        
         foreach($data["criticas"] as $fila)
            {

              echo "<tr>";
              echo "<td><a href='/Francesc/Practica-2/controlador.php/publicautor?autor=${fila['autor']}'>${fila['autor']}</a> --- ${fila['texto']} </td><td id='nota'> <span>${fila['nota']}</span></td>";
              echo "</tr>";
            }
         echo '<tr><td colspan=2><button onclick="cargarform()" >Añadir Crítica</button></td></tr><tr><td colspan=2><div id="formescondido">
            <form method="get" action="/Francesc/Practica-2/vista/plantilla.php">
            <input type="hidden" name="idpelis" value="'.$data["info"][0]["id"].'">
            <label>Nombre: </label><input type="text" name="autor"><br>
            <label>Crítica: </label><textarea rows="15" cols="80" name="texto" id="mytextarea" placeholder="arrastra esquina inferior derecha para cambiar tamaño"></textarea>
            <label>Nota: </label><select name="nota"> 
                    <option value="0">0</option>
                   <option value="1">1</option>
                   <option value="2">2</option>
                   <option value="3">3</option>
                   <option value="4">4</option>
                   <option value="5">5</option>
                   <option value="6">6</option>
                   <option value="7">7</option>
                   <option value="8">8</option>
                   <option value="9">9</option>
                   <option value="10">10</option>
                    </select>
            
            <p><input type="submit" value="confirmar"></p>
            </form>
            </div></td></table>'; 
        }
        if(isset($_GET["texto"]))
        {
            
            try{
            $con = new PDO('mysql:host=localhost;dbname=cinemania', "root"); 
        }catch(PDOException $e){
            echo "<div class='error'>".$e->getMessage()."</div>"; 
            die();
        }
            $sql="insert into criticas(autor,id_pelicula,texto,nota) values('${_GET["autor"]}','${_GET["idpelis"]}','${_GET["texto"]}','${_GET["nota"]}');";
               $res=$con->exec($sql);
              
              if($res===1)
              {
                  echo "Se ha añadido tu crítica: ".$_GET["autor"]."<br>";
                  echo "<div id='textocritica'>".$_GET["texto"]."</div>";
                  echo "<button><a href='/Francesc/Practica-2/controlador.php/publicvistapeli?id=".$_GET['idpelis']."'>Volver</a></button>";
                  
              }
              else echo "No se ha podido añadir la crítica";
        }
     
        
  
            
            
        
        ?>
        
        
        <script>
            function cargarform()
            {
                var x=document.getElementById("formescondido");
                x.style.display="inline";
            }
        </script>
    </div>
    </body>




</html>