<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User - TeamSync</title>
    <link rel="stylesheet" href="../css/main.css">
    <script src="../js/admin.js" defer></script>
</head>
<body>

<?php include 'admin-navbar.php'; ?>

<div class="project-container">
    <h1>Create New User</h1>

    <form action="../controller/admin-user-controller.php?action=create_user" method="post" class="user-form" onsubmit="return validateUserCreateForm(event)">
        <div class="form-group">
            <label for="firstname">First Name:</label>
            <input type="text" id="firstname" name="firstname">
            <p class="error-message" id="firstnameError">
                <?php
                if (isset($_SESSION['errorMessages']) && in_array("Please enter a First name.", $_SESSION['errorMessages'])) {
                    echo "Please enter a First name.";
                }
                ?>
            </p>
        </div>

        <div class="form-group">
            <label for="lastname">Last Name:</label>
            <input type="text" id="lastname" name="lastname">
            <p class="error-message" id="lastnameError">
                <?php
                if (isset($_SESSION['errorMessages']) && in_array("Please enter a Last name.", $_SESSION['errorMessages'])) {
                    echo "Please enter a Last name.";
                }
                ?>
            </p>
        </div>

        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username">
            <p class="error-message" id="usernameError">
                <?php
                if (isset($_SESSION['errorMessages']) && in_array("Please enter a Username.", $_SESSION['errorMessages'])) {
                    echo "Please enter a Username.";
                }
                ?>
            </p>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email">
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

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            <p class="error-message" id="passwordError">
                <?php
                if (isset($_SESSION['errorMessages']) && in_array("Password must be at least 8 characters long, with at least one uppercase letter, one lowercase letter, and one special character.", $_SESSION['errorMessages'])) {
                    echo "Password must be at least 8 characters long, with at least one uppercase letter, one lowercase letter, and one special character.";
                }
                ?>
            </p>
        </div>

        <div class="form-group">
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password">
            <p class="error-message" id="confirmPasswordError">
                <?php
                if (isset($_SESSION['errorMessages']) && in_array("Passwords do not match.", $_SESSION['errorMessages'])) {
                    echo "Passwords do not match.";
                }
                ?>
            </p>
        </div>

        <label for="role">Role:</label>
        
        <div class="radio-group">
            <input type="radio" id="admin" name="role" value="1">
            <label for="admin">Admin</label>

            <input type="radio" id="pm" name="role" value="2">
            <label for="pm">Project Manager</label>
            
            <input type="radio" id="dev" name="role" value="3">
            <label for="dev">Developer</label>

            <input type="radio" id="client" name="role" value="4">
            <label for="client">Client</label>
        </div>
        <p class="error-message" id="roleError">
            <?php
            if (isset($_SESSION['errorMessages']) && in_array("Please select a role.", $_SESSION['errorMessages'])) {
                echo "Please select a role.";
            }
            ?>
        </p>

        <div class="form-buttons">
            <button type="submit" class="button-primary">Create User</button>
        </div>
    </form>

</div>

<?php
unset($_SESSION['errorMessages']);
?>

</body>
</html>
