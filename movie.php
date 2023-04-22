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
    $current_movie = $_SESSION['id_movie_to_show'];
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
        <div class="container">
<?php 

##Incrementar visitas
mysqli_query($conn, "UPDATE movies SET viewers = (viewers + 1) WHERE id=$current_movie");

##Pelicula seleccionada
$sql = "SELECT * FROM movies WHERE id=$current_movie";

$result = mysqli_query($conn, $sql);

while($checkdb=mysqli_fetch_array($result)){
    

    $directory = $checkdb['videopath'];
    echo ("<h1>". $checkdb['name'] . "</h1>");

    echo"<div class='embed-responsive embed-responsive-16by9'>";   
    echo '<video controls="controls" class="embed-responsive-item">
    <source src="'.$directory.'" type="video/mp4"> 
    Tu navegador no soporta los video en HTML5
    </video></div>';

    echo"<br><h6 style='display: inline;' >Género : </h6><h5 style='display: inline;'>".ucwords($checkdb['genre'])." &nbsp</h5>";
    echo"<h6 style='display: inline;' >Año de lanzamiento : </h6><h5 style='display: inline;'>".$checkdb['rdate']." &nbsp </h5>";
    echo"<h6  style='display: inline;' >Visitas : </h6><h5 id='views' style='display: inline;'>". "0"."</h5>";
    echo"<br><br><h4 style='display: inline;' >Descripción : </h4><h5 style='display: inline;'>".ucfirst($checkdb['decription'])."</h5>";

    if (isset($_POST['deletemovie'])) {

        $sql = "DELETE FROM comments WHERE id_movie=$current_movie";
        $result = mysqli_query($conn, $sql);
        $sql = "DELETE FROM movies WHERE id=$current_movie";
        $result = mysqli_query($conn, $sql);
        echo '<script language="javascript">alert("Borrada pelicula y comentarios correctamente ' . $current_movie .'");  window.location = "home.php";</script>';
    }
    

}

$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);

while($checkdb=mysqli_fetch_array($result)){
    if($checkdb['id'] == $user && $checkdb['user_privileges'] == 'admin'){
        echo("<form method='post' action=''>");
        echo("<br><input id='deleteInputs' type='submit' value='Borrar película' name='deletemovie'><br>");
        echo("</form");
    }
}

?> 

<?php include 'includes/footer.php'; ?>
</div>

</body>

</html>

