
<?php

$dbserver = "mysql:host=localhost;";
$dbname = "dbname=sample";
$dbusername = "root";
$dbpassword = "";

try{
    $pdo = new PDO($dbserver . $dbname, $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
}catch(PDOException $e){
    echo $e->getMessage();
}

?>
