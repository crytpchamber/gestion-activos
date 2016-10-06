<?php
session_start();

?>

<?php

//echo $_GET['eliminarResp'];

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







?>