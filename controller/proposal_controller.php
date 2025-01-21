<?php
session_start();

// Include the database connection and model
include_once '../model/db.php';
include_once '../model/project_model.php';

$errorMessages = [];

// Retrieve form data
$name = trim($_POST['proposalname']);
$description = trim($_POST['description']);
$deadline = $_POST['proposaldeadline'];

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
$submitSuccess = submitNewProposal($clientId, $name, $description, $deadline);

if ($submitSuccess) {
    echo "<script>
                alert('Project Proposal Has Been Submitted Successfully');
                window.location.href = '../controller/dashboard_controller.php';
              </script>";
} else {
    // Failed to submit the proposal
    echo "<script>
                alert('Error: Something went wrong during submission. Please try again.');
                window.location.href = '../controller/dashboard_controller.php';
              </script>";
}

