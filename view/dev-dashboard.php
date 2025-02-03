<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Developer Dashboard - TeamSync</title>
    <link rel="stylesheet" href="../css/dashboard.css">
    <script src="../js/dev.js" defer></script>
</head>
<body>

<?php include 'dev-navbar.php'; ?>

<!-- Main Container -->
<div class="container">

    <!-- Overview Section -->
    <div class="stats-section">
        <a href="../controller/dev-task-controller.php?action=view_all_tasks" class="stats-card"> 
            <div>
                <h3>Total Tasks</h3>
                <p><?php echo $totalTasksCount; ?></p>
            </div>
        </a>
        <a href="../controller/dev-task-controller.php?action=view_active_tasks" class="stats-card"> 
            <div>
                <h3>Active Tasks</h3>
                <p><?php echo $activeTasksCount; ?></p>
            </div>
        </a>
        <a href="../controller/dev-task-controller.php?action=view_completed_tasks" class="stats-card"> 
            <div>
                <h3>Completed Tasks</h3>
                <p><?php echo $completedTasksCount; ?></p>
            </div>
        </a>
    </div>

    <!-- Search Section -->
    <div class="search-container">
        <input type="hidden" id="userid" value="<?php echo $_SESSION['userid']; ?>">
        <h3>Search Tasks</h3>
        <input type="text" id="searchQuery" placeholder="Search Tasks...">
        <div id="searchResults"></div>
    </div>

    <!-- Active Tasks Section -->
<div class="task-section">
    <h2>Active Tasks</h2>
    <div class="task-grid">
        <?php foreach ($activeTasks as $task) { ?>
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
                    <p>PM Comments: <?php echo $task['pm_comment']; ?></p>
                </div>
            </a>
        <?php } ?>
    </div>
</div>


</div>

</body>
</html>
