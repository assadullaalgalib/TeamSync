<?php
session_start();

// Include the database connection and model
include_once '../model/db.php';
include_once '../model/project_model.php';

$errorMessages = [];

// Retrieve form data
$name = trim($_POST['name']);
$description = trim($_POST['description']);
$deadline = $_POST['deadline'];

// Server-side validation
// Name validation
if (empty($name)) {
    $errorMessages[] = "Project name is required.";
}

// Description validation
if (empty($description)) {
    $errorMessages[] = "Project description is required.";
}

// Deadline validation
if (empty($deadline)) {
    $errorMessages[] = "Deadline is required.";
}

// If there are validation errors, redirect to proposal page with error messages
if (!empty($errorMessages)) {
    $_SESSION['errorMessages'] = $errorMessages;
    header("Location: ../view/submit_proposal.php");
    exit();
}

// Call the model function to submit the new proposal
$clientId = $_SESSION['userid'];

if (submitNewProposal($clientId, $name, $description, $deadline)) {
    // Proposal submitted successfully
    $_SESSION['successMessage'] = "Proposal submitted successfully.";
    header("Location: ../view/client_dashboard.php");
} else {
    // Failed to submit the proposal
    $_SESSION['errorMessages'] = ["Failed to submit the proposal. Please try again."];
    header("Location: ../view/submit_proposal.php");
}
?>
