var passwords = document.getElementById("password")
  , confirm_passwords = document.getElementById("confirm_password");

function validatePassword(){
  if(passwords.value != confirm_passwords.value) {
    confirm_passwords.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_passwords.setCustomValidity('');
  }
}

passwords.onchange = validatePassword;
confirm_passwords.onkeyup = validatePassword;