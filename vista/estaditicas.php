<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width; initial-scale=1.0">
        <title>Entrenador Estadistica</title>
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
    <script src="../Chart.js-2.3.0/jquery.min.js"></script>
  <script src="../Chart.js-2.3.0/dist/Chart.bundle.js"></script>
    <style>
    canvas {
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }
    </style>

    <nav id="menu">
                <ul>

                    <li><a href="../index.php">Incio</a></li>
                    <li><a href="../controlador.php/preguntaAleatoria">pregunta Aleatoria</a></li>
                    <<li><a href='../controlador.php/crearpregunta'>Crear preguntas</a></li>

                </ul>
            </nav>
    </head>

    <style>

    </style>
</head>

<body>
    <div id="container" style="width: 50%;">
        <canvas id="canvas"></canvas>
    </div>

    <script>

        var randomScalingFactor = function() {
            return (Math.random() > 0.5 ? 1.0 : -1.0) * Math.round(Math.random() * 100);
        };
        var randomColorFactor = function() {
            return Math.round(Math.random() * 255);
        };
        var randomColor = function() {
            return 'rgba(' + randomColorFactor() + ',' + randomColorFactor() + ',' + randomColorFactor() + ',.7)';
        };
        var barChartData = {
            labels: [

              <?php

              try
                          {
                              $con = new PDO ("mysql:host=localhost;dbname=bd","root");
                          }
                      catch(PDOException $e)
                          {
                              echo "Error:".$e->getMessage();
                              die();
                          }

                        $sql="SELECT ruta from estadistica ORDER BY `estadistica`.`clics`";
                        $res=$con->query($sql);

                        foreach ($res as $resultado)
                          {
                              ?>
                              "<?php echo $resultado['ruta'];?>",
                              <?php
                            }
              ?>

            ],
            datasets: [{
                label: 'Estadistica',
                backgroundColor: "rgba(220,220,220,0.5)",
                data: [
                  <?php

                  try
                              {
                                  $con = new PDO ("mysql:host=localhost;dbname=bd","root");
                              }
                          catch(PDOException $e)
                              {
                                  echo "Error:".$e->getMessage();
                                  die();
                              }

                            $sql="SELECT * FROM `estadistica` ORDER BY `estadistica`.`clics`  ";
                            $res=$con->query($sql);

                            foreach ($res as $resultado)
                              {
                                  ?>
                                  <?php echo $resultado["clics"];?>,
                                  <?php
                                }
                  ?>



                ]
            }]

        };

        window.onload = function() {
            var ctx = document.getElementById("canvas").getContext("2d");
            window.myBar = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    // Elements options apply to all of the options unless overridden in a dataset
                    // In this case, we are setting the border of each bar to be 2px wide and green
                    elements: {
                        rectangle: {
                            borderWidth: 2,
                            borderColor: 'rgb(0, 255, 0)',
                            borderSkipped: 'bottom'
                        }
                    },
                    responsive: true,
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Estadistica visitas'
                    }
                }
            });

        };

    </script>
</body>

</html>
