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

/* datos para filtrar*/
/* Responsable */
$stmt = $dbh->prepare("SELECT t.idResposable, t.Nombre, t.Apellido ".
                          " FROM resposable t ");
$stmt->execute();
//$data = $stmt->fetchALL();
$data2=$stmt->fetchAll(PDO::FETCH_ASSOC);

/* Sucursales*/
$stmt = $dbh->prepare("SELECT t.idsucursal, t.Descripcion " .
    " FROM sucursal t ");
$stmt->execute();
//$data = $stmt->fetchALL();
$data3=$stmt->fetchAll(PDO::FETCH_ASSOC);


/* Ubicacion */
$stmt = $dbh->prepare("SELECT t.idUbicacion, t.Descripcion " .
    " FROM ubicacion t ");
$stmt->execute();
//$data = $stmt->fetchALL();
$data4=$stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<hr />
<div class="row">
    <div class="col-md-3 col-lg-3 col-sm-3 col-xs-1"></div>
    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-10" >
        <label >Filtrar por Responsable</label>
        <select class="form-control filtros" id="responsable" name="responsable" title="responsable" >
            <?php
            foreach ($data2 as $row) {
                ?>

                <option value="<?php echo $row['Nombre']." ".$row['Apellido']; ?>">
                    <?php echo $row['Nombre']." ".$row['Apellido']; ?>
                </option>


                <?php
            }
            ?>
        </select>
        <label >Filtrar por Sucursal</label>
        <select class="form-control filtros2" id="responsable" name="responsable" title="responsable" >
            <?php
            foreach ($data3 as $row) {
                ?>

                <option value="<?php echo $row['Descripcion']; ?>">
                    <?php echo $row['Descripcion']; ?>
                </option>


                <?php
            }
            ?>
        </select>

        <label >Filtrar por Ubicación</label>
        <select class="form-control filtros3" id="responsable" name="responsable" title="responsable" >
            <?php
            foreach ($data4 as $row) {
                ?>

                <option value="<?php echo $row['Descripcion']; ?>">
                    <?php echo $row['Descripcion']; ?>
                </option>


                <?php
            }
            ?>
        </select>
    </div>
    <div class="col-md-3 col-lg-3 col-sm-3 col-xs-1"></div>

</div>

<hr />



<div id="tablaRelacion" class="table-responsive">
    <table  class="table table-bordered table-hover" id="tableRelacion">
        <thead>
        <tr>
            <th>Activo</th>
            <th>Responsable</th>
            <th>Sucursal</th>
            <th>Ubicación</th>
            <th>Modificar</th>
        </tr>
        </thead>
        <tbody>
        <?php

        foreach ($data as $row ) {
            echo "<tr>";
            echo "<td>" . $row['Descripcion'] . "</td><td>" . $row['Nombre'] ." " . $row['Apellido'] .  "</td>" .
                "<td>" . $row['sucursal'] . "</td><td>" . $row['ubicacion'] . "</td><td>" .
                "<button id='" .$row['idRelacionActivos']. "' type='button' class='btn btn-default btn-sm glyphicon glyphicon-edit modifAsignacion'></button></td>";

            //"<span class='glyphicon glyphicon-remove' id = '".$row['usuario']."'></span></td>";

            echo "</tr>";
        }

        ?>
        </tbody>

    </table>
</div><!--end of .table-responsive-->

<hr />

<?php
$stmt = $dbh->prepare("SELECT t.idActivos, t.Descripcion " .
                          " FROM activos t ");
$stmt->execute();
//$data = $stmt->fetchALL();
$data=$stmt->fetchAll(PDO::FETCH_ASSOC);





?>


<div class="row">
    <div class="col-md-3 col-lg-3 col-sm-3 col-xs-1"></div>
    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-10" >

            <div id="errorRelacion">
                <!-- error will be shown here ! -->
            </div>



    </div>
    <div class="col-md-3 col-lg-3 col-sm-3 col-xs-1"></div>
</div>