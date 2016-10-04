
<?php
session_start();

if(!isset($_SESSION['user_session']))
{
    header("Location: index.php");
}

include_once 'conf/dbconn.php';

$stmt = $dbh->prepare("SELECT u.*, t.descripcion as tipoUsuario FROM usuarios as u inner join tipo_usuario t 
                       on t.idTipo_Usuario = u.Tipo_Usuario_idTipo_Usuario WHERE idUsuarios=:uid");
$stmt->execute(array(":uid"=>$_SESSION['user_session']));
$row=$stmt->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Gestion de Activos CATEMAR, C.A.</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
    <link href="css/style.css" rel="stylesheet" media="screen">
    <link href="css/menu.css" rel="stylesheet" media="screen">



</head>

<body>

<div class="container">
    <div id="bienvenido" class='alert alert-success'>
        <button id="close" class='close' data-dismiss='alert'>&times;</button>
        Hola, <strong><?php echo $row['Nombre'] . " " . $row['Apellido']; ?>.  Bienvenido</strong>.
    </div>
</div>

<div class="container">
    <div class="row profile">
        <div class="col-md-3">
            <div class="profile-sidebar">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">
                    <img src="imgs/<?php echo $row['foto'] ?>" class="img-responsive" alt="">
                </div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name">
                        <?php echo $row['Nombre'] . " " . $row['Apellido']; ?>
                    </div>
                    <div class="profile-usertitle-job">
                        <?php echo $row['tipoUsuario'] ?>

                    </div>
                </div>
                <!-- END SIDEBAR USER TITLE -->
                <!-- SIDEBAR BUTTONS -->
                <div class="profile-userbuttons">
                    <button id="Administrar" type="button" class="btn btn-success btn-sm">Administrador</button>
                    <button id="Salir" type="button" class="btn btn-danger btn-sm">Salir</button>
                </div>
                <!-- END SIDEBAR BUTTONS -->
                <!-- SIDEBAR MENU -->
                <div class="profile-usermenu">
                    <ul class="nav">
                        <li>
                            <a href="#">
                                <i class="glyphicon glyphicon-home"></i>
                                Inicio </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="glyphicon glyphicon-user"></i>
                                Account Settings </a>
                        </li>
                        <li>
                            <a href="#" target="_blank">
                                <i class="glyphicon glyphicon-ok"></i>
                                Tasks </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="glyphicon glyphicon-flag"></i>
                                Help </a>
                        </li>
                        <li>
                            <a id="Salir" href="#">
                                <i  class="glyphicon glyphicon-log-out"></i>
                                Salir </a>
                        </li>
                    </ul>
                </div>
                <!-- END MENU -->
            </div>
        </div>
        <div class="col-md-9">
            <div class="profile-content">
                <div id="menuAdmin"> </div>

                

                <div id="opciones"> </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript" src="js/jquery-3.1.1.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/menu.js"></script>

</body>
</html>