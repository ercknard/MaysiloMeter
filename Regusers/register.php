<?php 
session_start();
?>
<?php
// Define variables and initialize with empty values
$username = $contact = $password = $confirm_password = "";
$username_err = $contact_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM tblusers WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);


            if(mysqli_stmt_num_rows($stmt) == 1){
                $username_err = "This username is already taken.";
            } else{
                $username = trim($_POST["username"]);
            }
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
}

    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    

    // Validate password
    if(empty(trim($_POST["contact"]))){
        $contact_err = "Please enter a contact.";     
    } elseif(strlen(trim($_POST["contact"])) < 11){
        $contact_err = "Contact must have atleast 11 characters.";
    } else{
        $contact = trim($_POST["contact"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
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
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 400px; padding: 20px; margin-left: auto; margin-right: auto;}
    </style>
    <script>
     var check = function() {
      if (document.getElementById('password').value ==
          document.getElementById('confirm_password').value) {
          document.getElementById('message').style.color = 'green';
          document.getElementById('message').innerHTML = 'matching';
      } else {
      		document.getElementById('message').style.color = 'red';
          document.getElementById('message').innerHTML = 'not matching';
      }
  }
</script>
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
  oninput="this.setCustomValidity('')" minlength="6" onkeyup='check();'>
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" placeholder="Repeat password." class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>" required oninvalid="this.setCustomValidity('Verify your password here.')"
  oninput="this.setCustomValidity('')" minlength="6" onkeyup='check();'>
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