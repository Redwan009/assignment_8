<!DOCTYPE html>
<html>
  <head>
    <title>Registration Form</title>
  </head>
  <body>
    <h1>Registration Form</h1>
    <?php
// Define variables and set to empty values
$first_name = $last_name = $email = $password = $confirm_password = "";
$first_name_err = $last_name_err = $email_err = $password_err = $confirm_password_err = "";

// Process form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate first name
    if (empty($_POST["first_name"])) {
        $first_name_err = "First name is required";
    } else {
        $first_name = test_input($_POST["first_name"]);
    }

    // Validate last name
    if (empty($_POST["last_name"])) {
        $last_name_err = "Last name is required";
    } else {
        $last_name = test_input($_POST["last_name"]);
    }

    // Validate email
    if (empty($_POST["email"])) {
        $email_err = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        // Check if email is valid format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_err = "Invalid email format";
        }
    }

    // Validate password
    if (empty($_POST["password"])) {
        $password_err = "Password is required";
    } else {
        $password = test_input($_POST["password"]);
    }

    // Validate confirm password
    if (empty($_POST["confirm_password"])) {
        $confirm_password_err = "Confirm password is required";
    } else {
        $confirm_password = test_input($_POST["confirm_password"]);
        // Check if password and confirm password match
        if ($password != $confirm_password) {
            $confirm_password_err = "Passwords do not match";
        }
    }

    // If all fields are valid, display confirmation message
    if (empty($first_name_err) && empty($last_name_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)) {
        echo "<p>Thank you for registering, $first_name!</p>";
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
      <label for="first_name">First Name:</label>
      <input type="text" name="first_name" id="first_name" value="<?php echo $first_name; ?>">
      <span class="error"><?php echo $first_name_err; ?></span>
      <br><br>
      <label for="last_name">Last Name:</label>
      <input type="text" name="last_name" id="last_name" value="<?php echo $last_name; ?>">
      <span class="error"><?php echo $last_name_err; ?></span>
      <br><br>
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
