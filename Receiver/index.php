<?php
header("Content-Type: application/json");

// Collect what you need in the $data variable.

$json = json_encode($data);
if ($json === false) {
    // Avoid echo of empty string (which is invalid JSON), and
    // JSONify the error message instead:
    $json = json_encode(["jsonError" => json_last_error_msg()]);
    if ($json === false) {
        // This should not happen, but we go all the way now:
        $json = '{"jsonError":"unknown"}';
    }
    // Set HTTP response status code to: 500 - Internal Server Error
    http_response_code(500);
}
echo $json;
?>
<?php

    //open connection to mysql db
    $connection = mysqli_connect("us-cdbr-east-04.cleardb.com","b64914f07d5e65","f742c533","heroku_5142987c57081aa") or die("Error " . mysqli_error($connection));

    //fetch table rows from mysql db
    $sql = "select * from tblusers";
    $result = mysqli_query($connection, $sql) or die("Error in Selecting " . mysqli_error($connection));

    //create an array1
    $mirmo = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $mirmo[] = $row; 
    }
    echo json_encode($mirmo);
    
    //close the db connections
    mysqli_close($connection);
?>
<?php

if(isset($_SERVER["HTTP_ORIGIN"]))
{
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
}
else
{
    header("Access-Control-Allow-Origin: *");
}

header("Access-Control-Allow-Credentials: true");
header("Access-Control-Max-Age: 600");

if($_SERVER["REQUEST_METHOD"] == "OPTIONS")
{
    if (isset($_SERVER["HTTP_ACCESS_CONTROL_REQUEST_METHOD"]))
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");

    if (isset($_SERVER["HTTP_ACCESS_CONTROL_REQUEST_HEADERS"]))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}

?>