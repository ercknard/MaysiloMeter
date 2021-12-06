
<?php

//open connection to mysql db
$connection = mysqli_connect("us-cdbr-east-04.cleardb.com","b64914f07d5e65","f742c533","heroku_5142987c57081aa") or die("Error " . mysqli_error($connection));

//fetch table rows from mysql db
$sql = "select * from tblusers";
$result = mysqli_query($connection, $sql) or die("Error in Selecting " . mysqli_error($connection));

$row_count = mysqli_num_rows($result);
// free the result set as you don't need it anymore
mysqli_free_result($result);

$page_count = 0;
if (0 === $row_count) {  
    // maybe show some error since there is nothing in your table
} else {
   // determine page_count
   $page_count = (int)ceil($row_count / $items_per_page);
   // double check that request page is in range
   if($page > $page_count) {
        // error to user, maybe set page to 1
        $page = 1;
   }
}

// determine page number from $_GET
$page = 1;
if(!empty($_GET['page'])) {
    $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
    if(false === $page) {
        $page = 1;
    }
}

// set the number of items to display per page
$items_per_page = 10;

// build query
$offset = ($page - 1) * $items_per_page;
$sql = "SELECT * FROM tblusers LIMIT " . $offset . "," . $items_per_page;


// later when outputting page, you can simply work with $page and $page_count to output links
// for example
for ($i = 1; $i <= $page_count; $i++) {
   if ($i === $page) { // this is current page
       echo 'Page ' . $i . '<br>';
   } else { // show link to other page   
       echo '<a href="/index.php?page=' . $i . '">Page ' . $i . '</a><br>';
   }
} 
?>
