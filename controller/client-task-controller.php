<?php
session_start();
include_once '../model/task-model.php';
include_once '../model/project-model.php';
include_once '../model/user-model.php';

$action = $_GET['action'] ?? 'view';
$clientId = $_SESSION['userid']; // Assuming client ID is stored in session

switch ($action) {
    case 'view':
        handleViewTask();
        break;
    default:
        header("Location: ../controller/client-dashboard-controller.php");
        break;
}

function handleViewTask() {
    $taskId = $_GET['task_id'];
    $task = getTaskDetails($taskId); // Assuming this function fetches a task by its ID
    $projectName = getProjectName($task['project_id']); // Assuming this function fetches the project name by ID
    $developerName = getUserName($task['developer_id']); // Assuming this function fetches the developer name by ID

    include '../view/client-task-view.php';
}
