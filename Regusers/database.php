<?php
$servername = "us-cdbr-east-04.cleardb.com";
$username = "b64914f07d5e65";
$password = "f742c533";
$dbname = "heroku_5142987c57081aa";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

$sql = "ALTER TABLE tblusers
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6";

if($conn->query($sql) === TRUE) {
  echo "Table successfully updated";
} else {
  echo "Error updating table: " . $conn->error;
}
?>
