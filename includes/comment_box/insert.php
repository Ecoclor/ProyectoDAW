<?php

require($_SERVER['DOCUMENT_ROOT'] . "/php/rasppi/db/db.php");

$conn = connect();

session_start();

$id = $_SESSION['id'];
$comments = $_REQUEST['comments'];
$current_date = date("Y-m-d");
$current_movie = $_SESSION['id_movie_to_show'];


mysqli_query($conn, "INSERT INTO `comments` (`id`, `comments`, `publish_date`, `id_movie`, `id_user`) VALUES (NULL, '$comments', '$current_date', '$current_movie', '$id')");

$result = mysqli_query($conn, "SELECT * FROM comments  ORDER BY id ASC");
while($row=mysqli_fetch_array($result)){
echo "<div class='comments_content'>";
echo "<h4><a href='delete.php?id=" . $row['id'] . "'> X</a></h4>";
echo "<h1>" . $row['id_user'] . "</h1>";
echo "<h2>" . $row['publish_date'] . "</h2></br></br>";
echo "<h3>" . $row['comments'] . "</h3>";
echo "</div>";
}
mysqli_close($conn);
?>

