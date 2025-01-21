<?php
session_start();

// Include the database connection and model
include_once '../model/db.php';
include_once '../model/user_model.php';

$errorMessages = [];

// Retrieve form data
$first_name = trim($_POST['first_name']);
$last_name = trim($_POST['last_name']);
$username = trim($_POST['username']);
$email = trim($_POST['email']);
$password = $_POST['password'];
$confirmPassword = $_POST['confirm_password'];
$role = $_POST['role'];

// Server-side validation
// Role validation
if (empty($role)) {
    $errorMessages[] = "Please select a role.";
}

// First Name validation
if (empty($first_name)) {
    $errorMessages[] = "Please enter a First name.";
}

// Last Name validation
if (empty($last_name)) {
    $errorMessages[] = "Please enter a Last name.";
}

// Username validation
if (empty($username)) {
    $errorMessages[] = "Please enter a Username.";
}

if (empty($email)) {
    $errorMessages[] = "Email is required.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errorMessages[] = "Invalid email format.";
}

// Password validation
if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[^a-zA-Z0-9]/', $password)) {
    $errorMessages[] = "Password must be at least 8 characters long, with at least one uppercase letter, one lowercase letter, and one special character.";
}

// Confirm password validation
if ($password !== $confirmPassword) {
    $errorMessages[] = "Passwords do not match.";
}

// Check for errors
if (!empty($errorMessages)) {
    $_SESSION['errorMessages'] = $errorMessages;
    header("Location: ../view/registration.php");
    exit();
} else {
    // Role mapping based on the value in the registration form
    switch ($role) {
        case 'developer':
            $roleid = 3;
            break;
        case 'client':
            $roleid = 4;
            break;
        default:
            $roleid = 3; // Default to Developer if something goes wrong
            break;
    }

    // Call the model function to insert the user into the database
    $insertSuccess = insertUser($first_name, $last_name, $username, $email, $password, $roleid);

    if ($insertSuccess) {
        // Registration successful, redirect to login page with success message
        echo "<script>
                alert('Registration Successful');
                window.location.href = '../view/login.php';
              </script>";
    } else {
        // Error during registration
        echo "<script>
                alert('Error: Something went wrong during registration.');
                window.location.href = '../view/registration.php';
              </script>";
    }
}
