<?php

require($_SERVER['DOCUMENT_ROOT'] . "/php/rasppi/db/db.php");

$conn = connect();

session_start();
$id = $_SESSION['id'];
$movie_id = $_SESSION['id_movie_to_show'];

//$result = mysqli_query($conn, "SELECT * FROM comments ORDER BY id ASC");
$result = mysqli_query($conn, "SELECT * FROM comments INNER JOIN USERS ON comments.id_user = users.id where id_movie=$movie_id  ORDER BY comments.id ASC");

while($row=mysqli_fetch_array($result)){
echo "<div class='comments_content'>";
if($row['id_user'] == $id || $_SESSION['user_priv'] == 'admin'){
echo "<h4 class='delete_cross'><a href='includes/comment_box/delete.php?id=" . $row['id'=='comments.id'] . "'> X</a></h4>"; ##Solucionar ID de la consulta
}
echo "<b class='nickname_comment'>" . $row['user_nickname'] . "</b></br>";
echo "<p class='date_comment'>" . $row['publish_date'] . "</p></br></br>";
echo "<p class='text_comment'>" . $row['comments'] . "</p>";
echo "</div>";
}
mysqli_close($conn);

?>