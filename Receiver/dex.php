
<?php

//open connection to mysql db
$connection = mysqli_connect("us-cdbr-east-04.cleardb.com","b64914f07d5e65","f742c533","heroku_5142987c57081aa") or die("Error " . mysqli_error($connection));

//fetch table rows from mysql db
$sql = "select * from tblusers";
$result = mysqli_query($connection, $sql) or die("Error in Selecting " . mysqli_error($connection));

//create an array11
$mirmo = array();
while($row =mysqli_fetch_assoc($result))
{
    $mirmo[] = $row; 
}
header('Content-Type: application/json; charset=utf-8');
echo json_encode($mirmo);

//close the db connections
mysqli_close($connection);
?>