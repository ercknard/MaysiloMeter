


<?php
// ApiCode: TR-FLOOD012526_WYPU2
// ApiPassword: x}]v{#habv

$contact = $_POST["contact"];
$message = $_POST["message"];
$apiCode = "APIMODITO";
$apiPass = "PASSWORDMODITO";
function itexmo($number,$message,$apicode,$passwd){
			$ch = curl_init();
			$itexmo = array('1' => $number, '2' => $message, '3' => $apicode, 'passwd' => $passwd);
			curl_setopt($ch, CURLOPT_URL,"https://www.itexmo.com/php_api/api.php");
			curl_setopt($ch, CURLOPT_POST, 1);
			 curl_setopt($ch, CURLOPT_POSTFIELDS, 
			          http_build_query($itexmo));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			return curl_exec ($ch);
			curl_close ($ch);
}

$result = itexmo($contact, $message, $apiCode, $apiPass);
echo $result;
