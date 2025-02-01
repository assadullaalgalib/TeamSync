<?php
// Include the session manager
require_once '../model/session-manager-model.php';

// Start the session using the session manager
startSession();


include_once '../model/task-model.php';

$action = $_GET['action'] ?? '';

switch ($action) {

    case 'view_all_tasks':
        handleViewAllTask();
        break;

    case 'view_active_tasks':
        handleViewActiveTask();
        break;

    case 'view_completed_tasks':
        handleViewCompletedTask();
        break;

    case 'view_task':
        handleViewTask();
        break;

    case 'submit_task':
        handleFileUpload();
        break;

    case 'download_file':
        handleFileDownload();
        break;

    default:
        header("Location: ../controller/user-dashboard-controller.php");
        exit();
        break;
}

function handleViewCompletedTask() {
    $userId = $_SESSION['userid'];
    $tasks = getCompletedTasks($userId);
    include '../view/dev-task-showall.php';
}

function handleViewActiveTask() {
    $userId = $_SESSION['userid'];
    $tasks = getActiveTasks($userId);
    include '../view/dev-task-showall.php';
}

function handleViewAllTask() {
    $userId = $_SESSION['userid'];
    $tasks = getAllTasksByUserId($userId);
    include '../view/dev-task-showall.php';
}

function handleViewTask() {
    $taskId = $_GET['task_id'];
    $task = getTaskDetails($taskId);
    include '../view/dev-task-view.php';
}

function handleFileUpload() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $taskId = $_POST['task_id'];
        $fileData = file_get_contents($_FILES["file"]["tmp_name"]);
        $fileName = $_FILES["file"]["name"];
        $fileType = $_FILES["file"]["type"];
        if ($fileData) {
            saveFileData($taskId, $fileData, $fileName, $fileType);
            $status = 'Waiting For Approval'; 
            updateTaskStatus($taskId, $status); 
            setSession('fileMessage', "File uploaded successfully.");
        } else {
            setSession('fileMessage', "File upload failed, please try again.");
        }
        
        header("Location: ../controller/dev-task-controller.php?action=view_all_tasks&task_id=$taskId");
        exit();
    }
}


function handleFileDownload() {
    $taskId = $_GET['task_id'];
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
        header("Location: ../controller/dev-task-controller.php?action=view_all_tasks&task_id=$taskId");
        exit;
    }
}
?>
