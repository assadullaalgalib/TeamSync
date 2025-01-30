<?php
session_start();
include_once '../model/project-model.php';
include_once '../model/user-model.php';

$action = $_GET['action'] ?? 'all'; // Default to 'all' if no action is specified
$clientId = $_SESSION['userid']; // Assuming client ID is stored in session

switch ($action) {
    case 'active':
        $projects = getClientActiveProjects($clientId);
        $projectType = "Active";
        break;
    case 'pending':
        $projects = getClientPendingProjects($clientId);
        $projectType = "Pending";
        break;
    case 'handedover':
        $projects = getClientHandedoverProjects($clientId);
        $projectType = "Handed Over";
        break;
    case 'completed':
        $projects = getClientCompletedProjects($clientId);
        $projectType = "Completed";
        break;
    case 'rejected':
        $projects = getClientRejectedProjects($clientId);
        $projectType = "Rejected";
        break;
    default:
        $projects = getClientProjects($clientId); // Default to 'all'
        $projectType = "All";
        break;
}

$activeProjectsCount = count(getClientActiveProjects($clientId));
$pendingProjectsCount = count(getClientPendingProjects($clientId));
$handedoverProjectsCount = count(getClientHandedoverProjects($clientId));
$completedProjectsCount = count(getClientCompletedProjects($clientId));
$rejectedProjectsCount = count(getClientRejectedProjects($clientId));
$allProjectsCount = count(getClientProjects($clientId));

$clientName = getUserName($clientId); // Assuming this function fetches the client's name

include '../view/client-dashboard.php';
