<?php 
require 'db/db.php';
session_start();
// Check whether user is logged on or not
if (!isset($_SESSION['id'])) {
    header("location:index.php");
}
// Establish Database Connection
$conn = connect();
?>
<?php
    $user = $_SESSION['id'];
    #$current_movie = $_SESSION['id_movie_to_show'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Video</title>
    <link rel="stylesheet" type="text/css" href="resources/css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css' integrity='sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO' crossorigin='anonymous'>
    <script src="./resources/js/chart.min.js"></script>
    <script src="./resources/js/main.js"></script>
    <script>
        reloadviews();
    </script>
</head>
<body>

    <div class="container">

        <?php include 'includes/navbar.php'; ?>
        <br>
        </div>
<body>
    <div class='embed-responsive embed-responsive-16by9'>
    <video controls="controls" class="embed-responsive-item">
    <source src="data/videos/test-video.mp4" type="video/mp4">
    Tu navegador no soporta los video en HTML5
    </video></div>';

    <br><h6 style='display: inline;' >Género : </h6><h5 style='display: inline;'> Accioón &nbsp</h5>
    <h6 style='display: inline;' >Año de lanzamiento : </h6><h5 style='display: inline;'> 2000 &nbsp </h5>
    <h6  style='display: inline;' >Visitas : </h6><h5 id='views' style='display: inline;'>1</h5>
    <br><br><h4 style='display: inline;' >Descripción : </h4><h5 style='display: inline;'>Descripción prueba</h5>

<div>

<?php include 'includes/footer.php'; ?>
</div>

</body>
</html>

