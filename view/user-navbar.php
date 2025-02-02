<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/navbar.css">
</head>
<body>
    <!-- Navbar -->
<nav class="navbar">
    <div class="logo">TeamSync</div>
    <div class="nav-links">
        <a href="../controller/user-dashboard-controller.php">Home</a>
        <a href="../controller/user-logout-controller.php">Logout</a>
        <a href="../controller/user-profile-controller.php?action=view_profile" class="welcome-link">Welcome, <?php echo $userName; ?>!</a>
    </div>
</nav>
</body>
</html>