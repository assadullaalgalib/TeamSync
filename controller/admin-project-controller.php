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

    // Other actions...

    default:
        header("Location: ../controller/user-dashboard-controller.php");
        break;
}

function showAllProjects() {
    $projects = getTotalProjects();
    include '../view/admin-show-all-project.php';
}

function showProjectProposal() {
    $projects = getAllPendingProjects();
    include '../view/admin-show-all-proposal.php';
}

function handleViewProposal() {
    $projectId = $_GET['project_id'];
    $project = getProjectInfo($projectId);
    $clientName = getUserName($project['client_id']);
    $pms = getPMWithProjectCount();
    include '../view/admin-view-proposal.php';
}

function assignPMToProject() {
    $projectId = $_POST['project_id'];
    $pmId = $_POST['pm_id'];
    assignProjectManager($projectId, $pmId);
    header("Location: ../controller/admin-project-controller.php?action=show_all_proposals.php");
}