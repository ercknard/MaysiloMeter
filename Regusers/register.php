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
        
        <form action="sms.php" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Your desired name." class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" required oninvalid="this.setCustomValidity('Enter Your Username here')"
  oninput="this.setCustomValidity('')">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>  
            <div class="form-group">
                <label>Contact Number</label>
                <input type="number" name="contact" placeholder="Enter your 11 digit mobile number." class="form-control <?php echo (!empty($contact_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $contact; ?>" required oninvalid="this.setCustomValidity('Enter Your Contact number here.')"
  oninput="this.setCustomValidity('')" maxlength="11" minlength="11" pattern="\d{11}">
                <span class="invalid-feedback"><?php echo $contact_err; ?></span>
            </div>  
                <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Put at least 6 character password." class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>" required oninvalid="this.setCustomValidity('Enter a 6 character Password.')"
  oninput="this.setCustomValidity('')" minlength="6">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" placeholder="Repeat password." class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>" required oninvalid="this.setCustomValidity('Verify your password here.')"
  oninput="this.setCustomValidity('')" minlength="6">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
                <input value="Register" onclick="matchPassword()" type="submit" class="btn btn-primary btn-block">

                <hr color="lightblue" width="100%">

                <p>If the registration fails. Submit a request to ADMIN by clicking the REQUEST button below. <br> <b> NOTE : All inputs are confidential. </b></p>

                <a href="Request/request.php" class="btn btn-secondary ml-2">REQUEST</a> <a href="Login/login.php" class="btn btn-primary ml-2">Update Contact Number</a>
            </form>
    </div>
    
</body>
</html>