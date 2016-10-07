<?php
session_start();

if(!isset($_SESSION['user_session']))
{
    header("Location: index.php");
}

include_once 'conf/dbconn.php';


$stmt = $dbh->prepare("SELECT t.idActivos, t.Descripcion, t.fecha_adquisicion, t.tiempo_depre, t.valor_adquisicion, " .
                      " t.fecha_registro, t.fecha_ini_deprec, u.Descripcion as DescUbicacion " .
                      "     FROM activos t inner join ubicacion u " .
                      " on u.idUbicacion = t.ubicacion_idUbicacion ");
$stmt->execute();
//$data = $stmt->fetchALL();
$data=$stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<hr />



<div id="tablaActivos" class="table-responsive">
    <table  class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>Descripcion</th>
            <th>Fecha Adquisicion</th>
            <th>Tiempo de Depreciación</th>
            <th>Valor de Adquisicion</th>
            <th>Ubicación</th>
            <th>Eliminar</th>
        </tr>
        </thead>
        <tbody>
        <?php

        foreach ($data as $row ) {
            echo "<tr>";
            echo "<td>" . $row['Descripcion'] . "</td><td>" . $row['fecha_adquisicion'] . "</td>" .
                 "<td>" . $row['tiempo_depre'] . "</td><td>" . $row['valor_adquisicion'] . "</td><td>" .
                $row['DescUbicacion'] . "</td><td>" .
                 //"<span class='glyphicon glyphicon-remove' id = '".$row['usuario']."'></span></td>";
                "<button id='" .$row['idActivos']. "' type='button' class='btn btn-danger btn-sm glyphicon glyphicon-remove borrarAct'></button></td>";
            echo "</tr>";
        }

        ?>
        </tbody>

    </table>
</div><!--end of .table-responsive-->

<hr />

<?php
$stmt = $dbh->prepare("SELECT t.idUbicacion, t.Descripcion 
                           FROM ubicacion t ");
$stmt->execute();
//$data = $stmt->fetchALL();
$data=$stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="row">
    <div class="col-md-3 col-lg-3 col-sm-3 col-xs-1"></div>
    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-10" >
        <form method="post" id="registrar-activo" class="form-horizontal">

            <div id="errorAct">
                <!-- error will be shown here ! -->
            </div>

            <div class="form-group">
                <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripcion" required>
            </div>
            <div class="form-group">
                <label >Fecha de Adquisición</label>
                <input type="date" class="form-control" name="fecha_adq" id="fecha_adq" placeholder="Fecha de Adquisición" required>
            </div>
            <div class="form-group">
                <input type="number" min="0" class="form-control" name="tiempodepre" id="tiempodepre" placeholder="Tiempo a depreciar (años)" required>
            </div>
            <div class="form-group">
                <input type="number" min="0" class="form-control" name="valorAdq" id="valorAdq" placeholder="Valor de Adquisicion" required>
            </div>
            <div class="form-group">
                <label >Fecha Inicio de Depreciación</label>
                <input type="date" class="form-control" name="fechaIni" id="fechaIni" placeholder="Fecha Inicio Depreciación" required>
            </div>

            <div class="form-group">
                <label >Ubicación</label>
                <select class="form-control" id="ubic" name="ubic" title="ubic" >
                    <?php
                    foreach ($data as $row) {
                        ?>

                        <option value="<?php echo $row['idUbicacion']; ?>">
                            <?php echo $row['Descripcion']; ?>
                        </option>


                        <?php
                    }
                    ?>
                </select>
            </div>

            <input type="hidden" class="form-control" name="reg_act" id="reg_act">
            <hr />
            
            <div class="form-group">
                <button type="submit" class="btn btn-default" name="btn-loginAct" id="btn-loginAct" value="" >
                    <span class="glyphicon glyphicon-log-in"></span> &nbsp; Registrar
                </button>
                <button type="reset" class="btn btn-default" name="btn-loginActReset" id="btn-loginActReset" value="" >
                    <span class="glyphicon glyphicon-erase"></span> &nbsp; Limpiar
                </button>
            </div>
        </form>
    </div>
    <div class="col-md-3 col-lg-3 col-sm-3 col-xs-1"></div>
</div>
