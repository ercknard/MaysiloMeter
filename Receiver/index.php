

<?php  


//open connection to mysql db
$con = mysqli_connect("us-cdbr-east-04.cleardb.com","b64914f07d5e65","f742c533","heroku_5142987c57081aa") or die("Error " . mysqli_error($con));

    $limit = 10;  //set  Number of entries to show in a page.
    // Look for a GET variable page if not found default is 1.        
    if (isset($_GET["page"])) {    
    $page  = $_GET["page"];    
    }    
    else { $page=1;    
    } 
    //determine the sql LIMIT starting number for the results on the displaying page  
    $page_index = ($page-1) * $limit;      // 0

    $result=mysqli_query($con,"select contact from tblusers limit $page_index, $limit");
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $meow = $row["contact"]. "|";
            $cat = preg_replace("/\|$/", "", $meow);
        }

        echo $cat;
    } else {
        echo "0 results";
    }
    
    //$mirmo = array();
    //while($row=mysqli_fetch_assoc($All_Users))
    //{
    //   $mirmo[] = $row;
    //}
    //header('Content-Type: txt; charset=utf-8');
    //echo json_encode($mirmo);   

        //close the db connections
        mysqli_close($con);
?>
