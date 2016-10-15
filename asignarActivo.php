<?php
session_start();

if(!isset($_SESSION['user_session']))
{
    header("Location: index.php");
}

include_once 'conf/dbconn.php';


$stmt = $dbh->prepare("select ax.idRelacionActivos, ax.Activos_idActivos, a.Descripcion, ax.Resposable_idResposable, " .
                      "r.Nombre, r.Apellido, r.ubicacion_idUbicacion, u.Descripcion as ubicacion, u.sucursal_idsucursal, " .
                      "s.Descripcion as sucursal " .
                      "from relacionactivos ax inner join activos a on a.idActivos = ax.Activos_idActivos " .
                      "inner join resposable r on r.idResposable = ax.Resposable_idResposable " .
                      "inner join ubicacion u on u.idUbicacion = r.ubicacion_idUbicacion " .
                      "inner join sucursal s on s.idsucursal = u.sucursal_idsucursal ");


$stmt->execute();
//$data = $stmt->fetchALL();
$data=$stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<hr />



<div id="tablaRelacion" class="table-responsive">
    <table  class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>Activo</th>
            <th>Responsable</th>
            <th>Sucursal</th>
            <th>Ubicación</th>
        </tr>
        </thead>
        <tbody>
        <?php

        foreach ($data as $row ) {
            echo "<tr>";
            echo "<td>" . $row['Descripcion'] . "</td><td>" . $row['Nombre'] ." " . $row['Apellido'] .  "</td>" .
                "<td>" . $row['sucursal'] . "</td><td>" . $row['ubicacion'] . "</td>";

                //"<span class='glyphicon glyphicon-remove' id = '".$row['usuario']."'></span></td>";

            echo "</tr>";
        }

        ?>
        </tbody>

    </table>
</div><!--end of .table-responsive-->

<hr />

<?php
$stmt = $dbh->prepare("SELECT t.idActivos, t.Descripcion ".
                           " FROM activos t " .
                        " Where t.idActivos not in (select Activos_idActivos from relacionactivos)");
$stmt->execute();
//$data = $stmt->fetchALL();
$data=$stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $dbh->prepare("SELECT t.idResposable, t.Nombre, t.Apellido " .
                          " FROM resposable t ");
$stmt->execute();
//$data = $stmt->fetchALL();
$data2=$stmt->fetchAll(PDO::FETCH_ASSOC);



?>

<div class="row">
    <div class="col-md-3 col-lg-3 col-sm-3 col-xs-1"></div>
    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-10" >
        <form method="post" id="registrar-relacion" class="form-horizontal">

            <div id="errorRelacion">
                <!-- error will be shown here ! -->
            </div>


            <div class="form-group">
                <label >Activo</label>
                <select class="form-control" id="activo" name="activo" title="activo" >
                    <?php
                    foreach ($data as $row) {
                        ?>

                        <option value="<?php echo $row['idActivos']; ?>">
                            <?php echo $row['Descripcion']; ?>
                        </option>


                        <?php
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label >Responsable</label>
                <select class="form-control" id="responsable" name="responsable" title="responsable" >
                    <?php
                    foreach ($data2 as $row) {
                        ?>

                        <option value="<?php echo $row['idResposable']; ?>">
                            <?php echo $row['Nombre']." ".$row['Apellido']; ?>
                        </option>


                        <?php
                    }
                    ?>
                </select>
            </div>

            <input type="hidden" class="form-control" name="reg_asig" id="reg_act">
            <hr />

            <div class="form-group">
                <button type="submit" class="btn btn-default" name="btn-loginAct" id="btn-loginRela" value="" >
                    <span class="glyphicon glyphicon-log-in"></span> &nbsp; Registrar
                </button>
                <button type="reset" class="btn btn-default" name="btn-loginActReset" id="btn-loginRelaReset" value="" >
                    <span class="glyphicon glyphicon-erase"></span> &nbsp; Limpiar
                </button>
            </div>
        </form>
    </div>
    <div class="col-md-3 col-lg-3 col-sm-3 col-xs-1"></div>
</div>
