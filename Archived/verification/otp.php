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
                header("Location: ./index.php");
            }
        }
    }
    ?>
    <title>Verification</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body class="bg-light">
    <h1 class='mt-5 text-center'>Verification</h1>
    <div class="row justify-content-center align-items-center mt-5">
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