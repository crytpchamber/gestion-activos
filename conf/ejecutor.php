<?php
session_start();

?>

<?php

//echo $_GET['eliminarResp'];
/* Gestion de Responsables */
if (isset($_POST['reg_respons'])) {
    function registrarResponsable(){
        require_once './dbconn.php';
        $registrar = 1;

        $nombre = trim($_POST['nombre']);
        $apellido = trim($_POST['apellido']);
        $cedula = trim($_POST['cedula']);

        if ($nombre == '' || $apellido == '' || $cedula == '') {
            $registrar = 0;
        }

        try {
            if ($registrar == 1) {

                $stmt = $dbh->prepare("select max(idResposable) as numero from resposable ");
                $stmt->execute();
                $data=$stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($data as $row) {
                    $max = $row['numero'];
                }

                $max++;
                
                $stmt = $dbh->prepare("insert into resposable (idResposable, Nombre, Apellido, Cedula) " .
                    "values ($max,?,?,?)");
                $stmt->bindParam(1, $nombre);
                $stmt->bindParam(2, $apellido);
                $stmt->bindParam(3, $cedula);


                $stmt->execute();
                echo "ok";
            } else {
                echo "Error registrando Usuario.";
            }
        } catch(PDOException $e){

            echo $e->getMessage();
        }

    }
    registrarResponsable();

}


if (isset($_GET['eliminarResp'])) {
    function eliminarResp()
    {
        require_once './dbconn.php';
        $idResp = trim($_GET['eliminarResp']);


        try {
            
            $stmt = $dbh->prepare("delete from resposable where idResposable=:uid");
            $stmt->execute(array(":uid" => $idResp));

            echo 'ok';
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    eliminarResp();
}
/* Fin Gestion de Responsables */

/* Gestion de Sucursales */
if (isset($_POST['reg_sucu'])) {
    function registrarSucursal(){
        require_once './dbconn.php';
        $registrar = 1;

        $nombre = trim($_POST['descripcion']);

        if ($nombre == '' ) {
            $registrar = 0;
            echo "error registrando sucursal.";
        }

        try {
            if ($registrar == 1) {

                $stmt = $dbh->prepare("select max(idsucursal) as numero from sucursal ");
                $stmt->execute();
                $data=$stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($data as $row) {
                    $max = $row['numero'];
                }

                $max++;

                $stmt = $dbh->prepare("insert into sucursal (idsucursal, Descripcion) " .
                    "values ($max,?)");
                $stmt->bindParam(1, $nombre);

                $stmt->execute();
                echo "ok";
            } else {
                echo "Error registrando Sucursal.";
            }
        } catch(PDOException $e){

            echo $e->getMessage();
        }

    }
    registrarSucursal();

}


if (isset($_GET['eliminarSucu'])) {
    function eliminarSucu()
    {
        require_once './dbconn.php';
        $idSucu = trim($_GET['eliminarSucu']);


        try {

            $stmt = $dbh->prepare("delete from sucursal where idsucursal=:uid");
            $stmt->execute(array(":uid" => $idSucu));

            echo 'ok';
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    eliminarSucu();
}
/* Fin Gestion de Sucursales */

/* Gestion de Ubicaciones */
if (isset($_POST['reg_ubic'])) {
    function registrarSucursal(){
        require_once './dbconn.php';
        $registrar = 1;

        $nombre = trim($_POST['ubicacion']);
        $sucursal = trim($_POST['sucursal']);

        if ($nombre == '' || $sucursal == '') {
            $registrar = 0;
            echo "error registrando sucursal.";
        }

        try {
            if ($registrar == 1) {

                $stmt = $dbh->prepare("select max(idUbicacion) as numero from ubicacion ");
                $stmt->execute();
                $data=$stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($data as $row) {
                    $max = $row['numero'];
                }

                $max++;

                $stmt = $dbh->prepare("insert into ubicacion (idUbicacion, Descripcion, sucursal_idsucursal) " .
                    "values ($max,?,?)");
                $stmt->bindParam(1, $nombre);
                $stmt->bindParam(2, $sucursal);

                $stmt->execute();
                echo "ok";
            } else {
                echo "Error registrando Ubicacion.";
            }
        } catch(PDOException $e){

            echo $e->getMessage();
        }

    }
    registrarSucursal();

}


if (isset($_GET['eliminarUbic'])) {
    function eliminarSucu()
    {
        require_once './dbconn.php';
        $idUbic = trim($_GET['eliminarUbic']);


        try {

            $stmt = $dbh->prepare("delete from ubicacion where idUbicacion=:uid");
            $stmt->execute(array(":uid" => $idUbic));

            echo 'ok';
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    eliminarSucu();
}
/* Fin Gestion de Ubicaciones */


/* Carga de Activos */
if (isset($_POST['reg_act'])) {
    function registrarSucursal(){
        require_once './dbconn.php';
        $registrar = 1;

        $nombre = trim($_POST['descripcion']);
        $adquisicion = trim($_POST['fecha_adq']);
        $tdepre = trim($_POST['tiempodepre']);
        $valor = trim($_POST['valorAdq']);
        $inicio = trim($_POST['fechaIni']);


        if ($nombre == '' || $adquisicion == '' || $tdepre == '' || $valor == '' || $inicio == '') {
            $registrar = 0;
            echo "error registrando Activo. 1";
        }

        try {
            if ($registrar == 1) {

                $stmt = $dbh->prepare("select max(idActivos) as numero from activos ");
                $stmt->execute();
                $data=$stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($data as $row) {
                    $max = $row['numero'];
                }

                $max++;

                $stmt = $dbh->prepare("insert into Activos (idActivos, Descripcion, fecha_adquisicion, " .
                    " tiempo_depre, valor_adquisicion, fecha_registro, fecha_ini_deprec) " .
                    "values ($max,?,?,?,?,NOW(),?)");
                $stmt->bindParam(1, $nombre);
                $stmt->bindParam(2, $adquisicion);
                $stmt->bindParam(3, $tdepre);
                $stmt->bindParam(4, $valor);
                $stmt->bindParam(5, $inicio);


                $stmt->execute();
                echo "ok";
            } else {
                echo "Error registrando Activo. 2";
            }
        } catch(PDOException $e){

            echo $e->getMessage();
        }

    }
    registrarSucursal();

}


if (isset($_GET['eliminarAct'])) {
    function eliminarSucu()
    {
        require_once './dbconn.php';
        $idAct = trim($_GET['eliminarAct']);


        try {

            $stmt = $dbh->prepare("delete from activos where idActivos=:uid");
            $stmt->execute(array(":uid" => $idAct));

            echo 'ok';
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    eliminarSucu();
}
/* Fin Carga de Activos */


?>