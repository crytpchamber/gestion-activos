<?php
session_start();
require_once './conf/dbconn.php';
//header('Content-Type:multipart/form-data');

//echo $_POST['register'];

if(isset($_POST['register']))
{
    $registrar = 1;
//exit();




    $user = trim($_POST['usuario']);
    $user_password = trim($_POST['pwd']);
    $nombre = trim($_POST['Nombre']);
    $apellido = trim($_POST['Apellido']);
    $cedula = trim($_POST['cedula']);
    $tipo = trim($_POST['tipo']);
    $nacionalidad = trim($_POST['nacionalidad']);
    //$imagen =

    if ($user == '' || $user_password == '' || $nombre == '' || $apellido == '' || $cedula == '' || $tipo == '' || $nacionalidad == '') {
        $registrar = 0;
    }

    $existe = 0;
    try
    {
        if ($registrar == 1) {

            $cedulaCompleta = $nacionalidad . $cedula;

            $stmt = $dbh->prepare("select usuario from usuarios where usuario = :uid ");
            $stmt->execute(array(":uid" => $user));
            $data=$stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($data as $row) {
                $existe++;
            }


            if ($existe>0) {
                echo "Usuario ya existe.";
            } else {

                // Cargar la imagen despues de guardar el usuario
                $target_dir = "uploads/";
                $target_file = $target_dir . basename($_FILES["filename"]["name"]);
                $nombreImg = basename($_FILES["filename"]["name"]);
                $uploadOk = 1;
                $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

                if (trim($nombreImg) != '') {
                    // Check if image file is a actual image or fake image
                    if (isset($_POST["filename"])) {
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
                    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                        && $imageFileType != "gif"
                    ) {
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
                } else {
                    $nombreImg = 'default.jpg';
                    $target_dir = "uploads/";
                    $target_file = $target_dir . 'default.jpg';
                }

                $stmt = $dbh->prepare("insert into usuarios (usuario, clave, Nombre, Apellido, Cedula, Tipo_Usuario_idTipo_Usuario, foto) " .
                    "values (?,?,?,?,?,?,?)");
                $stmt->bindParam(1, $user);
                $stmt->bindParam(2, $user_password);
                $stmt->bindParam(3, $nombre);
                $stmt->bindParam(4, $apellido);
                $stmt->bindParam(5, $cedulaCompleta);
                $stmt->bindParam(6, $tipo);
                $stmt->bindParam(7, $nombreImg);

                $stmt->execute();



                echo "ok";
            }
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