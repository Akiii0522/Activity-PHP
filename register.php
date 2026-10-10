<?php
require 'functions.php';

// define variables and set to empty values
$username = $email = $password = $confirmPassword = "";
$usernameErr = $emailErr = $passwordErr = $confirmErr = "";
$ok = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $ok = true;
  $username = test_input($_POST["username"]);
  $email = test_input($_POST["email"]);
  $password = $_POST["password"];
  $confirmPassword = $_POST["confirmPassword"];

  // username: 5-20 characters, letters and numbers only
  if ($username == "") {
    $usernameErr = "Username is required.";
    $ok = false;
  } elseif (!preg_match("/^[A-Za-z0-9]{5,20}$/", $username)) {
    $usernameErr = "Username must be 5-20 characters, letters and numbers only.";
    $ok = false;
  }

  // email: required and must be well-formed
  if ($email == "") {
    $emailErr = "Email is required.";
    $ok = false;
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $emailErr = "Please enter a valid email address (e.g., name@example.com).";
    $ok = false;
  }

  // password: at least 8 characters, a number and a special character
  if ($password == "") {
    $passwordErr = "Password is required.";
    $ok = false;
  } elseif (!preg_match("/^.{8,}$/", $password)) {
    $passwordErr = "Password must contain at least 8 characters.";
    $ok = false;
  } elseif (!preg_match("/[0-9]/", $password)) {
    $passwordErr = "Password must include at least one number.";
    $ok = false;
  } elseif (!preg_match("/[^A-Za-z0-9\s]/", $password)) {
    $passwordErr = "Password must include at least one special character.";
    $ok = false;
  }

  // confirm password: must match
  if ($confirmPassword == "") {
    $confirmErr = "Please confirm your password.";
    $ok = false;
  } elseif ($confirmPassword != $password) {
    $confirmErr = "Passwords do not match.";
    $ok = false;
  }
}

// values used by header.php
$title = "Register Page";
$css = "Register.css";
$bodyClass = "login-page d-flex justify-content-center align-items-center cinzel";

include 'header.php';
?>

    <div class="card login-card bg-dark bg-opacity-25 border border-white border-opacity-50 rounded-4 shadow">
        <div class="card-body p-4 text-white">

            <div class="text-center mb-0">
                <img class="img-fluid login-logo" src="Image/darkvengeance-logo.png" alt="DarkVengeance Logo">
            </div>

            <h3 class="text-center mb-0">Register</h3>

            <form id="registerForm" method="post" action="" novalidate>

                <!-- USERNAME PART -->
                <div class="mb-3">
                    <label for="username" class="visually-hidden">Username</label>
                    <div class="input-group login-field-wrapper rounded-pill overflow-hidden bg-opacity-75 <?php if ($usernameErr != "") echo "validation-invalid"; ?>" style="background-color: #c8bcf5;">
                        <input type="text" name="username" class="form-control bg-transparent border-0 px-4" id="username" placeholder="Create Username" value="<?php echo $username; ?>">
                        <span class="input-group-text bg-transparent border-0 pe-4">
                          <i class="bi bi-person-fill y"></i>
                        </span>
                    </div>
                    <div class="field-error"><?php echo $usernameErr; ?></div>
                    <div class="form-text field-help">Use 5–20 characters: letters and numbers only (e.g., Shadow123).</div>
                </div>

                <!-- EMAIL PART -->
                <div class="mb-3">
                    <label for="email" class="visually-hidden">Email</label>
                    <div class="input-group login-field-wrapper rounded-pill overflow-hidden bg-opacity-75 <?php if ($emailErr != "") echo "validation-invalid"; ?>" style="background-color: #c8bcf5;">
                        <input type="text" name="email" class="form-control bg-transparent border-0 px-4" id="email" placeholder="Enter Your Email" value="<?php echo $email; ?>">
                        <span class="input-group-text bg-transparent border-0 pe-4">
                          <i class="bi bi-envelope-fill "></i>
                        </span>
                    </div>
                    <div class="field-error"><?php echo $emailErr; ?></div>
                    <div class="form-text field-help">Enter a valid email address (e.g., name@example.com).</div>
                </div>

                <!-- PASSWORD PART -->
                <div class="mb-3">
                    <label for="password" class="visually-hidden">Password</label>
                    <div class="input-group login-field-wrapper rounded-pill overflow-hidden bg-opacity-75 <?php if ($passwordErr != "") echo "validation-invalid"; ?>" style="background-color: #c8bcf5;">
                        <input type="password" name="password" id="password" class="form-control bg-transparent border-0 px-4" placeholder="Create Your Password">
                        <span class="input-group-text bg-transparent border-0 pe-4">
                            <i class="bi bi-lock-fill"></i>
                        </span>
                    </div>
                    <div class="field-error"><?php echo $passwordErr; ?></div>
                    <div class="form-text field-help">Use at least 8 characters, including a number and a special character.</div>
                </div>

                <!-- CONFIRM PASSWORD PART -->
                <div class="mb-3">
                    <label for="confirmPassword" class="visually-hidden">Confirm password</label>
                    <div class="input-group login-field-wrapper rounded-pill overflow-hidden bg-opacity-75 <?php if ($confirmErr != "") echo "validation-invalid"; ?>" style="background-color: #c8bcf5;">
                        <input type="password" name="confirmPassword" id="confirmPassword" class="form-control bg-transparent border-0 px-4" placeholder="Confirm Your Password">
                        <span class="input-group-text bg-transparent border-0 pe-4">
                            <i class="bi bi-shield-fill-check"></i>
                        </span>
                    </div>
                    <div class="field-error"><?php echo $confirmErr; ?></div>
                    <div class="form-text field-help">Re-enter the same password you entered above.</div>
                </div>

                <!-- SUBMIT BUTTON PART -->
                <button type="submit" name="submit" class="btn w-100 mt-3">Register</button>

                <?php
                if ($ok) {
                  echo '<div class="small text-center text-success mt-2">All fields are valid. Welcome, ' . $username . '!</div>';
                }
                ?>

            </form>

            <p class="text-center mt-3 small">
              Do you have an account? <a href="login.php" class="text-decoration-underline text-white fw-bold">Login</a>
            </p>

        </div>
    </div>


  </body>
</html>
