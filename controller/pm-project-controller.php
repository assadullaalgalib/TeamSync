<?php
session_start();
include_once '../model/project-model.php';
include_once '../model/user-model.php';
include_once '../model/task-model.php';

$action = $_GET['action'] ?? '';

switch ($action) {

    case 'view_proposal':
        showProjectProposal();
        break;

    case 'approve_reject_proposal':
        handleApproveRejectProposal();
        break;

    case 'edit':
        showEditProjectForm();
        break;
    
    case 'update':
        handleUpdateProject();
        break;

    case 'delete':
        handleDeleteProject();
        break;

    case 'view':
        handleViewProject();
        break;

    case 'handover':
        handleHandoverProject();
        break;

    // Other actions...

    default:
        header("Location: ../controller/user-dashboard-controller.php");
        break;
}

function showProjectProposal() {
    $projectId = $_GET['project_id'];
    $project = getProjectInfo($projectId);
    $clientName = getUserName($project['client_id']); // Assuming you have this function

    include '../view/pm-project-proposal.php';
}

function handleApproveRejectProposal() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $projectId = $_POST['project_id'];
        $action = $_POST['action'];

        if ($action == 'approve') {
            $statusUpdated = updateProjectStatusAndType($projectId, 'Approved', 'Project');
            if ($statusUpdated) {
                $_SESSION['successMessage'] = "Project proposal approved successfully.";
            } else {
                $_SESSION['errorMessage'] = "Failed to approve project proposal.";
            }
        } elseif ($action == 'reject') {
            $statusUpdated = updateProjectStatus($projectId, 'Rejected');
            if ($statusUpdated) {
                $_SESSION['successMessage'] = "Project proposal rejected successfully.";
            } else {
                $_SESSION['errorMessage'] = "Failed to reject project proposal.";
            }
        }

        header("Location: ../controller/user-dashboard-controller.php");
        exit();
    }
}


function showEditProjectForm() {
    $projectId = $_POST['project_id'];
    $project = getProjectInfo($projectId);
    $clientName = getUserName($project['client_id']);

    include '../view/pm-project-edit.php';
}

function handleUpdateProject() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $projectId = $_POST['project_id'];
        $projectName = $_POST['project_name'];
        $description = $_POST['description'];
        $startDate = $_POST['start_date'];
        $deadline = $_POST['deadline'];
        
        $projectUpdated = updateProject($projectId, $projectName, $description, $startDate, $deadline);

        if ($projectUpdated) {
            $_SESSION['successMessage'] = "Project updated successfully.";
        } else {
            $_SESSION['errorMessage'] = "Failed to update project.";
        }

        header("Location: ../controller/pm-project-controller.php?action=view&project_id=$projectId");
        exit();
    }
}

function handleDeleteProject() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $projectId = $_POST['project_id'];

        // First, delete all tasks associated with the project
        $tasksDeleted = deleteTasksByProjectId($projectId);

        // Then, delete the project itself if tasks deletion was successful
        if ($tasksDeleted) {
            $projectDeleted = deleteProject($projectId);

            if ($projectDeleted) {
                $_SESSION['successMessage'] = "Project and associated tasks deleted successfully.";
            } else {
                $_SESSION['errorMessage'] = "Failed to delete project.";
            }
        } else {
            $_SESSION['errorMessage'] = "Failed to delete tasks associated with the project.";
        }

        header("Location: ../controller/user-dashboard-controller.php");
        exit();
    }
}


function handleViewProject() {
    $projectId = $_GET['project_id'];
    $project = getProjectInfo($projectId);
    $clientName = getUserName($project['client_id']);
    $tasks = getTasksForProject($projectId);
    include '../view/pm-project-view.php';
}

function handleHandoverProject() {
    $projectId = $_GET['project_id'];
    $project = getProjectInfo($projectId);

    if ($project['progress'] == 100) {
        $statusUpdated = updateProjectStatus($projectId, 'Completed');

        if ($statusUpdated) {
            $_SESSION['successMessage'] = "Project handed over successfully.";
        } else {
            $_SESSION['errorMessage'] = "Failed to handover project.";
        }
    } else {
        $_SESSION['errorMessage'] = "Project progress must be 100% to handover.";
    }

    header("Location: ../controller/user-dashboard-controller.php");
    exit();
}