
<?php
session_start(); //gagamitin mo lang to kapag mag momodify or mag aaccess ka ng isang session
require_once('../db/index.php'); //database

$_SESSION["username"] = $_POST["username"] ?: '';
$_SESSION["password"] = $_POST["password"] ?: '';
$_SESSION["contact"] = $_POST["contact"] ?: '';

$getUser = $pdo->prepare("SELECT * FROM tblusers WHERE username = ?");
$getUser->execute([$_SESSION["username"]]);

if ($getUser->rowCount() > 0) {
    // if user already exists
    $_SESSION["alert-type"] = "danger";
    $_SESSION["alert-message"] = "User already exists!";
	header("location: ../index.php");
} 
else {
    // magpoproceed kapag all goods
    $_SESSION["code"] = getRandomCode(); //instantiating new value in session

    // Paste niyo to kapag kelangan niyo ng SMS
    $apiCode = "ST-ALFRE973283_L9IHY";
    $apiPass = "p@uyumbg#z";

    //contact number, message, apicode, apipass
    $result = itexmo($_SESSION["contact"], "Verification Code: ".$_SESSION["code"], $apiCode, $apiPass);
	if($result == "0" || $result == 0){
        header("location: ../otp.php");
    }else{
        $_SESSION["alert-type"] = "warning";
        $_SESSION["alert-message"] = "Message was't sent!";
	    header("location: ../index.php");
    }
}

// Randomizer

function getRandomCode() {
    $var ="0123456789";
    srand((double)microtime()*1000000);
    $i = 0;
    $rand_Code = '' ;
        while ($i <= 4) {
            $num = rand() % 10;
            $tmp = substr($var, $num, 1);
            $rand_Code = $rand_Code . $tmp;
            $i++;
        }
    return $rand_Code;
}

function itexmo($number,$message,$apicode,$passwd){
    $ch = curl_init();
    $itexmo = array('1' => $number, '2' => $message, '3' => $apicode, 'passwd' => $passwd);
    curl_setopt($ch, CURLOPT_URL, "https://www.itexmo.com/php_api/api.php");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, 
    http_build_query($itexmo));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    return curl_exec ($ch);
    curl_close ($ch);
}
