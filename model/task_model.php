<?php
include_once 'db.php';

function getActiveTasks($developerId) {
    $conn = getDbConnection();
    $sql = "SELECT t.*, p.name AS project_name, u.firstname AS pm_name
            FROM tasks t
            JOIN projects p ON t.project_id = p.project_id
            JOIN usr u ON p.pm_id = u.userid
            WHERE t.developer_id = ? AND t.status IN ('Not Started', 'In Progress')";
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
?>
