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
$contact = $_SESSION['contact'];

if($inputtedCode == $correctCode){
    $sql = "INSERT INTO tblusers (username, contact)
    VALUES ('".$username."','".$contact."')";
    
    if ($conn->query($sql) === TRUE) {
        $_SESSION['message_type'] = 'success';
        $_SESSION['message'] = 'User has been inserted successfully!';
    } else {
        $_SESSION['message_type'] = 'warning';
        $_SESSION['message'] = 'Something is wrong!';
    }

    header('location: reg.php');
}else{
    $_SESSION['message_type'] = 'danger';
    $_SESSION['message'] = 'Incorrect Code. Please try again!';
    header('location: reg.php');
}
?>