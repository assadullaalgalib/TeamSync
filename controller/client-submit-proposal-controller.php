<?php
// Include the session manager
require_once '../model/session-manager-model.php';

// Start the session using the session manager
startSession();

// Include the database connection and model
include_once '../model/db-connection-model.php';
include_once '../model/project-model.php';

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
    setSession('errorMessages', $errorMessages);
    header("Location: ../view/client-submit-proposal.php");
    exit();
}

// Call the model function to submit the new proposal
$clientId = getSession('userid');
$submitSuccess = submitNewProposal($clientId, $name, $description, $deadline);

if ($submitSuccess) {
    echo "<script>
                alert('Project Proposal Has Been Submitted Successfully');
                window.location.href = '../controller/user-dashboard-controller.php';
              </script>";
} else {
    // Failed to submit the proposal
    echo "<script>
                alert('Error: Something went wrong during submission. Please try again.');
                window.location.href = '../controller/user-dashboard-controller.php';
              </script>";
}
?>
