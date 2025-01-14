<?php
session_start();
    // Display error messages if any
    if (isset($_SESSION['errorMessages'])) {
        echo '<ul>';
        foreach ($_SESSION['errorMessages'] as $message) {
            echo "<li>$message</li>";
        }
        echo '</ul>';
        // Clear error messages after displaying them
        unset($_SESSION['errorMessages']);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TeamSync Login</title>
    <script src="../scripts/js/loginformvalidation.js" defer></script>
</head>
<body>
    <h2>TeamSync Login</h2>
    <form id="loginForm" action="../controller/login_control.php" method="POST">
        <fieldset>
            <legend>Login Information</legend>
            <table>
                <tr>
                    <td><label for="email">Email:</label></td>
                    <td><input type="email" name="email" id="email" ></td>
                </tr>
                <tr>
                    <td><label for="password">Password:</label></td>
                    <td><input type="password" name="password" id="password" ></td>
                </tr>
            </table>
            <br>
            <button type="submit">Login</button>
        </fieldset>
    </form>

    <p>Don't have an account? <a href="../view/registration.php">Register here</a></p>
</body>
</html>
