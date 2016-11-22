<?php
session_start();

if(!isset($_SESSION['user_session']))
{
    header("Location: index.php");
}

include_once 'conf/dbconn.php';


if (isset($_GET['variableD'])) {
  $variable=$_GET['variableD'];
  $_SESSION['variableD']=$variable;
$stmt = $dbh->prepare("SELECT * from activos where Descripcion='$variable';");
}else
{
 $stmt = $dbh->prepare("SELECT * from activos ;"); 
}


$stmt->execute();
//$data = $stmt->fetchALL();
$data=$stmt->fetchAll(PDO::FETCH_ASSOC);


?>
<hr />
<div class="form-group">



    
     
      
        

       
                <label >Modo de busqueda</label>
               <!-- <select class="form-control" id="opbusqueda" name="opbusqueda" title="Opcion de Buscqueda" >
                    

                     
                <option value="Pcategoria">Por Categoria</option>
                <option value="Psubcategoria">Por Subcategoria</option>
                <option value="Pubicacion">Por La Ubicacion</option>
                <option value="Psucursal">Por Sucursal</option>


                     
                </select>-->
                <datalist id="lista3" ></datalist>

                <br>    
                  <input type="text" class="form-control"  name="string" list="lista3" onkeyup="consultaajax()" placeholder="Ingrese el activo a buscar  ">
                  <br>
                  <a href="javascript:void(0);" class="btn btn-default"  id="btn-opbuscador3" >
                    <span class="glyphicon glyphicon-log-in"></span> &nbsp; Buscar
                </a>
           </div>
           

<hr />

<div id="tablaResponsable" class="table-responsive">
    <table  class="table table-striped table-bordered"  style=" font-size: 70%;">
        
        <tr>
            <th align="center">ID</th>
            <th align="center">Descripcion</th>
            <th align="center">Inicio de depreciacion</th>
            <th align="center">Ene</th>
            <th align="center">Feb</th>
            <th align="center">Mar</th>
            <th align="center">Abr</th>
            <th align="center">May</th>
            <th align="center">Jun</th>
            <th align="center">Jul</th>
            <th align="center">Ago</th>
            <th align="center">Sep</th>
            <th align="center">Oct</th>
            <th align="center">Nov</th>
            <th align="center">Dic</th>
             <?php
        foreach ($data as $row ) {
        $fechainidada=explode("-",$row['fecha_ini_deprec']);
        $meses=$row['tiempo_depre']*12;
        $LocalM=date("m");
        $LocalY=date("Y");
        $acum=$LocalY-$fechainidada[0];
        $acummes=$acum*12;
           /* for ($i=1;$i<=$LocalM;$i++){
                echo "<th>".$i."-".$LocalY."</th>";

            }*/
        }
        ?>
            <!-- <th>Eliminar</th> -->
        </tr>
        
        

        <?php
        foreach ($data as $row ) {


            $fechainidada=explode("-",$row['fecha_ini_deprec']);
        $meses=$row['tiempo_depre']*12;
        $LocalM=date("m");
        $LocalY=date("Y");
        $acum=$LocalY-$fechainidada[0];
        $acummes=$acum*12;
        
        $Vdepreciable=$row['valor_adquisicion'];
        $meses=$row['tiempo_depre']*12;
        $VPM=$Vdepreciable/$meses;
        $VPMF=number_format($VPM,2,'.',',');
        $negativo=$acummes*$VPMF;
        $primervalor=$row['valor_adquisicion']-$negativo;
        $rest=0;
            echo "<tr>";
            echo "<td>" . $row['idActivos']."</td><td>".$row['Descripcion'] ."</td><td>".$row['fecha_ini_deprec'] ."</td>";
            for ($i=1;$i<=$LocalM;$i++){
                echo "<td>";
                if ($fechainidada[0]==$LocalY && $fechainidada[1]>$i) {
                    echo "Null";
                }else{

                echo ($primervalor-$rest);
                echo "</td>";
                $rest+=$VPMF;
                }

            }
            echo "</tr>";
        }

        ?>
        

    </table>
</div><!--end of .table-responsive-->



<script >  
    function consultaajax(){
  var periodo=document.getElementsByName('string')[0].value;
 //var opcione=document.getElementsByName('opbusqueda')[0].value;

// mostrarresultado(periodo,opcione);
 mostrarresultado(periodo);

  }

 // function mostrarresultado(periodo,opcione)
  function mostrarresultado(periodo)
  {
    $.ajax({
      type: 'POST',
      url: 'ajaxdepreciacion.php',
      data:{
        peri:periodo,
       // opcg:opcione
      }


    }).done(function(respuesta){ 
      console.log(respuesta);
      var activo=JSON.parse(respuesta);
      
      
  $('option[id=grupodeopciones]').remove();   
//$('li').remove();//para remover la lista
       
      for (var i in activo) {
$('datalist[id=lista3]').append('<option id="grupodeopciones" value="'+activo[i].Descripcion+'" ></option>');

       /* if (opcione=="Pcategoria") {
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
            }*/

      
}


    });
  }

</script> 
<script type="text/javascript" src="js/script.js"></script>
