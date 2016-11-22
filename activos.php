<?php
session_start();

if(!isset($_SESSION['user_session']))
{
    header("Location: index.php");
}

include_once 'conf/dbconn.php';


$stmt = $dbh->prepare("SELECT t.idActivos, t.Descripcion, t.fecha_adquisicion, t.tiempo_depre, t.valor_adquisicion, " .
                      " t.fecha_registro, t.fecha_ini_deprec, t.ubicacion_idUbicacion, u.Descripcion as DescUbicacion ,t.estado " .
                      "     FROM activos t inner join ubicacion u " .
                      " on u.idUbicacion = t.ubicacion_idUbicacion ");
$stmt->execute();
//$data = $stmt->fetchALL();
$data=$stmt->fetchAll(PDO::FETCH_ASSOC);


$stmt = $dbh->prepare("SELECT t.idUbicacion, t.Descripcion " .
                      "FROM ubicacion t ");
$stmt->execute();
//$data = $stmt->fetchALL();
$data2=$stmt->fetchAll(PDO::FETCH_ASSOC);


$stmt = $dbh->prepare("SELECT t.idCategoria, t.Descripcion " .
    "FROM categorias t ");
$stmt->execute();
//$data = $stmt->fetchALL();
$data3=$stmt->fetchAll(PDO::FETCH_ASSOC);



?>

<hr />



<div id="tablaActivos" class="table-responsive">
    <table  class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>Descripcion</th>
            <th>Fecha Adquisicion</th>
            <th width='15%'>  Estado  </th>
            <th>Tiempo de Depreciación</th>
            <th align="center">Valor de Adquisicion</th>
            <th>Ubicación</th>
            <th>Opciones</th>
        </tr>
        </thead>
        <tbody>
        <?php

        foreach ($data as $row ) {
            $estado=trim($row['estado']);
            echo "<tr>";
            echo "<td>" . $row['Descripcion'] ."</td> " .
                " <td width='25%'><input class='form-control' type='date' class='fechaadq' id='tiempoadq".$row['idActivos']."' value='" . $row['fecha_adquisicion'] . "'></td>" .
                " <td><select class='form-control' id='estado".$row['idActivos']."' name='estado' title='estado' >" ;
                if ($row['estado']=="A") {
                        echo "<option value='A' selected>A</option>";
                    } else {
                        echo "<option value='A' >A</option>";
                    }
if ($row['estado']=="M") {
                        echo "<option value='M' selected>M</option>";
                    } else {
                        echo "<option value='M' >M</option>";
                    }
                    if ($row['estado']=='D') {
                        echo "<option value='D' selected>D</option>";
                    } else {
                        echo "<option value='D' >D</option>";
                    }
echo "</select></td>".
               // "<td width='10%'><input class='form-control' style='width:100%' type='' id='estado".$row['idActivos']."' value='"  . $row['estado'] . "'></td>".
                " <td width='12%'><input class='form-control' style='width:70%' type='number' id='tiempodepre".$row['idActivos']."' value='" . $row['tiempo_depre']. "'></td>" .
                " <td width='25%'><input class='form-control' style='width:100%' type='number' id='valor".$row['idActivos']."' value='"  . $row['valor_adquisicion'] . "'></td>".
                " <td><select class='form-control' id='ubic".$row['idActivos']."' name='ubic' title='ubic' >" ;

            foreach ($data2 as $row2) {

                    if ($row2['idUbicacion']==$row['ubicacion_idUbicacion']) {
                        echo "<option value='" . $row2['idUbicacion'] . "' selected> " . $row2['Descripcion'] . "</option>";
                    } else {
                        echo "<option value='" . $row2['idUbicacion'] . "'> " . $row2['Descripcion'] . "</option>";
                    }
            }

 


            echo "</select></td><td width='50%'> ".



                 //"<span class='glyphicon glyphicon-remove' id = '".$row['usuario']."'></span></td>";
                "<button id='" .$row['idActivos']. "' type='button' class='btn btn-default btn-sm glyphicon glyphicon-edit modifActivo'></button>
                <button id='" .$row['idActivos']. "' type='button' class='btn btn-danger btn-sm glyphicon glyphicon-remove borrarAct'></button>
                
                </td>";
                /*foreach ($data as $row ) {

                    echo "<td width='25%'><input class='form-control' style='width:100%' type='number' id='estado".$row['idActivos']."' value='"  . $row['estado'] . "'></td>";
                }*/
            echo "</tr>";
            //echo $row['tiempo_depre'];
        }

        ?>
        </tbody>

    </table>
</div><!--end of .table-responsive-->

<hr />

<?php


?>

<div class="row">
    <div class="col-md-3 col-lg-3 col-sm-3 col-xs-1"></div>
    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-10" >
        <form method="post" id="registrar-activo" class="form-horizontal">

            <div id="errorAct">
                <!-- error will be shown here ! -->
            </div>

            <div class="form-group">
                <input type="text" class="form-control" name="codigo" id="codigo" placeholder="Codigo de Activo" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripcion" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="serial" id="serial" placeholder="Serial de Activo" required>
            </div>
            <div class="form-group">
                <label >Fecha de Adquisición</label>
                <input type="date" class="form-control" name="fecha_adq" id="fecha_adq" placeholder="Fecha de Adquisición" required>
            </div>
            <div class="form-group">
                <input type="number" min="0" class="form-control" name="tiempodepre" id="tiempodepre" placeholder="Tiempo a depreciar (años)" required>
            </div>
            <div class="form-group">
                <input type="number" min="0" class="form-control" name="valorAdq" id="valorAdq" placeholder="Valor de Adquisicion" required>
            </div>
            <div class="form-group">
                <label >Fecha Inicio de Depreciación</label>
                <input type="date" class="form-control" name="fechaIni" id="fechaIni" placeholder="Fecha Inicio Depreciación" required>
            </div>

            <div class="form-group">
                <label >Ubicación</label>
                <select class="form-control" id="ubic" name="ubic" title="ubic" >
                    <option value="" selected disabled>Seleccione Ubicación</option>
                    <?php
                    foreach ($data2 as $row) {
                        ?>

                        <option value="<?php echo $row['idUbicacion']; ?>">
                            <?php echo $row['Descripcion']; ?>
                        </option>


                        <?php
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label >Categoria</label>
                <select class="form-control" id="categ" name="categ" title="categ" >
                    <option value="" selected disabled>Seleccione Categoría</option>
                    <?php
                    foreach ($data3 as $row) {
                        ?>

                        <option value="<?php echo $row['idCategoria']; ?>">
                            <?php echo $row['Descripcion']; ?>
                        </option>


                        <?php
                    }
                    ?>
                </select>
            </div>

            <div class="form-group" id="subcateg">
                <label >Sub-Categoria</label>
                <select class="form-control" id="scateg" name="scateg" title="scateg" >
                    <option value=" " selected disabled>
                        Seleccione una Categoria.
                    </option>
                </select>
            </div>


            <input type="hidden" class="form-control" name="reg_act" id="reg_act">
            <hr />
            
            <div class="form-group">
                <button type="submit" class="btn btn-default" name="btn-loginAct" id="btn-loginAct" value="" >
                    <span class="glyphicon glyphicon-log-in"></span> &nbsp; Registrar
                </button>
                <button type="reset" class="btn btn-default" name="btn-loginActReset" id="btn-loginActReset" value="" >
                    <span class="glyphicon glyphicon-erase"></span> &nbsp; Limpiar
                </button>
            </div>
        </form>
    </div>
    <div class="col-md-3 col-lg-3 col-sm-3 col-xs-1"></div>
</div>
