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
    $_SESSION['fecha1']=$Vfecha1;
        $_SESSION['fecha2']=$Vfecha2;

$stmt = $dbh->prepare("SELECT * from pistasauditoria WHERE fechaPista BETWEEN '$Vfecha1' AND '$Vfecha2' ;");
}else{

$stmt = $dbh->prepare("SELECT * from pistasauditoria ;");
}

$stmt->execute();
//$data = $stmt->fetchALL();
$data=$stmt->fetchAll(PDO::FETCH_ASSOC);


?>


<hr />
<div class="form-group">



    
     
      
        

       
              <table align="center">
              <tr  >           <th colspan="2"  style="text-align:center; padding:10px;  padding-right:0px !important;"><span >Rango de Fecha</span></th>

</tr>

           <tr  >  
           
<td   ><input  class='form-control' type='date'  class='fechaadq' name="fecharango1" id='fecharango1' ></td>
<td  ><input  class='form-control' type='date'  class='fechaadq' name="fecharango2" id='fecharango2' ></td>
<td> <a style="margin-left:40%;" href="javascript:void(0);" class="btn btn-default"  id="btn-opbuscador99">
                    <span  class="glyphicon glyphicon-log-in"></span> &nbsp; Buscar
                </a></td>
                </tr>
                </table><br>
                 
           </div>
           <br>
<hr />
<div id="tablaResponsable" class="table-responsive">
    <table summary="This table shows how to create responsive tables using Bootstrap's default functionality" class="table table-bordered table-hover">
        
        <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Tipo de Operación</th>
            <th>Módulo</th>
            <th>Observación</th>
            <th>Usuario</th>
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

<script type="text/javascript" src="js/script.js"></script>