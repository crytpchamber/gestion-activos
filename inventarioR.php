<?php
session_start();

if(!isset($_SESSION['user_session']))
{
    header("Location: index.php");
}

include_once 'conf/dbconn.php';


$stmt = $dbh->prepare("select activos.estado, categorias.Descripcion as categoria,subcategoria.Descripcion as subcategoria ,activos.Descripcion as activo, activos.fecha_adquisicion ,activos.serial,activos.valor_adquisicion,ubicacion.Descripcion as ubicacion , sucursal.Descripcion as sucursal from activos,ubicacion,sucursal,categorias,subcategoria WHERE activos.ubicacion_idUbicacion=ubicacion.idUbicacion and ubicacion.sucursal_idsucursal=sucursal.idsucursal and activos.idSubCategoria=subcategoria.idSubCategoria AND subcategoria.idCategoria=categorias.idCategoria; ");
$stmt->execute();
//$data = $stmt->fetchALL();
$data=$stmt->fetchAll(PDO::FETCH_ASSOC);


?>
<hr />
<div class="form-group">



    
     
      
        

       
                <label >Modo de Busqueda</label>
                <select class="form-control" id="opbusqueda" name="opbusqueda" title="Opcion de Buscqueda" >
                    

                     
                <option value="Pcategoria">Por Categoría</option>
                <option value="Psubcategoria">Por Subcategoría</option>
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
                  <a href="javascript:void(0);" class="btn btn-default"  id="btn-opbuscador2" >
                    <span class="glyphicon glyphicon-log-in"></span> &nbsp; Buscar
                </a>
                <a href="exportadorlcinvg.php" class="btn btn-default"  style="
    background-image: linear-gradient(to bottom,#b73339 0,#eee 100%);
" id="bt" >
                    <span class="glyphicon glyphicon-log-in"></span> &nbsp; Descargar Lista de cotejo
                </a>
           </div>
           

<hr />

<div id="tablaResponsable" class="table-responsive">
    <table summary="This table shows how to create responsive tables using Bootstrap's default functionality" class="table table-bordered table-hover">
        
        <tr>
            <th>Categoría</th>
            <th>Sub-Categoría</th>
            <th>Activo</th>
            <th>Fecha de Adquisición</th>
            <th>Serial</th>
            <th>Estado</th>
            <th>Valor</th>
            <th>Ubicación</th>
            <th>Sucursal</th>
            <!-- <th>Eliminar</th> -->
        </tr>
        
        
        <?php

      //  $_SESSION['fil']="<script >var a =document.getElementsByName('opbusqueda')[0].value;</script >";
        foreach ($data as $row ) {
            echo "<tr>";
            echo "<td>" . $row['categoria']."</td><td>".$row['subcategoria'] . "</td><td>" . $row['activo'] . "</td>" .
                "<td>" . $row['fecha_adquisicion'] . "</td>"."<td>" . $row['serial']." </td>"."<td>" . $row['estado']." </td><td>".$row['valor_adquisicion'] . "</td><td>" . $row['ubicacion'] . "</td>"  ;
              echo "<td>" . $row['sucursal']."</td>";  
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
      url: 'ajaxinventario.php',
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
        if (opcione=="Pcategoria") {
        $('datalist[id=lista3]').append('<option id="grupodeopciones" value="'+activo[i].Descripcion+'" ></option>');
            }else {
                 if (opcione=="Psubcategoria") {
        $('datalist[id=lista3]').append('<option id="grupodeopciones" value="'+activo[i].Descripcion+'" ></option>');
            }else {
                 if (opcione=="Pubicacion") {
        $('datalist[id=lista3]').append('<option id="grupodeopciones" value="'+activo[i].Descripcion+'" ></option>');
            }else {
                 if (opcione=="Psucursal") {
        $('datalist[id=lista3]').append('<option id="grupodeopciones" value="'+activo[i].Descripcion+'" ></option>');
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
