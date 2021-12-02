<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Success</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 400px; padding: 20px; margin-left: auto; margin-right: auto;}
    </style>
</head>
<body>
<div class="wrapper">
<img class="img-responsive center-block d-block mx-auto" src="/images/floodlogo.png" width="120px" height="120px">

<hr color="lightblue" width="100%">
                    <h2>Change number Submission Result :</h2>
                    <p>Your request is submitted successfully, double check if your number has been updated</p>
                    <p>Welcome: <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>,</p>
                    <p>Your updated number: <b><?php echo htmlspecialchars($_SESSION["contact"]); ?></b>,</p>
                    <a class="btn btn-danger ml-2" href="logout.php">Sign out</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>