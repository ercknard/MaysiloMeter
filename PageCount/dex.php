<?php  


//open connection to mysql db
$con = mysqli_connect("us-cdbr-east-04.cleardb.com","b64914f07d5e65","f742c533","heroku_5142987c57081aa") or die("Error " . mysqli_error($con));

$limit = 10;
$result=mysqli_query($con,"SELECT COUNT(*) as total from tblusers");
$user_count = mysqli_fetch_row($result);  
$total_records = $user_count[0];
$total_pages = ceil($total_records / $limit);

$mirmo = array($total_pages);
while($row=mysqli_fetch_assoc($mirmo))


header('Content-Type: application/json; charset=utf-8');
echo json_encode($mirmo);   // 9/3=  3


    //close the db connections
    mysqli_close($con);

    ?>

