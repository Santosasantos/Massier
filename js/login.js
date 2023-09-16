
function showSignUpForm() {
    document.getElementById("login-form").style.display = "none";
    document.getElementById("signup-form").style.display = "block";
    document.getElementById("password-reset-form").style.display = "none";
    document.getElementById("txt").textContent="Sign Up";
  }
  
  function showLoginForm() {
    document.getElementById("signup-form").style.display = "none";
    document.getElementById("login-form").style.display = "block";
    document.getElementById("password-reset-form").style.display = "none";
    document.getElementById("txt").textContent="Log in";
  }

  function showPassResetForm(){
    document.getElementById("login-form").style.display = "none";
    document.getElementById("signup-form").style.display = "none";
    document.getElementById("password-reset-form").style.display = "block";
    document.getElementById("txt").textContent="Password Reset";
  }

  function CreateMessForm() {
    document.getElementById("join-form").style.display = "none";
    document.getElementById("create-form").style.display = "block";
    document.getElementById("txt").textContent="Create new mess";
    document.getElementById("txth4").textContent="You can create a new mess";
  }
  
  function joinMessForm() {
    document.getElementById("create-form").style.display = "none";
    document.getElementById("join-form").style.display = "block";
    document.getElementById("txt").textContent="Join a mess";
    document.getElementById("txth4").textContent="You can join an existing mess";
  }


