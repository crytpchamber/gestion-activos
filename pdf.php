
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
	<title>Reporte general de activos</title>
     <style>
      @media print { .footer { page-break-after: always !important; }}
      
      .footer { position: absolute; bottom: 0px; }
      .pagenum:before { content: counter(page); }
    </style>
</head>
<body style="background-color:#F1F3FA;  border-radius: 25px;">
	<?php
include "pdf1.php";



if(!isset($_SESSION['user_session']))
{
    header("Location: index.php");
}

include_once 'conf/dbconn.php';

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
" src="imgs/catemar.png" > </span><div style="margin-left:22%;" class="container col-lg-4 col-md-4"><table style="margin-left:100px;" class=" ">
        <tr><th style="text-align:right;" >Fecha :</th><td style="text-align:center;"><?=date("d-m-y");?>&nbsp;&nbsp;&nbsp;<span style="font-weight:bold;">Hora :</span>&nbsp;    <?=date("H:m:s");?>  </td></tr>
        <?php foreach ($data2 as $ro2 ) {
            echo "<tr class='borderless '><th style=' text-align:right;' >Emitido Por:</th><td style='text-align:center;'> &nbsp;".$ro2['Nombre']." ".$ro2['Apellido']." (".$ro2['cargo'].") </td></tr>";
            echo "<tr class='borderless '><th style=' text-align:right;' >Cedula: </th><td style='text-align:center;'>".$ro2['Cedula']."</td></tr>";
            echo "<tr class='borderless '><th style=' text-align:right;' >Ubicacion: </th><td style='text-align:center;'>".$ro2['ubicacion']."</td></tr>";
            echo "<tr class='borderless '><th style=' text-align:right;' >Sucursal: </th><td style='text-align:center;'>".$ro2['sucursal']."</td></tr>";
        } ?>
        
    </table></div> 
<h1 align="center" >  Reporte de activos </h1>
    
<hr/>
    <table  class="table table-striped table-bordered"  style=" font-size: smaller;">
        
        <tr>
            <th align="center">Activo</th>
            <th align="center">Fecha de adquisicion</th>
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
        
            echo "<td style=' vertical-align: middle ;' >" . $row['activo']."</td><td align='center' style=' vertical-align: middle ;'>".$row['fecha_adquisicion'] . "</td><td align='center' style=' vertical-align: middle ;'>" . $row['Nombre'] . "</td>" .
                "<td align='center' style=' vertical-align: middle ;'>" . $row['Apellido'] . "</td>"."<td align='center' style=' vertical-align: middle ;'>" . $row['Cedula']." </td><td align='center' style=' vertical-align: middle ;' >".$row['ubicacion'] . "</td><td style=' vertical-align: middle ;' >" . $row['sucursal'] . "</td>"  ;
                //"<span class='glyphicon glyphicon-remove' id = '".$row['usuario']."'></span></td>";
               // "<button id='" .$row['idResposable']. "' type='button' class='btn btn-danger btn-sm glyphicon glyphicon-remove borrarResp'></button></td>";
            echo "</tr>";
        }

        ?>
        

    </table>
</div><!--end of .table-responsive-->
</div>


<div class="footer" >Page:<span  class="pagenum"></span></div>



</body>

<!--<script type="text/javascript" src="js/jquery-3.1.1.js"></script>
<script>
    $(document).ready(function($){
    var ventana_ancho = $(document).width();
    var ventana_alto = $(document).height();
    var divisoresf=ventana_alto / 700;
    var divisores=parseInt(divisoresf);
    for (var i = 1; i <= divisores; i++) {
        divisores[i]
   // $( ".inner" ).append( "<div style='top:"+700*i+"px;' class='footer'>Page: <span class='pagenum'></span></div>" );
    }
    alert(divisores);
});
</script>-->
</html>