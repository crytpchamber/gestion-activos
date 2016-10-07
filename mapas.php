<?php
session_start();

if(!isset($_SESSION['user_session']))
{
    header("Location: index.php");
}

include_once 'conf/dbconn.php';


$stmt = $dbh->prepare("SELECT ma.idmapas_acceso, ma.Descripcion, ma.puedeEliminar, ma.puedeModificar, ma.puedeGuardar
                           FROM  mapas_acceso ma  ");
$stmt->execute();
//$data = $stmt->fetchALL();
$data=$stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<hr />

<div id="tablaMapas" class="table-responsive">
    <table summary="This table shows how to create responsive tables using Bootstrap's default functionality" class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>Mapa de Acceso</th>
            <th>Puede Modificar</th>
            <th>Puede Eliminar</th>
            <th>Puede Guardar</th>
            <th>Eliminar</th>
        </tr>
        </thead>
        <tbody>
        <?php

        foreach ($data as $row ) {
            echo "<tr>";
            echo "<td>" . $row['Descripcion']."</td><td> ";
            if ($row['puedeEliminar'] == 1) {
                echo "Si </td><td>";
            } else {
                echo "No </td><td>";
            }
            if ($row['puedeModificar'] == 1) {
                echo "Si </td><td>";
            } else {
                echo "No </td><td>";
            }
            if ($row['puedeGuardar'] == 1) {
                echo "Si </td><td>";
            } else {
                echo "No </td><td>";
            }
               //"<span class='glyphicon glyphicon-remove' id = '".$row['usuario']."'></span></td>";
            echo  "<button id='" .$row['idmapas_acceso']. "' type='button' class='btn btn-danger btn-sm glyphicon glyphicon-remove borrar4'></button></td>";
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
        <form method="post" id="registrar-mapa" class="form-horizontal">

            <div id="error4">
                <!-- error will be shown here ! -->
            </div>

            <div class="form-group">
                <input type="text" class="form-control" name="mapa" id="mapa" placeholder="Descripción" required>
            </div>

            <div class="form-group checkbox">
                <label class="checkbox-inline"><input id="eliminar" type="checkbox" value="">Puede Eliminar</label>
                <label class="checkbox-inline"><input id="modificar" type="checkbox" value="">Puede Modificar</label>
                <label class="checkbox-inline"><input id="guardar" type="checkbox" value="">Puede Guardar</label>
            </div>


            <input type="hidden" class="form-control" name="register" id="register">
            <hr />

            <div class="form-group">
                <button type="submit" class="btn btn-default" name="btn-login3" id="btn-login4"  >
                    <span class="glyphicon glyphicon-log-in"></span> &nbsp; Registrar
                </button>

            </div>
        </form>
    </div>
    <div class="col-md-3 col-lg-3 col-sm-3 col-xs-1"></div>
</div>
