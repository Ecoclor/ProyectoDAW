<?php 
require 'db/db.php';
session_start();
//ob_start();
// Comprobar Login
if (!isset($_SESSION['id'])) {
    header("location:index.php");
}
// Conexión DB
$conn = connect();
?>

<?php
if(isset($_GET['id']) && $_GET['id'] != $_SESSION['uid']) {
    $current_id = $_GET['id'];
    $flag = 1;
} else {
    $current_id = $_SESSION['id'];
    $flag = 0;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Perfil de usuario</title>
    <link rel="stylesheet" type="text/css" href="resources/css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .post{
        margin-right: 50px;
        float: right;
        margin-bottom: 18px;
    }
    .profile{
        
        background-color: white;
        box-shadow: 0 0 5px #4267b2;
        width: 50rem;
        padding: 20px;
        margin:auto;
    }
    input[type="file"]{
        display: none;
    }
    label.upload{
        cursor: pointer;
        color: white;
        background-color: #4267b2;
        padding: 8px 12px;
        display: inline-block;
        max-width: 80px;
        overflow: auto;
    }
    label.upload:hover{
        background-color: #23385f;
    }
    .changeprofile{
        color: #23385f;
        font-family: Fontin SmallCaps;
    }
    </style>
</head>
<body>
    <div class="container">
        <?php include 'includes/navbar.php'; ?>
        <h1>Perfil de usuario</h1>
        <?php
        $postsql;
        if($flag == 0) { // Perfil

            $profilesql = "SELECT users.id, users.user_gender, users.user_hometown, users.user_birthdate,
                                 users.user_firstname, users.user_lastname, users.profile_picture_path
                          FROM users
                          WHERE users.id = $current_id";
            $profilequery = mysqli_query($conn, $profilesql);
        } 

        include 'includes/profile.php';
        
        ?>
    </div>


    <div>
        <br><br>
            <?php include 'includes/footer.php'; ?>
        </div>

</body>
<script>
function showPath(){
    var path = document.getElementById("selectedFile").value;
    path = path.replace(/^.*\\/, "");
    document.getElementById("path").innerHTML = path;
}

</script>
</html>
<?php include 'functions/upload.php'; ?>

<?php

?>
