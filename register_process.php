<?php
session_start();
require_once './conf/dbconn.php';
header('Content-Type:multipart/form-data');

//echo $_POST['register'];

if(isset($_POST['register']))
{
    $registrar = 1;
/*
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["filename"]["name"]);
    $nombreImg = basename($_FILES["filename"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

    // Check if image file is a actual image or fake image
    if(isset($_POST["register"])) {
        $check = getimagesize($_FILES["filename"]["tmp_name"]);
        if ($check !== false) {
            //echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "El archivo no es una imagen.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Disculpe, ya existe un archivo con ese nombre.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Disculpe, solo archivos JPG, JPEG, PNG o GIF permitidos.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Disculpe, la imagen no pudo ser cargada.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["filename"]["tmp_name"], $target_file)) {
            //echo "El ". basename( $_FILES["filename"]["name"]). " has been uploaded.";
        } else {
            echo "Disculpe, hubo un error cargando su imagen.";
        }
    }
*/
    $user = trim($_POST['usuario']);
    $user_password = trim($_POST['pwd']);
    $nombre = trim($_POST['Nombre']);
    $apellido = trim($_POST['Apellido']);
    $cedula = trim($_POST['cedula']);
    $tipo = trim($_POST['tipo']);

    if ($user == '' || $user_password == '' || $nombre == '' || $apellido == '' || $cedula == '' || $tipo == '') {
        $registrar = 0;
    }

    try
    {
        if ($registrar == 1) {
            $stmt = $dbh->prepare("insert into usuarios (usuario, clave, Nombre, Apellido, Cedula, Tipo_Usuario_idTipo_Usuario) " .
                "values (?,?,?,?,?,?)");
            $stmt->bindParam(1, $user);
            $stmt->bindParam(2, $user_password);
            $stmt->bindParam(3, $nombre);
            $stmt->bindParam(4, $apellido);
            $stmt->bindParam(5, $cedula);
            $stmt->bindParam(6, $tipo);

            $stmt->execute();
            echo "ok";
        } else {
            echo "Error registrando Usuario.";
        }


    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
} else {
    echo "boton no envia valor";
}

?>