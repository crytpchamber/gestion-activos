<?php
session_start();

if(!isset($_SESSION['user_session']))
{
    header("Location: index.php");
}

include_once 'conf/dbconn.php';

$stmt = $dbh->prepare(" SELECT u.idUsuarios, u.usuario, u.Nombre, u.Apellido, u.Cedula, t.descripcion as tipoUsuario ".
                      " FROM usuarios as u inner join tipo_usuario t ".
                      " on t.idTipo_Usuario = u.Tipo_Usuario_idTipo_Usuario ");
$stmt->execute();
//$data = $stmt->fetchALL();
$data=$stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(150);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

</script>


<hr />

<div id="tablaUsuarios" class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>Usuario</th>
            <th>Nombre Completo</th>
            <th>Cedula</th>
            <th>Tipo de Usuario</th>
            <th>Contraseña</th>
            <th>Opciones</th>
        </tr>
        </thead>
        <tbody>
            <?php

                foreach ($data as $row ) {
                    echo "<tr>";
                    echo "<td>" . $row['usuario'] . "</td><td>" . $row['Nombre']." ".$row['Apellido'] . "</td><td>" .
                        $row['Cedula'] . "</td><td>" . $row['tipoUsuario'] . "</td>" ;
                    echo "<td> <input type='password' class='form-control' name='newpass' id='newpass' placeholder='Nueva Contraseña'> </td><td>";
                       //"<span class='glyphicon glyphicon-remove' id = '".$row['usuario']."'></span></td>";
                    if ($row['usuario']=="admin") {
                        echo "<button id='".$row['usuario']."' type='button' class='btn btn-default btn-sm glyphicon glyphicon-edit editongo'></button></td>";
                    } else {
                        echo "<button id='".$row['usuario']."' type='button' class='btn btn-default btn-sm glyphicon glyphicon-edit editongo'></button>".
                            " <button id='" .$row['usuario']. "' type='button' class='btn btn-danger btn-sm glyphicon glyphicon-remove borrar'></button></td>";
                    }

                    echo "</tr>";
                }

            ?>
        </tbody>

    </table>
</div><!--end of .table-responsive-->

<hr />


<?php
    $stmt = $dbh->prepare("SELECT t.idTipo_Usuario, t.descripcion " .
                          " FROM tipo_usuario t ");
    $stmt->execute();
    //$data = $stmt->fetchALL();
    $data=$stmt->fetchAll(PDO::FETCH_ASSOC);

?>





<div class="row">
    <div class="col-md-3 col-lg-3 col-sm-3 col-xs-1"></div>
    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-10" >
        <form method="POST" id="registrar-usuario" class="form-horizontal" enctype="multipart/form-data" >

            <div id="error2">
                <!-- error will be shown here ! -->
            </div>

            <div class="form-group">
                <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuario" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="Nombre" id="Nombre" placeholder="Nombre" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="Apellido" id="Apellido" placeholder="Apellido" required>
            </div>
            <div class='form-group form-inline' >
                <select id='nacionalidad' name='nacionalidad' class='form-control' style='min-width: 15%'>
                    <option value='' selected disabled> </option>
                    <option value='V-'>V-</option>
                    <option value='E-'>E-</option>
                </select>
                <input type='text' class='form-control' name='cedula' id='cedula' style='min-width: 83%' placeholder='Cedula' required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="pwd" id="pwd" placeholder="Contraseña" required>

            </div>
            <input type="hidden" class="form-control" name="register" id="register">
            <div class="form-group">
                <select class="form-control" id="tipo" name="tipo" title="tipo" >
                    <option value="" selected disabled>Seleccionar Tipo de Usuario</option>
                    <?php
                        foreach ($data as $row) {
                    ?>

                            <option value="<?php echo $row['idTipo_Usuario']; ?>">
                                <?php echo $row['descripcion']; ?>
                            </option>


                    <?php
                        }
                    ?>
                </select>
            </div>


            <div class="form-group">
                <input id="filename" type="file" name="filename" accept="image/gif, image/jpg, image/jpeg, image/png" onchange="readURL(this)" >
                <img id="blah" src="#" alt="Imagen" />
            </div>

            <hr />

            <div class="form-group">
                <button type="submit" class="btn btn-default" name="btn-loginUsuario" id="btn-loginUsuario" value="Submit" >
                    <span class="glyphicon glyphicon-log-in"></span> &nbsp; Registrar
                </button>

                <button type="reset" class="btn btn-default" name="btn-loginReset" id="btn-loginReset" value="Submit" >
                    <span class="glyphicon glyphicon-erase"></span> &nbsp; Borrar
                </button>

            </div>
        </form>
    </div>
    <div class="col-md-3 col-lg-3 col-sm-3 col-xs-1"></div>
</div>

