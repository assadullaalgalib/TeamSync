<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Task - TeamSync</title>
    <link rel="stylesheet" href="../css/pm-task-view-edit-projectproposal.css">
</head>
<body>

<div class="project-container">
    <h1><?php echo $task['name']; ?></h1>

    <div class="project-details">
        <p><strong>Project Name:</strong> <?php echo $projectName; ?></p>
        <p><strong>Developer Name:</strong> <?php echo $developerName ? $developerName : "Unassigned"; ?></p>
        <p><strong>Task Description:</strong> <?php echo $task['description']; ?></p>
        <p><strong>Start Date:</strong> <?php echo $task['start_date']; ?></p>
        <p><strong>Deadline:</strong> <?php echo $task['deadline']; ?></p>
        <p><strong>Status:</strong> <?php echo $task['status']; ?></p>
    </div>

    <?php if (!empty($task['file_name'])) { ?>
        <p><strong>File Name:</strong> <?php echo $task['file_name']; ?></p>
        <form action="../controller/pm-task-controller.php?action=download_file" method="post">
            <input type="hidden" name="task_id" value="<?php echo $task['task_id']; ?>">
            <button type="submit" class="button-primary">Download</button>
        </form>
        <p><strong>Upload Time:</strong> <?php echo $task['timestamp']; ?></p>
    <?php } ?>

    <h2>Project Manager Comments</h2>
<form action="../controller/pm-task-controller.php?action=approve_reject" method="post">
    <input type="hidden" name="task_id" value="<?php echo $task['task_id']; ?>">
    <textarea name="pm_comment" rows="4"><?php echo $task['pm_comment']; ?></textarea>
    <div class="form-buttons">
        <button type="submit" name="action" value="approve" class="button-primary">Approve</button>
        <button type="submit" name="action" value="reject" class="button-danger">Reject</button>
    </div>
</form>

<h3>Actions</h3>
<div class="form-buttons">
    <form action="../controller/pm-task-controller.php?action=edit" method="post">
        <input type="hidden" name="task_id" value="<?php echo $task['task_id']; ?>">
        <button type="submit" class="button-primary">Edit Task</button>
    </form>

    <form action="../controller/pm-task-controller.php?action=delete" method="post">
        <input type="hidden" name="task_id" value="<?php echo $task['task_id']; ?>">
        <button type="submit" class="button-danger">Delete Task</button>
    </form>
</div>

<a href="../controller/user-dashboard-controller.php" class="button-dark">Back to Dashboard</a>

</div>

</body>
</html>
