<?php  


//open connection to mysql db
$con = mysqli_connect("us-cdbr-east-04.cleardb.com","b64914f07d5e65","f742c533","heroku_5142987c57081aa") or die("Error " . mysqli_error($con));

$limit = 10;
/*$result=mysqli_query($con,"SELECT COUNT(*) as total from tblusers");
$user_count = mysqli_fetch_row($result);   // say total count 9  
$total_records = $user_count[0];   //9
$total_pages = ceil($total_records / $limit);*/

  //set  Number of entries to show in a page.
    // Look for a GET variable page if not found default is 1.        
    if (isset($_GET["page"])) {    
    $page  = $_GET["page"];    
    }    
    else { $page=1;    
    } 
    //determine the sql LIMIT starting number for the results on the displaying page  
    $page_index = ($page-1) * $limit;      // 0

    $result=mysqli_query($con,"select contact from tblusers limit $page_index, $limit");
    $cactus = "";
    if ($result->num_rows > 0) {
       $count = 0;
       while($row = $result->fetch_assoc()) {

$count++;

                if ($count == $result->num_rows) {

                    $cactus .= $row["contact"];
                } else {
                    $cactus .= $row["contact"]."|"; 
                 }
        }

    } else {
        echo "0 results";
    }
    
 /*   if ($page == 1) {
        echo "#" . $total_pages . "|";
        echo $cactus . "*";   // 9/3=  3
        }
        else { */
            echo "#" . $cactus . "*";
       /* } */

        mysqli_close($con);
?>