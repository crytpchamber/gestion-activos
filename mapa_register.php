<?php
session_start();
require_once './conf/dbconn.php';

//echo $_POST['register'];

if(isset($_POST['register']))
{
    $registrar = 1;

    $mapa = trim($_POST['mapa']);
    $ubicacion = trim($_POST['eliminar']);
    $sucursal = trim($_POST['modificar']);
    $activos = trim($_POST['guardar']);
    //$responsable = trim($_POST['checkResp']);


    if ($mapa == '' || $ubicacion == '' || $sucursal == '' || $activos =='') {
        $registrar = 0;
    }

    try
    {
        if ($registrar == 1) {
            $stmt = $dbh->prepare("select max(idmapas_acceso) as numero from mapas_acceso");
            $stmt->execute();
            $data=$stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($data as $row) {
                $max = $row['numero'];
            }

            //echo $max;
            $stmt = $dbh->prepare("insert into mapas_acceso (idmapas_acceso, Descripcion, puedeEliminar, " .
                "puedeModificar, puedeGuardar)"  .
                "values ($max+1,?,?,?,?)");
            $stmt->bindParam(1, $mapa);
            $stmt->bindParam(2, $ubicacion);
            $stmt->bindParam(3, $sucursal);
            $stmt->bindParam(4, $activos);



            $stmt->execute();
            echo "ok";
        } else {
            echo "Error registrando Mapa";
        }


    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
}

?>