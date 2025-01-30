<?php
require_once '../model/session-manager-model.php';

include_once '../model/db-connection-model.php';
include_once '../model/user-model.php';

startSession();

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
    setSession('errorMessages', $errorMessages);
    header("Location: ../view/user-login.php");
    exit();
}

// Call the model function to authenticate the user
$user = authenticateUser($email, $password);

if ($user !== null) {
    // User found and password matches, login successful
    setSession('userid', $user['userid']);
    setSession('email', $user['email']);
    setSession('roleid', $user['roleid']);
    setSession('firstname', $user['firstname']);
    setSession('lastname', $user['lastname']);
    setSession('name', $user['name']);

    header("Location: ../controller/user-dashboard-controller.php");
    exit();
} else {
    // Incorrect credentials or user not found
    setSession('errorMessages', ["Invalid email or password. Please try again."]);
    header("Location: ../view/user-login.php");
    exit();
}

// Close the database connection
$conn->close();

