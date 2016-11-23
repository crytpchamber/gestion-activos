
<?php
session_start();

if(!isset($_SESSION['user_session']))
{
    header("Location: index.php");
}

include_once 'conf/dbconn.php';

$stmt = $dbh->prepare("SELECT u.*, t.descripcion as tipoUsuario FROM usuarios as u inner join tipo_usuario t " .
                      " on t.idTipo_Usuario = u.Tipo_Usuario_idTipo_Usuario WHERE idUsuarios=:uid");
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
    <link rel="shortcut icon" href="imgs/favicon.ico">



</head>

<body>

<div class="container">

</div>

<div class="container">
    <div class="row profile">
        <div class="col-md-3">
            <div class="profile-sidebar">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">
                    <img src="uploads/<?php echo $row['foto'] ?>" class="img-responsive" alt="">
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
                    <?php
                        if ($row['Tipo_Usuario_idTipo_Usuario']==0) {
                            echo "<button id='Administrar' type='button' class='btn btn-success btn-sm'>Administrador</button>";
                        }

                    ?>

                    <button id="Salir" type="button" class="btn btn-danger btn-sm">Salir</button>
                </div>
                <!-- END SIDEBAR BUTTONS -->
                <!-- SIDEBAR MENU -->
                <div class="profile-usermenu">
                    <ul class="nav navi" id="usernav">
                        <li>
                            <a id="Inicio" href="javascript:void(0);">
                                <i class="glyphicon glyphicon-home"></i>
                                Inicio </a>
                        </li>
                        <li>
                            <a id="Responsable" href="javascript:void(0);">
                                <i class="glyphicon glyphicon-user"></i>
                                Responsables </a>
                        </li>
                        <li>
                            <a id="Sucursal" href="javascript:void(0);" >
                                <i class="glyphicon glyphicon-tent"></i>
                                Sucursal </a>
                        </li>
                        <li>
                            <a id="Ubicacion" href="javascript:void(0);" >
                                <i class="glyphicon glyphicon-road"></i>
                                Ubicación </a>
                        </li>
                        <li>
                            <a id="Categorias" href="javascript:void(0);">
                                <i class="glyphicon glyphicon-list-alt"></i>
                                Categorías </a>
                        </li>
                        <li>
                            <a id="Asignacion" href="javascript:void(0);">
                                <i class="glyphicon glyphicon-check"></i>
                                Gestión de Activos </a>
                        </li>
                        <li>
                            <a id="Reportes" href="javascript:void(0);">
                                <i class="glyphicon glyphicon-open-file"></i>
                                Reportes </a>
                        </li>
                        <li>
                            <a id="Salir" href="javascript:void(0);">
                                <i  class="glyphicon glyphicon-log-out"></i>
                                Salir </a>
                        </li>
                        <li class='icon2 hidden-lg'>
                            <a href='javascript:void(0);' onclick='myFunction2()'>&#9776;</a>
                        </li>
                    </ul>
                </div>
                <!-- END MENU -->
            </div>
        </div>
        <div class="col-md-9">
            <div class="profile-content">
                <div id="menuAdmin"> </div>

                

                <div id="opciones">
                    <div id="bienvenido" class='alert alert-success' >
                        <button id="close" class='close' data-dismiss='alert'>&times;</button>
                        Hola, <strong><?php echo $row['Nombre'] . " " . $row['Apellido']; ?>.  Bienvenido</strong>.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript" src="js/jquery-3.1.1.js"></script>
<script type="text/javascript" src="js/jquery.mask.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/menu.js"></script>

<!-- <script type="text/javascript" src="js/jquery.form.min.js"></script> -->

</body>
</html>