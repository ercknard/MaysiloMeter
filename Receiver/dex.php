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

    $All_Users=mysqli_query($con,"select * from tblusers limit $page_index, $limit");
    while($row=mysqli_fetch_array($All_Users))
    {
        //show  data in table or where you want..
    }
    $all_data=mysqli_query($con,"select * from tblusers");
    $user_count = mysqli_fetch_row($all_data);   // say total count 9  
    $total_records = $user_count[0];   //9
    $total_pages = ceil($total_records / $limit);    // 9/3=  3

    if($page >= 2){
        echo "<a href='dex.php?page=".($page-1)."' class='btn 
     customBtn2'>Previous</a>";
      }
    
    if($page<$total_pages) {
        echo "<a href='dex.php?page=".($page+1)."' class='btn customBtn2'>Next</a>";   
    }       
?>