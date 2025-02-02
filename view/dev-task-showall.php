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

<!-- All Tasks Section -->
<h1>All Tasks</h1>

<div class="task-container">
    <?php foreach ($tasks as $task) { ?>
        <a href="../controller/dev-task-controller.php?action=view_task&task_id=<?php echo $task['task_id']; ?>" class="task-card-link">
            <div class="task-card">
                <div class="card-header">
                    <span class="task-id">#<?php echo $task['task_id']; ?></span>

                    <span class="status" data-status="<?php echo $task['status']; ?>">
                        <?php echo $task['status']; ?>
                    </span>
                </div>
                <h2><?php echo $task['name']; ?></h2>
                <p>Project Name: <?php echo $task['project_name']; ?></p>
                <p>Managed By: <?php echo $task['pm_name']; ?></p>
                <p>Start Date: <?php echo $task['start_date']; ?></p>
                <p>Deadline: <?php echo $task['deadline']; ?></p>
            </div>
        </a>
    <?php } ?>
</div>

</body>
</html>
