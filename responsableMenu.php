<?php

session_start();

if(!isset($_SESSION['user_session']))
{
    header("Location: index.php");
}
include_once 'conf/dbconn.php';
if ($_SESSION['responsable']=='0') {
    echo "error";
} else {

    echo "<ul class='topnav' id='myTopnav'>
        <li style='width: 50%; text-align: center'><a id='crearRespons' href='javascript:void(0);'>Crear Responsable</a></li>
        <li style='width: 50%; text-align: center'><a id='eliminarRespons' href='javascript:void(0);'>Eliminar Responsable</a></li>
    
       <!-- <li style='width: 25%; text-align: center'><a id='modificarGestion' href='javascript:void(0);'>Modificar Asignacion</a></li>
        <li style='width: 33%; text-align: center'><a id='eliminarGestion' href='javascript:void(0);'>Eliminar Asignacion</a></li> -->
    
        <li class='icon'>
            <a href='javascript:void(0);' onclick='myFunction()'>&#9776;</a>
        </li>
    </ul>
    <script type='text/javascript' src='js/jquery-3.1.1.js'></script>
    <script type='text/javascript' src='js/script.js'></script> ";
}

?>