<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - TeamSync</title>
    <link rel="stylesheet" href="../css/profile.css">
    <script src="../js/user.js" defer></script>
</head>
<body>

<?php include 'user-navbar.php'; ?>

    <div class="profile-container">
        <h1>Edit Profile</h1>

        <form action="../controller/user-profile-controller.php?action=update_profile" method="post" enctype="multipart/form-data" onsubmit="return validateEditProfileForm(event)">
            <input type="hidden" name="userid" value="<?php echo $user['userid']; ?>">

            <!-- Display current profile picture if available -->
            <?php if ($user['profile_picture']) { ?>
                <div class="form-group">
                    <label for="current-profile-pic">Current Profile Picture:</label><br>
                    <img id="current-profile-pic" src="data:image/jpeg;base64,<?php echo base64_encode($user['profile_picture']); ?>" alt="Profile Picture" width="150"><br><br>
                </div>
            <?php } ?>

            <div class="form-buttons">
                <button type="button" onclick="showFileInput()" class="button-primary">Change Profile Picture</button>
                <button type="button" onclick="deleteProfilePicture()" class="button-danger">Delete Profile Picture</button><br><br>
            </div>

            <!-- File input and new profile picture preview -->
            <input type="file" id="profile_picture" name="profile_picture" style="display:none;" onchange="previewImage(event)"><br>
            <img id="preview-profile-pic" src="#" alt="New Profile Picture Preview" style="display: none;" width="150"><br><br>
            <p class="error-message" id="fileError">
                <?php
                if (isset($_SESSION['error']) && $_SESSION['error'] === "Invalid file type or file too large. Please upload a JPEG, PNG, or GIF image under 5MB.") {
                    echo $_SESSION['error'];
                }
                ?>
            </p>

            <label for="firstname">First Name:</label>
            <input type="text" id="firstname" name="firstname" value="<?php echo $user['firstname']; ?>">
            <p class="error-message" id="firstNameError">
                <?php
                if (isset($_SESSION['errorMessages']) && in_array("Please enter a First name.", $_SESSION['errorMessages'])) {
                    echo "Please enter a First name.";
                }
                ?>
            </p>

            <label for="lastname">Last Name:</label>
            <input type="text" id="lastname" name="lastname" value="<?php echo $user['lastname']; ?>">
            <p class="error-message" id="lastNameError">
                <?php
                if (isset($_SESSION['errorMessages']) && in_array("Please enter a Last name.", $_SESSION['errorMessages'])) {
                    echo "Please enter a Last name.";
                }
                ?>
            </p>

            <label for="username">Username:</label>
            <input type="text" id="username" name="name" value="<?php echo $user['name']; ?>">
            <p class="error-message" id="usernameError">
                <?php
                if (isset($_SESSION['errorMessages']) && in_array("Please enter a Username.", $_SESSION['errorMessages'])) {
                    echo "Please enter a Username.";
                }
                ?>
            </p>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>">
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

            <label for="password">Password (Leave blank to keep current password):</label>
            <input type="password" id="password" name="password">
            <p class="error-message" id="passwordError">
                <?php
                if (isset($_SESSION['errorMessages']) && in_array("Password must be at least 8 characters long, with at least one uppercase letter, one lowercase letter, and one special character.", $_SESSION['errorMessages'])) {
                    echo "Password must be at least 8 characters long, with at least one uppercase letter, one lowercase letter, and one special character.";
                }
                ?>
            </p>
            
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password">
            <p class="error-message" id="confirmPasswordError">
                <?php
                if (isset($_SESSION['errorMessages']) && in_array("Passwords do not match.", $_SESSION['errorMessages'])) {
                    echo "Passwords do not match.";
                }
                ?>
            </p>

            <div class="form-buttons">
                <button type="submit" class="button-primary">Update Profile</button>
            </div>
        </form>

        <!-- Hidden form to delete profile picture -->
        <form id="delete-profile-picture-form" action="../controller/user-profile-controller.php?action=delete_profile_picture" method="post">
            <input type="hidden" name="userid" value="<?php echo $user['userid']; ?>">
        </form>

    </div>

    

<script>

</script>

</body>
</html>

<?php
    unset($_SESSION['errorMessages']);
    unset($_SESSION['error']);
?>
