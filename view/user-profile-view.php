<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - TeamSync</title>
    <link rel="stylesheet" href="../css/profile.css">
</head>
<body>

<?php include 'user-navbar.php'; ?>

    <div class="profile-container">
        <h1>User Profile</h1>

        <?php if ($user['profile_picture']) { ?>
            <img class="profile-picture" src="data:image/jpeg;base64,<?php echo base64_encode($user['profile_picture']); ?>" alt="Profile Picture">
        <?php } ?>

        <div class="profile-info">
            <p><span class="label">Role:</span> <?php echo $user['role_name']; ?></p>
            <p><span class="label">First Name:</span> <?php echo $user['firstname']; ?></p>
            <p><span class="label">Last Name:</span> <?php echo $user['lastname']; ?></p>
            <p><span class="label">Username:</span> <?php echo $user['name']; ?></p>
            <p><span class="label">Email:</span> <?php echo $user['email']; ?></p>
        </div>

        <div class="profile-actions">
            <a href="../controller/user-profile-controller.php?action=edit_profile" class="button-primary">Edit Profile</a>
            <a href="../controller/user-profile-controller.php?action=delete_account" class="button-danger" onclick="return confirm('Are you sure you want to delete this account?');">Delete My Account</a>

        </div>
    </div>

</body>
</html>