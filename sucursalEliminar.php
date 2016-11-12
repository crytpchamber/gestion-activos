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

    $stmt = $dbh->prepare('SELECT t.idsucursal, t.Descripcion '.
                          ' FROM sucursal t  ');
    $stmt->execute();
    //$data = $stmt->fetchALL();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);


    echo "<hr />
    
    <div id='tablaSucursal' class='table-responsive'>
        <table class='table table-bordered table-hover'>
            <thead>
            <tr>
                <th>Codigo</th>
                <th>Sucursal</th>
                <th>Opciones</th>
            </tr>
            </thead>
            <tbody> ";


    foreach ($data as $row) {
        echo '<tr>';
        echo '<td>' . $row['idsucursal'] . '</td><td>' . $row['Descripcion'] . '</td><td>' .
            //'<span class='glyphicon glyphicon-remove' id = ''.$row['usuario'].''></span></td>';
            "<button id=" . $row['idsucursal'] . " type='button' class='btn btn-danger btn-sm glyphicon glyphicon-remove borrarSucursal'></button></td>";
        echo '</tr>';
    }


    echo "   </tbody>
    
        </table>
    </div><!--end of .table-responsive-->
    
    <hr />";


    echo "<div class='row'>
        <div class='col-md-3 col-lg-3 col-sm-3 col-xs-1'></div>
        <div class='col-md-6 col-lg-6 col-sm-6 col-xs-10' >
    
            <div id='errorSucu'>
                <!-- error will be shown here ! -->
            </div>
    
            <label >Filtrar por Sucursal</label>
            <select class='form-control filtrosSucu' id='sucursal' name='sucursal' title='sucursal' > ";
            echo "<option value='' selected disabled>Seleccionar Sucursal</option>";

    foreach ($data as $row) {


        echo " <option value=" . $row['Descripcion'] . ">" . $row['Descripcion'] . "</option>";


    }

    echo "       </select>
    
            <hr />
    
        </div>
        <div class='col-md-3 col-lg-3 col-sm-3 col-xs-1'></div>
    
    </div>";
}

?>