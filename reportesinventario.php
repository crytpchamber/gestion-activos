   
<?php include_once 'conf/dbconn.php';
session_start();
$_SESSION['opcion']=$_GET['filtro'];
$_SESSION['referencia']=$_GET['tipo'];

$opcion=$_GET['filtro'];
$referencia=$_GET['tipo'];
if ($opcion=="Pcategoria") {
    # code...
    $sql="select categorias.Descripcion as categoria,subcategoria.Descripcion as subcategoria ,activos.Descripcion as activo, activos.fecha_adquisicion ,activos.serial,activos.valor_adquisicion,ubicacion.Descripcion as ubicacion , sucursal.Descripcion as sucursal from activos,ubicacion,sucursal,categorias,subcategoria WHERE activos.ubicacion_idUbicacion=ubicacion.idUbicacion and ubicacion.sucursal_idsucursal=sucursal.idsucursal and activos.idSubCategoria=subcategoria.idSubCategoria AND subcategoria.idCategoria=categorias.idCategoria and categorias.Descripcion='$referencia';";

}elseif ($opcion=="Psubcategoria") {
    $sql="select categorias.Descripcion as categoria,subcategoria.Descripcion as subcategoria ,activos.Descripcion as activo, activos.fecha_adquisicion ,activos.serial,activos.valor_adquisicion,ubicacion.Descripcion as ubicacion , sucursal.Descripcion as sucursal from activos,ubicacion,sucursal,categorias,subcategoria WHERE activos.ubicacion_idUbicacion=ubicacion.idUbicacion and ubicacion.sucursal_idsucursal=sucursal.idsucursal and activos.idSubCategoria=subcategoria.idSubCategoria AND subcategoria.idCategoria=categorias.idCategoria and subcategoria.Descripcion='$referencia';";
    # code...
}elseif ($opcion=="Pubicacion") {
    # code...
    $sql="select categorias.Descripcion as categoria,subcategoria.Descripcion as subcategoria ,activos.Descripcion as activo, activos.fecha_adquisicion ,activos.serial,activos.valor_adquisicion,ubicacion.Descripcion as ubicacion , sucursal.Descripcion as sucursal from activos,ubicacion,sucursal,categorias,subcategoria WHERE activos.ubicacion_idUbicacion=ubicacion.idUbicacion and ubicacion.sucursal_idsucursal=sucursal.idsucursal and activos.idSubCategoria=subcategoria.idSubCategoria AND subcategoria.idCategoria=categorias.idCategoria and ubicacion.Descripcion='$referencia' ;";
}elseif ($opcion=="Psucursal") {
    # code...
    $sql="select categorias.Descripcion as categoria,subcategoria.Descripcion as subcategoria ,activos.Descripcion as activo, activos.fecha_adquisicion ,activos.serial,activos.valor_adquisicion,ubicacion.Descripcion as ubicacion , sucursal.Descripcion as sucursal from activos,ubicacion,sucursal,categorias,subcategoria WHERE activos.ubicacion_idUbicacion=ubicacion.idUbicacion and ubicacion.sucursal_idsucursal=sucursal.idsucursal and activos.idSubCategoria=subcategoria.idSubCategoria AND subcategoria.idCategoria=categorias.idCategoria and sucursal.Descripcion='$referencia';";
}
$stmt2 = $dbh->prepare($sql);
$stmt2->execute();
//$data = $stmt->fetchALL();
$data2=$stmt2->fetchAll(PDO::FETCH_ASSOC);

 ?>
    <table summary="This table shows how to create responsive tables using Bootstrap's default functionality" class="table table-bordered table-hover">
        
        <tr>
            <th>Categoria</th>
            <th>SubCategoria</th>
            <th>Activo</th>
            <th>Fecha de adquisicion</th>
            <th>Serial</th>
            <th>Valor</th>
            <th>Ubicacion</th>
            <th>Sucursal</th>
            <!-- <th>Eliminar</th> -->
        </tr>
        
        
        <?php

        foreach ($data2 as $row2 ) {
            
             echo "<tr>";
            echo "<td>" . $row2['categoria']."</td><td>".$row2['subcategoria'] . "</td><td>" . $row2['activo'] . "</td>" .
                "<td>" . $row2['fecha_adquisicion'] . "</td>"."<td>" . $row2['serial']." </td><td>".$row2['valor_adquisicion'] . "</td><td>" . $row2['ubicacion'] . "</td>"  ;
              echo "<td>" . $row2['sucursal']."</td>";  
            echo "</tr>";
        }

        ?>
        

    </table>
   