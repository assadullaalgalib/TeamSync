<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - TeamSync</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<h1>User Profile</h1>

<?php if ($user['profile_picture']) { ?>
    <p><strong>Profile Picture:</strong></p>
    <img src="data:image/jpeg;base64,<?php echo base64_encode($user['profile_picture']); ?>" alt="Profile Picture" width="150">
<?php } ?>

<p><strong>Role: <?php echo $user['role_name']; ?></strong></p>

<p><strong>First Name:</strong> <?php echo $user['firstname']; ?></p>
<p><strong>Last Name:</strong> <?php echo $user['lastname']; ?></p>
<p><strong>Username:</strong> <?php echo $user['name']; ?></p>
<p><strong>Email:</strong> <?php echo $user['email']; ?></p>


<a href="../controller/user-profile-controller.php?action=edit_profile">Edit Profile</a>
<a href="../controller/user-profile-controller.php?action=delete_account">Delete My Account</a>
<a href="../controller/user-dashboard-controller.php">Back to Dashboard</a>

</body>
</html>
