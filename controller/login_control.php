<?php
session_start();

// Include the database connection and model
include_once '../model/db.php';
include_once '../model/user_model.php';

$errorMessages = [];

// Retrieve form data
$email = trim($_POST['email']);
$password = $_POST['password'];

// Server-side validation
// Email validation
if (empty($email)) {
    $errorMessages[] = "Email is required.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errorMessages[] = "Invalid email format.";
}

// Password validation
if (empty($password)) {
    $errorMessages[] = "Password is required.";
}

// If there are validation errors, redirect to login page with error messages
if (!empty($errorMessages)) {
    $_SESSION['errorMessages'] = $errorMessages;
    header("Location: ../view/login.php");
    exit();
}

// Call the model function to authenticate the user
$user = authenticateUser($email, $password);

if ($user !== null) {
    // User found and password matches, login successful
    $_SESSION['userid'] = $user['userid'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['roleid'] = $user['roleid'];
    $_SESSION['firstname'] = $user['firstname'];
    $_SESSION['lastname'] = $user['lastname'];

    header("Location: ../controller/dashboard_controller.php");
    
} else {
    // Incorrect credentials or user not found
    $_SESSION['errorMessages'] = ["Invalid email or password. Please try again."];
    header("Location: ../view/login.php");
}

// Close the database connection
$conn->close();
?>
