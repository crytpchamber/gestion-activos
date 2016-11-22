 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
    <title>Reporte de activos</title>
   
</head>
<body style="background-color:#F1F3FA;  border-radius: 25px;">
    <?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);

if(!isset($_SESSION['user_session']))
{
    header("Location: index.php");
}

include_once 'conf/dbconn.php';


$stmt = $dbh->prepare("SELECT * from activos ;");
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
<h1 align="center" >  Reporte de activos </h1>

<hr/>
    <table  class="table table-striped table-bordered"  style=" font-size: 50%;">
        
        <tr>
            <th align="center">ID</th>
            <th align="center">Descripcion</th>
            <th align="center">Inicio de depreciacion</th>
            <th align="center">Ene</th>
            <th align="center">Feb</th>
            <th align="center">Mar</th>
            <th align="center">Abr</th>
            <th align="center">May</th>
            <th align="center">Jun</th>
            <th align="center">Jul</th>
            <th align="center">Ago</th>
            <th align="center">Sep</th>
            <th align="center">Oct</th>
            <th align="center">Nov</th>
            <th align="center">Dic</th>
             <?php
        foreach ($data as $row ) {
        $fechainidada=explode("-",$row['fecha_ini_deprec']);
        $meses=$row['tiempo_depre']*12;
        $LocalM=date("m");
        $LocalY=date("Y");
        $acum=$LocalY-$fechainidada[0];
        $acummes=$acum*12;
           /* for ($i=1;$i<=$LocalM;$i++){
                echo "<th>".$i."-".$LocalY."</th>";

            }*/
        }
        ?>
            <!-- <th>Eliminar</th> -->
        </tr>
        
        

        <?php
        foreach ($data as $row ) {


            $fechainidada=explode("-",$row['fecha_ini_deprec']);
        $meses=$row['tiempo_depre']*12;
        $LocalM=date("m");
        $LocalY=date("Y");
        $acum=$LocalY-$fechainidada[0];
        $acummes=$acum*12;
        
        $Vdepreciable=$row['valor_adquisicion'];
        $meses=$row['tiempo_depre']*12;
        $VPM=$Vdepreciable/$meses;
        $VPMF=number_format($VPM,2,'.',',');
        $negativo=$acummes*$VPMF;
        $primervalor=$row['valor_adquisicion']-$negativo;
        $rest=0;
            echo "<tr>";
            echo "<td>" . $row['idActivos']."</td><td>".$row['Descripcion'] ."</td><td>".$row['fecha_ini_deprec'] ."</td>";
            for ($i=1;$i<=$LocalM;$i++){
                echo "<td align='center'>";
                if ($fechainidada[0]==$LocalY && $fechainidada[1]>$i) {
                    echo "Null";
                }else{

                echo ($primervalor-$rest);
                echo "</td>";
                $rest+=$VPMF;
                }

            }
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