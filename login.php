<?php
require 'functions.php';

// define variables and set to empty values
$email = $password = "";
$emailErr = $passwordErr = "";
$ok = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $ok = true;
  $email = test_input($_POST["email"]);
  $password = $_POST["password"];

  // email: required and must be well-formed
  if ($email == "") {
    $emailErr = "Email is required.";
    $ok = false;
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $emailErr = "Invalid email format (e.g., name@example.com).";
    $ok = false;
  }

  // password: required, at least 8 characters, a number and a special character
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
}

// values used by header.php
$title = "Login Page";
$css = "login.css";
$bodyClass = "login-page d-flex justify-content-center align-items-center cinzel";

include 'header.php';
?>

    <div class="card login-card bg-dark bg-opacity-25 border border-white border-opacity-50 rounded-4 shadow">
        <div class="card-body p-4 text-white">

          <div class="text-center mb-3">
            <img class="img-fluid login-logo" src="Image/darkvengeance-logo.png" alt="DarkVengeance  Logo">
          </div>

            <form method="post" action="" novalidate>

                <!-- EMAIL PART -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <div class="input-group login-field-wrapper rounded-pill overflow-hidden bg-opacity-75 <?php if ($emailErr != "") echo "validation-invalid"; ?>" style="background-color: #c8bcf5;">
                        <input type="text" name="email" class="form-control bg-transparent border-0 px-4" id="email" placeholder="Enter Your Email" value="<?php echo $email; ?>">
                        <span class="input-group-text bg-transparent border-0 pe-4">
                          <i class="bi bi-envelope-fill"></i>
                        </span>
                    </div>
                    <div class="field-error"><?php echo $emailErr; ?></div>
                </div>

                <!-- PASSWORD PART -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group login-field-wrapper rounded-pill overflow-hidden bg-opacity-75 <?php if ($passwordErr != "") echo "validation-invalid"; ?>" style="background-color: #c8bcf5;">
                        <input type="password" name="password" id="password" class="form-control bg-transparent border-0 px-4" placeholder="Enter Your Password">
                        <span class="input-group-text bg-transparent border-0 pe-4">
                          <i class="bi bi-lock-fill"></i>
                        </span>
                    </div>
                    <div class="field-error"><?php echo $passwordErr; ?></div>
                </div>

                <!-- REMEMBER ME AND FORGOT PASSWORD PART -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="remember" id="remember">
                      <label class="form-check-label" for="remember">Remember me</label>
                    </div>
                    <a href="#" class="small text-secondary text-decoration-none">Forgot password?</a>
                </div>

                <!-- SUBMIT BUTTON PART -->
                <button type="submit" name="submit" class="btn w-100" id="loginButton">Login</button>

                <?php
                if ($ok) {
                  echo '<p class="small text-center text-success mt-2 mb-0">Login input is valid. Welcome, ' . $email . '!</p>';
                }
                ?>

            </form>

            <p class="text-center mt-3 mb-0">
              Do you have an account? <a href="register.php" class="text-decoration-underline text-white fw-bold">Sign up</a>
            </p>

        </div>
    </div>


  </body>
</html>
