<?php
session_start();

if(!isset($_SESSION['user_session']))
{
    header("Location: index.php");
}

include_once 'conf/dbconn.php';

if (isset($_GET['fecha1']) && isset($_GET['fecha2'])) {
    $Vfecha1=$_GET['fecha1'];
    $Vfecha2=$_GET['fecha2'];
$stmt = $dbh->prepare("SELECT * from activos WHERE fecha_adquisicion BETWEEN '$Vfecha1' AND '$Vfecha2' ;");
}else{

$stmt = $dbh->prepare("SELECT * from activos ;");
}

$stmt->execute();
//$data = $stmt->fetchALL();
$data=$stmt->fetchAll(PDO::FETCH_ASSOC);

 
?>
<hr />
<div class="form-group">



    
     
      
        

       
              <table align="center">
              <tr  >           <th colspan="2"  style="text-align:center; padding:10px;  padding-right:0px !important;"><span style="margin-left:65%;">Rango de fecha</span></th>   

</tr>

           <tr  >  
           
<td width='25%' ><input  style="margin-left:80%;" class='form-control' type='date'  class='fechaadq' name="fecharango1" id='fecharango1' ></td>
<td width='25%' ><input style="margin-left:80%;" class='form-control' type='date'  class='fechaadq' name="fecharango2" id='fecharango2' ></td>
<td> <a style="margin-left:40%;" href="javascript:void(0);" class="btn btn-default"  id="btn-opbuscador9">
                    <span  class="glyphicon glyphicon-log-in"></span> &nbsp; Buscar
                </a></td>
                </tr>
                </table><br>
                 
           </div>
           

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




    
<script type="text/javascript" src="js/script.js"></script>