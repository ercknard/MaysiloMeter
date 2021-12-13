<?php
session_start();
$code = getRandomCode();
$username = $_POST['username'];
$password =$_POST['password'];
$contact = $_POST['contact'];

// Generate sessions
$_SESSION['otp'] = $code;
$_SESSION['username'] = $username;
$_SESSION['password'] = $password;
$_SESSION['contact'] = $contact;

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

    $message = "From FloodO'Meter Maysilo water level Monitoring System. This is your verification code: ".$vcode;
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
        CURLOPT_HTTPHEADER => array(
        "X-TXTBOX-Auth: 53316f0a4a7326fdad5c18608c9e53d3"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
        echo $response;
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
</head>
<body>
    <div class="container">
        <div class="row justify-content-center align-items-center">
           
            <form method="POST" action="check.php" width="100%">
                <div class="form-group">
                    <label for="code"></label>
                    <input id="code" type="number" name="code">
                </div>
                <input type="submit" value="Verify" class="btn btn-success btn-block">
            </form>
        </div>
    </div>
    
</body>
</html>