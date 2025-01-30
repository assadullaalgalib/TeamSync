<?php
// Include the session manager
require_once '../model/session-manager-model.php';

// Start the session using the session manager
startSession();


include_once '../model/task-model.php';

$action = $_GET['action'] ?? '';

if ($action == 'view_active') {
    $taskId = $_GET['task_id'];
    $task = getTaskDetails($taskId);
    include '../view/dev-task-active.php';

} elseif ($action == 'view_completed') {
    $taskId = $_GET['task_id'];
    $task = getTaskDetails($taskId);
    include '../view/dev-task-completed.php';

} elseif ($action == 'submit_task') {
    handleFileUpload();

} elseif ($action == 'download_file') {
    handleFileDownload();

}else {
    header("Location: ../controller/user-dashboard-controller.php");
    exit();
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
        
        header("Location: ../controller/dev-task-controller.php?action=view_active&task_id=$taskId");
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
        header("Location: ../controller/dev-task-controller.php?action=view_completed&task_id=$taskId");
        exit;
    }
}
?>
