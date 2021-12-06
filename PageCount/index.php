<?php  


//open connection to mysql db
$con = mysqli_connect("us-cdbr-east-04.cleardb.com","b64914f07d5e65","f742c533","heroku_5142987c57081aa") or die("Error " . mysqli_error($con));

$all_data=mysqli_query($con,"select count(id) from tblusers");
$user_count = mysqli_fetch_row($all_data);   // say total count 9  
$total_records = $user_count[0];   //9
$total_pages = ceil($total_records / $limit);    // 9/3=  3

    //close the db connections
    mysqli_close($connection);

    ?>