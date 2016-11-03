<?php
session_start();

if(!isset($_SESSION['user_session']))
{
    header('Location: index.php');
}

include_once 'conf/dbconn.php';


$stmt = $dbh->prepare('SELECT t.idResposable, t.Nombre, t.Apellido, t.Cedula, t.ubicacion_idUbicacion, u.Descripcion ' .
                           ' FROM resposable t inner join ubicacion u ' .
                           ' on u.idUbicacion = t.ubicacion_idUbicacion ');
$stmt->execute();
//$data = $stmt->fetchALL();
$data=$stmt->fetchAll(PDO::FETCH_ASSOC);


if ($_SESSION['eliminar']=='0') {
    echo "error";
} else {

    echo "<hr />

    <div id='tablaResponsable' class='table-responsive'>
    <table class='table table-bordered table-hover'>
        <thead>
        <tr>
            <th>Responsable</th>
            <th>Cedula</th>
            <th>Ubicación</th>
            <th>Opciones</th>
        </tr>
        </thead>
        <tbody> ";


    foreach ($data as $row) {
        echo "<tr>";
        echo "<td>" . $row['Nombre'] . " " . $row['Apellido'] . "</td><td>" . $row['Cedula'] . "</td>" .
            "<td>" . $row['Descripcion'] . "</td><td>" .
            //'<span class='glyphicon glyphicon-remove' id = ''.$row['usuario'].''></span></td>';
            "<button id=" . $row['idResposable'] . " type='button' class='btn btn-danger btn-sm glyphicon glyphicon-remove borrarResp'></button></td>";
        echo '</tr>';
    }


    echo "        </tbody>

    </table>
    </div><!--end of .table-responsive-->
    
    <hr />";


    $stmt = $dbh->prepare('SELECT t.idUbicacion, t.Descripcion ' .
        ' FROM ubicacion t ');
    $stmt->execute();
    //$data = $stmt->fetchALL();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $dbh->prepare('SELECT t.idResposable, t.Nombre, t.Apellido ' .
        ' FROM resposable t ');
    $stmt->execute();
    //$data = $stmt->fetchALL();
    $data2 = $stmt->fetchAll(PDO::FETCH_ASSOC);


    echo "<div class='row'>
    <div class='col-md-3 col-lg-3 col-sm-3 col-xs-1'></div>
    <div class='col-md-6 col-lg-6 col-sm-6 col-xs-10' >

        <div id='errorResp'>
            <!-- error will be shown here ! -->
        </div>

        <label >Filtrar por Responsable</label>
        <select class='form-control filtrosResp' id='responsable' name='responsable' title='responsable' > ";

    foreach ($data2 as $row) {


        echo "<option value=" . $row['Nombre'] . " " . $row['Apellido'] . " > " . $row['Nombre'] . " " . $row['Apellido'] . "
                </option> ";


    }

    echo "       </select>

        <label >Filtrar por Ubicación</label>
        <select class='form-control filtrosResp2' id='responsable' name='responsable' title='responsable' > ";

    foreach ($data as $row) {


        echo "   <option value= " . $row['Descripcion'] . " > " . $row['Descripcion'] . "</option> ";


    }

    echo "       </select>

        <hr />

    </div>
    <div class='col-md-3 col-lg-3 col-sm-3 col-xs-1'></div>

    </div> ";
}
?>
