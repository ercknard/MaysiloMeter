<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
    session_start();
    require_once('./partials/head.php'); 
    require_once('./db/index.php');

    if(isset($_POST["otp"])){
        $code = $_SESSION["code"];
        $user = $_SESSION["username"];
        $pass = $_SESSION["password"];
        $contact = $_SESSION["contact"];
        if( $code == $_POST["otp"]){
            $insertedUser = $pdo->prepare("INSERT INTO tblusers (username, password, contact) VALUES (?, ?, ?)");
            $insertedUser->execute([$user, md5($pass), $contact]);
            if ($insertedUser->rowCount() > 0) {
                // if user is inserted successfully
                header("Location: ./success.php");
            }
        }
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMS Verification</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 400px; padding: 20px; margin-left: auto; margin-right: auto;}
    </style>
</head>
<body>
<div class="wrapper">
<img class="img-responsive center-block d-block mx-auto" src="/images/floodlogo.png" width="120px" height="120px">

<hr color="lightblue" width="100%">
        <h2>SMS verification</h2>
        <p>Kindly enter the 6 digit otp code to verify your phone number</p>
        <form method="POST">
            <div class="form-group">
                <label role="button" for="otp">Enter OTP sent to your number: </label>
                <input id="otp" name="otp" type="text" class="form-control">
            </div>
            <div class="form-group">
                <input class="btn btn-primary btn-block" type="submit" value="Verify">
            </div>
        </form>
    </div>
</body>
<?php require_once('./partials/script.php'); ?>

</html>