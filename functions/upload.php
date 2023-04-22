<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['profile']) || isset($_POST['post'])){
        $filename = basename($_FILES["fileUpload"]["name"]);
        $filetype = pathinfo($filename, PATHINFO_EXTENSION); 
        if($filetype != "png" && $filetype != "jpg" && $filetype!= "jpeg" && $filetype != "gif"){
            echo 'Only JPG, JPEG, PNG & GIF formats are allowed.';
        }
        if(exif_imagetype($_FILES["fileUpload"]["tmp_name"])){ 
            if(isset($_POST['profile'])){
                $filepath = "data/images/profiles/" . $_SESSION['id'] . '.' . $filetype;
                if (file_exists($filepath)) {
                    unlink($filepath);
                }
                if(move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $filepath)){
                    $conn = connect();
                    $sql = "UPDATE users SET profile_picture_path = '" . $filepath . "' WHERE users.id = " . $_SESSION['id'] . ";";
                    if (mysqli_query($conn, $sql)) {
                        echo "Imagen modificada correctamente";
                        echo '<script language="javascript">alert("Imagen modificada correctamente");</script>';
                        header("Refresh:0");
                    } else {
                        echo "Error al modificar la imagen";
                        unlink($filepath);
                    }
                }
            }
        }
    }
}
?>