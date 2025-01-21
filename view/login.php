<?php
session_start();
// Display error messages if any
if (isset($_SESSION['errorMessages'])) {
    echo '<ul>';
    foreach ($_SESSION['errorMessages'] as $message) {
        echo "<li>$message</li>";
    }
    echo '</ul>';
    unset($_SESSION['errorMessages']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>TeamSync Login</title>
    <link rel="stylesheet" href="../scripts/css/validation.css">
    <script src="../scripts/js/validation.js" defer></script>
    
</head>
<body>
    <h2>TeamSync Login</h2>
    <form id="loginForm" action="../controller/login_control.php" method="POST" onsubmit="loginValidate(event)">
        <fieldset>
            <legend>Login Information</legend>
            <table>
                <tr>
                    <td><label for="email">Email:</label></td>
                    <td><input type="email" name="email" id="email"></td> 
                    <td><p class="error-message" id="emailError"></p></td>
                </tr>
                <tr>
                    <td><label for="password">Password:</label></td>
                    <td><input type="password" name="password" id="password"></td> 
                    <td><p class="error-message" id="passwordError"> </p></td>
                </tr>
            </table>
            <br>
            <button type="submit">Login</button>
        </fieldset>
    </form>

    <p>Don't have an account? <a href="../view/registration.php"><button>Register here</button></a></p>
</body>
</html>
