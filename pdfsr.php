
<!DOCTYPE html> 
<html lang="en">
<head>
	<meta charset="UTF-8">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
	<title>Asignaciones por responsables</title>
    
</head>
<body style="background-color:#F1F3FA;  border-radius: 25px;">

	<?php
session_start();

if(!isset($_SESSION['user_session']))
{
    header("Location: index.php");
}

include_once 'conf/dbconn.php';

$opcion=$_SESSION['opcion'];
$referencia=$_SESSION['referencia'];

 if (isset($_SESSION['Vfecha2']) && isset($_SESSION['Vfecha1']) && $_SESSION['Vfecha2']!="" && $_SESSION['Vfecha1']!="") {
    $Vfecha1=$_SESSION['Vfecha1'];
    $Vfecha2=$_SESSION['Vfecha2'];



$stmt = $dbh->prepare("select activos.Descripcion as activo ,activos.fecha_adquisicion ,resposable.Nombre ,resposable.Apellido,resposable.Cedula,ubicacion.Descripcion as ubicacion ,sucursal.Descripcion as sucursal from relacionactivos,activos,resposable ,ubicacion ,sucursal where relacionactivos.Activos_idActivos=activos.idActivos and relacionactivos.Resposable_idResposable=resposable.idResposable and resposable.ubicacion_idUbicacion=ubicacion.idUbicacion and ubicacion.sucursal_idsucursal=sucursal.idsucursal and activos.fecha_adquisicion BETWEEN '$Vfecha1' AND '$Vfecha2' and activos.estado='A' and resposable.Cedula='$referencia'; ");
}else{


$stmt = $dbh->prepare("select activos.Descripcion as activo ,activos.fecha_adquisicion ,resposable.Nombre ,resposable.Apellido,resposable.Cedula,ubicacion.Descripcion as ubicacion ,sucursal.Descripcion as sucursal from relacionactivos,activos,resposable ,ubicacion ,sucursal where relacionactivos.Activos_idActivos=activos.idActivos and relacionactivos.Resposable_idResposable=resposable.idResposable and resposable.ubicacion_idUbicacion=ubicacion.idUbicacion and ubicacion.sucursal_idsucursal=sucursal.idsucursal and activos.estado='A' and resposable.Cedula='$referencia'; ");
}


$stmt->execute();
//$data = $stmt->fetchALL();
$data=$stmt->fetchAll(PDO::FETCH_ASSOC);
//datos del emisor

$idusuario=$_SESSION['user_session'];

$stmt = $dbh->prepare("select usuarios.Nombre,usuarios.Apellido,usuarios.Cedula,ubicacion.Descripcion as ubicacion ,sucursal.Descripcion as sucursal,tipo_usuario.descripcion as cargo from usuarios,ubicacion,sucursal,tipo_usuario,modulos WHERE usuarios.idUsuarios='$idusuario' and usuarios.Tipo_Usuario_idTipo_Usuario=tipo_usuario.idTipo_Usuario and tipo_usuario.modulos_idmodulos=modulos.idmodulos AND modulos.ubicacion=ubicacion.idUbicacion AND ubicacion.sucursal_idsucursal=sucursal.idsucursal;");

$stmt->execute();
//$data = $stmt->fetchALL();
$data2=$stmt->fetchAll(PDO::FETCH_ASSOC);
//fin de datos del emisor


?>
   <br><br>
<div class="container">
<div id="tablaResponsable" class="table-responsive table-condensed ">
<span ><img align="left" style="
    width: 25%;
" src="imgs/catemar.png" ></span><div style="margin-left:22%;" class="container col-lg-4 col-md-4"><table style="margin-left:100px;" class=" ">
        
        <?php foreach ($data2 as $ro2 ) {
             $_SESSION['NR']=$ro2['Nombre']." ".$ro2['Apellido'];
            echo "<tr class='borderless '><th style=' text-align:right;' >Emitido Por:</th><td style='text-align:center;'> &nbsp;".$ro2['Nombre']." ".$ro2['Apellido']." (".$ro2['cargo'].") </td></tr>";
            echo "<tr class='borderless '><th style=' text-align:right;' >Cedula: </th><td style='text-align:center;'>".$ro2['Cedula']."</td></tr>";
            echo "<tr class='borderless '><th style=' text-align:right;' >Ubicacion: </th><td style='text-align:center;'>".$ro2['ubicacion']."</td></tr>";
            echo "<tr class='borderless '><th style=' text-align:right;' >Sucursal: </th><td style='text-align:center;'>".$ro2['sucursal']."</td></tr>";
        } ?>
        
    </table></div> 
<h1 align="center" >  Reporte de asignaciones </h1>

<hr/>
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

        foreach ($data as $row2 ) {
            echo "<tr>";
            echo "<td>" . $row2['activo']."</td><td>".$row2['fecha_adquisicion'] . "</td><td>" . $row2['Nombre'] . "</td>" .
                "<td>" . $row2['Apellido'] . "</td>"."<td>" . $row2['Cedula']." </td><td>".$row2['ubicacion'] . "</td><td>" . $row2['sucursal'] . "</td>"  ;
                //"<span class='glyphicon glyphicon-remove' id = '".$row['usuario']."'></span></td>";
               // "<button id='" .$row['idResposable']. "' type='button' class='btn btn-danger btn-sm glyphicon glyphicon-remove borrarResp'></button></td>";
            echo "</tr>";
        }

        ?>
        

    </table>
</div><!--end of .table-responsive-->
</div>

 <script type="text/php">


        if ( isset($pdf) ) {


          
          $pdf->page_text(550, 770, "Pagina: {PAGE_NUM} de {PAGE_COUNT}", "bold", 6, array(0,0,0));
          $pdf->page_text(50, 760, "     Fecha :        ".date("d-m-y") , "bold", 6, array(0,0,0));   
          $pdf->page_text(50, 770, "      Hora  :        ".date("H:m:s") , "bold", 6, array(0,0,0)); 
          
          $pdf->page_text(45, 780, "Emitido Por:   ".$_SESSION['NR']." ".$_SESSION['AR'] , "bold", 6, array(0,0,0)); 
          

        }
        </script> 

</body>
</html>