<?php 
require 'db/db.php';
session_start();
// Comprobar sesión iniciada
if (!isset($_SESSION['id'])) {
    header("location:index.php");
}
$temp = $_SESSION['id'];

session_destroy();
session_start();
$_SESSION['id'] = $temp;
$_SESSION['user_priv'] = '';
ob_start(); 
// Conexión base de datos
$conn = connect();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Rasppi - Home</title>
    <link rel="stylesheet" type="text/css" href="resources/css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>


    </style>
</head>
<body>

    <div class="container">
        <?php include 'includes/navbar.php'; ?>
        <?php

$sql = "SELECT * FROM users WHERE user_privileges = 'admin' ";
$result = mysqli_query($conn, $sql);

$user = $_SESSION['id'];


?>
      <main>
        <form method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
            <label><b>Buscador: </b></label>
            <br>
            <input type='text' class='form-control' name='movie_name' id='movie_name'>
            <br>
            <input type='submit' value='Buscar' name='movie_search'>
        </form>
        <br>

        <br>
        <h1>Películas</h1>
        <div class="ContenedorGrid">
        <div class="ContenedorGrid">
        <?php
        if (isset($_POST['movie_filter'])) {
            if ($_POST['movie_filter'] == "alphabetical") {
                $sql = "SELECT * FROM movies ORDER BY name ASC";
            } elseif ($_POST['movie_filter'] == "published_date") {
                $sql = "SELECT * FROM movies ORDER BY rdate ASC";
            } elseif ($_POST['movie_filter'] == "viewers") {
                $sql = "SELECT * FROM movies ORDER BY viewers DESC";
            }
        } else {
            $sql = "SELECT * FROM movies";
        }
        $result = mysqli_query($conn, $sql);
        $found = false;
        while($checkdb=mysqli_fetch_array($result)){
            if (isset($_POST['movie_search'])) {
                $movie_name = $_POST['movie_name'];
                #Buscar película
                if ($checkdb['name'] == $movie_name) {
                    echo("<div class='grid-item'>");
                    echo ("<img alt='' src=" . $checkdb['imgpath'] . "  width='340' height='220'></a>");
                    echo ("<figcaption>" . $checkdb['name'] . "</figcaption>");
                    echo("<form method='post' action=''>");
                    echo("<br><input type='submit' value='Ver' name='showmovie". $checkdb['id'] ."'><br>");
                    echo("</form>");
                    echo("</div>");
                    global $found;
                    $found = true;
                }
            } else {
                #Listado de todas las peliculas
                echo("<div class='grid-item'>");
                echo ("<img alt='' src=" . $checkdb['imgpath'] . "  width='340' height='220'></a>");
                echo ("<figcaption>" . $checkdb['name'] . "</figcaption>");
                echo("<form method='post' action=''>");
                echo("<br><input type='submit' value='Ver' name='showmovie". $checkdb['id'] ."'><br>");
                echo("</form>");
                echo("</div>");
            }
            if (isset($_POST['showmovie'.$checkdb['id']])) {
                $_SESSION['id_movie_to_show'] = $checkdb['id'];
                echo '<script language="javascript">window.location = "movie.php";</script>';
            }
        }
        #Resultado si no encuentra una película
        if ($found == false and isset($_POST['movie_search'])) {
            echo("<h2>No se ha encontrado ningún resultado</h2>");
        }
        ?>
        </main>
    </div>


<br><br>
<div>
    <?php include 'includes/footer.php';?>
</div>
</body>
</html>