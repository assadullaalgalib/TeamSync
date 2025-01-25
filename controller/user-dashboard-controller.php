<?php
require_once '../model/session-manager-model.php';
include_once '../model/project-model.php';
include_once '../model/user-model.php';
include_once '../model/task-model.php';

startSession();

if (sessionExists('userid') && sessionExists('roleid')) {
    $userId = getSession('userid');
    $roleId = getSession('roleid');

    switch ($roleId) {
        case 1: // Admin
            header('Location: ../view/admin_dashboard.php');
            break;
        case 2: // Project Manager
            showPMdashboard($userId);
            break;
        case 3: // Developer
            showDeveloperDashboard($userId);
            break;
        case 4: // Client
            showClientDashboard($userId);
            break;
        default:
            // There is some issue here, if the user authentication or something doesnt work it auto redirects to login without even notifying. 

            // Invalid role, redirect to login with an error
            header('Location: ../view/user-login.php?error=invalid_role');
    }
    exit();
} else {
    // Not authenticated, redirect to login
    header('Location: ../view/user-login.php?error=not_authenticated');
    exit();
}

function showDeveloperDashboard($developerId)
{
    $developerName = getUserName($developerId);
    $activeTasks = getActiveTasks($developerId);
    $completedTasks = getCompletedTasks($developerId);
    $activeTasksCount = count($activeTasks);
    $completedTasksCount = count($completedTasks);

    include '../view/dev-dashboard.php';
}

function showClientDashboard($clientId)
{
    $projects = getClientProjects($clientId);
    $activeCount = getActiveProjectsCount($clientId);
    $pendingCount = getPendingProjectsCount($clientId);
    $completedCount = getCompletedProjectsCount($clientId);
    $clientName = getUserName($clientId);

    include '../view/client-dashboard.php';
}

function showPMdashboard($pmId)
{
    $pmName = getUserName($pmId);
    $projects = getPMProjects($pmId);
    $pendingTaskApprovals = getPendingTaskApprovals($pmId);

    // Calculate progress for each project
    foreach ($projects as &$project) {
        $project['progress'] = calculateProjectProgress($project['project_id']);
    }
    unset($project); // Break reference

    include '../view/pm-dashboard.php';
}
