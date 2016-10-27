<?php
session_start();

if(!isset($_SESSION['user_session']))
{
    header('Location: index.php');
}

include_once 'conf/dbconn.php';


        $stmt = $dbh->prepare("SELECT t.idSubCategoria, t.Descripcion, t.idCategoria, c.Descripcion as Categoria " .
                              "FROM subcategoria t inner join categorias c  " .
                              "on c.idCategoria = t.idCategoria ");
        $stmt->execute();
    //$data = $stmt->fetchALL();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);


        $stmt = $dbh->prepare("select idCategoria, Descripcion from categorias ");
        $stmt->execute();

        $data2 = $stmt->fetchAll(PDO::FETCH_ASSOC);



        echo "<hr />
    
    <div id='tablaSubCategorias' class='table-responsive'>
        <table class='table table-bordered table-hover'>
            <thead>
            <tr>
                <th>Codigo</th>
                <th>Sub-Categoria</th>
                <th>Categoria</th>
                <th>Eliminar</th> 
            </tr>
            </thead>
            <tbody>";


        foreach ($data as $row) {
            echo '<tr>';
            echo '<td>' . $row['idSubCategoria'] . '</td><td>' . $row['Descripcion'] . '</td><td>' . $row['Categoria'] . '</td>';
            //echo "<td><span class='glyphicon glyphicon-remove' id = ".$row['idCategoria']."></span></td>";
            echo "<td><button id=" .$row['idSubCategoria']. " type='button' class='btn btn-danger btn-sm glyphicon glyphicon-remove borrarSubCateg'></button></td>";
            echo '</tr>';
        }


        echo "        </tbody>
    
        </table>
    </div><!--end of .table-responsive-->
    
    <hr />";


        echo "<div class='row'>
        <div class='col-md-3 col-lg-3 col-sm-3 col-xs-1'></div>
        <div class='col-md-6 col-lg-6 col-sm-6 col-xs-10' >
            <form method='post' id='registrar-subcategoria' class='form-horizontal'>
    
                <div id='errorSubCate'>
                    <!-- error will be shown here ! -->
                </div>
    
    
                <div class='form-group'>
                    <input type='text' class='form-control' name='descripcion' id='descripcion' placeholder='Descripcion' required>
                    
                </div>";

            echo "<div class='form-group'>
                                <select class='form-control' id='categoria' name='categoria' required> ";

                foreach ($data2 as $row2) {


                    echo " <option value=" . $row2['idCategoria'] . ">" . $row2['Descripcion'] . "</option> ";


                }

                echo "              </select>
                            </div>";


    
        echo  "<input type='hidden' class='form-control' name='reg_scate' id='reg_scate'>
                <hr />
                
                <div class='form-group'>
                    <button type='submit' class='btn btn-default' name='btn-loginsCate' id='btn-loginsCate' value='' >
                        <span class='glyphicon glyphicon-log-in'></span> &nbsp; Registrar
                    </button>
    
                </div>
            </form>
        </div>
        <div class='col-md-3 col-lg-3 col-sm-3 col-xs-1'></div>
    </div>";



?>