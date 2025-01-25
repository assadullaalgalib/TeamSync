<?php
include_once 'db-connection-model.php';

function getProjectInfo($projectId) {
    $conn = getDbConnection();
    $sql = "SELECT * FROM projects WHERE project_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $projectId);
    $stmt->execute();

    $result = $stmt->get_result();
    $projectInfo = $result->fetch_assoc();

    $stmt->close();
    $conn->close();

    return $projectInfo;
}

function getProjectName($projectId) {
    $projectInfo = getProjectInfo($projectId); 
    return $projectInfo['name'];
}

function getPMProjects($pmId) {
    $conn = getDbConnection(); 
    $sql = "SELECT * FROM projects WHERE pm_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $pmId);
    $stmt->execute();
    $result = $stmt->get_result();

    $projects = [];
    while ($row = $result->fetch_assoc()) {
        $projects[] = $row;
    }

    $stmt->close();
    $conn->close();

    return $projects;
}


function getClientProjects($clientId) {
    $conn = getDbConnection();
    $sql = "SELECT project_id, name, description, status, deadline, progress FROM projects WHERE client_id = ? ORDER BY project_id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $clientId);
    $stmt->execute();
    $result = $stmt->get_result();

    $projects = [];
    while ($row = $result->fetch_assoc()) {
        $projects[] = $row;
    }

    $stmt->close();
    $conn->close();

    return $projects;
}


function getActiveProjectsCount($clientId) {
    $conn = getDbConnection();
    $sql = "SELECT COUNT(*) as count FROM projects WHERE client_id = ? AND status = 'Approved' OR status = 'In Progress'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $clientId);
    $stmt->execute();
    $result = $stmt->get_result();
    $count = $result->fetch_assoc()['count'];

    $stmt->close();
    $conn->close();

    return $count;
}

function getPendingProjectsCount($clientId) {
    $conn = getDbConnection();
    $sql = "SELECT COUNT(*) as count FROM projects WHERE client_id = ? AND status = 'Pending Approval'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $clientId);
    $stmt->execute();
    $result = $stmt->get_result();
    $count = $result->fetch_assoc()['count'];

    $stmt->close();
    $conn->close();

    return $count;
}

function getCompletedProjectsCount($clientId) {
    $conn = getDbConnection();
    $sql = "SELECT COUNT(*) as count FROM projects WHERE client_id = ? AND status = 'Completed'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $clientId);
    $stmt->execute();
    $result = $stmt->get_result();
    $count = $result->fetch_assoc()['count'];

    $stmt->close();
    $conn->close();

    return $count;
}

function calculateProjectProgress($projectId) {
    $conn = getDbConnection();

    // Total tasks for the project
    $sqlTotal = "SELECT COUNT(*) as total FROM tasks WHERE project_id = ?";
    $stmtTotal = $conn->prepare($sqlTotal);
    $stmtTotal->bind_param("i", $projectId);
    $stmtTotal->execute();
    $resultTotal = $stmtTotal->get_result();
    $totalTasks = $resultTotal->fetch_assoc()['total'];

    // Completed tasks for the project
    $sqlCompleted = "SELECT COUNT(*) as completed FROM tasks WHERE project_id = ? AND status = 'Completed'";
    $stmtCompleted = $conn->prepare($sqlCompleted);
    $stmtCompleted->bind_param("i", $projectId);
    $stmtCompleted->execute();
    $resultCompleted = $stmtCompleted->get_result();
    $completedTasks = $resultCompleted->fetch_assoc()['completed'];

    $stmtTotal->close();
    $stmtCompleted->close();
    $conn->close();

    // Calculate progress
    if ($totalTasks === 0) {
        return 0;
    }

    $progress = ($completedTasks * 100) / $totalTasks;

    // Format the progress to 2 decimal places
    return number_format($progress, 2);
}

function submitNewProposal($clientId, $name, $description, $deadline) {
    $conn = getDbConnection();
    

    $sql = "INSERT INTO projects (client_id, name, description, deadline, status, type) VALUES (?, ?, ?, ?, 'Pending Approval', 'Proposal')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isss", $clientId, $name, $description, $deadline);
    
    $result = $stmt->execute();
    
    $stmt->close();
    $conn->close();
    
    return $result;
}


?>
