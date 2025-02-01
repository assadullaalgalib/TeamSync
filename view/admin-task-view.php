<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Task - TeamSync</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<h1><?php echo $task['name']; ?></h1>

<p><strong>Project Name:</strong> <?php echo $projectName; ?></p>
<p><strong>Developer Name:</strong> <?php echo $developerName ? $developerName : "Unassigned"; ?></p>
<p><strong>Task Description:</strong> <?php echo $task['description']; ?></p>
<p><strong>Start Date:</strong> <?php echo $task['start_date']; ?></p>
<p><strong>Deadline:</strong> <?php echo $task['deadline']; ?></p>
<p><strong>Status:</strong> <?php echo $task['status']; ?></p>

<?php if (!empty($task['pm_comment'])) { ?>
    <p><strong>Project Manager Comments:</strong> <?php echo $task['pm_comment']; ?></p>
<?php } ?>

<?php if (!empty($task['file_name'])) { ?>
    <p><strong>File Name:</strong> <?php echo $task['file_name']; ?></p>
    <form action="../controller/pm-task-controller.php?action=download_file" method="post">
        <input type="hidden" name="task_id" value="<?php echo $task['task_id']; ?>">
        <button type="submit">Download</button>
    </form>
    <p><strong>Upload Time:</strong> <?php echo $task['timestamp']; ?></p>
<?php } ?>

<a href="../controller/admin-project-controller.php?action=view_project&project_id=<?php echo $task['project_id']; ?>">Back</a>
<a href="../controller/user-dashboard-controller.php">Home</a>

</body>
</html>
