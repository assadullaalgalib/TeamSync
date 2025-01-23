<?php
include_once 'db-connection-model.php';

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

    // Combine first and last name
    $task['pm_name'] = $task['pm_name'] . ' ' . $task['pm_lastname'];

    return $task;
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

