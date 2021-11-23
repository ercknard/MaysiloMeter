<?php
    //open connection to mysql db
    $connection = mysqli_connect("us-cdbr-east-04.cleardb.com","b64914f07d5e65","f742c533","heroku_5142987c57081aa") or die("Error " . mysqli_error($connection));

    //fetch table rows from mysql db
    $sql = "select * from tblusers";
    $result = mysqli_query($connection, $sql) or die("Error in Selecting " . mysqli_error($connection));

    //create an array
    $mirmo = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $mirmo[] = $row;
    }
    echo json_encode($mirmo);

    //write to json file
    $fp = fopen('users.json', 'w');
    fwrite($fp, json_encode($mirmo));
    fclose($fp);

    //close the db connection
    mysqli_close($connection);
?>
