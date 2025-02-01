<?php
/* require_once '../model/session-manager-model.php';

if (sessionExists('errorMessages')) {
    echo '<div class="error-message">';
    echo '<ul>';
    $errorMessages = getSession('errorMessages');
    foreach ($errorMessages as $message) {
        echo "<li>$message</li>";
    }
    echo '</ul>';
    removeSession('errorMessages');
    echo '</div>';
} */
?>
<!-- here the validation should work so that it check if the email or pass is incorrect it will show the error using the PHP Validation -->

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
                    <p class="error-message" id="emailError"></p>
                </div>
                <div class="input-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password">
                    <p class="error-message" id="passwordError"></p>
                </div>
                <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="../view/user-registration.php">Register here</a></p>
    </div>
</body>
</html>

