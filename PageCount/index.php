<?php  


//open connection to mysql db
$con = mysqli_connect("us-cdbr-east-04.cleardb.com","b64914f07d5e65","f742c533","heroku_5142987c57081aa") or die("Error " . mysqli_error($con));

$sql = "select count(*) AS NumberOFdata from tblusers";
$result=mysqli_query($con,"SELECT COUNT(*) as total from tblusers");
$data=mysqli_fetch_assoc($result);
echo $data['total'];

$limit = 10;
$user_count = mysqli_fetch_row($result);   // say total count 9  
$total_records = $user_count[0];   //9
$total_pages = ceil($total_records / $limit);
echo $total_pages['total'];    // 9/3=  3


    //close the db connections
    mysqli_close($con);

    ?>

