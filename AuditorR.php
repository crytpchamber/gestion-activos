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
$stmt = $dbh->prepare("SELECT * from pistasauditoria WHERE fecha_adquisicion BETWEEN '$Vfecha1' AND '$Vfecha2' ;");
}else{

$stmt = $dbh->prepare("SELECT * from pistasauditoria ;");
}

$stmt->execute();
//$data = $stmt->fetchALL();
$data=$stmt->fetchAll(PDO::FETCH_ASSOC);


?>


<hr />
<!--<div class="form-group">



    
     
      
        

       
              <table align="center">
              <tr  >           <th colspan="2"  style="text-align:center; padding:10px;  padding-right:0px !important;"><span style="margin-left:65%;">Rango de fecha</span></th>   

</tr>

           <tr  >  
           
<td width='25%'  ><input  style="margin-left:80%;" class='form-control' type='date'  class='fechaadq' name="fecharango1" id='fecharango1' ></td>
<td width='25%' ><input style="margin-left:80%;" class='form-control' type='date'  class='fechaadq' name="fecharango2" id='fecharango2' ></td>
<td> <a style="margin-left:40%;" href="javascript:void(0);" class="btn btn-default"  id="btn-opbuscador19">
                    <span  class="glyphicon glyphicon-log-in"></span> &nbsp; Buscar
                </a></td>
                </tr>
                </table><br>
                 
           </div>-->
           <br>

<div id="tablaResponsable" class="table-responsive">
    <table summary="This table shows how to create responsive tables using Bootstrap's default functionality" class="table table-bordered table-hover">
        
        <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>tipo de operacion</th>
            <th>modulo</th>
            <th>observacion</th>
            <th>usuario</th>
            <!-- <th>Eliminar</th> -->
        </tr>
        
        
        <?php

        foreach ($data as $row ) {
            echo "<tr>";
            echo "<td>" . $row['idpistasAuditoria']."</td><td>".$row['fechaPista'] . "</td>"  ;
            echo "<td>" . $row['tipo_operacion']."</td><td>".$row['modulo'] . "</td>"  ;
            echo "<td>" . $row['observacion']."</td><td>".$row['usuario'] . "</td>"  ;
            echo "</tr>";
        }

        ?>
        

    </table>
</div><!--end of .table-responsive-->

