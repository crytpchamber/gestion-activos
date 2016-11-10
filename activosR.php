<?php
session_start();

if(!isset($_SESSION['user_session']))
{
    header("Location: index.php");
}

include_once 'conf/dbconn.php';


$stmt = $dbh->prepare("SELECT * from activos ;");
$stmt->execute();
//$data = $stmt->fetchALL();
$data=$stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<hr />

<div id="tablaResponsable" class="table-responsive">
    <table summary="This table shows how to create responsive tables using Bootstrap's default functionality" class="table table-bordered table-hover">
        
        <tr>
            <th>ID</th>
            <th>Descripcion</th>
            <th>Fecha de adquisicion</th>
            <th>Tiempo de depreciacion</th>
            <th>Valor de adquisicion</th>
            <th>Fecha de registro </th>
            <th>Fecha de inicio de depreciacion</th>
            <!-- <th>Eliminar</th> -->
        </tr>
        
        
        <?php

        foreach ($data as $row ) {
            echo "<tr>";
            echo "<td>" . $row['idActivos']."</td><td>".$row['Descripcion'] . "</td><td>" . $row['fecha_adquisicion'] . "</td>" .
                "<td>" . $row['tiempo_depre'] . "</td>"."<td>" . $row['valor_adquisicion']." </td><td>".$row['fecha_registro'] . "</td><td>" . $row['fecha_ini_deprec'] . "</td>"  ;
                //"<span class='glyphicon glyphicon-remove' id = '".$row['usuario']."'></span></td>";
               // "<button id='" .$row['idResposable']. "' type='button' class='btn btn-danger btn-sm glyphicon glyphicon-remove borrarResp'></button></td>";
            echo "</tr>";
        }

        ?>
        

    </table>
</div><!--end of .table-responsive-->

