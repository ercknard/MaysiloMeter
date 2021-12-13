<?php
session_start();

$servername = "us-cdbr-east-04.cleardb.com";
$username = "b64914f07d5e65";
$password = "f742c533";
$dbname = "heroku_5142987c57081aa";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

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

    header('location: reg.php');
    // $user = $pdo->prepare("INSERT INTO tblusers ('username', 'password', 'contact') VALUES (?, ?, ?)");
    // // Positional Parameter
    // $user->execute([$username, $password, $contact])
}else{
    $_SESSION['message_type'] = 'danger';
    $_SESSION['message'] = 'Incorrect Code. Please try again!';
    header('location: index.php');
}
?>



