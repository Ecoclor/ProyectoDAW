<?php 
require 'db/db.php';
session_start();
if (isset($_SESSION['id'])) {
    header("location:home.php");
}
session_destroy();
session_start();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="resources/css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container{
            margin: 40px auto;
            width: 400px;
        }
        .content {
            padding: 30px;
            background-color: white;
            box-shadow: 0 0 5px #4267b2;
        }
        header{
            background: #417386;
            color: red;
            font-size: 2rem;
            box-shadow: 0 0 2rem 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
            margin-left: 5rem;
            margin-right: 3rem;
            font-size: 1rem;
            padding: 1rem;
        }
        h1 {
            color: white;
            padding-left: 3%;
        }
    </style>
</head>
<body>
<header class="text-center container-xxxl">
    <h1>Rasppi - Login</h1>
</header>
    <div class="container">
        <div class="content">
            <div class="tabcontent" id="signin">
                <form method="post" onsubmit="return validateLogin()">
                    <label>Email</label><br>
                    <input type="text"  class="form-control" name="useremail" id="loginuseremail">
                    <div class="required"></div>
                    <br>
                    <label>Contraseña</label><br>
                    <input type="password"  class="form-control" name="userpass" id="loginuserpass">
                    <div class="required"></div>
                    <br>
                    <input type="submit" value="Login" name="login">
                    <br>
                    <a href="register.php">Registrarse</a>
                </form>
            </div>
        </div>
    </div>
    <br>
    <?php include 'includes/footer.php'; ?>
</body>
</html>

<?php
$conn = connect();
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    if (isset($_POST['login'])) { 
        $useremail = $_POST['useremail'];
        $userpass = md5($_POST['userpass']);
        $query = mysqli_query($conn, "SELECT * FROM users WHERE user_email = '$useremail' AND user_password = '$userpass'");
        if($query){
            if(mysqli_num_rows($query) == 1) {
                $row = mysqli_fetch_assoc($query);
                $_SESSION['id'] = $row['id'];
                $_SESSION['user_name'] = $row['user_firstname'] . " " . $row['user_lastname'];
                header("location:home.php");
            }
            else {
                ?> <script>
                    document.getElementsByClassName("required")[1].innerHTML = "Los Datos son incorrectos";
                </script> <?php
            }
        } else{
            echo mysqli_error($conn);
        }
    }
}
?>