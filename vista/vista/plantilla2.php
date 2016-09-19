<!doctype html>
<html lang="es">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width; initial-scale=1.0">
        <title>CINEMANIA-película</title>
         <link rel="stylesheet" type="text/css" href="/Francesc/Practica-2/css/estilos.css">
        <script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
          <script>
          tinymce.init({
            selector: '#mytextarea',
              menubar:false,
              plugins: 'lists advlist autolink charmap code textcolor colorpicker emoticons media image paste searchreplace table fullscreen',
              toolbar: "undo redo paste copy searchreplace fullscreen | styleselect bold italic forecolor backcolor | code charmap emoticons media image table",
              image_dimensions: false,
              media_dimensions: false
             
          });
        </script>
        <style>
            body
            {     
               /*  background-image: url(/Francesc/Practica-2/vista/imatges/degradado2.jpg); */
                background-image: url("/Francesc/Practica-2/vista/imatges/<?php echo $data["info"][0]["titulo"]; ?>2.jpg");
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
            <a href="../index.php"><img alt="volver al inicio" id="home" src="/Francesc/Practica-2/vista/imatges/home2.png"></a>
        </header>
        
      
      
        <?php
            
      
        if (isset($data["info"]))
        {   
            $nota_media=$data["info"][0]["nota_media"];
            $nota_media=floatval($nota_media);
            $nota_media=round($nota_media,2);
            echo '<div id="info">
                    <div id="contencarat"><img alt="carátula grande" id="caratula" src="/Francesc/Practica-2/'.$data["info"][0]["foto"].'"></div>';
              echo '<div id="todo"><h2>'.$data["info"][0]["titulo"].' ('.$data["info"][0]["anyo"].')</h2>';
                   echo '<h3><span>Director:</span> '.$data["info"][0]["director"].'<br>';
                        echo '<span>Media de las críticas:</span> '.$nota_media.'<br>';
                        echo '<a href="'.$data["info"][0]["affinity"].'">Enlace a Filmaffinity</a></h3>';
                        echo '<h4><span>Sinopsis:</span><br> '.$data["info"][0]["sinopsis"].'</h4>';
            
                        echo "<table><tr>";
                        echo "<th>Críticas</th><th>Nota</th>";
                        echo "</tr>";
                        foreach($data["criticas"] as $fila)
                        {
                          echo "<tr>";
                          echo "<td><a href='/Francesc/Practica-2/controlador.php/publicautor?autor=${fila['autor']}'>${fila['autor']}</a> --- ${fila['texto']} </td><td class='notamedia'> <span>${fila['nota']}</span></td>";
                          echo "</tr>";
                        }
                        echo '<tr><td colspan=2><button id="cargarform" onclick="cargarform()" >Añadir Crítica</button></td></tr><tr><td colspan=2><div id="formescondido">
                            <form method="post" action="/Francesc/Practica-2/controlador.php/publicoment">
                            <input type="hidden" name="idpelis" value="'.$data["info"][0]["id"].'">
                            <label>Nombre: </label><input type="text" name="autor"><br>
                            <label>Crítica: </label><textarea rows="15" cols="80" name="texto" id="mytextarea" placeholder="arrastra esquina inferior derecha para cambiar tamaño"></textarea>
                            <label>Nota: </label>
                            <select name="nota"> 
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

        echo "</div></div>";    
        
        ?>
        
        
        <script>
            var i=0;
            function cargarform()
            {
                i+=1;
                var x=document.getElementById("formescondido");
                if(i%2!==0) x.style.display="inline";
                else x.style.display="none";
            }
        </script>
    
     
</body>




</html>