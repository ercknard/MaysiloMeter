<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login.php");
    exit;
}
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
</head>
<body>

<div class="sidenav">
<img class="img-responsive center-block d-block mx-auto" src="/images/floodlogo.png" width="120px" height="120px">
<hr color="white">
<a href="Dashboardini.php">User Details</a>
<a href="Request.php">Request</a>
<a href="Announcements.php">Announcements</a>
<a class="highlight" href="Diagrams.php">Diagrams</a>
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
                        <h2 class="pull-left">Diagrams      </h2>
                        <a href="../welcome.php" class="btn btn-primary pull-right ml-2">Back</a>
                    </div>

                    <iframe width="400px" height="400px" frameborder="0" src=" https://industrial.ubidots.com/app/dashboards/public/widget/p3U4z_iXN9hVQW8cNvudfDosppSxQmH3d40GjKWcAuY?embed=true"></iframe>
                        <iframe width="400px" height="400px" frameborder="0" src=" https://industrial.ubidots.com/app/dashboards/public/widget/ZfaeOHgpncrcSSDQ78hQyjIe-Q6TSKSh_O4BGogxKbk?embed=true"></iframe>
                    

                    </div>
            </div>        
        </div>
    </div>
</body>
</html>