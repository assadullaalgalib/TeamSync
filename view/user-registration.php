<!-- here the validation should work so that it check if the email or pass is incorrect it will show the error using the PHP Validation -->

<?php
require_once '../model/session-manager-model.php';

if (sessionExists('errorMessages')) {
    echo '<ul>';
    $errorMessages = getSession('errorMessages');
    foreach ($errorMessages as $message) {
        echo "<li>$message</li>";
    }
    echo '</ul>';
    removeSession('errorMessages');
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>TeamSync Registration</title>
    <link rel="stylesheet" href="../css/user-registration.css">
    <script src="../js/scripts.js" defer></script>
</head>
<body>
    <div class="registration-box">
        <h2>TeamSync Registration</h2>
        <form id="registrationForm" action="../controller/user-registration-controller.php" method="POST" onsubmit="regValidate(event)">
            <!-- Role Selection Section -->
            <div class="form-section">
                <h3>Select Role</h3>
                <div class="role-selection">
                    <label>
                        <input type="radio" id="role_client" name="role" value="client"> Client
                    </label>
                    <label>
                        <input type="radio" id="role_developer" name="role" value="developer"> Developer
                    </label>
                </div>
                <p class="error-message" id="roleError"></p>
            </div>

            <!-- Personal Information Section -->
            <div class="form-section">
                <h3>Personal Information</h3>
                <div class="input-group">
                    <label for="firstName">First Name:</label>
                    <input type="text" id="firstName" name="first_name" placeholder="John">
                    <p class="error-message" id="firstNameError"></p>
                </div>
                <div class="input-group">
                    <label for="lastName">Last Name:</label>
                    <input type="text" id="lastName" name="last_name" placeholder="Doe">
                    <p class="error-message" id="lastNameError"></p>
                </div>
                <div class="input-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" placeholder="johndoe123">
                    <p class="error-message" id="usernameError"></p>
                </div>
                <div class="input-group">
                    <label for="emailAddress">Email:</label>
                    <input type="email" id="emailAddress" name="email" placeholder="email@example.com">
                    <p class="error-message" id="emailError"></p>
                </div>
                <div class="input-group">
                    <label for="userPassword">Password:</label>
                    <input type="password" id="userPassword" name="password">
                    <p class="error-message" id="passwordError"></p>
                </div>
                <div class="input-group">
                    <label for="confirmPassword">Confirm Password:</label>
                    <input type="password" id="confirmPassword" name="confirm_password" placeholder="Retype Password">
                    <p class="error-message" id="confirmPasswordError"></p>
                </div>
            </div>

            <!-- Submission Section -->
            <div class="form-actions">
                <button type="submit" id="submitBtn">Register</button>
                <button type="reset" id="resetBtn">Clear Form</button>
            </div>
        </form>

        <p>Already have an account? <a href="../view/user-login.php">Login here</a></p>
    </div>
</body>
</html>


