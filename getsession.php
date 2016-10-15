<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 10/15/2016
 * Time: 11:17 AM
 */


session_start();

if(!isset($_SESSION['user_session']))
{
    header("Location: index.php");
}

//echo $_SESSION['usuarios'];
?>