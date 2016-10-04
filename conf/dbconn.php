<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 10/1/2016
 * Time: 11:22 AM
 */

$servername = "localhost";
$username = "root";
$password = "";

try {
    $dbh = new PDO("mysql:host=$servername;dbname=myDB", $username, $password);
    // set the PDO error mode to exception
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}

?>