<?php
session_start();

if(!isset($_SESSION['user_session']))
{
    header("Location: index.php");
}

include_once 'conf/dbconn.php';

//echo $_POST['id'];
try {
    $stmt = $dbh->prepare("delete from tipo_usuario where idTipo_Usuario=:uid");
    $stmt->execute(array(":uid"=>$_POST['id']));

    echo 'ok';
} catch(PDOException $e) {
    echo $e->getMessage();
}


?>