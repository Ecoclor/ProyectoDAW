<?php

require($_SERVER['DOCUMENT_ROOT'] . "/php/ProyectoDAW/db/db.php");

$conn = connect();

if(isset($_GET['id'])){
	$id = $_GET['id'];
mysqli_query($conn,"DELETE FROM comments WHERE id='$id'");
header("location: /../php/ProyectoDAW/home.php");

}
mysqli_close($conn);
?>
