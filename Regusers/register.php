<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
        
        <h2>User Registration</h2>
        <p>If you wish to have flood alerts through sms kindly fill out the form.</p>

        <?php if(isset($_SESSION['message'])): ?>
            <div class="alert alert-<?= $_SESSION['message_type'] ?>" role="alert">
                <?= $_SESSION['message'] ?>
            </div>
        <?php endif ?>  
        
            <form method="POST" action="sms.php" width="100%">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>  
            <div class="form-group">
                <label>Contact</label>
                <input type="text" name="contact" class="form-control <?php echo (!empty($contact_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $contact; ?>">
                <span class="invalid-feedback"><?php echo $contact_err; ?></span>
            </div>  
                <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
                <input value="Register" type="submit" class="btn btn-primary btn-block">

                <hr color="lightblue" width="100%">

                <p>If the registration fails. Submit a request to ADMIN by clicking the REQUEST button below. <br> <b> NOTE : All inputs are confidential. </b></p>

                <a href="Request/request.php" class="btn btn-secondary ml-2">REQUEST</a> <a href="Login/login.php" class="btn btn-primary ml-2">Update Contact Number</a>
            </form>
    </div>
</body>
</html>