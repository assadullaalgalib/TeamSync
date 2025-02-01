<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Details - TeamSync</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<h2>Task Details</h2>
<table>
    <tr>
        <td>Task Name:</td>
        <td><?php echo $task['name']; ?></td>
    </tr>
    <tr>
        <td>Project Name:</td>
        <td><?php echo $task['project_name']; ?></td>
    </tr>
    <tr>
        <td>Managed By:</td>
        <td><?php echo $task['pm_name']; ?></td>
    </tr>
    <tr>
        <td>Status:</td>
        <td><?php echo $task['status']; ?></td>
    </tr>
    <tr>
        <td>Start Date:</td>
        <td><?php echo $task['start_date']; ?></td>
    </tr>
    <tr>
        <td>Deadline:</td>
        <td><?php echo $task['deadline']; ?></td>
    </tr>
    <tr>
        <td>PM Comments:</td>
        <td><?php echo $task['pm_comment'] ? $task['pm_comment'] : 'No comments'; ?></td>
    </tr>
    <?php if ($task['status'] == 'Completed') { ?>
        <tr>
            <td>Approved On:</td>
            <td><?php echo $task['timestamp']; ?></td>
        </tr>
    <?php } ?>
</table>

<?php if ($task['file_name']) { ?>
    <h2>Download File</h2>
    <p>File: <?php echo $task['file_name']; ?></p>
    <a href="dev-task-controller.php?action=download_file&task_id=<?php echo $task['task_id']; ?>">Download File</a>
<?php } ?>

<?php if ($task['status'] != 'Completed') { ?>
    <h2>Submit Task</h2>
    <form action="dev-task-controller.php?action=submit_task" method="post" enctype="multipart/form-data">
        <input type="hidden" name="task_id" value="<?php echo $task['task_id']; ?>">
        <table>
            <tr>
                <td><label for="file">Select file:</label></td>
                <td><input type="file" name="file" id="file" ></td>
            </tr>
            <tr>
                <td colspan="2">
                    <p id="fileMessage">
                        <?php
                        require_once '../model/session-manager-model.php';
                        startSession();

                        if (sessionExists('fileMessage')) {
                            echo getSession('fileMessage');
                            removeSession('fileMessage');
                        }
                        ?>
                    </p>
                </td>
            </tr>
            <tr>
                <td><button type="submit">Submit</button></td>
            </tr>
        </table>
    </form>

<?php } ?>

<a href="../controller/user-dashboard-controller.php">Home</a>

</body>
</html>
