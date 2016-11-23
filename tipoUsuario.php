<?php
session_start();

if(!isset($_SESSION['user_session']))
{
    header("Location: index.php");
}

include_once 'conf/dbconn.php';


$stmt = $dbh->prepare("SELECT t.idTipo_Usuario, t.descripcion, m.descModulo ".
                      " FROM tipo_usuario t inner join modulos m ".
                      " on m.idmodulos = t.modulos_idmodulos ");
$stmt->execute();
//$data = $stmt->fetchALL();
$data=$stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<hr />

<div id="tablaTipos" class="table-responsive">
    <table summary="This table shows how to create responsive tables using Bootstrap's default functionality" class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>Tipo de Usuario</th>
            <th>Módulo</th>
            <th>Opciones</th>
        </tr>
        </thead>
        <tbody>
        <?php

        foreach ($data as $row ) {
            echo "<tr>";
            echo "<td>" . $row['descripcion']."</td><td> ".$row['descModulo'] . "</td><td>" .
                //"<span class='glyphicon glyphicon-remove' id = '".$row['usuario']."'></span></td>";
                "<button id='" .$row['idTipo_Usuario']. "' type='button' class='btn btn-danger btn-sm glyphicon glyphicon-remove borrar2'></button></td>";
            echo "</tr>";
        }

        ?>
        </tbody>

    </table>
</div><!--end of .table-responsive-->

<hr />

<?php
$stmt = $dbh->prepare("SELECT m.idmodulos, m.descModulo ".
                      " FROM  modulos m  ");
$stmt->execute();
//$data = $stmt->fetchALL();
$data=$stmt->fetchAll(PDO::FETCH_ASSOC);


?>


<div class="row">
    <div class="col-md-3 col-lg-3 col-sm-3 col-xs-1"></div>
    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-10" >
        <form method="post" id="registrar-tipoUsuario" class="form-horizontal">

            <div id="error2">
                <!-- error will be shown here ! -->
            </div>

            <div class="form-group">
                <input type="text" class="form-control" name="tipo" id="tipo" placeholder="Descripción" required>
            </div>



            <div class="form-group">
                <select class="form-control" id="modulo" name="modulo" required>
                    <option value="" selected disabled>Seleccione Módulo</option>
                    <?php
                    foreach ($data as $row) {
                        ?>

                        <option value="<?php echo $row['idmodulos']; ?>">
                            <?php echo $row['descModulo']; ?>
                        </option>


                        <?php
                    }
                    ?>
                </select>
            </div>
            <input type="hidden" class="form-control" name="register" id="register">
            <hr />
            
            <div class="form-group">
                <button type="submit" class="btn btn-default" name="btn-login2" id="btn-login2"  >
                    <span class="glyphicon glyphicon-log-in"></span> &nbsp; Registrar
                </button>
                <button type="reset" class="btn btn-default" name="btn-loginReset" id="btn-loginReset"  >
                    <span class="glyphicon glyphicon-erase"></span> &nbsp; Borrar
                </button>
            </div>
        </form>
    </div>
    <div class="col-md-3 col-lg-3 col-sm-3 col-xs-1"></div>
</div>
