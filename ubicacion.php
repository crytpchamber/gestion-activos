<?php
session_start();

if(!isset($_SESSION['user_session']))
{
    header("Location: index.php");
}

include_once 'conf/dbconn.php';


$stmt = $dbh->prepare("SELECT t.idUbicacion, t.Descripcion, t.sucursal_idsucursal, m.Descripcion as Sucursal 
                           FROM ubicacion t inner join sucursal m 
                           on m.idsucursal = t.sucursal_idsucursal ");
$stmt->execute();
//$data = $stmt->fetchALL();
$data=$stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<hr />



<div id="tablaUbicacion" class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>Ubicacion</th>
            <th>Sucursal</th>
           <!-- <th>Eliminar</th> -->
        </tr>
        </thead>
        <tbody>
        <?php

        foreach ($data as $row ) {
            echo "<tr>";
            echo "<td>" . $row['Descripcion'] . "</td><td>" . $row['Sucursal'] . "</td>" ;
                //"<span class='glyphicon glyphicon-remove' id = '".$row['usuario']."'></span></td>";
               // "<button id='" .$row['idUbicacion']. "' type='button' class='btn btn-danger btn-sm glyphicon glyphicon-remove borrarUbic'></button></td>";
            echo "</tr>";
        }

        ?>
        </tbody>

    </table>
</div><!--end of .table-responsive-->

<hr />

<?php
$stmt = $dbh->prepare("SELECT m.idsucursal, m.Descripcion 
                           FROM  sucursal m  ");
$stmt->execute();
//$data = $stmt->fetchALL();
$data=$stmt->fetchAll(PDO::FETCH_ASSOC);


?>
<div class="row">
    <div class="col-md-3 col-lg-3 col-sm-3 col-xs-1"></div>
    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-10" >
        <form method="post" id="registrar-ubicacion" class="form-horizontal">

            <div id="errorUbic">
                <!-- error will be shown here ! -->
            </div>

            <div class="form-group">
                <input type="text" class="form-control" name="ubicacion" id="ubicacion" placeholder="Ubicacion" required>
            </div>


            <div class="form-group">
                <select class="form-control" id="sucursal" name="sucursal" required>
                    <?php
                    foreach ($data as $row) {
                        ?>

                        <option value="<?php echo $row['idsucursal']; ?>">
                            <?php echo $row['Descripcion']; ?>
                        </option>


                        <?php
                    }
                    ?>
                </select>
            </div>


            <input type="hidden" class="form-control" name="reg_ubic" id="reg_ubic">
            <hr />
            
            <div class="form-group">
                <button type="submit" class="btn btn-default" name="btn-loginUbic" id="btn-loginUbic" value="" >
                    <span class="glyphicon glyphicon-log-in"></span> &nbsp; Registrar
                </button>

            </div>
        </form>
    </div>
    <div class="col-md-3 col-lg-3 col-sm-3 col-xs-1"></div>
</div>
