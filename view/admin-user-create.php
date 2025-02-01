<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User - TeamSync</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<h1>Create New User</h1>

<form action="../controller/admin-user-controller.php?action=create_user" method="post">
    <label for="firstname">First Name:</label>
    <input type="text" id="firstname" name="firstname"><br><br>

    <label for="lastname">Last Name:</label>
    <input type="text" id="lastname" name="lastname"><br><br>

    <label for="username">Username:</label>
    <input type="text" id="name" name="name"><br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email"><br><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password"><br><br>

    <label for="confirm_password">Confirm Password:</label>
    <input type="password" id="confirm_password" name="confirm_password"><br><br>

    <label for="role">Role:</label>
    <input type="radio" id="admin" name="role" value="1">
    <label for="admin">Admin</label>
    <input type="radio" id="pm" name="role" value="2">
    <label for="pm">Project Manager</label>
    <input type="radio" id="dev" name="role" value="3">
    <label for="dev">Developer</label><br><br>

    <button type="submit">Create User</button>
</form>

<a href="../controller/user-dashboard-controller.php">Home</a>

</body>
</html>
