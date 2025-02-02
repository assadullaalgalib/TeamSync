<?php
session_start();
include_once '../model/project-model.php';
include_once '../model/user-model.php';
include_once '../model/task-model.php';

$action = $_GET['action'] ?? '';

switch ($action) {

    case 'view':
        handleViewTask();
        break;

    default:
        header("Location: ../controller/user-dashboard-controller.php");
        break;
}

function handleViewTask() {
    $userId = $_SESSION['userid'];
    $adminName = getUserName($userId);

    
    $taskId = $_GET['task_id'];
    $task = getTaskDetails($taskId);
    $projectName = getProjectName($task['project_id']);
    $developerName = getUserName($task['developer_id']);
    include '../view/admin-task-view.php';
}