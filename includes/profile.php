<?php
echo '<div class="profile">';
echo '<center>';
$row = mysqli_fetch_assoc($profilequery);
// Nombre y usuario
if(!empty($row['user_nickname']))
    echo  "<h1>" . $row['user_firstname'] . ' ' . $row['user_lastname'] . ' (' . $row['user_nickname'] . ')' . "</h1>";
else
    echo "<h1>" . $row['user_firstname'] . ' ' . $row['user_lastname']."</h1>";
echo '<br>';
// Informción del perfil 
$width = '400rem';
$height = '400rem';
// include 'includes/profile_picture.php';
echo '<img src="' . $row['profile_picture_path'] . '" width="' . $width . '" height="' . $height .'">';
echo '<br>';
// Genero
if($row['user_gender'] == "M")
    echo 'Sexo: Hombre';
else if($row['user_gender'] == "F")
    echo 'Sexo: Mujer';
echo '<br>';
// Fecha de nacimiento
echo "Fecha de nacimiento: " . $row['user_birthdate'];
// Residencia
if(!empty($row['user_hometown'])){
    echo '<br>';
    echo "Residencia: " . $row['user_hometown'];
}

echo "<br><br>";
echo "<form action='' method='post' enctype='multipart/form-data'>";
echo "<center>";
echo    "<label class='upload' onchange='showPath()'>";
echo        "<span id='path' style='color: white;'>Buscar imagen en el PC</span>";
echo        "<input type='file' name='fileUpload' id='selectedFile'>";
echo    "</label>";
echo "</center>";
echo "<br>";
echo "<input type='submit' value='Subir imagen' name='profile'>";
echo "</form>";
echo '<center>'; 
echo'</div>';

?>