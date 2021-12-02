<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$new_contact = $confirm_contact = "";
$new_contact_err = $confirm_contact_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new contact
    if(empty(trim($_POST["new_contact"]))){
        $new_contact_err = "Please enter the new contact.";     
    } elseif(strlen(trim($_POST["new_contact"])) < 11){
        $new_contact_err = "contact must have atleast 6 characters.";
    } else{
        $new_contact = trim($_POST["new_contact"]);
    }
    
    // Validate confirm contact
    if(empty(trim($_POST["confirm_contact"]))){
        $confirm_contact_err = "Please confirm the contact.";
    } else{
        $confirm_contact = trim($_POST["confirm_contact"]);
        if(empty($new_contact_err) && ($new_contact != $confirm_contact)){
            $confirm_contact_err = "contact did not match.";
        }
    }
        
    // Check input errors before updating the database
    if(empty($new_contact_err) && empty($confirm_contact_err)){
        // Prepare an update statement
        $sql = "UPDATE tblusers SET contact = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_contact, $param_id);
            
            // Set parameters
            $param_contact = $new_contact;
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // contact updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: login.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>

<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM tblusers WHERE id = ?";
    
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
                $contact = $row["contact"];
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
    <title>Reset contact</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; margin-left: auto; margin-right: auto;}
    </style>
</head>
<body>
    <div class="wrapper">
    <img class="img-responsive center-block d-block mx-auto" src="/images/floodlogo.png" width="120px" height="120px">

<hr color="lightblue" width="100%">
        <h2>Reset contact</h2>
        <p>Please fill out this form to reset your contact.</p>
        <p>Welcome : <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>, </p>
        <p>Current Number : <p><b><?php echo $row["contact"]; ?></b></p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group">
                <label>New contact</label>
                <input type="text" name="new_contact" class="form-control <?php echo (!empty($new_contact_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_contact; ?>">
                <span class="invalid-feedback"><?php echo $new_contact_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm contact</label>
                <input type="text" name="confirm_contact" class="form-control <?php echo (!empty($confirm_contact_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $confirm_contact_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a class="btn btn-link ml-2" href="logout.php">Sign out</a>
            </div>
        </form>
    </div>    
</body>
</html>