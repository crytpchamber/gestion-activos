


<?php
$host="localhost";

$root="root";
$root_password="";


try {
    $dbh = new PDO("mysql:host=$host", $root, $root_password);


    $sql = file_get_contents('./database.sql');
    $sql = str_replace( '?', "\\077", $sql );

    $qr = $dbh->prepare($sql, array( PDO::ATTR_EMULATE_PREPARES => true ));

    $qr->execute() ;
    echo "Import action - 100% successfull";




} catch (PDOException $e) {
    die("DB ERROR: ". $e->getMessage());
}

?>