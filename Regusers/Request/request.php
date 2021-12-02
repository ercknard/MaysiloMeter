
<?php
// Include config file
require_once "../../Admin/config.php";
 
// Define variables and initialize with empty values
$username = $contact = $comments = "";
$username_err = $contact_err = $comments_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate username
    $input_username = trim($_POST["username"]);
    if(empty($input_username)){
        $username_err = "Please enter a username.";
    } elseif(!filter_var($input_username, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $username_err = "Please enter a valid username.";
    } else{
        $username = $input_username;
    }
    
    // Validate contact
    $input_contact = trim($_POST["contact"]);
    if(empty($input_contact)){
        $contact_err = "Please enter the contact number.";     
    } elseif(!ctype_digit($input_contact)){
        $contact_err = "Please enter a positive integer value.";
    } else{
        $contact = $input_contact;
    }

        // Validate contact
        $input_comments = trim($_POST["comments"]);
        $comments = $input_comments;
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($contact_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO request (username, contact, comments) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_contact, $param_comments);
            
            // Set parameters
            $param_username = $username;
            $param_contact = $contact;
            $param_comments = $comments;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: success.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Request</title>
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
                    <h2 class="mt-5">Request Form</h2>
                    <p>Please fill up this REQUEST form to submit your credentials to ADMIN. An ADMIN will register you manually.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                            <span class="invalid-feedback"><?php echo $username_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Contact</label>
                            <input type="text" name="contact" class="form-control <?php echo (!empty($contact_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $contact; ?>">
                            <span class="invalid-feedback"><?php echo $contact_err;?></span>
                        </div>
                        <div class="form-group">
                        <label>Purpose: <?=$row['comments']?></label></br>
                        <input type="radio" name="comments" <?=$row['comments']=="for Registration" ? "checked" : ""?> value="REGISTRATION"> <B>for Registration.</B>
                        <BR>
                        <input type="radio" name="comments" <?=$row['comments']=="to Update" ? "checked" : ""?> value="UPDATE"> <B>to Update.</B>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="../register.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>