<?php
session_start();
$code = getRandomCode();
$username = $_POST['username'];
$contact = $_POST['contact'];
$pssword = $_POST['password'];

// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
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
            $contact_err = "Please enter a contact number.";     
        } elseif(strlen(trim($_POST["contact"])) < 11){
            $contact_err = "Must enter 11 digit contact number";
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
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}

// Generate sessions
$_SESSION['otp'] = $code;
$_SESSION['username'] = $username;
$_SESSION['contact'] = $contact;
$_SESSION['password'] = $password;

// Randomizer
function getRandomCode() {
    $var ="0123456789";
    srand((double)microtime()*1000000);
    $i = 0;
    $rand_Code = '' ;
        while ($i <= 5) {
            $num = rand() % 10;
            $tmp = substr($var, $num, 1);
            $rand_Code = $rand_Code . $tmp;
            $i++;
        }
    return $rand_Code;
}
// Send SMS to User
sendSMS($contact, $code);
function sendSMS($cnumber, $vcode){
    $curl = curl_init();

    $message = "From Maysilo Flood O' Meter. This is your 6 digit verification code:  ".$vcode;
    $num = $cnumber;

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://ws-live.txtbox.com/v1/sms/push",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => false,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => array('message' => $message, 'number' => $num ),

        // Insert your API here
        // 53316f0a4a7326fdad5c18608c9e53d3
        CURLOPT_HTTPHEADER => array(
        "X-TXTBOX-Auth: 4cda15eaa2c11f414b8627e0489805ed"
        ),
        ));


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

        <?php if(isset($_SESSION['message'])): ?>
            <div class="alert alert-<?= $_SESSION['message_type'] ?>" role="alert">
                <?= $_SESSION['message'] ?>
            </div>
        <?php endif ?>  
        
            <form method="POST" action="check.php" width="100%">
                <div class="form-group">
                    <label for="code"> OTP NUMBER: </label>
                    <br>
                    <input id="code" type="number" name="code" class="form-control">
                </div>
                <hr>
                <input type="submit" value="Verify" class="btn btn-primary btn-block">
            </form>
    </div> 
</body>
</html>