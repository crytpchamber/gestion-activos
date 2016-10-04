<?php
session_start();
require_once './conf/dbconn.php';

echo $_POST['register'];

if(isset($_POST['register']))
{
    $registrar = 1;

    $tipo = trim($_POST['tipo']);
    $modulo = trim($_POST['modulo']);


    if ($tipo == '' || $modulo == '' ) {
        $registrar = 0;
    }

    try
    {
        if ($registrar == 1) {
            $stmt = $dbh->prepare("select max(idTipo_Usuario) as numero from tipo_usuario");
            $stmt->execute();
            $data=$stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($data as $row) {
                $max = $row['numero'];
            }

            //echo $max;
            $stmt = $dbh->prepare("insert into tipo_usuario (idTipo_Usuario, descripcion, modulos_idmodulos) " .
                "values ($max+1,?,?)");
            $stmt->bindParam(1, $tipo);
            $stmt->bindParam(2, $modulo);


            $stmt->execute();
            echo "ok";
        } else {
            echo "Error registrando Tipo de Usuario.";
        }


    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
}

?>