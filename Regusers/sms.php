
<?php
session_start();
$code = getRandomCode();
$username = $_POST['username'];
$contact = $_POST['contact'];
$password = $_POST['password'];



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