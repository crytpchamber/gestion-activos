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

        $stmt = $dbh->prepare("SELECT * FROM usuarios WHERE usuario=:user");
        $stmt->execute(array(":user"=>$user));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();

        if($row['clave']==$password){

            echo "ok"; // log in
            $_SESSION['user_session'] = $row['idUsuarios'];
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