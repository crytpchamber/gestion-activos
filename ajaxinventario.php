<?php  

$semana=$_POST['peri'];
$opcion=$_POST['opcg'];

$idConn=new mysqli("localhost","root","","mydb");

if ($opcion=="Pcategoria") {
	# code...
	$sql="select * from categorias where Descripcion LIKE '$semana%';";

}elseif ($opcion=="Psubcategoria") {
	$sql="select * from subcategoria where Descripcion LIKE '$semana%';";
	# code...
}elseif ($opcion=="Pubicacion") {
	# code...
	$sql="select * from ubicacion where Descripcion LIKE '$semana%';";
}elseif ($opcion=="Psucursal") {
	# code...
	$sql="select * from sucursal where Descripcion LIKE '$semana%';";
}


//$sql="select * from  activos  where  descripcion LIKE '$semana%';";//; ";//
$respuesta=mysqli_query($idConn,$sql);
$fin=mysqli_num_rows($respuesta);
/*$areglo=array();
while($res=mysqli_fetch_assoc($respuesta)){
	$areglo[]=$res;
}
*/

for ($i=1; $i<=$fin ; $i++) { 
	$roww[$i]=mysqli_fetch_array($respuesta);
	# code...
}
//echo $roww;
echo  json_encode($roww);

 ?>