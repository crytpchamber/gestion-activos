<?php
session_start();
require_once './conf/dbconn.php';

//echo $_POST['register'];

if(isset($_POST['register']))
{
    $registrar = 1;

    $modulo = trim($_POST['modulo']);
    $mapa = trim($_POST['mapa']);
    $ubicacion = trim($_POST['checkUbic']);
    $sucursal = trim($_POST['checkSucu']);
    $activos = trim($_POST['checkAct']);
    $responsable = trim($_POST['checkResp']);


    if ($mapa == '' || $modulo == '' || $ubicacion == '' || $sucursal == '' || $activos =='' || $responsable == '') {
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
            $stmt = $dbh->prepare("insert into modulos (idmodulos, descModulo, mapas_acceso_idmapas_acceso, " .
                "ubicacion, sucursal, activos, responsable )"  .
                "values ($max+1,?,?,?,?,?,?)");
            $stmt->bindParam(1, $modulo);
            $stmt->bindParam(2, $mapa);
            $stmt->bindParam(3, $ubicacion);
            $stmt->bindParam(4, $sucursal);
            $stmt->bindParam(5, $activos);
            $stmt->bindParam(6, $responsable);


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