<?php
session_start();

if(!isset($_SESSION['user_session']))
{
    header('Location: index.php');
}

include_once 'conf/dbconn.php';
if ($_SESSION['guardar']=='0') {
    echo "error";
} else {

        $stmt = $dbh->prepare('SELECT t.idsucursal, t.Descripcion 
                               FROM sucursal t  ');
        $stmt->execute();
    //$data = $stmt->fetchALL();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);


        echo "<hr />
    
    <div id='tablaSucursal' class='table-responsive'>
        <table class='table table-bordered table-hover'>
            <thead>
            <tr>
                <th>Código</th>
                <th>Sucursal</th>
                <!-- <th>Eliminar</th> -->
            </tr>
            </thead>
            <tbody>";


        foreach ($data as $row) {
            echo '<tr>';
            echo '<td>' . $row['idsucursal'] . '</td><td>' . $row['Descripcion'] . '</td>';
            //'<span class='glyphicon glyphicon-remove' id = ''.$row['usuario'].''></span></td>';
            //'<button id='' .$row['idsucursal']. '' type='button' class='btn btn-danger btn-sm glyphicon glyphicon-remove borrarSucursal'></button></td>';
            echo '</tr>';
        }


        echo "        </tbody>
    
        </table>
    </div><!--end of .table-responsive-->
    
    <hr />";


        echo "<div class='row'>
        <div class='col-md-3 col-lg-3 col-sm-3 col-xs-1'></div>
        <div class='col-md-6 col-lg-6 col-sm-6 col-xs-10' >
            <form method='post' id='registrar-sucursal' class='form-horizontal'>
    
                <div id='errorSucu'>
                    <!-- error will be shown here ! -->
                </div>
    
    
                <div class='form-group'>
                    <input type='text' class='form-control' name='descripcion' id='descripcion' placeholder='Descripción' required>
                </div>
    
                <input type='hidden' class='form-control' name='reg_sucu' id='reg_sucu'>
                <hr />
                
                <div class='form-group'>
                    <button type='submit' class='btn btn-default' name='btn-loginSucu' id='btn-loginSucu' value='' >
                        <span class='glyphicon glyphicon-log-in'></span> &nbsp; Registrar
                    </button>
                    <button type='reset' class='btn btn-default' name='btn-loginReset' id='btn-loginReset' value='' >
                        <span class='glyphicon glyphicon-erase'></span> &nbsp; Borrar
                    </button>    
                </div>
            </form>
        </div>
        <div class='col-md-3 col-lg-3 col-sm-3 col-xs-1'></div>
    </div>";

}

?>