<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["userloggedin"]) || $_SESSION["userloggedin"] !== true){
    unset($_SESSION['userloggedin']);
    exit;

    // Include config file
require_once "config.php";

}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Contact Number</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 400px; padding: 20px; margin-left: auto; margin-right: auto;}
    </style>
</head>
<body>
<div class="wrapper">
<img class="img-responsive center-block d-block mx-auto" src="/images/floodlogo.png" width="120px" height="120px">

<hr color="lightblue" width="100%"> 
        <h2>Change number</h2>
        <p>Please fill out this form to change your contact number.<b> NOTE : you will be asked for new verification code. Thank you! </b></p>
        <p>Welcome: <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>,</p>
        <p>Your current number: <b><?php echo htmlspecialchars($_SESSION["contact"]); ?></b>,</p>
        <form action="controllers/checkexists.php" method="post">


            <div class="form-group">
                <label>New contact number</label>
                <input type="text" name="contact" placeholder="+63xxxxxxxxxx"  class="form-control" required oninvalid="this.setCustomValidity('Enter Your Contact number here.')"
  oninput="this.setCustomValidity('')" maxlength="13" minlength="13">
            </div>
            <div class="form-group">
                <label>Confirm contact number</label>
                <input type="text" name="confirm_contact" placeholder="+63xxxxxxxxxx"  class="form-control" required oninvalid="this.setCustomValidity('Enter Your Contact number here.')"
  oninput="this.setCustomValidity('')" maxlength="13" minlength="13">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a class="btn btn-danger ml-2" href="logout.php">Sign out</a>
            </div>
        </form>
        <a href="unregister.php" class="btn btn-primary" value="Unregister User">un </a>
    </div>    
</body>
</html>