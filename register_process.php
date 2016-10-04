<?php
session_start();
require_once './conf/dbconn.php';

echo $_POST['register'];

if(isset($_POST['register']))
{
    $registrar = 1;

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
}

?>