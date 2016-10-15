<?php
session_start();

if(!isset($_SESSION['user_session']))
{
    header("Location: index.php");
}
include_once 'conf/dbconn.php';
if ($_SESSION['guardar']=='0') {
    echo "error";
} else {



    $stmt = $dbh->prepare("SELECT t.idResposable, t.Nombre, t.Apellido, t.Cedula, t.ubicacion_idUbicacion, u.Descripcion " .
                               " FROM resposable t inner join ubicacion u " .
                               " on u.idUbicacion = t.ubicacion_idUbicacion ");
    $stmt->execute();
    //$data = $stmt->fetchALL();
    $data=$stmt->fetchAll(PDO::FETCH_ASSOC);




    echo "<hr />
    
    <div id='tablaResponsable' class='table-responsive'>
        <table  class='table table-bordered table-hover'>
            <thead>
            <tr>
                <th>Responsable</th>
                <th>Cedula</th>
                <th>Ubicación</th>
                <!-- <th>Eliminar</th> -->
            </tr>
            </thead>
            <tbody>";


            foreach ($data as $row ) {
                echo "<tr>";
                echo "<td>" . $row['Nombre']." ".$row['Apellido'] . "</td><td>" . $row['Cedula'] . "</td>" .
                    "<td>" . $row['Descripcion'] . "</td>" ;
                    //"<span class='glyphicon glyphicon-remove' id = '".$row['usuario']."'></span></td>";
                   // "<button id='" .$row['idResposable']. "' type='button' class='btn btn-danger btn-sm glyphicon glyphicon-remove borrarResp'></button></td>";
                echo "</tr>";
            }


     echo      " </tbody>
    
        </table>
    </div><!--end of .table-responsive-->
    
    <hr /> ";



    $stmt = $dbh->prepare("SELECT t.idUbicacion, t.Descripcion 
                               FROM ubicacion t ");
    $stmt->execute();
    //$data = $stmt->fetchALL();
    $data=$stmt->fetchAll(PDO::FETCH_ASSOC);



    echo "<div class='row'>
        <div class='col-md-3 col-lg-3 col-sm-3 col-xs-1'></div>
        <div class='col-md-6 col-lg-6 col-sm-6 col-xs-10' >
            <form method='post' id='registrar-responsable' class='form-horizontal'>
    
                <div id='errorResp'>
                    <!-- error will be shown here ! -->
                </div>
    
                <div class='form-group'>
                    <input type='text' class='form-control' name='nombre' id='nombre' placeholder='Nombre' required>
                </div>
                <div class='form-group'>
                    <input type='text' class='form-control' name='apellido' id='apellido' placeholder='Apellido' required>
                </div>
                <div class='form-group'>
                    <input type='text' class='form-control' name='cedula' id='cedula' placeholder='Cedula' required>
                </div>
    
                <div class='form-group'>
                    <label >Ubicación</label>
                    <select class='form-control' id='ubic' name='ubic' title='ubic' > ";

                        foreach ($data as $row) {
                            ?>

                            <option value="<?php echo $row['idUbicacion']; ?>">
                                <?php echo $row['Descripcion']; ?>
                            </option>


                            <?php
                        }

      echo              "</select>
                </div>
    
    
                <input type='hidden' class='form-control' name='reg_respons' id='reg_respons' value='prueba'>
                <hr />
                
                <div class='form-group'>
                    <button type='submit' class='btn btn-default' name='btn-loginResp' id='btn-loginResp' value='' >
                        <span class='glyphicon glyphicon-log-in'></span> &nbsp; Registrar
                    </button>
    
                </div>
            </form>
        </div>
        <div class='col-md-3 col-lg-3 col-sm-3 col-xs-1'></div>
    </div> ";
}

?>