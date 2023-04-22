<?php

require($_SERVER['DOCUMENT_ROOT'] . "/php/rasppi/db/db.php");

$conn = connect();

session_start();

$id = $_SESSION['id'];
$current_movie = $_SESSION['id_movie_to_show'];

$result = mysqli_query($conn, "SELECT * FROM `movies` WHERE id=$current_movie"); 
while($row=mysqli_fetch_array($result)){

echo $row['viewers'];

}
mysqli_close($conn);
?>