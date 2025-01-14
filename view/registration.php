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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TeamSync Registration</title>
    <script src="../scripts/js/regformvalidation.js" defer></script>
</head>
<body>

    <h2>TeamSync Registration</h2>

    <form id="registrationForm" action="../controller/registration_control.php" method="POST">
		
        <!-- Role Selection Section -->
        <fieldset>
            <legend>Select Role</legend>
            <table>
                <tr>
                    <td><input type="radio" id="role" name="role" value="client"> Client</td>
                    <td><input type="radio" id="role" name="role" value="developer"> Developer</td>
                </tr>
            </table>
        </fieldset>

        <!-- Personal Information Section -->
        <fieldset>
            <legend>Personal Information</legend>
            <table>
                <tr>
                    <td>First Name:</td>
                    <td><input type="text" id="first_name" name="first_name" placeholder="John"></td>
                </tr>
                <tr>
                    <td>Last Name:</td>
                    <td><input type="text" id="last_name" name="last_name" placeholder="Doe"></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" id="username" name="username" placeholder="johndoe123"></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="email" id="email" name="email" placeholder="email@example.com"></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" id="password" name="password"></td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td><input type="password" id="confirm_password" name="confirm_password" placeholder="Retype Password"></td>
                </tr>
            </table>
        </fieldset>

        <!-- Submission Section -->
        <fieldset>
            <table>
                <tr>
                    <td><input type="submit" value="Register"></td>
                    <td><input type="reset" value="Clear Form"></td>
                </tr>
            </table>
        </fieldset>
    </form>
    
    <p>Already have an account? <a href="../view/login.php">Login here</a></p>

</body>
</html>
