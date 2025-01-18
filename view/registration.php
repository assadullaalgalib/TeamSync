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
    <title>TeamSync Registration</title>
    <link rel="stylesheet" href="../scripts/css/validation.css">
    <script src="../scripts/js/validation.js" defer></script>
</head>
<body>
    <h2>TeamSync Registration</h2>
    <form id="registrationForm" action="../controller/registration_control.php" method="POST" onsubmit="regValidate(event)">
        <!-- Role Selection Section -->
        <fieldset>
            <legend>Select Role</legend>
            <table>
                <tr>
                    <td><input type="radio" id="role_client" name="role" value="client"> Client</td>
                    <td><input type="radio" id="role_developer" name="role" value="developer"> Developer</td>
                    <td><p class="error-message" id="roleError"></p></td>
                </tr>
            </table>
        </fieldset>

        <!-- Personal Information Section -->
        <fieldset>
            <legend>Personal Information</legend>
            <table>
                <tr>
                    <td>First Name:</td>
                    <td><input type="text" id="firstName" name="first_name" placeholder="John"></td>
                    <td><p class="error-message" id="firstNameError"></p></td>
                </tr>
                <tr>
                    <td>Last Name:</td>
                    <td><input type="text" id="lastName" name="last_name" placeholder="Doe"></td>
                    <td><p class="error-message" id="lastNameError"></p></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" id="username" name="username" placeholder="johndoe123"></td>
                    <td><p class="error-message" id="usernameError"></p></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="email" id="emailAddress" name="email" placeholder="email@example.com"></td>
                    <td><p class="error-message" id="emailError"></p></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" id="userPassword" name="password"></td>
                    <td><p class="error-message" id="passwordError"></p></td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td><input type="password" id="confirmPassword" name="confirm_password" placeholder="Retype Password"></td>
                    <td><p class="error-message" id="confirmPasswordError"></p></td>
                </tr>
            </table>
        </fieldset>

        <!-- Submission Section -->
        <fieldset>
            <table>
                <tr>
                    <td><input type="submit" id="submitBtn" value="Register"></td>
                    <td><input type="reset" id="resetBtn" value="Clear Form"></td>
                </tr>
            </table>
        </fieldset>
    </form>
    
    <p>Already have an account? <a href="../view/login.php">Login here</a></p>
</body>
</html>
