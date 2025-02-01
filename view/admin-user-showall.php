
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Users - TeamSync</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<h1>All Users</h1>

<table border="1">
    <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user) { ?>
        <tr>
            <td><?php echo $user['firstname']; ?></td>
            <td><?php echo $user['lastname']; ?></td>
            <td><?php echo $user['name']; ?></td>
            <td><?php echo $user['email']; ?></td>
            <td><?php echo $user['role_name']; ?></td>
            <td>
                <a href="../controller/admin-user-controller.php?action=edit&userid=<?php echo $user['userid']; ?>">Edit</a>
                <a href="../controller/admin-user-controller.php?action=delete&userid=<?php echo $user['userid']; ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<a href="../controller/admin-user-controller.php?action=show_create_user">Create New User</a>
<a href="../controller/user-dashboard-controller.php">Back to Dashboard</a>

</body>
</html>
