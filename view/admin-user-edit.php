<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - TeamSync</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<h1>Edit User</h1>

<form action="../controller/admin-user-controller.php?action=update_user" method="post">
    <input type="hidden" name="userid" value="<?php echo $user['userid']; ?>">

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

<a href="../controller/admin-user-controller.php?action=show_all">Back to All Users</a>

</body>
</html>
