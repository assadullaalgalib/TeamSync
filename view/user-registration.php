<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>TeamSync Registration</title>
    <link rel="stylesheet" href="../css/user-registration.css">
    <script src="../js/user.js" defer></script>
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
                <p class="error-message" id="roleError">
                    <?php
                    if (isset($_SESSION['errorMessages']) && in_array("Please select a role.", $_SESSION['errorMessages'])) {
                        echo "Please select a role.";
                    }
                    ?>
                </p>
            </div>

            <!-- Personal Information Section -->
            <div class="form-section">
                <h3>Personal Information</h3>
                <div class="input-group">
                    <label for="firstName">First Name:</label>
                    <input type="text" id="firstName" name="first_name" placeholder="John">
                    <p class="error-message" id="firstNameError">
                        <?php
                        if (isset($_SESSION['errorMessages']) && in_array("Please enter a First name.", $_SESSION['errorMessages'])) {
                            echo "Please enter a First name.";
                        }
                        ?>
                    </p>
                </div>
                <div class="input-group">
                    <label for="lastName">Last Name:</label>
                    <input type="text" id="lastName" name="last_name" placeholder="Doe">
                    <p class="error-message" id="lastNameError">
                        <?php
                        if (isset($_SESSION['errorMessages']) && in_array("Please enter a Last name.", $_SESSION['errorMessages'])) {
                            echo "Please enter a Last name.";
                        }
                        ?>
                    </p>
                </div>
                <div class="input-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" placeholder="johndoe123">
                    <p class="error-message" id="usernameError">
                        <?php
                        if (isset($_SESSION['errorMessages']) && in_array("Please enter a Username.", $_SESSION['errorMessages'])) {
                            echo "Please enter a Username.";
                        }
                        ?>
                    </p>
                </div>
                <div class="input-group">
                    <label for="emailAddress">Email:</label>
                    <input type="email" id="emailAddress" name="email" placeholder="email@example.com">
                    <p class="error-message" id="emailError">
                        <?php
                        if (isset($_SESSION['errorMessages'])) {
                            if (in_array("Email is required.", $_SESSION['errorMessages'])) {
                                echo "Email is required.";
                            } elseif (in_array("Invalid email format.", $_SESSION['errorMessages'])) {
                                echo "Invalid email format.";
                            } elseif (in_array("Email already exists. Please enter a different email.", $_SESSION['errorMessages'])) {
                                echo "Email already exists. Please enter a different email.";
                            }
                        }
                        ?>
                    </p>
                </div>
                <div class="input-group">
                    <label for="userPassword">Password:</label>
                    <input type="password" id="userPassword" name="password">
                    <p class="error-message" id="passwordError">
                        <?php
                        if (isset($_SESSION['errorMessages']) && in_array("Password must be at least 8 characters long, with at least one uppercase letter, one lowercase letter, and one special character.", $_SESSION['errorMessages'])) {
                            echo "Password must be at least 8 characters long, with at least one uppercase letter, one lowercase letter, and one special character.";
                        }
                        ?>
                    </p>
                </div>
                <div class="input-group">
                    <label for="confirmPassword">Confirm Password:</label>
                    <input type="password" id="confirmPassword" name="confirm_password" placeholder="Retype Password">
                    <p class="error-message" id="confirmPasswordError">
                        <?php
                        if (isset($_SESSION['errorMessages']) && in_array("Passwords do not match.", $_SESSION['errorMessages'])) {
                            echo "Passwords do not match.";
                        }
                        ?>
                    </p>
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

<?php
    unset($_SESSION['errorMessages']);
?>