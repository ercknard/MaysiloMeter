<?php
session_start();
require_once('database.php');
$inputtedCode = $_POST['code'];

$correctCode = $_SESSION['otp'];
$username = $_SESSION['username'];
$password =$_SESSION['password'];
$contact = $_SESSION['contact'];

if($inputtedCode == $correctCode){
    $user = $pdo->prepare("INSERT INTO tblusers (username, password, contact) VALUES (:user, :pass, :contact)");
    // Implicit Binding
    $user->execute([
        ":pass" => $password,
        ":user" => $username,
        ":contact" => md5($contact),
    ]);

    if($user->rowCount() > 0){
        $_SESSION['message_type'] = 'success';
        $_SESSION['message'] = 'User has been inserted successfully!';
    }else{
        $_SESSION['message_type'] = 'warning';
        $_SESSION['message'] = 'Something is wrong!';
    }

    header('location: index.php');
    // $user = $pdo->prepare("INSERT INTO tblusers ('username', 'password', 'contact') VALUES (?, ?, ?)");
    // // Positional Parameter
    // $user->execute([$username, $password, $contact])
}else{
    $_SESSION['message_type'] = 'danger';
    $_SESSION['message'] = 'Incorrect Code. Please try again!';
    header('location: index.php');
}
?>



