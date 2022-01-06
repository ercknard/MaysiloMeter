<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login.php");
    exit;
}
?>
<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "../config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM announcements WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $adminName = $row["adminName"];
                $content = $row["content"];
                $updates = $row["updates"];
                $created_at = $row["created_at"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Announcement</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 850px;
            margin-left: 250px;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>

<style>
body {
  font-family: "Lato", sans-serif;
}

.sidenav {
  height: 100%;
  width: 200px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #1AA7EC;
  overflow-x: hidden;
  padding-top: 20px;
}

.sidenav a {
  padding: 6px 6px 6px 32px;
  text-decoration: none;
  font-size: 20px;
  color: #ffffff;
  display: block;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.main {
  margin-left: 200px; /* Same as the width of the sidenav */
}

.highlight {
    background-color: #8cd3ff;
}

.sidenav p{
    text-align: center;
    color: #ffffff;
}
@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>
</head>
<body>

<div class="sidenav">
<img class="img-responsive center-block d-block mx-auto" src="/images/floodlogo.png" width="120px" height="120px">
<hr color="white">
<a  href="Dashboardini.php">User Details</a>
<a class="highlight" href="../Announcements.php">Announcements</a>
<a href="../Diagrams.php">Diagrams</a>
<a href="../Tables.php">Tables</a>
<hr color="white">
<p>Admin User: <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>,</p>
<a href="../../logout.php" class="btn btn-danger pull-center ml-4 mr-4"><i class="fa fa-user-o"></i> Sign Out</a>
</div>

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                <div class="mt-5 mb-3 clearfix">
                <h4>Admin User : <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>, </h4>

<hr color="lightblue" width="100%">
                    <h1 class="mt-5 mb-3">View Announcements</h1>
                    <div class="form-group">
                        <label>Content</label>
                        <p><b><?php echo $row["content"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Author</label>
                        <p><b><?php echo $row["adminName"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Post Type</label>
                        <p><b><?php echo $row["updates"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Time Created</label>
                        <p><b><?php echo $row["created_at"]; ?></b></p>
                    </div>
                    <p><a href="annLanding.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>