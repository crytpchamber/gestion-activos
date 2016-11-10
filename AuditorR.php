<?php
session_start();

if(!isset($_SESSION['user_session']))
{
    header("Location: index.php");
}

include_once 'conf/dbconn.php';


$stmt = $dbh->prepare("SELECT * from pistasauditoria;");
$stmt->execute();
//$data = $stmt->fetchALL();
$data=$stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<hr />

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

