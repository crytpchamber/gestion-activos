<?php
session_start();
require_once './conf/dbconn.php';

echo $_POST['register'];

if(isset($_POST['register']))
{
    $registrar = 1;

    $modulo = trim($_POST['modulo']);
    $mapa = trim($_POST['mapa']);


    if ($mapa == '' || $modulo == '' ) {
        $registrar = 0;
    }

    try
    {
        if ($registrar == 1) {
            $stmt = $dbh->prepare("select max(idmodulos) as numero from modulos");
            $stmt->execute();
            $data=$stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($data as $row) {
                $max = $row['numero'];
            }

            //echo $max;
            $stmt = $dbh->prepare("insert into modulos (idmodulos, descModulo, mapas_acceso_idmapas_acceso) " .
                "values ($max+1,?,?)");
            $stmt->bindParam(1, $modulo);
            $stmt->bindParam(2, $mapa);


            $stmt->execute();
            echo "ok";
        } else {
            echo "Error registrando Modulo";
        }


    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
}

?>