<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Tasks - TeamSync</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<!-- Header -->
<table>
    <tr>
        <td colspan="3">
            <h1>All Tasks</h1>
        </td>
    </tr>
    <tr>
        <td><a href="../controller/user-dashboard-controller.php">Dashboard</a></td>
        <td><a href="../controller/user-profile-controller.php?action=view_profile">Profile</a></td>
        <td><a href="../controller/user-logout-controller.php">Logout</a></td>
    </tr>
</table>

<!-- Task Filters -->
<div>
    <a href="../controller/dev-task-controller.php?action=view_all_tasks">All Tasks</a>
    <a href="../controller/dev-task-controller.php?action=view_active_tasks">Active Tasks</a>
    <a href="../controller/dev-task-controller.php?action=view_completed_tasks">Completed Tasks</a>
</div>

<!-- All Tasks Section -->
<h2>All Tasks</h2>
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
        <?php foreach ($tasks as $task) { ?>
        <tr>
            <td><?php echo $task['name']; ?></td>
            <td><?php echo $task['project_name']; ?></td>
            <td><?php echo $task['pm_name']; ?></td>
            <td><?php echo $task['status']; ?></td>
            <td><?php echo $task['start_date']; ?></td>
            <td><?php echo $task['deadline']; ?></td>
            <td><?php echo $task['pm_comment']; ?></td>
            <td>
                <a href="../controller/dev-task-controller.php?action=view_task&task_id=<?php echo $task['task_id']; ?>">View</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<a href="../controller/project-controller.php?action=view_all_projects">All Projects</a>

</body>
</html>
