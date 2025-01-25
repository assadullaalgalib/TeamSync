<?php
session_start();
include_once '../model/task-model.php';
include_once '../model/project-model.php';
include_once '../model/user-model.php';

$action = $_GET['action'] ?? '';

switch ($action) {
/*     case 'create':
        handleCreateTask();
        break;

    case 'edit':
        handleEditTask();
        break;

    case 'delete':
        handleDeleteTask();
        break;
 */
    case 'view':
        handleViewTask();
        break;

    case 'approve_reject':
        handleApproveRejectTask();
        break;

    case 'download_file':
        handleFileDownload();
        break;

    default:
        header("Location: ../view/pm-dashboard.php");
        break;
}


function handleFileDownload() {
    $taskId = $_POST['task_id'];
    $fileDetails = getFileDetails($taskId);

    if ($fileDetails) {
        // Clear the output buffer to prevent previous output
        if (ob_get_level()) {
            ob_end_clean();
        }

        // Set headers for file download
        header('Content-Description: File Transfer');
        header('Content-Type: ' . $fileDetails['file_type']);
        header('Content-Disposition: attachment; filename="' . $fileDetails['file_name'] . '"');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . strlen($fileDetails['file_data']));

        // Output the file content
        echo $fileDetails['file_data'];
        exit;
    } else {
        setSession('fileMessage', "File not found.");
        header("Location: ../controller/pm-task-controller.php?action=view&task_id=$taskId");
        exit;
    }
}

function handleApproveRejectTask() {
    $taskId = $_POST['task_id'];
    $pmComment = $_POST['pm_comment'];
    $action = $_POST['action'];

    if ($action == 'approve') {
        $taskApproved = approveTask($taskId, $pmComment);
        if ($taskApproved) {
            $_SESSION['successMessage'] = "Task approved successfully.";
        } else {
            $_SESSION['errorMessage'] = "Failed to approve task.";
        }
    } elseif ($action == 'reject') {
        $taskRejected = rejectTask($taskId, $pmComment);
        if ($taskRejected) {
            $_SESSION['successMessage'] = "Task rejected successfully.";
        } else {
            $_SESSION['errorMessage'] = "Failed to reject task.";
        }
    }

    header("Location: ../controller/user-dashboard-controller.php");
    exit();
}

function handleViewTask() {
    $taskId = $_GET['task_id'];
    $task = getTaskDetails($taskId);
    $projectName = getProjectName($task['project_id']);
    $developerName = getUserName($task['developer_id']);

    include '../view/pm-task-view.php';
}

/* function handleCreateTask() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $projectId = $_POST['project_id'];
        $taskName = $_POST['task_name'];
        $taskDescription = $_POST['task_description'];
        $deadline = $_POST['deadline'];
        $developerId = $_POST['developer_id'];
        $priority = $_POST['priority'];

        $taskCreated = createTask($projectId, $taskName, $taskDescription, $deadline, $developerId, $priority);

        if ($taskCreated) {
            $_SESSION['successMessage'] = "Task created successfully.";
        } else {
            $_SESSION['errorMessage'] = "Failed to create task.";
        }

        header("Location: ../controller/pm-tasks-controller.php?action=view&project_id=$projectId");
        exit();
    }
    include '../view/pm-task-create.php';
}



function handleEditTask() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $taskId = $_POST['task_id'];
        $taskName = $_POST['task_name'];
        $taskDescription = $_POST['task_description'];
        $deadline = $_POST['deadline'];
        $developerId = $_POST['developer_id'];
        $priority = $_POST['priority'];

        $taskUpdated = updateTask($taskId, $taskName, $taskDescription, $deadline, $developerId, $priority);

        if ($taskUpdated) {
            $_SESSION['successMessage'] = "Task updated successfully.";
        } else {
            $_SESSION['errorMessage'] = "Failed to update task.";
        }

        header("Location: ../controller/pm-tasks-controller.php?action=view&project_id=" . $_POST['project_id']);
        exit();
    }
    $taskId = $_GET['task_id'];
    $task = getTaskDetails($taskId);
    include '../view/pm-task-edit.php';
}

function handleDeleteTask() {
    $taskId = $_GET['task_id'];
    $projectId = $_GET['project_id'];
    $taskDeleted = deleteTask($taskId);

    if ($taskDeleted) {
        $_SESSION['successMessage'] = "Task deleted successfully.";
    } else {
        $_SESSION['errorMessage'] = "Failed to delete task.";
    }

    header("Location: ../controller/pm-tasks-controller.php?action=view&project_id=$projectId");
    exit();
} */


?>
