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

        <form action="../controller/user-profile-controller.php?action=update_profile" method="post" enctype="multipart/form-data">
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

            <label for="firstname">First Name:</label>
            <input type="text" id="firstname" name="firstname" value="<?php echo $user['firstname']; ?>">

            <label for="lastname">Last Name:</label>
            <input type="text" id="lastname" name="lastname" value="<?php echo $user['lastname']; ?>">

            <label for="username">Username:</label>
            <input type="text" id="name" name="name" value="<?php echo $user['name']; ?>">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>">

            <label for="password">Password (Leave blank to keep current password):</label>
            <input type="password" id="password" name="password">
            
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password">

            <div class="form-buttons">
                <button type="submit" class="button-primary">Update Profile</button>
            </div>
        </form>

        <!-- Hidden form to delete profile picture -->
        <form id="delete-profile-picture-form" action="../controller/user-profile-controller.php?action=delete_profile_picture" method="post">
            <input type="hidden" name="userid" value="<?php echo $user['userid']; ?>">
        </form>

    </div>

</body>
</html>