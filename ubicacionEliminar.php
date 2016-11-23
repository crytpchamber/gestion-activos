<?php
session_start();

if(!isset($_SESSION['user_session']))
{
    header('Location: index.php');
}

include_once 'conf/dbconn.php';
if ($_SESSION['eliminar']=='0') {
    echo "error";
} else {

    $stmt = $dbh->prepare('SELECT t.idUbicacion, t.Descripcion, t.sucursal_idsucursal, m.Descripcion as Sucursal ' .
                              ' FROM ubicacion t inner join sucursal m  ' .
                              ' on m.idsucursal = t.sucursal_idsucursal ');
    $stmt->execute();
    //$data = $stmt->fetchALL();
    $data=$stmt->fetchAll(PDO::FETCH_ASSOC);




    echo " <hr />
    
    
    
    <div id='tablaUbicacion' class='table-responsive'>
        <table class='table table-bordered table-hover'>
            <thead>
            <tr>
                <th>Ubicación</th>
                <th>Sucursal</th>
                <th>Opciones</th>
            </tr>
            </thead>
            <tbody> ";



            foreach ($data as $row ) {
                echo '<tr>';
                echo '<td>' . $row['Descripcion'] . '</td><td>' . $row['Sucursal'] . '</td><td>' .
                    //'<span class='glyphicon glyphicon-remove' id = ''.$row['usuario'].''></span></td>';
                    "<button id=" .$row['idUbicacion']. " type='button' class='btn btn-danger btn-sm glyphicon glyphicon-remove borrarUbic'></button></td>";
                echo '</tr>';
            }


    echo "        </tbody>
    
        </table>
    </div><!--end of .table-responsive-->
    
    <hr /> ";


    $stmt = $dbh->prepare('SELECT m.idsucursal, m.Descripcion '.
                              ' FROM  sucursal m  ');
    $stmt->execute();
    //$data = $stmt->fetchALL();
    $data=$stmt->fetchAll(PDO::FETCH_ASSOC);


    /* Ubicacion */
    $stmt = $dbh->prepare('SELECT t.idUbicacion, t.Descripcion ' .
        ' FROM ubicacion t ');
    $stmt->execute();
    //$data = $stmt->fetchALL();
    $data2=$stmt->fetchAll(PDO::FETCH_ASSOC);



    echo "<div class='row'>
        <div class='col-md-3 col-lg-3 col-sm-3 col-xs-1'></div>
        <div class='col-md-6 col-lg-6 col-sm-6 col-xs-10' >
            <div id='errorUbic'>
                <!-- error will be shown here ! -->
            </div>
    
            <label >Filtrar por Ubicación</label>
            <select class='form-control filtrosUbic2' id='responsable' name='responsable' title='responsable' > ";
    echo "<option value='' selected disabled>Seleccionar Ubicación</option>";

                foreach ($data2 as $row) {


                    echo "<option value=" . $row['Descripcion']. ">" .$row['Descripcion'] . " </option> ";

                }

    echo "       </select>
    
    
            <label >Filtrar por Sucursal</label>
            <select class='form-control filtrosUbic' id='responsable' name='responsable' title='responsable' > ";
    echo "<option value='' selected disabled>Seleccionar Sucursal</option>";
                foreach ($data as $row) {


                   echo "<option value=" . $row['Descripcion'] .">" .$row['Descripcion']. "  </option>";
                    echo $row['Descripcion'];

                }

     echo "       </select>
    
    
    
            <hr />
        </div>
        <div class='col-md-3 col-lg-3 col-sm-3 col-xs-1'></div>
    </div> ";
}

?>