<?php

require($_SERVER['DOCUMENT_ROOT'] . "/php/rasppi/db/db.php");

$conn = connect();

if(isset($_GET['id'])){
	$id = $_GET['id'];
mysqli_query($conn,"DELETE FROM comments WHERE id='$id'");
header("location: /../php/rasppi/home.php");

}
mysqli_close($conn);
?>
