<?php
// Conexión Base de datos
function connect() {
    static $conn;
    if ($conn === NULL){ 
        $conn = mysqli_connect('localhost','root','','rasppi');
    }
    return $conn;
}

?>