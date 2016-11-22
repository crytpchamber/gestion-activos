   
<?php include_once 'conf/dbconn.php';
session_start();
$_SESSION['opcion']=$_GET['filtro'];
$_SESSION['referencia']=$_GET['tipo'];

$opcion=$_GET['filtro'];
$referencia=$_GET['tipo'];
if ($opcion=="Pactivo") {
    # code...
    if (isset($_GET['fecha1']) && isset($_GET['fecha2'])  && $_GET['fecha2']!="" && $_GET['fecha1']!="") {
    $Vfecha1=$_GET['fecha1'];
    $Vfecha2=$_GET['fecha2'];
     $_SESSION['Vfecha2']=$Vfecha2;
    $_SESSION['Vfecha1']=$Vfecha1;

$sql="select activos.Descripcion as activo ,activos.fecha_adquisicion ,resposable.Nombre ,resposable.Apellido,resposable.Cedula,ubicacion.Descripcion as ubicacion ,sucursal.Descripcion as sucursal  from relacionactivos,activos,resposable ,ubicacion ,sucursal  where relacionactivos.Activos_idActivos=activos.idActivos and relacionactivos.Resposable_idResposable=resposable.idResposable and resposable.ubicacion_idUbicacion=ubicacion.idUbicacion and ubicacion.sucursal_idsucursal=sucursal.idsucursal  and activos.fecha_adquisicion BETWEEN '$Vfecha1' AND '$Vfecha2' and activos.Descripcion='$referencia';";
}else{

$sql="select activos.Descripcion as activo ,activos.fecha_adquisicion ,resposable.Nombre ,resposable.Apellido,resposable.Cedula,ubicacion.Descripcion as ubicacion ,sucursal.Descripcion as sucursal  from relacionactivos,activos,resposable ,ubicacion ,sucursal  where relacionactivos.Activos_idActivos=activos.idActivos and relacionactivos.Resposable_idResposable=resposable.idResposable and resposable.ubicacion_idUbicacion=ubicacion.idUbicacion and ubicacion.sucursal_idsucursal=sucursal.idsucursal  and activos.Descripcion='$referencia';";
}

    

}elseif ($opcion=="Presponsable") {
    if (isset($_GET['fecha1']) && isset($_GET['fecha2']) && $_GET['fecha2']!="" && $_GET['fecha1']!="") {
    $Vfecha1=$_GET['fecha1'];
    $Vfecha2=$_GET['fecha2'];
     $_SESSION['Vfecha2']=$Vfecha2;
    $_SESSION['Vfecha1']=$Vfecha1;

$sql="select activos.Descripcion as activo ,activos.fecha_adquisicion ,resposable.Nombre ,resposable.Apellido,resposable.Cedula,ubicacion.Descripcion as ubicacion ,sucursal.Descripcion as sucursal from relacionactivos,activos,resposable ,ubicacion ,sucursal where relacionactivos.Activos_idActivos=activos.idActivos and relacionactivos.Resposable_idResposable=resposable.idResposable and resposable.ubicacion_idUbicacion=ubicacion.idUbicacion and ubicacion.sucursal_idsucursal=sucursal.idsucursal and activos.fecha_adquisicion BETWEEN '$Vfecha1' AND '$Vfecha2' and resposable.Cedula='$referencia';";
}else{

$sql="select activos.Descripcion as activo ,activos.fecha_adquisicion ,resposable.Nombre ,resposable.Apellido,resposable.Cedula,ubicacion.Descripcion as ubicacion ,sucursal.Descripcion as sucursal from relacionactivos,activos,resposable ,ubicacion ,sucursal where relacionactivos.Activos_idActivos=activos.idActivos and relacionactivos.Resposable_idResposable=resposable.idResposable and resposable.ubicacion_idUbicacion=ubicacion.idUbicacion and ubicacion.sucursal_idsucursal=sucursal.idsucursal and resposable.Cedula='$referencia';";
}

   
    # code...
}elseif ($opcion=="Pubicacion") {
    if (isset($_GET['fecha1']) && isset($_GET['fecha2'])  && $_GET['fecha2']!="" && $_GET['fecha1']!="") {
    $Vfecha1=$_GET['fecha1'];
    $Vfecha2=$_GET['fecha2'];
    $_SESSION['Vfecha2']=$Vfecha2;
    $_SESSION['Vfecha1']=$Vfecha1;

 $sql="select activos.Descripcion as activo ,activos.fecha_adquisicion ,resposable.Nombre ,resposable.Apellido,resposable.Cedula,ubicacion.Descripcion as ubicacion ,sucursal.Descripcion as sucursal from relacionactivos,activos,resposable ,ubicacion ,sucursal where relacionactivos.Activos_idActivos=activos.idActivos and relacionactivos.Resposable_idResposable=resposable.idResposable and resposable.ubicacion_idUbicacion=ubicacion.idUbicacion and ubicacion.sucursal_idsucursal=sucursal.idsucursal and activos.fecha_adquisicion BETWEEN '$Vfecha1' AND '$Vfecha2' and ubicacion.Descripcion='$referencia' ;";
}else{

 $sql="select activos.Descripcion as activo ,activos.fecha_adquisicion ,resposable.Nombre ,resposable.Apellido,resposable.Cedula,ubicacion.Descripcion as ubicacion ,sucursal.Descripcion as sucursal from relacionactivos,activos,resposable ,ubicacion ,sucursal where relacionactivos.Activos_idActivos=activos.idActivos and relacionactivos.Resposable_idResposable=resposable.idResposable and resposable.ubicacion_idUbicacion=ubicacion.idUbicacion and ubicacion.sucursal_idsucursal=sucursal.idsucursal and ubicacion.Descripcion='$referencia' ;";
}

    # code...
   
}elseif ($opcion=="Psucursal") {
    if (isset($_GET['fecha1']) && isset($_GET['fecha2'])  && $_GET['fecha2']!="" && $_GET['fecha1']!="") {
    $Vfecha1=$_GET['fecha1'];
    $Vfecha2=$_GET['fecha2'];
     $_SESSION['Vfecha2']=$Vfecha2;
    $_SESSION['Vfecha1']=$Vfecha1;

 $sql="select activos.Descripcion as activo ,activos.fecha_adquisicion ,resposable.Nombre ,resposable.Apellido,resposable.Cedula,ubicacion.Descripcion as ubicacion ,sucursal.Descripcion as sucursal from relacionactivos,activos,resposable ,ubicacion ,sucursal where relacionactivos.Activos_idActivos=activos.idActivos and relacionactivos.Resposable_idResposable=resposable.idResposable and resposable.ubicacion_idUbicacion=ubicacion.idUbicacion and ubicacion.sucursal_idsucursal=sucursal.idsucursal and activos.fecha_adquisicion BETWEEN '$Vfecha1' AND '$Vfecha2' and sucursal.Descripcion='$referencia';";
}else{

 $sql="select activos.Descripcion as activo ,activos.fecha_adquisicion ,resposable.Nombre ,resposable.Apellido,resposable.Cedula,ubicacion.Descripcion as ubicacion ,sucursal.Descripcion as sucursal from relacionactivos,activos,resposable ,ubicacion ,sucursal where relacionactivos.Activos_idActivos=activos.idActivos and relacionactivos.Resposable_idResposable=resposable.idResposable and resposable.ubicacion_idUbicacion=ubicacion.idUbicacion and ubicacion.sucursal_idsucursal=sucursal.idsucursal  and sucursal.Descripcion='$referencia';";
}

    # code...
   
}
$stmt2 = $dbh->prepare($sql);
$stmt2->execute();
//$data = $stmt->fetchALL();
$data2=$stmt2->fetchAll(PDO::FETCH_ASSOC);

 ?>
    <table summary="This table shows how to create responsive tables using Bootstrap's default functionality" class="table table-bordered table-hover">
        
        <tr>
            <th>Activo</th>
            <th>Fecha de adquisicion</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Cedula</th>
            <th>Ubicacion</th>
            <th>Sucursal</th>
            <!-- <th>Eliminar</th> -->
        </tr>
        
        
        <?php

        foreach ($data2 as $row2 ) {
            
            echo "<tr>";
            echo "<td>" . $row2['activo']."</td><td>".$row2['fecha_adquisicion'] . "</td><td>" . $row2['Nombre'] . "</td>" .
                "<td>" . $row2['Apellido'] . "</td>"."<td>" . $row2['Cedula']." </td><td>".$row2['ubicacion'] . "</td><td>" . $row2['sucursal'] . "</td>"  ;
                //"<span class='glyphicon glyphicon-remove' id = '".$row['usuario']."'></span></td>";
               // "<button id='" .$row['idResposable']. "' type='button' class='btn btn-danger btn-sm glyphicon glyphicon-remove borrarResp'></button></td>";
            echo "</tr>";
        }

        ?>
        

    </table>
   