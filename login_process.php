<?php
session_start();
require_once './conf/dbconn.php';

if(isset($_POST['btn-login']))
{
    $user = trim($_POST['user']);
    $user_password = trim($_POST['password']);

    //$password = md5($user_password);
    $password = $user_password;

    try
    {

        $stmt = $dbh->prepare("SELECT u.*, t.descripcion as tipo_desc, m.ubicacion, m.sucursal, m.activos, m.responsable, ".
            " ma.puedeEliminar, ma.puedeGuardar, ma.puedeModificar " .
            " FROM usuarios u inner join tipo_usuario t on u.Tipo_Usuario_idTipo_Usuario = t.idTipo_Usuario " .
            " inner join modulos m on m.idmodulos = t.modulos_idmodulos inner join mapas_acceso ma on " .
            " ma.idmapas_acceso = m.mapas_acceso_idmapas_acceso " .
            " WHERE usuario=:user ");
        $stmt->execute(array(":user"=>$user));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();

        if($row['clave']==$password){

            echo "ok"; // log in
            $_SESSION['user_session'] = $row['idUsuarios'];
            $_SESSION['usuarios'] = 0 ;
            $_SESSION['ubicacion'] = $row['ubicacion'] ;
            $_SESSION['sucursal'] = $row['sucursal'];
            $_SESSION['activos'] = $row['activos'];
            $_SESSION['responsable'] = $row['responsable'];
            $_SESSION['eliminar'] = $row['puedeEliminar'];
            $_SESSION['guardar'] = $row['puedeGuardar'];
            $_SESSION['modificar'] = $row['puedeModificar'];
        }
        else{

            echo "Usuario o contraseña invalida."; // wrong details
        }

    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
}

?>