<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>TeamSync Login</title>
    <link rel="stylesheet" href="../css/user-login.css">
    <script src="../js/user.js" defer></script>
</head>
<body>
    <div class="login-box">
        <h2>TeamSync Login</h2>
        <form id="loginForm" action="../controller/user-login-controller.php" method="POST" onsubmit="loginValidate(event)">
                <div class="input-group">
                    <label for="email">Email:</label>
                    <input type="text" name="email" id="email">
                    <p class="error-message" id="emailError">
                        <?php if (isset($_SESSION['errorMessages']) && in_array("Email is required.", $_SESSION['errorMessages'])) {
                            echo "Email is required.";
                        } elseif (isset($_SESSION['errorMessages']) && in_array("Invalid email format.", $_SESSION['errorMessages'])) {
                            echo "Invalid email format.";
                        } ?>
                    </p>
                </div>
                <div class="input-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password">
                    <p class="error-message" id="passwordError">
                        <?php if (isset($_SESSION['errorMessages']) && in_array("Password is required.", $_SESSION['errorMessages'])) {
                            echo "Password is required.";
                        } elseif (isset($_SESSION['errorMessages']) && in_array("Invalid email or password. Please try again.", $_SESSION['errorMessages'])) {
                            echo "Incorrect username or password. Please try again.";
                        } ?>
                    </p>
                </div>
                <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="../view/user-registration.php">Register here</a></p>
    </div>
</body>
</html>
