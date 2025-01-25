<?php
session_start();
include_once '../model/project-model.php';
include_once '../model/user-model.php';
include_once '../model/task-model.php';

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'view':
        handleViewProject();
        break;

    // Other actions...

    default:
        header("Location: ../controller/user-dashboard-controller.php");
        break;
}

function handleViewProject() {
    $projectId = $_GET['project_id'];
    $project = getProjectInfo($projectId);
    $clientName = getUserName($project['client_id']);
    $tasks = getTasksForProject($projectId);
    include '../view/pm-project-view.php';
}
