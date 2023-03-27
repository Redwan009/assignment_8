<!DOCTYPE html>
<html>
  <head>
    <title>Login Form</title>
  </head>
  <body>
    <h1>Login Form</h1>
    <?php
// Start session
session_start();

// Check if user is already logged in, redirect to welcome page if so
if (isset($_SESSION["first_name"])) {
    header("location: welcome.php");
    exit;
}

// Define variables and set to empty values
$email = $password = "";
$email_err = $password_err = "";

// Process form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate email
    if (empty($_POST["email"])) {
        $email_err = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
    }

    // Validate password
    if (empty($_POST["password"])) {
        $password_err = "Password is required";
    } else {
        $password = test_input($_POST["password"]);
    }

    // If both fields are valid, check login credentials
    if (empty($email_err) && empty($password_err)) {
        // Replace with database query to check if user exists
        if ($email == "example@example.com" && $password == "password") {
            // Store user info in session and redirect to welcome page
            $_SESSION["first_name"] = "John"; // Replace with actual first name from database
            header("location: welcome.php");
            exit;
        } else {
            $password_err = "Invalid email or password";
        }
    }
}

// Function to test and sanitize form input data
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <label for="email">Email Address:</label>
      <input type="text" name="email" id="email" value="<?php echo $email; ?>">
      <span class="error"><?php echo $email_err; ?></span>
      <br><br>
      <label for="password">Password:</label>
      <input type="password" name="password" id="password">
      <span class="error"><?php echo $password_err; ?></span>
      <br><br>
      <input type="submit" value="Login">
    </form>
  </body>
</html>
