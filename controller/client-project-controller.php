<?php
session_start();
include_once '../model/project-model.php';
include_once '../model/task-model.php';
include_once '../model/user-model.php';

$action = $_GET['action'] ?? 'all';
$clientId = $_SESSION['userid']; // Assuming client ID is stored in session

switch ($action) {
    case 'view':
        handleViewProject();
        break;
    case 'accept_reject':
        handleAcceptRejectProject();
        break;
    case 'download_file':
        fileDownload();
        break;
    default:
        header("Location: ../controller/user-dashboard-controller.php");
        break;
}

function fileDownload(){
    $userId = $_SESSION['userid'];
    $clientName = getUserName($userId);

    handleFileDownload();
}

function handleViewProject() {
    $userId = $_SESSION['userid'];
    $clientName = getUserName($userId);

    $projectId = $_GET['project_id'];
    $project = getProjectInfo($projectId); // Assuming this function fetches a project by its ID
    $tasks = getTasksForProject($projectId); // Assuming this function fetches tasks related to a project
    $pmName = getUserName($project['pm_id']);
    include '../view/client-project-view.php';
}

function handleAcceptRejectProject() {
    $userId = $_SESSION['userid'];
    $clientName = getUserName($userId);

    $projectId = $_POST['project_id'];
    $action = $_POST['action'];
    $clientFeedback = $_POST['client_feedback'];

    if ($action == 'accept') {

        $projectAccepted = acceptHandedoverProject($projectId, $clientFeedback);
        if ($taskApproved) {
            $_SESSION['successMessage'] = "Project accepted successfully.";
        } else {
            $_SESSION['errorMessage'] = "Failed to accept project.";
        }
    } elseif ($action == 'reject') {

        $projectRejected = rejectHandedoverProject($projectId, $clientFeedback);
        if ($taskRejected) {
            $_SESSION['successMessage'] = "Project rejected successfully.";
        } else {
            $_SESSION['errorMessage'] = "Failed to reject project.";
        }
    }

    header("Location: ../controller/client-dashboard-controller.php");
    exit();
}