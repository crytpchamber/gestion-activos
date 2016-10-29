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
        $ubicacion = trim($_POST['ubic']);

        if ($nombre == '' || $apellido == '' || $cedula == '' || $ubicacion == '') {
            $registrar = 0;
        }

        $existe = 0;
        try {
            if ($registrar == 1) {

                $stmt = $dbh->prepare("select max(idResposable) as numero from resposable ");
                $stmt->execute();
                $data=$stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($data as $row) {
                    $max = $row['numero'];
                }

                $max++;

                $stmt = $dbh->prepare("select idResposable, Nombre as numero from resposable ".
                    "where (Nombre = :uid and Apellido = :uid2) or Cedula = :uid3 ");
                $stmt->execute(array(":uid" => $nombre,":uid2" => $apellido, ":uid3" => $cedula));
                $data=$stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($data as $row) {
                    $existe++;
                }

                if ($existe>0) {
                    echo "Ya existe un registo con ese nombre o Cedula.";
                } else {

                    $stmt = $dbh->prepare("insert into resposable (idResposable, Nombre, Apellido, Cedula, ubicacion_idUbicacion) " .
                        "values ($max,?,?,?,?)");
                    $stmt->bindParam(1, $nombre);
                    $stmt->bindParam(2, $apellido);
                    $stmt->bindParam(3, $cedula);
                    $stmt->bindParam(4, $ubicacion);

                    $stmt->execute();
                    echo "ok";
                }
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
            $existe = 0;
            if ($registrar == 1) {

                $stmt = $dbh->prepare("select max(idsucursal) as numero from sucursal ");
                $stmt->execute();
                $data=$stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($data as $row) {
                    $max = $row['numero'];
                }

                $max++;


                $stmt = $dbh->prepare("select idsucursal, Descripcion as numero from sucursal ".
                    "where Descripcion = :uid");
                $stmt->execute(array(":uid" => $nombre));
                $data=$stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($data as $row) {
                    $existe++;
                }

                if ($existe>0) {
                    echo "Ya existe un registo con ese nombre.";
                } else {

                    $stmt = $dbh->prepare("insert into sucursal (idsucursal, Descripcion) " .
                        "values ($max,?)");
                    $stmt->bindParam(1, $nombre);

                    $stmt->execute();
                    echo "ok";
                }
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
    function registrarUbicacion(){
        require_once './dbconn.php';
        $registrar = 1;

        $nombre = trim($_POST['ubicacion']);
        $sucursal = trim($_POST['sucursal']);

        if ($nombre == '' || $sucursal == '') {
            $registrar = 0;
            echo "error registrando sucursal.";
        }

        try {
            $existe = 0;
            if ($registrar == 1) {

                $stmt = $dbh->prepare("select max(idUbicacion) as numero from ubicacion ");
                $stmt->execute();
                $data=$stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($data as $row) {
                    $max = $row['numero'];
                }

                $max++;

                $stmt = $dbh->prepare("select idUbicacion, Descripcion as numero from ubicacion ".
                                    "where Descripcion = :uid");
                $stmt->execute(array(":uid" => $nombre));
                $data=$stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($data as $row) {
                    $existe++;
                }

                if ($existe>0) {
                    echo "Ya existe un registo con ese nombre.";
                } else {
                    $stmt = $dbh->prepare("insert into ubicacion (idUbicacion, Descripcion, sucursal_idsucursal) " .
                        "values ($max,?,?)");
                    $stmt->bindParam(1, $nombre);
                    $stmt->bindParam(2, $sucursal);

                    $stmt->execute();
                    echo "ok";
                }
            } else {
                echo "Error registrando Ubicacion.";
            }
        } catch(PDOException $e){

            echo $e->getMessage();
        }

    }
    registrarUbicacion();

}


if (isset($_GET['eliminarUbic'])) {
    function eliminarUbic()
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
    eliminarUbic();
}
/* Fin Gestion de Ubicaciones */


/* Carga de Activos */
if (isset($_POST['reg_act'])) {
    function registrarActivo(){
        require_once './dbconn.php';
        $registrar = 1;

        $nombre = trim($_POST['descripcion']);
        $adquisicion = trim($_POST['fecha_adq']);
        $tdepre = trim($_POST['tiempodepre']);
        $valor = trim($_POST['valorAdq']);
        $inicio = trim($_POST['fechaIni']);
        $sucursal = trim($_POST['ubic']);
        $categ  = trim($_POST['categ']);
        $scateg = trim($_POST['scateg']);
        $serial = trim($_POST['serial']);


        if ($nombre == '' || $adquisicion == '' || $tdepre == '' || $valor == '' || $inicio == '' || $sucursal == '' || $categ == '' ||
            $scateg == '' || $serial == '') {
            $registrar = 0;
            echo "error registrando Activo. 1";
        }

        if ($adquisicion > $inicio) {
            $registrar = 0;
            echo "La fecha de inicio de depreciación no puede ser menor a la de adquisición.";
        }

        if ($_SESSION['guardar']==0) {
            echo "error";
        }else {

            try {
                $existe = 0;
                if ($registrar == 1) {

                    $stmt = $dbh->prepare("select max(idActivos) as numero from activos ");
                    $stmt->execute();
                    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($data as $row) {
                        $max = $row['numero'];
                    }

                    $max++;


                    $stmt = $dbh->prepare("select idActivos from Activos " .
                        "where (Descripcion = :uid or serial = :uid2 ) ");
                    $stmt->execute(array(":uid" => $nombre,":uid2" => $serial));
                    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($data as $row) {
                        $existe++;
                    }

                    if ($existe > 0) {
                        echo "Ya existe un registo con ese Nombre o Código.";
                    } else {

                        $stmt = $dbh->prepare("insert into Activos (idActivos, Descripcion, fecha_adquisicion, " .
                            " tiempo_depre, valor_adquisicion, fecha_registro, fecha_ini_deprec, ubicacion_idUbicacion, ".
                            " categorias_idCategoria, idSubCategoria, serial) " .
                            "values ($max,?,?,?,?,NOW(),?,?,?,?,?)");
                        $stmt->bindParam(1, $nombre);
                        $stmt->bindParam(2, $adquisicion);
                        $stmt->bindParam(3, $tdepre);
                        $stmt->bindParam(4, $valor);
                        $stmt->bindParam(5, $inicio);
                        $stmt->bindParam(6, $sucursal);
                        $stmt->bindParam(7, $categ);
                        $stmt->bindParam(8, $scateg);
                        $stmt->bindParam(9, $serial);

                        $stmt->execute();
                        echo "ok";
                    }
                } else {
                    echo "Error registrando Activo. 2";
                }
            } catch (PDOException $e) {

                echo $e->getMessage();
            }
        }

    }
    registrarActivo();

}


if (isset($_GET['eliminarAct'])) {
    function eliminarAct()
    {
        require_once './dbconn.php';
        $idAct = trim($_GET['eliminarAct']);

        if ($_SESSION['eliminar']==0) {
            echo "error";
        }else {
            try {

                $stmt = $dbh->prepare("delete from activos where idActivos=:uid");
                $stmt->execute(array(":uid" => $idAct));

                echo 'ok';
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
    eliminarAct();
}
/* Fin Carga de Activos */


/* Carga Asignacion de Activos */
if (isset($_POST['reg_asig'])) {
    function asignarActivo(){
        require_once './dbconn.php';
        $registrar = 1;

        $activo = trim($_POST['activo']);
        $responsable = trim($_POST['responsable']);



        if ($activo == '' || $responsable == '') {
            $registrar = 0;
            echo "error registrando Asignacion de Activo. 1";
        }

        if ($_SESSION['guardar']==0) {
            echo "error";
        }else {

            try {
                if ($registrar == 1) {

                    $stmt = $dbh->prepare("select max(idRelacionActivos) as numero from relacionactivos ");
                    $stmt->execute();
                    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($data as $row) {
                        $max = $row['numero'];
                    }

                    $max++;

                    $stmt = $dbh->prepare("insert into relacionactivos (idRelacionActivos, Activos_idActivos, Resposable_idResposable) " .
                        "values ($max,?,?)");
                    $stmt->bindParam(1, $activo);
                    $stmt->bindParam(2, $responsable);


                    $stmt->execute();
                    echo "ok";
                } else {
                    echo "Error registrando Asignacion de Activo. 2";
                }
            } catch (PDOException $e) {

                echo $e->getMessage();
            }
        }

    }
    asignarActivo();

}

if (isset($_GET['eliminarAsig'])) {
    function eliminarRelacAct()
    {
        require_once './dbconn.php';
        $idAct = trim($_GET['eliminarAsig']);

        if ($_SESSION['eliminar']==0) {
            echo "error";
        }else {
            try {

                $stmt = $dbh->prepare("delete from relacionactivos where idRelacionActivos=:uid");
                $stmt->execute(array(":uid" => $idAct));

                echo 'ok';
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
    eliminarRelacAct();
}

/* Modificar Activo*/
if (isset($_POST['btnmodAct'])) {
    function modificarActivo()
    {
       // echo 'entro';
        require_once './dbconn.php';
        $idAct = trim($_GET['modificarAct']);
        $tiempoadq = trim($_POST['tiempoadq']);
        $tiempodepre = trim($_POST['tiempodepre']);
        $valor = trim($_POST['valor']);
        $ubic = trim($_POST['ubic']);
        $date = 0;
        //echo date_format((string)$tiempoadq,"dd-MM-YYYY");
        //echo $tiempoadq;
        //echo $_SESSION['modificar']." ...";
        if ($_SESSION['modificar'] == 0 ) {
            echo "error";
        } else {
            try {

                $stmt = $dbh->prepare("update activos set fecha_adquisicion = '". $tiempoadq ."', ".
                                      "tiempo_depre = ".$tiempodepre .", " .
                                      " valor_adquisicion = ".$valor.", " .
                                      "ubicacion_idUbicacion = '".$ubic ."' " .
                                      " where idActivos=:uid");
                //$stmt->bindParam(':fecha_adq', trim($tiempoadq), PDO::PARAM_STR, 10);
                //$stmt->bindParam('tiempodepre', $tiempodepre, PDO::PARAM_INT);
                //$stmt->bindParam('valAdqui',  $valor, PDO::PARAM_STR);
                //$stmt->bindParam('ubicacion', $ubic, PDO::PARAM_INT);



                $stmt->execute(array(":uid" => $idAct));

                echo 'ok';
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
    modificarActivo();
}

/* Carga de Categorias */
if (isset($_POST['reg_cate'])) {
    function registrarCategoria(){
        require_once './dbconn.php';
        $registrar = 1;

        $nombre = trim($_POST['descripcion']);


        if (trim($nombre) == '') {
            $registrar = 0;
            echo "error registrando Categoria. 1";
        }

        if ($_SESSION['guardar']==0) {
            echo "error";
        }else {

            try {
                $existe = 0;
                if ($registrar == 1) {

                    $stmt = $dbh->prepare("select max(idCategoria) as numero from categorias ");
                    $stmt->execute();
                    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($data as $row) {
                        $max = $row['numero'];
                    }

                    $max++;


                    $stmt = $dbh->prepare("select idCategoria from categorias " .
                        "where (Descripcion = :uid ) ");
                    $stmt->execute(array(":uid" => $nombre));
                    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($data as $row) {
                        $existe++;
                    }

                    if ($existe > 0) {
                        echo "Ya existe un registo con ese nombre.";
                    } else {

                        $stmt = $dbh->prepare("insert into categorias (idCategoria, Descripcion) " .
                            "values ($max,?)");
                        $stmt->bindParam(1, $nombre);

                        $stmt->execute();
                        echo "ok";
                    }
                } else {
                    echo "Error registrando Categoria. 2";
                }
            } catch (PDOException $e) {

                echo $e->getMessage();
            }
        }

    }
    registrarCategoria();

}


if (isset($_GET['eliminarsCate'])) {
    function eliminarSubCateg()
    {
        require_once './dbconn.php';
        $idAct = trim($_GET['eliminarsCate']);

        if ($_SESSION['eliminar']==0) {
            echo "error";
        }else {
            try {

                $stmt = $dbh->prepare("delete from subcategoria where idSubCategoria=:uid");
                $stmt->execute(array(":uid" => $idAct));

                echo 'ok';
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
    eliminarSubCateg();
}



/* Carga de Sub-Categorias */
if (isset($_POST['reg_scate'])) {
    function registrarSubCategoria(){
        require_once './dbconn.php';
        $registrar = 1;

        $nombre = trim($_POST['descripcion']);
        $categoria = trim($_POST['categoria']);


        if (trim($nombre) == '' || trim($categoria) == '') {
            $registrar = 0;
            echo "error registrando Sub-Categoria. 1";
        }

        if ($_SESSION['guardar']==0) {
            echo "error";
        }else {

            try {
                $existe = 0;
                if ($registrar == 1) {

                    $stmt = $dbh->prepare("select max(idSubCategoria) as numero from subcategoria ");
                    $stmt->execute();
                    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($data as $row) {
                        $max = $row['numero'];
                    }

                    $max++;


                    $stmt = $dbh->prepare("select idSubCategoria from subcategoria " .
                        "where (Descripcion = :uid and idCategoria = :cate ) ");
                    $stmt->execute(array(":uid" => $nombre,":cate" => $categoria));
                    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($data as $row) {
                        $existe++;
                    }

                    if ($existe > 0) {
                        echo "Ya existe un registo con ese nombre.";
                    } else {

                        $stmt = $dbh->prepare("insert into subcategoria (idSubCategoria, Descripcion, idCategoria) " .
                            "values ($max,?,?)");
                        $stmt->bindParam(1, $nombre);
                        $stmt->bindParam(2, $categoria);

                        $stmt->execute();
                        echo "ok";
                    }
                } else {
                    echo "Error registrando Sub-Categoria. 2";
                }
            } catch (PDOException $e) {

                echo $e->getMessage();
            }
        }

    }
    registrarSubCategoria();

}


if (isset($_GET['bCate'])) {
    function comboSubCategoria() {
        require_once './dbconn.php';
        $bCate = trim($_GET['bCate']);

        if ($bCate == '') {
            echo 'error';
        } else {
            try {
                $stmt = $dbh->prepare("select idSubCategoria, Descripcion  from subcategoria " .
                                      "where idCategoria = :uid ");

                $stmt->execute(array(":uid" => $bCate));

                $data4 = $stmt->fetchAll(PDO::FETCH_ASSOC);

                echo "<label >Sub-Categoria</label> 
                     <select class='form-control' id='scateg' name='scateg' title='scateg' > ";
                foreach ($data4 as $row) {
                    echo "<option value='" .$row['idSubCategoria']."'> ";
                    echo $row['Descripcion'];
                    echo "</option>";
                }

                echo "</select>";

                //echo 'ok';
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

    }
    comboSubCategoria();


}




?>