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

            <!--$_SESSION['id_movie_to_show'] = $checkdb['id']; ##LO USARÉ PARA IDENTIFICAR EL VIDEO--> 

         </div>


<?php
   

        ?>
<br><br>
<div>
    <?php include 'includes/footer.php';?>
</div>
</body>
</html>