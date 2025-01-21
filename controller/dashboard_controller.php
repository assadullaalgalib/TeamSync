<?php
// dashboard_controller.php - Handle user dashboard requests

include_once '../model/project_model.php';
include_once '../model/user_model.php';
include_once '../model/task_model.php';

session_start();

if (isset($_SESSION['userid']) && isset($_SESSION['roleid'])) {
    $userId = $_SESSION['userid'];
    $roleId = $_SESSION['roleid'];

    switch ($roleId) {
        case 1: // Admin
            header('Location: ../view/admin_dashboard.php');
            break;
        case 2: // Project Manager
            header('Location: ../view/pm_dashboard.php');
            break;
        case 3: // Developer
            showDeveloperDashboard($userId);
            break;
        case 4: // Client
            showClientDashboard($userId);
            break;
        default:
            // Invalid role, redirect to login with an error
            header('Location: ../view/login.php?error=invalid_role');
    }
    exit();
} else {
    // Not authenticated, redirect to login
    header('Location: ../view/login.php?error=not_authenticated');
    exit();
}

function showDeveloperDashboard($developerId)
{
    $developerName = getUserName($developerId);
    $activeTasks = getActiveTasks($developerId);
    $completedTasks = getCompletedTasks($developerId);
    $activeTasksCount = count($activeTasks);
    $completedTasksCount = count($completedTasks);

    include '../view/developer_dashboard.php';
}

function showClientDashboard($clientId)
{
    $projects = getClientProjects($clientId);
    $activeCount = getActiveProjectsCount($clientId);
    $pendingCount = getPendingProjectsCount($clientId);
    $completedCount = getCompletedProjectsCount($clientId);
    $clientName = getUserName($clientId);

    include '../view/client_dashboard.php';
}
