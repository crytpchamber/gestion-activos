<?php
session_start();

if(!isset($_SESSION['user_session']))
{
    header("Location: index.php");
}

include_once 'conf/dbconn.php';

if (isset($_GET['fecha1']) && isset($_GET['fecha2'])) {
    $Vfecha1=$_GET['fecha1'];
    $Vfecha2=$_GET['fecha2'];


$stmt = $dbh->prepare("SELECT activos.Descripcion as activo ,activos.fecha_adquisicion ,resposable.Nombre ,resposable.Apellido,resposable.Cedula,ubicacion.Descripcion as ubicacion ,sucursal.Descripcion as sucursal " .
                           " FROM relacionactivos,activos,resposable ,ubicacion ,sucursal " .
                           " where relacionactivos.Activos_idActivos=activos.idActivos and relacionactivos.Resposable_idResposable=resposable.idResposable and resposable.ubicacion_idUbicacion=ubicacion.idUbicacion and ubicacion.sucursal_idsucursal=sucursal.idsucursal and activos.fecha_adquisicion BETWEEN '$Vfecha1' AND '$Vfecha2' and activos.estado='A';");
}else{

$stmt = $dbh->prepare("SELECT activos.Descripcion as activo ,activos.fecha_adquisicion ,resposable.Nombre ,resposable.Apellido,resposable.Cedula,ubicacion.Descripcion as ubicacion ,sucursal.Descripcion as sucursal " .
                           " FROM relacionactivos,activos,resposable ,ubicacion ,sucursal " .
                           " where relacionactivos.Activos_idActivos=activos.idActivos and relacionactivos.Resposable_idResposable=resposable.idResposable and resposable.ubicacion_idUbicacion=ubicacion.idUbicacion and ubicacion.sucursal_idsucursal=sucursal.idsucursal and activos.estado='A';");

}

$stmt->execute();
//$data = $stmt->fetchALL();
$data=$stmt->fetchAll(PDO::FETCH_ASSOC);


?>
<hr />
<div class="form-group">



    
     
      
        

       
                <label >Modo de Busqueda</label>
                <select class="form-control" id="opbusqueda" name="opbusqueda" title="Opcion de Buscqueda" >
                    

                     
                <option value="Pactivo">Por Nombre del Activo</option>
                <option value="Presponsable">Por Nombre del Responsable</option>
                <option value="Pubicacion">Por La Ubicación</option>
                <option value="Psucursal">Por Sucursal</option>


                     
                </select>
                <datalist id="lista3" ></datalist>

                <br>    
                  <input type="text" class="form-control"  name="string" list="lista3" onkeyup="consultaajax()" placeholder="Ingrese el dato a buscar  ">
                  <table align="center">
              <tr  >           <th colspan="2"  style="text-align:center; padding:10px;  padding-right:0px !important;"><span >Rango de fecha</span></th>   

</tr>

           <tr  >  
           
<td  ><input   class='form-control' type='date'  class='fechaadq' name="fecharango1" id='fecharango1' ></td>
<td ><input  class='form-control' type='date'  class='fechaadq' name="fecharango2" id='fecharango2' ></td>

                </tr>
                </table>
                  <br>
                  <a href="javascript:void(0);" class="btn btn-default"  id="btn-opbuscador" >
                    <span class="glyphicon glyphicon-log-in"></span> &nbsp; Buscar
                </a>


           </div>
          

           

<hr />

<div id="tablaResponsable" class="table-responsive">
    <table summary="This table shows how to create responsive tables using Bootstrap's default functionality" class="table table-bordered table-hover">
        
        <tr>
            <th>Activo</th>
            <th>Fecha de Adquisición</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Cédula</th>
            <th>Ubicación</th>
            <th>Sucursal</th>
            <!-- <th>Eliminar</th> -->
        </tr>
        
        
        <?php

      //  $_SESSION['fil']="<script >var a =document.getElementsByName('opbusqueda')[0].value;</script >";
        foreach ($data as $row ) {
            echo "<tr>";
            echo "<td>" . $row['activo']."</td><td>".$row['fecha_adquisicion'] . "</td><td>" . $row['Nombre'] . "</td>" .
                "<td>" . $row['Apellido'] . "</td>"."<td>" . $row['Cedula']." </td><td>".$row['ubicacion'] . "</td><td>" . $row['sucursal'] . "</td>"  ;
                //"<span class='glyphicon glyphicon-remove' id = '".$row['usuario']."'></span></td>";
               // "<button id='" .$row['idResposable']. "' type='button' class='btn btn-danger btn-sm glyphicon glyphicon-remove borrarResp'></button></td>";
            echo "</tr>";
        }

        ?>
        

    </table>
</div><!--end of .table-responsive-->



<script >  
    function consultaajax(){
  var periodo=document.getElementsByName('string')[0].value;
 var opcione=document.getElementsByName('opbusqueda')[0].value;

 mostrarresultado(periodo,opcione);

  }

  function mostrarresultado(periodo,opcione)
  {
    $.ajax({
      type: 'POST',
      url: 'servidorpruebaajax3.php',
      data:{
        peri:periodo,
        opcg:opcione
      }


    }).done(function(respuesta){ 
      console.log(respuesta);
      var activo=JSON.parse(respuesta);
      
      
  $('option[id=grupodeopciones]').remove();   
//$('li').remove();//para remover la lista
       
      for (var i in activo) {
        if (opcione=="Pactivo") {
        $('datalist[id=lista3]').append('<option id="grupodeopciones" value="'+activo[i].activo+'" ></option>');
            }else {
                 if (opcione=="Presponsable") {
        $('datalist[id=lista3]').append('<option id="grupodeopciones" value="'+activo[i].Cedula+'" ></option>');
            }else {
                 if (opcione=="Pubicacion") {
        $('datalist[id=lista3]').append('<option id="grupodeopciones" value="'+activo[i].ubicacion+'" ></option>');
            }else {
                 if (opcione=="Psucursal") {
        $('datalist[id=lista3]').append('<option id="grupodeopciones" value="'+activo[i].sucursal+'" ></option>');
            }else {
                
            }
            }
            }
            }
      
}


    });
  }

</script> 
<script type="text/javascript" src="js/script.js"></script>
