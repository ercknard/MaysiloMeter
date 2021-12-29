<?php
// Initialize the session
session_start();
 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$adminName = $content = $update = "";
$adminName_err = $content_err = $update_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate username
    $input_adminName = trim($_POST["adminName"]);
    if(empty($input_adminName)){
        $adminName_err = "Please enter a username.";
    } elseif(!filter_var($input_adminName, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $adminName_err = "Please enter a valid username.";
    } else{
        $adminName = $input_adminName;
    }
    
    // Validate content
    $input_content = trim($_POST["content"]);
    if(empty($input_content)){
        $content_err = "Please enter the content number.";     
    } else{
        $content = $input_content;
    }

        // Validate content
        $input_update = trim($_POST["update"]);
        $update = $input_update;
    
    // Check input errors before inserting in database
    if(empty($adminName_err) && empty($content_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO announcements (adminName, content, update) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_adminName, $param_content, $param_update);
            
            // Set parameters
            $param_adminName = $adminName;
            $param_content = $content;
            $param_update = $update;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: success.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement22
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
</head>
<body>

<div class="sidenav">
<img class="img-responsive center-block d-block mx-auto" src="/images/floodlogo.png" width="120px" height="120px">
<hr color="white">
<a href="Dashboardini.php">User Details</a>
<a class="highlight" href="Announcements.php">Announcements</a>
<a href="Diagrams.php">Diagrams</a>
<a href="Tables.php">Tables</a>
<hr color="white">
<p>Admin User: <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>,</p>
<a href="../logout.php" class="btn btn-danger pull-center ml-4 mr-4"><i class="fa fa-user-o"></i> Sign Out</a>
</div>

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                    <h4>Admin User : <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>, </h4>
                    <hr color="lightblue" width="100%">
                        <h2 class="pull-left">Announcements      </h2>
                        <a href="../welcome.php" class="btn btn-primary pull-right ml-2">Back</a>
                    </div>

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Author Name</label>
                            <input type="text" name="adminName" placeholder="Enter author name." class="form-control <?php echo (!empty($adminName_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $adminName; ?>">
                            <span class="invalid-feedback"><?php echo $adminName_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Announcement Content</label>
                            <textarea rows="10" type="text" name="content" placeholder="Content will be type here." class="form-control <?php echo (!empty($content_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $content; ?>" required oninvalid="this.setCustomValidity('Post Something here!!')"
  oninput="this.setCustomValidity('')"></textarea>
                            <span class="invalid-feedback"><?php echo $content_err; ?></span>
                        </div>  
                        <div class="form-group">
                        <label>Post Type :<?=$row['update']?></label></br>
                        <input type="radio" name="update" <?=$row['update']=="Announcement" ? "checked" : ""?> value="ANNOUNCEMENT"> <b>Announcement.</b>
                        <br>
                        <input type="radio" name="update" <?=$row['update']=="Article" ? "checked" : ""?> value="ARTICLE"> <b>Article.</b>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Post Announcement">
                    </form>      

                    </div>
            </div>        
        </div>
    </div>
</body>
</html>