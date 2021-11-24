<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>
    <br> Welcome Admin</h1>
    <p>
        <a href="https://maysilometer.herokuapp.com/Admin/AdminDashboard/Dashboard.html" target="_blank" class="btn btn-primary">Admin Dashboard</a>
        <br>
        <hr>
        <br>
        <a href="register.php" target="_blank" class="btn pull-left">Add new Admin</a><a href="reset-password.php" class="btn btn-primary pull-right">Reset Your Password</a>
        <br>
        <hr>
        <br>
        <a href="logout.php" class="btn btn-danger">Sign Out</a>
    </p>
    <style>
    a.btdas{
            background-image: linear-gradient(to right, #478ac9, #adf6f2);
         }
    </style>
</body>
</html>