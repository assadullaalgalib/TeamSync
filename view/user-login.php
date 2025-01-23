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
<html>

<head>
    <title>TeamSync Login</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/scripts.js" defer></script>

</head>

<body>
    <h2>TeamSync Login</h2>
    <form id="loginForm" action="../controller/user-login-controller.php" method="POST" onsubmit="loginValidate(event)">
        <fieldset>
            <legend>Login Information</legend>
            <table>
                <tr>
                    <td><label for="email">Email:</label></td>
                    <td><input type="text" name="email" id="email"></td>
                    <td>
                        <p class="error-message" id="emailError"></p>
                    </td>
                </tr>
                <tr>
                    <td><label for="password">Password:</label></td>
                    <td><input type="password" name="password" id="password"></td>
                    <td>
                        <p class="error-message" id="passwordError"> </p>
                    </td>
                </tr>
            </table>
            <br>
            <button type="submit">Login</button>
        </fieldset>
    </form>

    <p>Don't have an account? <a href="../view/user-registration.php">Register here</a></p>
</body>

</html>