<?php  

$semana=$_POST['peri'];
$opcion=$_POST['opcg'];

$idConn=new mysqli("localhost","root","","mydb");

if ($opcion=="Pactivo") {
	# code...
	$sql="select activos.Descripcion as activo ,activos.fecha_adquisicion ,resposable.Nombre ,resposable.Apellido,resposable.Cedula,ubicacion.Descripcion as ubicacion ,sucursal.Descripcion as sucursal  from relacionactivos,activos,resposable ,ubicacion ,sucursal  where relacionactivos.Activos_idActivos=activos.idActivos and relacionactivos.Resposable_idResposable=resposable.idResposable and resposable.ubicacion_idUbicacion=ubicacion.idUbicacion and ubicacion.sucursal_idsucursal=sucursal.idsucursal and activos.estado='A' and activos.Descripcion LIKE '$semana%';";

}elseif ($opcion=="Presponsable") {
	$sql="select activos.Descripcion as activo ,activos.fecha_adquisicion ,resposable.Nombre ,resposable.Apellido,resposable.Cedula,ubicacion.Descripcion as ubicacion ,sucursal.Descripcion as sucursal from relacionactivos,activos,resposable ,ubicacion ,sucursal where relacionactivos.Activos_idActivos=activos.idActivos and relacionactivos.Resposable_idResposable=resposable.idResposable and resposable.ubicacion_idUbicacion=ubicacion.idUbicacion and ubicacion.sucursal_idsucursal=sucursal.idsucursal and activos.estado='A' and resposable.Cedula LIKE '$semana%';";
	# code...
}elseif ($opcion=="Pubicacion") {
	# code...
	$sql="select activos.Descripcion as activo ,activos.fecha_adquisicion ,resposable.Nombre ,resposable.Apellido,resposable.Cedula,ubicacion.Descripcion as ubicacion ,sucursal.Descripcion as sucursal from relacionactivos,activos,resposable ,ubicacion ,sucursal where relacionactivos.Activos_idActivos=activos.idActivos and relacionactivos.Resposable_idResposable=resposable.idResposable and resposable.ubicacion_idUbicacion=ubicacion.idUbicacion and ubicacion.sucursal_idsucursal=sucursal.idsucursal and activos.estado='A' and ubicacion.Descripcion LIKE '$semana%' ;";
}elseif ($opcion=="Psucursal") {
	# code...
	$sql="select activos.Descripcion as activo ,activos.fecha_adquisicion ,resposable.Nombre ,resposable.Apellido,resposable.Cedula,ubicacion.Descripcion as ubicacion ,sucursal.Descripcion as sucursal from relacionactivos,activos,resposable ,ubicacion ,sucursal where relacionactivos.Activos_idActivos=activos.idActivos and relacionactivos.Resposable_idResposable=resposable.idResposable and resposable.ubicacion_idUbicacion=ubicacion.idUbicacion and ubicacion.sucursal_idsucursal=sucursal.idsucursal and activos.estado='A' and sucursal.Descripcion LIKE '$semana%';";
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