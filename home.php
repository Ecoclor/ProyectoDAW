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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="resources/css/main.css">
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

while($checkdb=mysqli_fetch_array($result)){
    if($checkdb['id'] == $user && $checkdb['user_privileges'] == 'admin'){  #Agregar nueva pelicula
        $_SESSION['user_priv'] = 'admin';
        echo("
        <br>
        <button id='butn' onclick='fun()'>Agregar película</button>
        <div class='createcontainer' id = 'conn' style = 'display: none'>
        <form method='post' action='' enctype='multipart/form-data'>
        <h1>Datos de película</h1>
                    
        <!--Nombre de video-->
        <label>Nombre de la película</label><br>
        <input type='text'  class='form-control' name='moviename' id='moviename'>
        <div class='required'></div>
        <br>
        <!--Genero-->
        <label>Género</label><br>
        <input type='text'  class='form-control' name='genre' id='genre'>
        <div class='required'></div>
        <br>
        <!--Fecha de publicación-->
        <label>Año de estreno</label><br>
        <input type='number'  class='form-control' minlength='1980' maxlength='2023' name='publishdate' id='publishdate'>
        <div class='required'></div>
        <br>
        <!--Descripciónn-->
        <label>Descripción</label><br>
        <input type='text'  class='form-control' name='moviedescription' id='moviedescription'>
        <div class='required'></div>
        <br>
        <!--Miniatura-->
        <label>Miniatura de video</label><br>
        <input type='file'  class='form-control' name='movieimage' id='movieimage'  accept='image/png, image/jpeg'>
        <br>
        <!--Video-->
        <label>Video</label><br>
        <input type='file'  class='form-control' name='movie' id='movie'  accept='video/mp4,video/x-m4v,video/*'>
        <br>
        <input type='submit' value='Añadir Aplicación' name='AddVideo'>
        <br><br>
        </form>
    </div>
        
        ");
    }
}

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

    <script type="text/javascript">
        var flag = false;
        var div = document.getElementById("conn");
        function fun() {
            if (flag ^= true) {
                            div.style.display = "block"; // mostrar formulario App
            } else {
                            div.style.display = "none"; // ocultar formulario App
            }
        }
    </script>
<?php
            $conn = connect();
            if (isset($_POST['AddVideo'])) { // Registrar datos pelicula
                
                $TargetMovieImage = "data/images/miniatures/".basename($_FILES['movieimage']['name']);
                $TargetMovie = "data/videos/".basename($_FILES['movie']['name']);
                $MovieName = $_POST['moviename'];
                $Genre = $_POST['genre'];
                $PublishDate = $_POST['publishdate'];
                $MovieDescription = $_POST['moviedescription'];
                $MovieImage =$_FILES['movieimage']['name'];
                $Movie = $_FILES['movie']['name'];
                // Insertar datos
                $sql = "INSERT INTO movies(`name`, `genre`, `rdate`, `decription`, `imgpath`, `videopath`, `id_user`)
                        VALUES ('$MovieName', '$Genre','$PublishDate','$MovieDescription', '$TargetMovieImage', '$TargetMovie' , $user )";
                if (file_exists($TargetMovie)) {
                    echo "El vídeo ya existe";
                } else {
                    if (move_uploaded_file($_FILES["movieimage"]["tmp_name"], $TargetMovieImage)) {
                        if (move_uploaded_file($_FILES["movie"]["tmp_name"], $TargetMovie)) {
                            echo "The file ". htmlspecialchars( basename( $_FILES["movieimage"]["name"])). " has been uploaded.\n";
                            if (mysqli_query($conn, $sql)) {
                                echo "Vídeo añadido";
                                echo '<script language="javascript">alert("Video añadido correctamente");  window.location = "home.php";</script>';
                            } else {
                                echo "Error al añadir el vídeo";
                                unlink($TargetMovieImage);
                                unlink($TargetMovie);
                            }
                        } else {
                            echo "Error al subir el vídeo";
                            unlink($TargetMovieImage);
                        }
                    } else {
                        echo "Error al subir la imagen";
                    }
                }
            }
        ?>

<br><br>
<div>
    <?php include 'includes/footer.php';?>
</div>
</body>
</html>