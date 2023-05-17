<?php 
require 'db/db.php';
session_start();
// Comprobar sesion
if (!isset($_SESSION['id'])) {
    header("location:index.php");
}
// Conectar con BBDD
$conn = connect();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Adminitración de cuentas</title>
    <link rel="stylesheet" type="text/css" href="resources/css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <style>

    button{

        transform: translate(300%, -10%);
        margin: 1%;
    }

    .centerHref{
        transform: translate(42%, -10%);
    }

        .ContenedorGrid {
        width: 74em;
        height: 10rem;
        display: grid;
        grid-template-columns:  1fr ;
        grid-template-rows: 1fr 1fr ;
    }
  
    .grid-item {
        margin-left: 10rem;
        margin-bottom: 2rem;
        background-color: white;
        border: 1px solid black;
        padding: 4rem;
    }

    button{

        transform: translate(370%, -10%);
        margin: 1%;
    }


    </style>
    <script src="./resources/js/chart.min.js"></script>
    <script language="javascript">

    </script>
</head>
<body>
    <div class="container">

        <?php include 'includes/navbar.php';?>
        <div id="chart_div" style="width: 30hv; height: 50hv;"></div>
        <?php

        $sql = "SELECT * FROM movies";
        $result = mysqli_query($conn, $sql);

        $data = array();
        $data[] = array('Video', 'Vistas');

        while($checkdb=mysqli_fetch_array($result)){

            $data[] = array($checkdb['name'], (int)$checkdb['viewers']);
        }

    //convert to JSON
    $jsonData = json_encode($data);
    ?>

    
    <!-- Create graphics -->
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable(<?php echo $jsonData; ?>);

            var options = {
                title: 'Vistas Totales de cada vídeo',
                bars: 'vertical',
                hAxis: {
                    format: '0' // Mostrar solo números enteros
                }
            };

            var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>

    </div>

        <div class="ContenedorGrid">



        </div>

    <div>

    </div>
        
    <br><br>
    <footer>
        <?php include 'includes/footer.php'; ?>
    </footer>
    </div>

</body>
</html>

<script type="text/javascript">
    var flag = false;
    var div = document.getElementById("conn");

    function fun() {
        if (flag ^= true) {
                         div.style.display = "block"; // mostrar formulario 
        } else {
                         div.style.display = "none"; // ocultar formulario 
        }
    }

    </script>