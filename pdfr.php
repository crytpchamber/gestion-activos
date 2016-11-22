
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
	<title>Reporte de responsables</title>
    
</head>
<body style="background-color:#F1F3FA;  border-radius: 25px;">
	<?php
session_start();

if(!isset($_SESSION['user_session']))
{
    header("Location: index.php");
}

include_once 'conf/dbconn.php';


$stmt = $dbh->prepare("SELECT resposable.idResposable,resposable.Nombre,resposable.Apellido,resposable.Cedula,ubicacion.Descripcion as ubicacion,sucursal.Descripcion as sucursal FROM resposable, ubicacion,sucursal where resposable.ubicacion_idUbicacion=ubicacion.idUbicacion and ubicacion.sucursal_idsucursal=sucursal.idsucursal");
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
            echo "<tr class='borderless '><th style=' text-align:right;' >Emitido Por:</th><td style='text-align:center;'> &nbsp;".$ro2['Nombre']." ".$ro2['Apellido']." (".$ro2['cargo'].") </td></tr>";
            echo "<tr class='borderless '><th style=' text-align:right;' >Cedula: </th><td style='text-align:center;'>".$ro2['Cedula']."</td></tr>";
            echo "<tr class='borderless '><th style=' text-align:right;' >Ubicacion: </th><td style='text-align:center;'>".$ro2['ubicacion']."</td></tr>";
            echo "<tr class='borderless '><th style=' text-align:right;' >Sucursal: </th><td style='text-align:center;'>".$ro2['sucursal']."</td></tr>";
        } ?>
        
    </table></div> 
<h1 align="center" >  Reporte de Responsables </h1>

<hr/>
    <table  class="table table-striped table-bordered"  style=" font-size: smaller;">
        
        <tr>
            <th align="center">ID</th>
            <th align="center">Nombre</th>
            <th align="center">Apellido</th>
            <th align="center">Cedula</th>
            <th align="center">Ubicacion</th>
            <th align="center">Sucursal</th>
                        <!-- <th>Eliminar</th> -->
        </tr>
        
        

        <?php
        foreach ($data as $row ) {
            echo "<tr>";
            echo "<td>" . $row['idResposable']."</td><td>".$row['Nombre'] . "</td><td>" . $row['Apellido'] . "</td>" .
                "<td>" . $row['Cedula'] . "</td>"."<td>" . $row['ubicacion']." </td><td>".$row['sucursal'] . "</td>" ;
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