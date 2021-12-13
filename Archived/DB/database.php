<?php

$DB_SERVER = "mysql:host=localhost;"; 
$DB_NAME = "dbname=sample"; 
$DB_USERNAME = "root"; 
$DB_PASSWORD = ""; 

try{
    $pdo = new PDO($DB_SERVER . $DB_NAME, $DB_USERNAME, $DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // $stmt = $pdo->prepare("SELECT * FROM tblusers");
    // $stmt->execute();
    
    // $count = $stmt->rowCount();
    // // echo $count;
    // $rows = $stmt->fetchAll(PDO::FETCH_NUM);
    // if($count > 0){
    //     foreach($rows as $row){
    //         echo $row[1]."<br/>";
    //     }
    // }else{
    //     echo $count;
    // }

    
}catch(PDOException $e){
    echo $e->getMessage();
}



?>

