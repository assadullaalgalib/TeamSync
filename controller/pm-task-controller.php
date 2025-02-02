<?php
session_start();
include_once '../model/task-model.php';
include_once '../model/project-model.php';
include_once '../model/user-model.php';

$action = $_GET['action'] ?? '';

switch ($action) {

    case 'edit':
        showEditTaskForm();
        break;

    case 'update':
        handleUpdateTask();
        break;

    case 'delete':
        handleDeleteTask();
        break;

    case 'create':
        handleCreateTask();
        break;

    case 'add':
        showAddTaskForm();
        break;
        
    case 'view':
        handleViewTask();
        break;

    case 'approve_reject':
        handleApproveRejectTask();
        break;

    case 'download_file':
        handleFileDownload();
        break;
        
// change after all things are working
    default:
        header("Location: ../controller/user-dashboard-controller.php");
        break;
}

function showEditTaskForm() {
    $pmId = $_SESSION['userid'];
    $pmName = getUserName($pmId);

    $taskId = $_REQUEST['task_id'];
    $task = getTaskDetails($taskId);
    $developers = getDevelopersWithTaskCounts();
    include '../view/pm-task-edit.php';
}

function handleUpdateTask() {
    $pmId = $_SESSION['userid'];
    $pmName = getUserName($pmId);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $taskId = $_POST['task_id'];
        $taskName = $_POST['task_name'];
        $taskDescription = $_POST['task_description'];
        $startDate = $_POST['start_date'];
        $deadline = $_POST['deadline'];
        $developerId = $_POST['developer_id'];
        $projectId = $_POST['project_id'];

        if (empty($developerId)) {
            $status = "Not Started";
            $developerId = NULL;
        } else {
            $status = "In Progress";
        }
        
        $taskUpdated = updateTask($taskId, $taskName, $taskDescription, $startDate, $deadline, $developerId, $status);

        if ($taskUpdated) {
            $_SESSION['successMessage'] = "Task updated successfully.";
        } else {
            $_SESSION['errorMessage'] = "Failed to update task.";
        }

        header("Location: ../controller/pm-project-controller.php?action=view&project_id=$projectId");
        exit();
    }
}

function showAddTaskForm() {
    $pmId = $_SESSION['userid'];
    $pmName = getUserName($pmId);

    $projectId = $_GET['project_id'];
    $project = getProjectInfo($projectId);
    $developers = getDevelopersWithTaskCounts();
    include '../view/pm-task-add.php';
}


function handleFileDownload() {
    $pmId = $_SESSION['userid'];
    $pmName = getUserName($pmId);

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
    $pmId = $_SESSION['userid'];
    $pmName = getUserName($pmId);

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

    // Recalculate project status based on task status changes
    $projectId = getProjectIdByTaskId($taskId);
    updateProjectStatusBasedOnTasks($projectId);

    header("Location: ../controller/pm-project-controller.php?action=view&project_id=$projectId");
    exit();
}


function handleViewTask() {
    $pmId = $_SESSION['userid'];
    $pmName = getUserName($pmId);
    
    $taskId = $_GET['task_id'];
    $task = getTaskDetails($taskId);
    $projectName = getProjectName($task['project_id']);
    $developerName = getUserName($task['developer_id']);
    include '../view/pm-task-view.php';
}

function handleCreateTask() {
    $pmId = $_SESSION['userid'];
    $pmName = getUserName($pmId);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $projectId = $_POST['project_id'];
        $taskName = $_POST['task_name'];
        $taskDescription = $_POST['task_description'];
        $startDate = $_POST['start_date'];
        $deadline = $_POST['deadline'];
        $developerId = $_POST['developer_id'];

        // Determine the status based on whether developerId is set
        if (empty($developerId)) {
            $status = "Not Started";
            $developerId = NULL; // Ensure $developerId is NULL if not set
        } else {
            $status = "In Progress";
        }

        $taskCreated = createTask($projectId, $taskName, $taskDescription, $startDate, $deadline, $developerId, $status);

        if ($taskCreated) {
            // Change project status to "In Progress"
            updateProjectStatus($projectId, 'In Progress');
            $_SESSION['successMessage'] = "Task created successfully.";
        } else {
            $_SESSION['errorMessage'] = "Failed to create task.";
        }

        header("Location: ../controller/pm-project-controller.php?action=view&project_id=$projectId");
        exit();
    }
}

function handleDeleteTask() {
    $pmId = $_SESSION['userid'];
    $pmName = getUserName($pmId);
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $projectId = $_POST['project_id'];
        $taskId = $_POST['task_id'];
        $taskDeleted = deleteTask($taskId);

        if ($taskDeleted) {
            $_SESSION['successMessage'] = "Task deleted successfully.";
        } else {
            $_SESSION['errorMessage'] = "Failed to delete task.";
        }

        // Redirect to the project view page or a relevant page after deletion
        header("Location: ../controller/pm-project-controller.php?action=view&project_id=$projectId");
        exit();
    }
}



?>
