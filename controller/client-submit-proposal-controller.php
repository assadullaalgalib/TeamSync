<?php
// Include the session manager
require_once '../model/session-manager-model.php';

// Start the session using the session manager
startSession();

// Include the database connection and model
include_once '../model/db-connection-model.php';
include_once '../model/project-model.php';
include_once '../model/user-model.php';

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'view':
        showClientSubmitProposalView();
        exit();

    case 'submit':
        handleClientSubmitProposal();
        exit();

    default:
        // If no action is specified, redirect to the proposal form view by default
        header("Location: ../controller/user-dashboard-controller.php");
        exit();
}

function showClientSubmitProposalView() {
    $clientId = getSession('userid');
    $clientName = getUserName($clientId);

    include '../view/client-submit-proposal.php';
}

function handleClientSubmitProposal() {
    // Retrieve form data
    $name = trim($_POST['proposalname']);
    $description = trim($_POST['description']);
    $deadline = $_POST['proposaldeadline'];

    // Call the model function to submit the new proposal
    $clientId = getSession('userid');
    $clientName = getUserName($clientId);

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
}
?>
