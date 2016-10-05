<?php
session_start();

if(!isset($_SESSION['user_session']))
{
    header("Location: index.php");
}

include_once 'conf/dbconn.php';


$stmt = $dbh->prepare("SELECT t.idActivos, t.Descripcion, t.fecha_adquisicion, t.tiempo_depre, t.valor_adquisicion, t.fecha_registro 
                           FROM activos t ");
$stmt->execute();
//$data = $stmt->fetchALL();
$data=$stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<hr />



<div id="tablaActivos" class="table-responsive">
    <table summary="This table shows how to create responsive tables using Bootstrap's default functionality" class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>Descripcion</th>
            <th>Fecha Adquisicion</th>
            <th>Tiempo de Depreciación</th>
            <th>Valor de Adquisicion</th>
            <th>Eliminar</th>
        </tr>
        </thead>
        <tbody>
        <?php

        foreach ($data as $row ) {
            echo "<tr>";
            echo "<td>" . $row['Descripcion'] . "</td><td>" . $row['fecha_adquisicion'] . "</td><td>" .
                 "<td>" . $row['tiempo_depre'] . "</td><td>" . $row['valor_adquisicion'] . "</td><td>" .
                 //"<span class='glyphicon glyphicon-remove' id = '".$row['usuario']."'></span></td>";
                "<button id='" .$row['idUbicacion']. "' type='button' class='btn btn-danger btn-sm glyphicon glyphicon-remove borrar2'></button></td>";
            echo "</tr>";
        }

        ?>
        </tbody>

    </table>
</div><!--end of .table-responsive-->

<hr />


<div class="row">
    <div class="col-md-3 col-lg-3 col-sm-3 col-xs-1"></div>
    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-10" >
        <form method="post" id="registrar-activo" class="form-horizontal">

            <div id="error2">
                <!-- error will be shown here ! -->
            </div>

            <div class="form-group">
                <input type="text" class="form-control" name="ubicacion" id="ubicacion" placeholder="Ubicacion" required>
            </div>


            <input type="hidden" class="form-control" name="register" id="register">
            <hr />
            
            <div class="form-group">
                <button type="submit" class="btn btn-default" name="btn-loginResp" id="btn-loginResp" value="" >
                    <span class="glyphicon glyphicon-log-in"></span> &nbsp; Registrar
                </button>

            </div>
        </form>
    </div>
    <div class="col-md-3 col-lg-3 col-sm-3 col-xs-1"></div>
</div>
