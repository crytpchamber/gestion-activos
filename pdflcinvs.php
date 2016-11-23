 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
    <title>Reporte de Inventario</title>
   
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




$stmt = $dbh->prepare("select activos.estado,categorias.Descripcion as categoria,subcategoria.Descripcion as subcategoria ,activos.Descripcion as activo, activos.fecha_adquisicion ,activos.serial,activos.valor_adquisicion,ubicacion.Descripcion as ubicacion , sucursal.Descripcion as sucursal from activos,ubicacion,sucursal,categorias,subcategoria WHERE activos.ubicacion_idUbicacion=ubicacion.idUbicacion and ubicacion.sucursal_idsucursal=sucursal.idsucursal and activos.idSubCategoria=subcategoria.idSubCategoria and activos.fecha_adquisicion BETWEEN '$Vfecha1' AND '$Vfecha2' AND subcategoria.idCategoria=categorias.idCategoria and sucursal.Descripcion='$referencia';");
}else{

$stmt = $dbh->prepare("select activos.estado,categorias.Descripcion as categoria,subcategoria.Descripcion as subcategoria ,activos.Descripcion as activo, activos.fecha_adquisicion ,activos.serial,activos.valor_adquisicion,ubicacion.Descripcion as ubicacion , sucursal.Descripcion as sucursal from activos,ubicacion,sucursal,categorias,subcategoria WHERE activos.ubicacion_idUbicacion=ubicacion.idUbicacion and ubicacion.sucursal_idsucursal=sucursal.idsucursal and activos.idSubCategoria=subcategoria.idSubCategoria AND subcategoria.idCategoria=categorias.idCategoria and sucursal.Descripcion='$referencia';");
}


$stmt->execute();
//$data = $stmt->fetchALL();
$data=$stmt->fetchAll(PDO::FETCH_ASSOC);

//datos del emisor

$idusuario=$_SESSION['user_session'];

$stmt = $dbh->prepare("select usuarios.Nombre,usuarios.Apellido,usuarios.Cedula,ubicacion.Descripcion as ubicacion ,sucursal.Descripcion as sucursal,tipo_usuario.descripcion as cargo from usuarios,ubicacion,sucursal,tipo_usuario,modulos WHERE usuarios.idUsuarios='$idusuario' and usuarios.Tipo_Usuario_idTipo_Usuario=tipo_usuario.idTipo_Usuario and tipo_usuario.modulos_idmodulos=modulos.idmodulos AND modulos.ubicacion=ubicacion.idUbicacion AND ubicacion.sucursal_idsucursal=sucursal.idsucursal; ");

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
<h1 align="center" >  Cotejo de Inventario </h1>

<hr/>
    <table  class="table table-striped table-bordered"  style=" font-size: 60%; ">
        
        <tr>
            
            <th align="center">Categoría</th>
            <th align="center">Sub-Categoría</th>
            <th align="center">Activo</th>
            <th align="center">Fecha de Adquisición</th>
            <th align="center">Serial</th>
            <th align="center">Estado</th>
            <th align="center">Valor</th>
            <th align="center">Ubicación</th>
            <th align="center">Sucursal</th>
            <th align="center">Estado</th>
            <!-- <th>Eliminar</th> -->
        </tr>
        
        

        <?php
        foreach ($data as $row ) {
          echo "<tr>";
            echo "<td>" . $row['categoria']."</td><td>".$row['subcategoria'] . "</td><td>" . $row['activo'] . "</td>" .
                "<td>" . $row['fecha_adquisicion'] . "</td>"."<td>" . $row['serial']." </td>"."<td>" . $row['estado']." </td><td>".$row['valor_adquisicion'] . "</td><td>" . $row['ubicacion'] . "</td>"  ;
              echo "<td>" . $row['sucursal']."</td>";  
               echo "<td>A<span ><img align='center' style='width: 100%;' src='imgs/check.png' ></span><br>D<span ><img align='center' style='width: 100%;' src='imgs/check.png' ></span><br>M<span ><img align='center' style='width: 100%;' src='imgs/check.png' ></span></td>";  
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