<?php

session_start();

if(isset($_POST['btn_delete']){
    // Initialise PDO connection (May need to abstract connection to an include)
    $pdo = new PDO('mysql:host=us-cdbr-east-04.cleardb.com;dbname=heroku_5142987c57081aa', 'b64914f07d5e65', 'f742c533');

    $statement = $pdo->prepare("DELETE FROM tblusers WHERE username = ?");
    $username = $_POST['username_delete'];
    $statement->execute(array($username));

    echo "Deleted.";
}