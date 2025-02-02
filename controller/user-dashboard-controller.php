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
            showAdminDashboard($userId);
            break;
        case 2: // Project Manager
            showPMDashboard($userId);
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

function showAdminDashboard($adminId)
{
    $adminName = getUserName($adminId);

    $totalProjects = getTotalProjects();
    $activeProjects = getAllActiveProjects();
    $pendingProjects = getAllPendingProjects();
    $completedProjects = getAllCompletedProjects();
    $rejectedProjects = getAllRejectedProjectProposals();

    $allUsers = getAllUsers();
    $allClients = getAllClients();
    $allPMs = getAllPMs();
    $allDevelopers = getAllDevelopers();
    $allAdmins = getAllAdminDetails();

    $totalProjectsCount = count($totalProjects);
    $activeProjectsCount = count($activeProjects);
    $pendingProjectsCount = count($pendingProjects);
    $completedProjectsCount = count($completedProjects);
    $rejectedProjectsCount = count($rejectedProjects);

    $allUsersCount = count($allUsers);
    $allClientsCount = count($allClients);
    $allPMsCount = count($allPMs);
    $allDevelopersCount = count($allDevelopers);
    $allAdminsCount = count($allAdmins);

    include '../view/admin-dashboard.php';
}

function showDeveloperDashboard($developerId)
{
    $devName = getUserName($developerId);
    $activeTasks = getActiveTasks($developerId);
    $completedTasks = getCompletedTasks($developerId);
    $activeTasksCount = count($activeTasks);
    $completedTasksCount = count($completedTasks);
    $totalTasksCount = $activeTasksCount + $completedTasksCount;

    include '../view/dev-dashboard.php';
}

function showClientDashboard($clientId)
{
    $clientName = getUserName($clientId);

    /* $projects = getClientProjects($clientId);
    $activeProjects = getClientActiveProjects($clientId);
    $pendingProjects = getClientPendingProjects($clientId);
    $completedProjects = getClientCompletedProjects($clientId);

    $activeProjectsCount = count($activeProjects);
    $pendingProjectsCount = count($pendingProjects);
    $completedProjectsCount = count($completedProjects);

    include '../view/client-dashboard.php'; */

    header("Location: ../controller/client-dashboard-controller.php");
    exit();


}

function showPMDashboard($pmId)
{
    $pmName = getUserName($pmId);
    $projects = getPMProjects($pmId);
    $ongoingProjects = getPMOngoingProjects($pmId);
    $completedProjects = getPMCompletedProjects($pmId);
    $pendingProposals = getPendingProjectProposals($pmId);
    $handedoverProjects = getPMHandedOverProjects($pmId);

    $pendingTaskApprovals = getPendingTaskApprovals($pmId);

    // Calculate progress for each project
    foreach ($projects as &$project) {
        $project['progress'] = calculateProjectProgress($project['project_id']);
    }
    unset($project); // Break reference

    include '../view/pm-dashboard.php';
}
