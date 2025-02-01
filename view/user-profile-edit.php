<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - TeamSync</title>
    <link rel="stylesheet" href="../css/user-profile-view-and-edit.css">
    <script src="../js/user.js" defer></script>
</head>
<body>

    <div class="profile-container">
        <h1>Edit Profile</h1>

        <form action="../controller/user-profile-controller.php?action=update_profile" method="post" enctype="multipart/form-data">
            <input type="hidden" name="userid" value="<?php echo $user['userid']; ?>">

            <?php if ($user['profile_picture']) { ?>
                <label>Current Profile Picture:</label>
                <img class="profile-picture" src="data:image/jpeg;base64,<?php echo base64_encode($user['profile_picture']); ?>" alt="Profile Picture">
            <?php } ?>

            <div class="profile-actions">
                <button type="button" class="button-primary" onclick="showFileInput()">Change Profile Picture</button>
                <button type="button" class="button-danger" onclick="deleteProfilePicture()">Delete Profile Picture</button>
            </div>

            <input type="file" id="profile_picture" name="profile_picture" class="hidden-input" onchange="previewImage(event)">

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
                <a href="../controller/user-profile-controller.php?action=view_profile" class="button-link button-dark">Back to Profile</a>
            </div>
        </form>
    </div>

</body>
</html>
