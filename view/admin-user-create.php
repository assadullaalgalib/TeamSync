<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User - TeamSync</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>

<?php include 'admin-navbar.php'; ?>

<div class="project-container">
    <h1>Create New User</h1>

    <form action="../controller/admin-user-controller.php?action=create_user" method="post" class="user-form">
        <div class="form-group">
            <label for="firstname">First Name:</label>
            <input type="text" id="firstname" name="firstname">
        </div>

        <div class="form-group">
            <label for="lastname">Last Name:</label>
            <input type="text" id="lastname" name="lastname">
        </div>

        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="name" name="name">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email">
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
        </div>

        <div class="form-group">
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password">
        </div>

        <label for="role">Role:</label>
        
        <div class="radio-group">
            <input type="radio" id="admin" name="role" value="1">
            <label for="admin">Admin</label>

            <input type="radio" id="pm" name="role" value="2">
            <label for="pm">Project Manager</label>
            
            <input type="radio" id="dev" name="role" value="3">
            <label for="dev">Developer</label>

            <input type="radio" id="client" name="role" value="4">
            <label for="client">Client</label>
        </div>

        <div class="form-buttons">
            <button type="submit" class="button-primary">Create User</button>
        </div>
    </form>

</div>

</body>
</html>
