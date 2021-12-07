<?php 
session_start();
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 500px; padding: 20px; margin-left: auto; margin-right: auto;}        
/* Style all input fields */

/* Style the container for inputs */
.container {
  background-color: #f1f1f1;
  padding: 20px;
}

/* The message box is shown when the user clicks on the password field */
#message12 {
  display:none;
  border: 1px solid blue;
  color: #000;
  position: relative;
  padding: 10px;
  margin-top: 10px;
  margin-bottom: 10px;
}

#message12 p {
  padding-left: 35px;
}

/* Add a green text color and a checkmark when the requirements are right */
.valid {
  color: green;
}

.valid:before {
  position: relative;
  left: -35px;
  content: "✔";
}

/* Add a red text color and an "x" when the requirements are wrong */
.invalid {
  color: red;
}

.invalid:before {
  position: relative;
  left: -35px;
  content: "✖";
}
    </style>
   
</head>
<body>
<div class="wrapper">
<img class="img-responsive center-block d-block mx-auto" src="/images/floodlogo.png" width="120px" height="120px">

<hr color="lightblue" width="100%">   
        
        <h2>User Registration</h2>
        <p>If you wish to have flood alerts through sms kindly fill out the form.</p>

        <?php if(isset($_SESSION['message'])): ?>
            <div class="alert alert-<?= $_SESSION['message_type'] ?>" role="alert">
                <?= $_SESSION['message'] ?>
            </div>
        <?php endif ?>  
        
        <form action="sms.php" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Your desired name." class="form-control" required oninvalid="this.setCustomValidity('Enter Your Username here')"
  oninput="this.setCustomValidity('')">
            </div>  
            <div class="form-group">
                <label>Contact Number</label>
                <input type="number" name="contact" placeholder="Enter your 11 digit mobile number."  class="form-control" required oninvalid="this.setCustomValidity('Enter Your Contact number here.')"
  oninput="this.setCustomValidity('')" maxlength="11" minlength="11" pattern="\d{11}">
            </div>  
                <div class="form-group">
                <label>Password</label>
                <input type="password" id="password" name="password" placeholder="Put a valid password." class="form-control" required oninvalid="this.setCustomValidity('Enter a valid password.')"
  oninput="this.setCustomValidity('')" minlength="6" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" >
            </div>
            <div id="message12">
            <b>Password must contain the following:</b>
            <hr color="lightblue" width="100%">
            <p id="letter" class="invalid">A lowercase letter 
            <p id="capital" class="invalid">A capital (uppercase) letter
            <p id="number" class="invalid">A number
            <p id="length" class="invalid">Minimum of 6 characters</p>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Repeat password." class="form-control" required oninvalid="this.setCustomValidity('Please make sure your passwords match.')"
  oninput="this.setCustomValidity('')" minlength="6" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" >
            </div>
                <input value="Register" type="submit" class="btn btn-primary btn-block">

                <hr color="lightblue" width="100%">

                <p>If the registration fails. Submit a request to ADMIN by clicking the REQUEST button below. <br> <b> NOTE : All inputs are confidential. </b></p>

                <a href="Request/request.php" class="btn btn-secondary ml-2">REQUEST</a> <a href="Login/login.php" class="btn btn-primary ml-2">Update Contact Number</a>
            </form>
    </div>
<script>
var myInput = document.getElementById("password");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message12").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message12").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}
</script>
</body>
</html>