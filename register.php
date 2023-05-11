<?php 
require 'db/db.php';
session_start();
$conn = connect();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrarse</title>
    <link rel="stylesheet" type="text/css" href="resources/css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <script language="javascript">

    </script>
</head>
<body>
    <div class="container">

    <header class="text-center container-xxxl">

    </header>
    </div>
        <div >
        <br>
        <h1>Formulario de registro</h1>

            <div class='createcontainer' id = 'conn'>
            <form method='post' action='' enctype='multipart/form-data'>

                <form method="post" onsubmit="return validateRegister()">
                    
                    <!--Nombre-->
                    <label>Nombre</label><br>
                    <input class="form-control" type="text" name="userfirstname" id="userfirstname">
                    <div class="required"></div>
                    <br>
                    <!--Apellido-->
                    <label>Apellido</label><br>
                    <input class="form-control" type="text" name="userlastname" id="userlastname">
                    <div class="required"></div>
                    <br>
                    <!--Nombre usuario-->
                    <label>Nombre de usuario</label><br>
                    <input class="form-control" type="text" name="usernickname" id="usernickname">
                    <div class="required"></div>
                    <br>
                    <!--Contraseña-->
                    <label>Contaseña</label><br>
                    <input class="form-control" type="password" name="userpass" id="userpass">
                    <div class="required"></div>
                    <br>
                    <!--Repetir Contraseña-->
                    <label>Confirmar contraseña</label><br>
                    <input class="form-control" type="password" name="userpassconfirm" id="userpassconfirm">
                    <div class="required"></div>
                    <br>
                    <!--Correo-->
                    <label>Email</label><br>
                    <input class="form-control" type="text" name="useremail" id="useremail">
                    <div class="required"></div>
                    <br>
                    <!--Fecha de nacimiento-->
                    Fecha de nacimiento<br>
                    <select name="selectday" >
                    <?php
                    for($i=1; $i<=31; $i++){
                        echo '<option value="'. $i .'">'. $i .'</option>';
                    }
                    ?>
                    </select>
                    <select name="selectmonth">
                    <?php
                    echo '<option value="1">Enero</option>';
                    echo '<option value="2">Febrero</option>';
                    echo '<option value="3">Marzo</option>';
                    echo '<option value="4">Abril</option>';
                    echo '<option value="5">Mayo</option>';
                    echo '<option value="6">Junio</option>';
                    echo '<option value="7">Julio</option>';
                    echo '<option value="8">Agosto</option>';
                    echo '<option value="9">Septiembre</option>';
                    echo '<option value="10">Octubre</option>';
                    echo '<option value="11">Noviembre</option>';
                    echo '<option value="12">Diciembre</option>';
                    ?>
                    </select>
                    <select name="selectyear">
                    <?php
                    for($i=2022; $i>=1900; $i--){
                        if($i == 1990){
                            echo '<option value="'. $i .'" selected>'. $i .'</option>';
                        }
                        echo '<option value="'. $i .'">'. $i .'</option>';
                    }
                    ?>
                    </select>
                    <br><br>
                    <label>Sexo</label>
                    <br>
                    <!--Sexo-->
                    <input type="radio" name="usergender" value="M" id="malegender" class="usergender" checked>
                    <label>Hombre</label>
                    <input type="radio" name="usergender" value="F" id="femalegender" class="usergender">
                    <label>Mujer</label>
                    <div class="required"></div>
                    <br>
                    <!--Residencia-->
                    <label>Residencia</label><br>
                    <input type="text" class="form-control"name="userhometown" id="userhometown">
                    <br>
                    <!--Privilegios-->
                    <br>
                    <div class="required"></div>
                    <br>
                    <!--Submit-->
                    <input type="submit" value="Crear Cuenta" name="register">
                    <br><br>
                </form>
                </form>
            </div>

    </div>
    </div>

        <?php
            $conn = connect();
            if (isset($_POST['register'])) { // Registrar datos de usuario
                
                $userfirstname = $_POST['userfirstname'];
                $userlastname = $_POST['userlastname'];
                $usernickname = $_POST['usernickname'];
                $userpassword = md5($_POST['userpass']);
                $useremail = $_POST['useremail'];
                $userbirthdate = $_POST['selectyear'] . '-' . $_POST['selectmonth'] . '-' . $_POST['selectday'];
                $usergender = $_POST['usergender'];
                $userhometown = $_POST['userhometown'];
                $defaultimg = 'data/images/profiles/1.png';

                // Comprobar duplicación de datos
                $query = mysqli_query($conn, "SELECT user_nickname, user_email FROM users WHERE user_nickname = '$usernickname' OR user_email = '$useremail'");
                if(mysqli_num_rows($query) > 0){
                    $row = mysqli_fetch_assoc($query);
                    if($usernickname == $row['user_nickname'] && !empty($usernickname)){
                        ?> <script>
                        document.getElementsByClassName("required")[4].innerHTML = "El nombre de usuario ya existe";
                        </script> <?php
                    }
                    if($useremail == $row['user_email']){
                        ?> <script>
                        document.getElementsByClassName("required")[7].innerHTML = "El correo ya existe";
                        </script> <?php
                    }
                }
                // Insertar datos
                $sql = "INSERT INTO users(user_firstname, user_lastname, user_nickname, user_password, user_email, user_gender, user_birthdate, user_hometown, user_privileges, profile_picture_path)
                        VALUES ('$userfirstname', '$userlastname', '$usernickname', '$userpassword', '$useremail', '$usergender', '$userbirthdate', '$userhometown', 'regular', '$defaultimg')";
                $query = mysqli_query($conn, $sql);
                echo '<script language="javascript">window.location = "index.php";</script>';
            }

        ?>

    </div>

    <br><br>
    <footer>
        <?php include 'includes/footer.php'; ?>
    </footer>
    </div>

</body>
</html>