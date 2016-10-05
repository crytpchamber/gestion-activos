<?php
session_start();

if(!isset($_SESSION['user_session']))
{
    header("Location: index.php");
}

include_once 'conf/dbconn.php';


$stmt = $dbh->prepare("SELECT m.idmodulos, m.descModulo, ma.Descripcion 
                           FROM  modulos m inner join mapas_acceso ma  
                           on ma.idmapas_acceso = m.mapas_acceso_idmapas_acceso ");
$stmt->execute();
//$data = $stmt->fetchALL();
$data=$stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<hr />

<div id="tablaModulos" class="table-responsive">
    <table summary="This table shows how to create responsive tables using Bootstrap's default functionality" class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>Modulo</th>
            <th>Mapa de Acceso</th>
            <th>Eliminar</th>
        </tr>
        </thead>
        <tbody>
        <?php

        foreach ($data as $row ) {
            echo "<tr>";
            echo "<td>" . $row['descModulo']."</td><td> ".$row['Descripcion'] . "</td><td>" .
                //"<span class='glyphicon glyphicon-remove' id = '".$row['usuario']."'></span></td>";
                "<button id='" .$row['idmodulos']. "' type='button' class='btn btn-danger btn-sm glyphicon glyphicon-remove borrar3'></button></td>";
            echo "</tr>";
        }

        ?>
        </tbody>

    </table>
</div><!--end of .table-responsive-->

<hr />

<?php
$stmt = $dbh->prepare("SELECT m.idmapas_acceso, m.Descripcion 
                           FROM  mapas_acceso m  ");
$stmt->execute();
//$data = $stmt->fetchALL();
$data=$stmt->fetchAll(PDO::FETCH_ASSOC);


?>


<div class="row">
    <div class="col-md-3 col-lg-3 col-sm-3 col-xs-1"></div>
    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-10" >
        <form method="post" id="registrar-modulo" class="form-horizontal">

            <div id="error3">
                <!-- error will be shown here ! -->
            </div>

            <div class="form-group">
                <input type="text" class="form-control" name="modulo" id="modulo" placeholder="Descripción" required>
            </div>



            <div class="form-group">
                <select class="form-control" id="mapa" name="mapa" required>
                    <?php
                    foreach ($data as $row) {
                        ?>

                        <option value="<?php echo $row['idmapas_acceso']; ?>">
                            <?php echo $row['Descripcion']; ?>
                        </option>


                        <?php
                    }
                    ?>
                </select>
            </div>
            <input type="hidden" class="form-control" name="register" id="register">
            <hr />
            
            <div class="form-group">
                <button type="submit" class="btn btn-default" name="btn-login3" id="btn-login3"  >
                    <span class="glyphicon glyphicon-log-in"></span> &nbsp; Registrar
                </button>

            </div>
        </form>
    </div>
    <div class="col-md-3 col-lg-3 col-sm-3 col-xs-1"></div>
</div>
