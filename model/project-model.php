<?php
include_once 'db-connection-model.php';

function assignProjectManager($projectId, $pmId) {
    $conn = getDbConnection();
    $sql = "UPDATE projects 
            SET pm_id = ?, status = 'Approved', type = 'Project' 
            WHERE project_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $pmId, $projectId);
    $result = $stmt->execute();

    $stmt->close();
    $conn->close();
    return $result;
}


function getTotalProjects() {
    $conn = getDbConnection();
    $sql = "SELECT p.project_id, CONCAT(c.firstname, ' ', c.lastname) AS client_name, CONCAT(pm.firstname, ' ', pm.lastname) AS pm_name, p.name, p.description, p.start_date, p.deadline, p.status, p.progress, p.comment, p.client_feedback
            FROM projects p
            JOIN usr c ON p.client_id = c.userid
            JOIN usr pm ON p.pm_id = pm.userid";
    $stmt = $conn->prepare($sql);
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



function getAllActiveProjects() {
    $conn = getDbConnection();
    $sql = "SELECT p.project_id, c.name AS client_name, pm.name AS pm_name, p.name, p.description, p.start_date, p.deadline, p.status, p.progress, p.comment, p.client_feedback
            FROM projects p
            JOIN usr c ON p.client_id = c.userid
            JOIN usr pm ON p.pm_id = pm.userid
            WHERE p.status = 'Approved' OR p.status = 'In Progress'";
    $stmt = $conn->prepare($sql);
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


function getAllPendingProjects() {
    $conn = getDbConnection();
    $sql = "SELECT p.project_id, CONCAT(c.firstname, ' ', c.lastname) AS client_name, CONCAT(pm.firstname, ' ', pm.lastname) AS pm_name, p.name, p.description, p.start_date, p.deadline, p.status, p.progress, p.comment, p.client_feedback
            FROM projects p
            JOIN usr c ON p.client_id = c.userid
            LEFT JOIN usr pm ON p.pm_id = pm.userid
            WHERE p.status = 'Pending Approval'";
    $stmt = $conn->prepare($sql);
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



function getAllCompletedProjects() {
    $conn = getDbConnection();
    $sql = "SELECT p.project_id, c.name AS client_name, pm.name AS pm_name, p.name, p.description, p.start_date, p.deadline, p.status, p.progress, p.comment, p.client_feedback
            FROM projects p
            JOIN usr c ON p.client_id = c.userid
            JOIN usr pm ON p.pm_id = pm.userid
            WHERE p.status = 'Completed'";
    $stmt = $conn->prepare($sql);
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


function acceptHandedoverProject($projectId, $clientFeedback) {
    $conn = getDbConnection();
    $status = 'Completed';
    $sql = "UPDATE projects 
            SET status = ?, client_feedback = ? 
            WHERE project_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $status, $clientFeedback, $projectId);
    $result = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $result;
}

function rejectHandedoverProject($projectId, $clientFeedback) {
    $conn = getDbConnection();
    $status = 'In Progress';
    $sql = "UPDATE projects 
            SET status = ?, client_feedback = ? 
            WHERE project_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $status, $clientFeedback, $projectId);
    $result = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $result;
}


function getAllProjectsWithClientNames($pmId) {
    $conn = getDbConnection();
    $sql = "SELECT p.project_id, c.name AS client_name, p.name, p.description, p.start_date, p.deadline, p.status, p.progress, p.comment, p.client_feedback
            FROM projects p
            JOIN usr c ON p.client_id = c.userid
            WHERE p.pm_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $pmId);
    $stmt->execute();
    $result = $stmt->get_result();
    $projects = [];

    while ($row = $result->fetch_assoc()) {
        $projects[] = $row;
    }

    $conn->close();
    return $projects;
}

function searchClientProjects($query, $userid) {
    $conn = getDbConnection();
    $sql = "SELECT project_id, name 
            FROM projects 
            WHERE client_id = ? AND LOWER(name) LIKE ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $userid, $query);
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

function searchPMProjects($query, $userid) {
    $conn = getDbConnection();
    $sql = "SELECT project_id, name 
            FROM projects 
            WHERE pm_id = ? AND LOWER(name) LIKE ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $userid, $query);
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


function getPendingProjectProposals($pmId) {
    $conn = getDbConnection();
    $sql = "SELECT * 
            FROM projects 
            WHERE type = 'Proposal' AND status = 'Pending Approval' AND pm_id = ?";
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



function updateProject($projectId, $projectName, $description, $startDate, $deadline) {
    $conn = getDbConnection();
    $sql = "UPDATE projects 
            SET name = ?, description = ?, start_date = ?, deadline = ? 
            WHERE project_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $projectName, $description, $startDate, $deadline, $projectId);
    $result = $stmt->execute();

    $stmt->close();
    $conn->close();
    return $result;
}

function deleteProject($projectId) {
    $conn = getDbConnection();
    $sql = "DELETE 
            FROM projects 
            WHERE project_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $projectId);
    $result = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $result;
}

function updateProjectStatusBasedOnTasks($projectId) {
    $conn = getDbConnection();

    $sql = "SELECT progress, status 
            FROM projects 
            WHERE project_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $projectId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    $progress = $row['progress'];
    $status = $row['status'];

    if ($progress < 100) {
        $status = 'In Progress';
    }

    $sql = "UPDATE projects 
            SET status = ? 
            WHERE project_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $projectId);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}


function updateProjectStatus($projectId, $status) {
    $conn = getDbConnection();
    $sql = "UPDATE projects 
            SET status = ? 
            WHERE project_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $projectId);
    $result = $stmt->execute();

    $stmt->close();
    $conn->close();
    return $result;
}

function updateProjectStatusAndType($projectId, $status, $type) {
    $conn = getDbConnection();
    $sql = "UPDATE projects 
            SET status = ?, type = ? 
            WHERE project_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $status, $type, $projectId);
    $result = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $result;
}

function getProjectInfo($projectId) {
    $conn = getDbConnection();
    $sql = "SELECT * 
            FROM projects 
            WHERE project_id = ?";
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
    $sql = "SELECT * 
            FROM projects 
            WHERE pm_id = ?";
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

function getPMOngoingProjects($pmId) {
    $conn = getDbConnection(); 
    $sql = "SELECT * 
            FROM projects 
            WHERE pm_id = ? AND (status = 'Approved' OR status = 'In Progress')";
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

function getPMHandedoverProjects($pmId) {
    $conn = getDbConnection(); 
    $sql = "SELECT * 
            FROM projects 
            WHERE pm_id = ? AND (status = 'Handed Over')";
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

function getPMCompletedProjects($pmId) {
    $conn = getDbConnection(); 
    $sql = "SELECT * 
            FROM projects 
            WHERE pm_id = ? AND status = 'Completed'";
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
    $sql = "SELECT * 
            FROM projects 
            WHERE client_id = ? 
            ORDER BY project_id DESC";
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


function getClientActiveProjects($clientId) {
    $conn = getDbConnection();
    $sql = "SELECT project_id, name, description, start_date, deadline, status, progress, comment, client_feedback 
            FROM projects 
            WHERE client_id = ? AND (status = 'Approved' OR status = 'In Progress')";
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


function getClientPendingProjects($clientId) {
    $conn = getDbConnection();
    $sql = "SELECT project_id, name, description, start_date, deadline, status, progress, comment, client_feedback 
            FROM projects 
            WHERE client_id = ? AND status = 'Pending Approval'";
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

function getClientHandedoverProjects($clientId) {
    $conn = getDbConnection();
    $sql = "SELECT project_id, name, description, start_date, deadline, status, progress, comment, client_feedback 
            FROM projects 
            WHERE client_id = ? AND status = 'Handed Over'";
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


function getClientCompletedProjects($clientId) {
    $conn = getDbConnection();
    $sql = "SELECT project_id, name, description, start_date, deadline, status, progress, comment, client_feedback 
            FROM projects 
            WHERE client_id = ? AND status = 'Completed'";
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

function getClientRejectedProjects($clientId) {
    $conn = getDbConnection();
    $sql = "SELECT project_id, name, description, start_date, deadline, status, progress, comment, client_feedback 
            FROM projects 
            WHERE client_id = ? AND status = 'Rejected'";
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


function calculateProjectProgress($projectId) {
    $conn = getDbConnection();

    // Total tasks for the project
    $sqlTotal = "SELECT COUNT(*) AS total 
                FROM tasks 
                WHERE project_id = ?";
    $stmtTotal = $conn->prepare($sqlTotal);
    $stmtTotal->bind_param("i", $projectId);
    $stmtTotal->execute();
    $resultTotal = $stmtTotal->get_result();
    $totalTasks = $resultTotal->fetch_assoc()['total'];

    // Completed tasks for the project
    $sqlCompleted = "SELECT COUNT(*) AS completed 
                    FROM tasks 
                    WHERE project_id = ? AND status = 'Completed'";
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
    

    $sql = "INSERT INTO projects (client_id, name, description, deadline, status, type) 
            VALUES (?, ?, ?, ?, 'Pending Approval', 'Proposal')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isss", $clientId, $name, $description, $deadline);
    
    $result = $stmt->execute();
    
    $stmt->close();
    $conn->close();
    
    return $result;
}


?>
