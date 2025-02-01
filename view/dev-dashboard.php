<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Developer Dashboard - TeamSync</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<!-- Header -->
<table>
    <tr>
        <td colspan="3">
            <h1>Welcome, <?php echo $developerName; ?>!</h1>
        </td>
    </tr>
    <tr>
        <td><a href="../controller/user-dashboard-controller.php">Dashboard</a></td>
        <td><a href="profile.php">Profile</a></td>
        <td><a href="../controller/user-logout-controller.php">Logout</a></td>
    </tr>
</table>

<!-- Overview Section -->
<table>
    <tr>
        <td>Active Tasks: <?php echo $activeTasksCount; ?></td>
        <td>Completed Tasks: <?php echo $completedTasksCount; ?></td>
    </tr>
</table>

<!-- Active Tasks Section -->
<h2>Active Tasks</h2>
<table border="1">
    <thead>
        <tr>
            <th>Task Name</th>
            <th>Project Name</th>
            <th>Managed By</th>
            <th>Status</th>
            <th>Start Date</th>
            <th>Deadline</th>
            <th>PM Comments</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($activeTasks as $task) { ?>
        <tr>
            <td><?php echo $task['name']; ?></td>
            <td><?php echo $task['project_name']; ?></td>
            <td><?php echo $task['pm_name']; ?></td>
            <td><?php echo $task['status']; ?></td>
            <td><?php echo $task['start_date']; ?></td>
            <td><?php echo $task['deadline']; ?></td>
            <td><?php echo $task['pm_comment']; ?></td>
            <td>
                <a href="../controller/dev-task-controller.php?action=view_active&task_id=<?php echo $task['task_id']; ?>">View</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<!-- Completed Tasks Section -->
<h2>Completed Tasks</h2>
<table border="1">
    <thead>
        <tr>
            <th>Task Name</th>
            <th>Project Name</th>
            <th>Managed By</th>
            <th>Status</th>
            <th>Start Date</th>
            <th>Deadline</th>
            <th>PM Comments</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($completedTasks as $task) { ?>
        <tr>
            <td><?php echo $task['name']; ?></td>
            <td><?php echo $task['project_name']; ?></td>
            <td><?php echo $task['pm_name']; ?></td>
            <td><?php echo $task['status']; ?></td>
            <td><?php echo $task['start_date']; ?></td>
            <td><?php echo $task['deadline']; ?></td>
            <td><?php echo $task['pm_comment']; ?></td>
            <td>
                <a href="../controller/dev-task-controller.php?action=view_completed&task_id=<?php echo $task['task_id']; ?>">View</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

</body>
</html>
