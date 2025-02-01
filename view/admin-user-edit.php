<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - TeamSync</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/admin.js" defer></script>
    


</head>
<body>

<h1>Edit User</h1>

<form action="../controller/admin-user-controller.php?action=update_user" method="post" enctype="multipart/form-data">
    <input type="hidden" name="userid" value="<?php echo $user['userid']; ?>">

    <!-- Display current profile picture if available -->
    <?php if ($user['profile_picture']) { ?>
        <label for="current-profile-pic">Current Profile Picture:</label><br>
        <img id="current-profile-pic" src="data:image/jpeg;base64,<?php echo base64_encode($user['profile_picture']); ?>" alt="Profile Picture" width="150"><br><br>
    <?php } ?>

    <button type="button" onclick="showFileInput()">Change Profile Picture</button>
    <button type="button" onclick="deleteProfilePicture()">Delete Profile Picture</button><br><br>

    <!-- File input and new profile picture preview -->
    <input type="file" id="profile_picture" name="profile_picture" style="display:none;" onchange="previewImage(event)"><br>
    <img id="preview-profile-pic" src="#" alt="New Profile Picture Preview" style="display: none;" width="150"><br><br>           


    <label for="firstname">First Name:</label>
    <input type="text" id="firstname" name="firstname" value="<?php echo $user['firstname']; ?>"><br><br>

    <label for="lastname">Last Name:</label>
    <input type="text" id="lastname" name="lastname" value="<?php echo $user['lastname']; ?>"><br><br>

    <label for="username">Username:</label>
    <input type="text" id="name" name="name" value="<?php echo $user['name']; ?>"><br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>"><br><br>

    <label for="password">Password (Leave blank to keep current password):</label>
    <input type="password" id="password" name="password"><br><br>

    <label for="role">Role:</label>
    <input type="radio" id="admin" name="role" value="1" <?php echo ($user['roleid'] == '1') ? 'checked' : ''; ?>>
    <label for="admin">Admin</label>
    <input type="radio" id="pm" name="role" value="2" <?php echo ($user['roleid'] == '2') ? 'checked' : ''; ?>>
    <label for="pm">Project Manager</label>
    <input type="radio" id="dev" name="role" value="3" <?php echo ($user['roleid'] == '3') ? 'checked' : ''; ?>>
    <label for="dev">Developer</label>
    <input type="radio" id="client" name="role" value="4" <?php echo ($user['roleid'] == '4') ? 'checked' : ''; ?>>
    <label for="dev">Client</label><br><br>

    <button type="submit">Update User</button>
</form>

<!-- Additional form to handle profile picture deletion -->
<form id="delete-profile-picture-form" action="../controller/admin-user-controller.php?action=delete_profile_picture" method="post">
    <input type="hidden" name="userid" value="<?php echo $user['userid']; ?>">
</form>

<a href="../controller/admin-user-controller.php?action=show_all">Back to All Users</a>

</body>
</html>
