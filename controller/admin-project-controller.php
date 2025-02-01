<?php
session_start();
include_once '../model/project-model.php';
include_once '../model/user-model.php';
include_once '../model/task-model.php';

$action = $_GET['action'] ?? '';

switch ($action) {

    case 'show_all_projects':
        showAllProjects();
        break;

    case 'show_all_proposals':
        showProjectProposal();
        break;

    case 'view_proposal':
        handleViewProposal();
        break;
    
    case 'assign_pm':
        assignPMToProject();
        break;

    case 'view_project':
        viewProject();
        break;

    case 'show_edit_project_form':
        showEditProjectForm();
        break;

    case 'edit_project':
        editProject();
        break;

    case 'delete_project':
        handledeleteProject();
        break;
    // Other actions...

    default:
        header("Location: ../controller/user-dashboard-controller.php");
        break;
}
function viewProject() {
    $projectId = $_GET['project_id'];
    $project = getProjectById($projectId);
    $tasks = getTasksForProject($projectId);
    include '../view/admin-project-view.php';
}

function showEditProjectForm() {
    $projectId = $_POST['project_id'];
    $project = getProjectById($projectId);
    $pms = getPMWithProjectCount();
    include '../view/admin-project-edit.php';
}

function editProject() {
    $projectId = $_POST['project_id'];
    $name = $_POST['project_name'];
    $description = $_POST['description'];
    $start_date = $_POST['start_date'];
    $deadline = $_POST['deadline'];
    $status = $_POST['status'];
    $pm_id = $_POST['pm_id'];

    $success = updateProjectAdmin($projectId, $name, $description, $start_date, $deadline, $status, $pm_id);

    if ($success) {
        $_SESSION['message'] = "Project updated successfully";
        header("Location: ../controller/admin-project-controller.php?action=view_project&project_id=$projectId");
    } else {
        $_SESSION['error'] = "Failed to update project";
        header("Location: ../controller/admin-project-controller.php?action=show_edit_project_form&project_id=$projectId");
    }
}

function handledeleteProject() {
    $projectId = $_GET['project_id'];
    $success = deleteProject($projectId);

    if ($success) {
        $_SESSION['message'] = "Project deleted successfully";
        header("Location: ../controller/admin-project-controller.php?action=show_all_projects");
    } else {
        $_SESSION['error'] = "Failed to delete project";
        header("Location: ../controller/admin-project-controller.php?action=show_all_projects");
    }
}

function showAllProjects() {
    $projects = getTotalProjects();
    include '../view/admin-project-showall.php';
}

function showProjectProposal() {
    $projects = getAllPendingProjects();
    include '../view/admin-proposal-showall.php';
}

function handleViewProposal() {
    $projectId = $_GET['project_id'];
    $project = getProjectInfo($projectId);
    $clientName = getUserName($project['client_id']);
    $pms = getPMWithProjectCount();
    include '../view/admin-proposal-view.php';
}

function assignPMToProject() {
    $projectId = $_POST['project_id'];
    $pmId = $_POST['pm_id'];
    assignProjectManager($projectId, $pmId);
    header("Location: ../controller/admin-project-controller.php?action=show_all_proposals.php");
}