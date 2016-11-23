<?php

session_start();

if(!isset($_SESSION['user_session']))
{
    header("Location: index.php");
}
include_once 'conf/dbconn.php';
if ($_SESSION['categorias']=='0') {
    echo "error";
} else {

    echo "<ul class='topnav' id='myTopnav'>
        <li style='width: 50%; text-align: center'><a id='crearCategoria' href='javascript:void(0);'>Crear Categorías</a></li>
        <li style='width: 50%; text-align: center'><a id='crearSubCategoria' href='javascript:void(0);'>Crear Sub-Categorías</a></li>
    
   
        <li class='icon'>
            <a href='javascript:void(0);' onclick='myFunction()'>&#9776;</a>
        </li>
    </ul>
    <script type='text/javascript' src='js/jquery-3.1.1.js'></script>
    <script type='text/javascript' src='js/script.js'></script> ";
}

?>