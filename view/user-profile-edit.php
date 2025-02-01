<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - TeamSync</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/user.js" defer></script>
</head>
<body>

<h1>Edit Profile</h1>

<form action="../controller/user-profile-controller.php?action=update_profile" method="post" enctype="multipart/form-data">
    <input type="hidden" name="userid" value="<?php echo $user['userid']; ?>">

    <!-- Display current profile picture if available -->
    <?php if ($user['profile_picture']) { ?>
        <label for="current-profile-pic">Current Profile Picture:</label><br>
        <img id="current-profile-pic" src="data:image/jpeg;base64,<?php echo base64_encode($user['profile_picture']); ?>" alt="Profile Picture" width="150"><br><br>
    <?php } ?>

    <!-- Buttons to change or delete profile picture -->
    <button type="button" onclick="showFileInput()">Change Profile Picture</button>
    <button type="button" onclick="deleteProfilePicture()">Delete Profile Picture</button><br><br>

    <!-- File input for uploading profile picture -->
    <input type="file" id="profile_picture" name="profile_picture" style="display:none;" onchange="previewImage(event)"><br><br>

    <!-- Other form fields -->
    <label for="firstname">First Name:</label>
    <input type="text" id="firstname" name="firstname" value="<?php echo $user['firstname']; ?>"><br><br>

    <label for="lastname">Last Name:</label>
    <input type="text" id="lastname" name="lastname" value="<?php echo $user['lastname']; ?>"><br><br>

    <label for="username">Username:</label>
    <input type="text" id="name" name="name" value="<?php echo $user['name']; ?>"><br><br>

    <label for="email">Email:</label>
    <input type="text" id="email" name="email" value="<?php echo $user['email']; ?>"><br><br>

    <label for="password">Password (Leave blank to keep current password):</label>
    <input type="password" id="password" name="password"><br><br>
    
    <label for="confirm_password">Confirm Password:</label>
    <input type="password" id="confirm_password" name="confirm_password"><br><br>

    <button type="submit">Update Profile</button>
</form>

<!-- Form to handle profile picture deletion -->
<form id="delete-profile-picture-form" action="../controller/user-profile-controller.php?action=delete_profile_picture" method="post" style="display:none;">
    <input type="hidden" name="userid" value="<?php echo $user['userid']; ?>">
</form>

<!-- Form to handle account deletion -->
<form id="delete-account-form" action="../controller/user-profile-controller.php?action=delete_account" method="post" style="display:none;">
    <input type="hidden" name="userid" value="<?php echo $user['userid']; ?>">
</form>

<!-- Button to delete account -->
<button type="button" onclick="deleteAccount()">Delete My Account</button>

<a href="../controller/user-profile-controller.php?action=view_profile">Back to Profile</a>

</body>
</html>
