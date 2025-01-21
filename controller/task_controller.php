<?php
session_start();
include_once '../model/task_model.php';

$action = $_GET['action'] ?? '';

if ($action == 'view_active') {
    $taskId = $_GET['task_id'];
    $task = getTaskDetails($taskId);
    include '../view/active_task.php';

} elseif ($action == 'view_completed') {
    $taskId = $_GET['task_id'];
    $task = getTaskDetails($taskId);
    include '../view/completed_task.php';

} elseif ($action == 'submit_task') {
    handleFileUpload();

} elseif ($action == 'download_file') {
    handleFileDownload();

}else {
    header("Location: ../controller/dashboard_controller.php");
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
            $_SESSION['fileMessage'] = "File uploaded successfully.";
        } else {
            $_SESSION['fileMessage'] = "File upload failed, please try again.";
        }
        
        header("Location: ../controller/task_controller.php?action=view_active&task_id=$taskId");
        exit();
    }
}

function handleFileDownload() {
    $taskId = $_GET['task_id'];
    $fileDetails = getFileDetails($taskId);

    if ($fileDetails) {
        header('Content-Description: File Transfer');
        header('Content-Type: ' . $fileDetails['file_type']);
        header('Content-Disposition: attachment; filename="' . $fileDetails['file_name'] . '"');
        header('Content-Length: ' . strlen($fileDetails['file_data']));
        echo $fileDetails['file_data'];
        exit;
    } else {
        $_SESSION['fileMessage'] = "File not found.";
        header("Location: ../controller/task_controller.php?action=view_completed&task_id=$taskId");
    }
}


?>
