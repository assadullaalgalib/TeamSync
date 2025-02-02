<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Users - TeamSync</title>
    <link rel="stylesheet" href="../css/showall.css">
</head>
<body>

<?php include 'admin-navbar.php'; ?>

<h1>All Users</h1>
<div class="form-buttons">
    <a href="../controller/admin-user-controller.php?action=show_create_user" class="button-primary">Create New User</a>
</div>

<div class="user-container">
    <?php foreach ($users as $user) { ?>
        <a href="../controller/admin-user-controller.php?action=view_user&userid=<?php echo $user['userid']; ?>" class="user-card-link">
            <div class="user-card">
                <div class="user-info">
                    <span class="user-id">#<?php echo $user['userid']; ?></span>
                    <p><strong>Username:</strong> <?php echo $user['name']; ?></p>
                    <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
                    <p><strong>Role:</strong> <?php echo $user['role_name']; ?></p>
                </div>
                
            </div>
        </a>
    <?php } ?>
</div>




</body>
</html>
