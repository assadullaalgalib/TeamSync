<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Tasks - TeamSync</title>
    <link rel="stylesheet" href="../css/showall.css">
</head>
<body>

<?php include 'dev-navbar.php'; ?>

<!-- Task Filters -->
<div class="filter-container">
    <a href="../controller/dev-task-controller.php?action=view_all_tasks" class="filter-link">All Tasks</a>
    <a href="../controller/dev-task-controller.php?action=view_active_tasks" class="filter-link">Active Tasks</a>
    <a href="../controller/dev-task-controller.php?action=view_completed_tasks" class="filter-link">Completed Tasks</a>
</div>

<!-- All Tasks Section -->
<h1>All Tasks</h1>
<div class="task-container">
    <?php foreach ($tasks as $task) { ?>
        <div class="task-card">
            <h3><?php echo $task['name']; ?></h3>
            <p><strong>Project Name:</strong> <?php echo $task['project_name']; ?></p>
            <p><strong>Managed By:</strong> <?php echo $task['pm_name']; ?></p>
            <p><strong>Status:</strong> <?php echo $task['status']; ?></p>
            <p><strong>Start Date:</strong> <?php echo $task['start_date']; ?></p>
            <p><strong>Deadline:</strong> <?php echo $task['deadline']; ?></p>
            <p><strong>PM Comments:</strong> <?php echo $task['pm_comment']; ?></p>
            <div class="task-actions">
                <a href="../controller/dev-task-controller.php?action=view_task&task_id=<?php echo $task['task_id']; ?>" class="button-primary">View</a>
            </div>
        </div>
    <?php } ?>
</div>

</body>
</html>
