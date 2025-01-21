<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Completed Task - TeamSync</title>
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
        <td><?php echo $task['pm_comment']; ?></td>
    </tr>
    <tr>
        <td>Approved On:</td>
        <td><?php echo $task['timestamp']; ?></td>
    </tr>
</table>

<h2>Download File</h2>
<a href="task_controller.php?action=download_file&task_id=<?php echo $task['task_id']; ?>">Download File</a>

</body>
</html>
