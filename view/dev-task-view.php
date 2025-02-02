<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Details - TeamSync</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>

<?php include 'dev-navbar.php'; ?>

<div class="project-container">
    <h1><?php echo $task['name']; ?></h1>

    <div class="project-details">
        <p><strong>Task Name:</strong> <?php echo $task['name']; ?></p>
        <p><strong>Project Name:</strong> <?php echo $task['project_name']; ?></p>
        <p><strong>Managed By:</strong> <?php echo $task['pm_name']; ?></p>
        <p><strong>Status:</strong> <?php echo $task['status']; ?></p>
        <p><strong>Start Date:</strong> <?php echo $task['start_date']; ?></p>
        <p><strong>Deadline:</strong> <?php echo $task['deadline']; ?></p>
        <p><strong>PM Comments:</strong> <?php echo $task['pm_comment'] ? $task['pm_comment'] : 'No comments'; ?></p>
        <?php if ($task['status'] == 'Completed') { ?>
            <p><strong>Approved On:</strong> <?php echo $task['timestamp']; ?></p>
        <?php } ?>
    </div>

    <?php if ($task['file_name']) { ?>
        <div class="file-details">
            <h2>Download File</h2>
            <p><strong>File:</strong> <?php echo $task['file_name']; ?></p>
            <a href="dev-task-controller.php?action=download_file&task_id=<?php echo $task['task_id']; ?>" class="button-primary">Download File</a>
        </div>
    <?php } ?>

    <?php if ($task['status'] != 'Completed') { ?>
        <div class="submit-task">
            <h2>Submit Task</h2>
            <form action="dev-task-controller.php?action=submit_task" method="post" enctype="multipart/form-data" class="submit-task-form">
                <input type="hidden" name="task_id" value="<?php echo $task['task_id']; ?>">
                <div class="form-group">
                    <label for="file">Select file:</label>
                    <input type="file" name="file" id="file">
                </div>
                <div class="form-group">
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
                </div>
                <div class="form-buttons">
                    <button type="submit" class="button-primary">Submit</button>
                </div>
            </form>
        </div>
    <?php } ?>

    <div class="form-buttons">
        <a href="../controller/user-dashboard-controller.php" class="button-dark">Home</a>
    </div>
</div>

</body>
</html>
