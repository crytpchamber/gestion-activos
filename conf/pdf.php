<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Pdf de reporte</title>
</head>
<body>
	<?php
include "pdf1.php";
?>

<hr />

<div id="tablaResponsable" class="table-responsive">
    <table  class="table table-bordered table-hover">
        
        <tr>
            <td>Activo</td>
            <td>Fecha de adquisicion</td>
            <td>Nombre</td>
            <td>Apellido</td>
            <td>Cedula</td>
            <td>Ubicacion</td>
            <td>Sucursal</td>
            <!-- <th>Eliminar</th> -->
        </tr>
        
        
        <?php

        foreach ($data as $row ) {
            echo "<tr>";
            echo "<td>" . $row['activo']."</td><td>".$row['fecha_adquisicion'] . "</td><td>" . $row['Nombre'] . "</td>" .
                "<td>" . $row['Apellido'] . "</td>"."<td>" . $row['Cedula']." </td><td>".$row['ubicacion'] . "</td><td>" . $row['sucursal'] . "</td>"  ;
                //"<span class='glyphicon glyphicon-remove' id = '".$row['usuario']."'></span></td>";
               // "<button id='" .$row['idResposable']. "' type='button' class='btn btn-danger btn-sm glyphicon glyphicon-remove borrarResp'></button></td>";
            echo "</tr>";
        }

        ?>
        

    </table>
</div><!--end of .table-responsive-->


</body>
</html>