<?php
include_once 'db-connection-model.php';

function searchPMTasks($query, $userid) {
    $conn = getDbConnection();
    $sql = "SELECT t.task_id, t.name 
            FROM tasks t
            JOIN projects p ON t.project_id = p.project_id
            WHERE LOWER(t.name) LIKE ? AND p.pm_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $query, $userid);
    $stmt->execute();
    $result = $stmt->get_result();
    $tasks = [];

    while ($row = $result->fetch_assoc()) {
        $tasks[] = $row;
    }

    $stmt->close();
    $conn->close();
    return $tasks;
}


function getProjectIdByTaskId($taskId) {
    $conn = getDbConnection();
    $sql = "SELECT project_id FROM tasks WHERE task_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $taskId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    $stmt->close();
    $conn->close();

    return $row['project_id'];
}

function deleteTasksByProjectId($projectId) {
    $conn = getDbConnection();
    $sql = "DELETE FROM tasks WHERE project_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $projectId);
    $result = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $result;
}

function updateTask($taskId, $taskName, $taskDescription, $startDate, $deadline, $developerId, $status) {
    $conn = getDbConnection();
    $sql = "UPDATE tasks SET name = ?, description = ?, start_date = ?, deadline = ?, developer_id = ?, status = ? WHERE task_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $taskName, $taskDescription, $startDate, $deadline, $developerId, $status, $taskId);
    $result = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $result;
}

function deleteTask($taskId) {
    $conn = getDbConnection();
    $sql = "DELETE FROM tasks WHERE task_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $taskId);
    $result = $stmt->execute();
    
    $stmt->close();
    $conn->close();
    return $result;
}

function createTask($projectId, $taskName, $taskDescription, $startDate, $deadline, $developerId, $status) {
    $conn = getDbConnection();
    $sql = "INSERT INTO tasks (project_id, name, description, start_date, deadline, developer_id, status) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("issssis", $projectId, $taskName, $taskDescription, $startDate, $deadline, $developerId, $status);
    $result = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $result;
}

function approveTask($taskId, $pmComment) {
    $conn = getDbConnection();
    $sql = "UPDATE tasks SET status = 'Completed', pm_comment = ? WHERE task_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $pmComment, $taskId);
    $result = $stmt->execute();
    
    $stmt->close();
    $conn->close();
    return $result;
}

function rejectTask($taskId, $pmComment) {
    $conn = getDbConnection();
    $sql = "UPDATE tasks SET status = 'In Progress', pm_comment = ? WHERE task_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $pmComment, $taskId);
    $result = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $result;
}

function getPendingTaskApprovals($pmId) {
    $conn = getDbConnection(); 
    $sql = "SELECT t.* 
            FROM tasks t 
            JOIN projects p ON t.project_id = p.project_id
            WHERE p.pm_id = ? AND t.status = 'Waiting For Approval'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $pmId);
    $stmt->execute();
    $result = $stmt->get_result();

    $pendingTaskApprovals = [];
    while ($row = $result->fetch_assoc()) {
        $pendingTaskApprovals[] = $row;
    }

    $stmt->close();
    $conn->close();

    return $pendingTaskApprovals;
}


function getActiveTasks($developerId) {
    $conn = getDbConnection();
    $sql = "SELECT t.*, p.name AS project_name, u.firstname AS pm_name
            FROM tasks t
            JOIN projects p ON t.project_id = p.project_id
            JOIN usr u ON p.pm_id = u.userid
            WHERE t.developer_id = ? AND t.status IN ('Not Started', 'In Progress', 'Waiting For Approval')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $developerId);
    $stmt->execute();
    $result = $stmt->get_result();

    $tasks = [];
    while ($row = $result->fetch_assoc()) {
        $tasks[] = $row;
    }

    $stmt->close();
    $conn->close();

    return $tasks;
}

function getCompletedTasks($developerId) {
    $conn = getDbConnection();
    $sql = "SELECT t.*, p.name AS project_name, u.firstname AS pm_name
            FROM tasks t
            JOIN projects p ON t.project_id = p.project_id
            JOIN usr u ON p.pm_id = u.userid
            WHERE t.developer_id = ? AND t.status = 'Completed'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $developerId);
    $stmt->execute();
    $result = $stmt->get_result();

    $tasks = [];
    while ($row = $result->fetch_assoc()) {
        $tasks[] = $row;
    }

    $stmt->close();
    $conn->close();

    return $tasks;
}

function getTaskDetails($taskId) {
    $conn = getDbConnection();
    $sql = "SELECT t.*, p.name AS project_name, u.firstname AS pm_name, u.lastname AS pm_lastname
            FROM tasks t
            JOIN projects p ON t.project_id = p.project_id
            JOIN usr u ON p.pm_id = u.userid
            WHERE t.task_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $taskId);
    $stmt->execute();
    $result = $stmt->get_result();
    $task = $result->fetch_assoc();

    $stmt->close();
    $conn->close();

    $task['pm_name'] = $task['pm_name'] . ' ' . $task['pm_lastname'];

    return $task;
}

function getTasksForProject($projectId) {
    $conn = getDbConnection();
    $sql = "SELECT * FROM tasks WHERE project_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $projectId);
    $stmt->execute();
    $result = $stmt->get_result();

    $tasks = [];
    while ($row = $result->fetch_assoc()) {
        $tasks[] = $row;
    }

    $stmt->close();
    $conn->close();

    return $tasks;
}


function saveFileData($taskId, $fileData, $fileName, $fileType) {
    $conn = getDbConnection();
    $sql = "UPDATE tasks SET file_data = ?, file_name = ?, file_type = ? WHERE task_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("bssi", $fileData, $fileName, $fileType, $taskId);
    $stmt->send_long_data(0, $fileData);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}

function getFileDetails($taskId) {
    $conn = getDbConnection();
    $sql = "SELECT file_data, file_name, file_type FROM tasks WHERE task_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $taskId);
    $stmt->execute();
    $result = $stmt->get_result();
    $fileDetails = $result->fetch_assoc();

    $stmt->close();
    $conn->close();

    return $fileDetails;
}

function updateTaskStatus($taskId, $status) { 
    $conn = getDbConnection(); 
    $sql = "UPDATE tasks SET status = ? WHERE task_id = ?"; 
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("si", $status, $taskId); 
    $stmt->execute(); 

    $stmt->close(); 
    $conn->close(); 
}

?>
