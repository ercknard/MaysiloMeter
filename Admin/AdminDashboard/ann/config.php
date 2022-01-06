<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'us-cdbr-east-04.cleardb.com');
define('DB_USERNAME', 'b64914f07d5e65');
define('DB_PASSWORD', 'f742c533');
define('DB_NAME', 'heroku_5142987c57081aa');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>