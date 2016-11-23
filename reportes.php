<?php
session_start();

if(!isset($_SESSION['user_session']))
{
    header("Location: index.php");
}

include_once 'conf/dbconn.php';


$stmt = $dbh->prepare("SELECT activos.Descripcion as activo ,activos.fecha_adquisicion ,resposable.Nombre ,resposable.Apellido,resposable.Cedula,ubicacion.Descripcion as ubicacion ,sucursal.Descripcion as sucursal " .
                           " FROM relacionactivos,activos,resposable ,ubicacion ,sucursal " .
                           " where relacionactivos.Activos_idActivos=activos.idActivos and relacionactivos.Resposable_idResposable=resposable.idResposable and resposable.ubicacion_idUbicacion=ubicacion.idUbicacion and ubicacion.sucursal_idsucursal=sucursal.idsucursal ");
$stmt->execute();
//$data = $stmt->fetchALL();
$data=$stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<hr />
<!--
<div id="tablaResponsable" class="table-responsive">
    <table summary="This table shows how to create responsive tables using Bootstrap's default functionality" class="table table-bordered table-hover">
        
        <tr>
            <th>Activo</th>
            <th>Fecha de adquisicion</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Cedula</th>
            <th>Ubicacion</th>
            <th>Sucursal</th>
          <th>Eliminar</th>
        </tr>
        
    -->
        <?php

        /*foreach ($data as $row ) {
            echo "<tr>";
            echo "<td>" . $row['activo']."</td><td>".$row['fecha_adquisicion'] . "</td><td>" . $row['Nombre'] . "</td>" .
                "<td>" . $row['Apellido'] . "</td>"."<td>" . $row['Cedula']." </td><td>".$row['ubicacion'] . "</td><td>" . $row['sucursal'] . "</td>"  ;
                //"<span class='glyphicon glyphicon-remove' id = '".$row['usuario']."'></span></td>";
               // "<button id='" .$row['idResposable']. "' type='button' class='btn btn-danger btn-sm glyphicon glyphicon-remove borrarResp'></button></td>";
            echo "</tr>";
        }*/

        ?>
        

 <!--   </table>
</div><!--end of .table-responsive-->

