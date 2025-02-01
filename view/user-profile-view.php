<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - TeamSync</title>
    <link rel="stylesheet" href="../css/user-profile-view and edit.css">
</head>
<body>

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
            <a href="../controller/user-profile-controller.php?action=edit_profile" class="button-link button-primary">Edit Profile</a>
            <a href="../controller/user-profile-controller.php?action=delete_account" class="button-link button-danger">Delete My Account</a>
            <a href="../controller/user-dashboard-controller.php" class="button-link button-dark">Back to Dashboard</a>
        </div>
    </div>

</body>
</html>
