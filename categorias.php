<?php
session_start();

if(!isset($_SESSION['user_session']))
{
    header('Location: index.php');
}

include_once 'conf/dbconn.php';


        $stmt = $dbh->prepare("SELECT t.idCategoria, t.Descripcion " .
                              "FROM categorias t  ");
        $stmt->execute();
    //$data = $stmt->fetchALL();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);


        echo "<hr />
    
    <div id='tablaCategorias' class='table-responsive'>
        <table class='table table-bordered table-hover'>
            <thead>
            <tr>
                <th>Codigo</th>
                <th>Categoria</th>
                <th>Eliminar</th> 
            </tr>
            </thead>
            <tbody>";


        foreach ($data as $row) {
            echo '<tr>';
            echo '<td>' . $row['idCategoria'] . '</td><td>' . $row['Descripcion'] . '</td>';
            //echo "<td><span class='glyphicon glyphicon-remove' id = ".$row['idCategoria']."></span></td>";
            echo "<td><button id=" .$row['idCategoria']. " type='button' class='btn btn-danger btn-sm glyphicon glyphicon-remove borrarCateg'></button></td>";
            echo '</tr>';
        }


        echo "        </tbody>
    
        </table>
    </div><!--end of .table-responsive-->
    
    <hr />";


        echo "<div class='row'>
        <div class='col-md-3 col-lg-3 col-sm-3 col-xs-1'></div>
        <div class='col-md-6 col-lg-6 col-sm-6 col-xs-10' >
            <form method='post' id='registrar-categoria' class='form-horizontal'>
    
                <div id='errorCate'>
                    <!-- error will be shown here ! -->
                </div>
    
    
                <div class='form-group'>
                    <input type='text' class='form-control' name='descripcion' id='descripcion' placeholder='Descripcion' required>
                </div>
    
                <input type='hidden' class='form-control' name='reg_cate' id='reg_cate'>
                <hr />
                
                <div class='form-group'>
                    <button type='submit' class='btn btn-default' name='btn-loginCate' id='btn-loginCate' value='' >
                        <span class='glyphicon glyphicon-log-in'></span> &nbsp; Registrar
                    </button>
    
                </div>
            </form>
        </div>
        <div class='col-md-3 col-lg-3 col-sm-3 col-xs-1'></div>
    </div>";



?>