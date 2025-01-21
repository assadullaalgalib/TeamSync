<?php
// index.php - Entry point to the application

// Check if the user is authenticated
if (isset($_SESSION['userid']) && isset($_SESSION['roleid'])) {
    // Redirect to the dashboard controller
    header('Location: controller/dashboard_controller.php');
    exit();
} else {
    // Not authenticated, redirect to login
    header('Location: view/login.php');
    exit();
}
?>