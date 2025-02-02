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
        <div class="stats-card">
            <h3>Active Tasks</h3>
            <p><?php echo $activeTasksCount; ?></p>
        </div>
        <div class="stats-card">
            <h3>Completed Tasks</h3>
            <p><?php echo $completedTasksCount; ?></p>
        </div>
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
                <div class="task-card">
                    <h3><?php echo $task['name']; ?></h3>
                    <p><strong>Project Name:</strong> <?php echo $task['project_name']; ?></p>
                    <p><strong>Managed By:</strong> <?php echo $task['pm_name']; ?></p>
                    <p><strong>Status:</strong> <?php echo $task['status']; ?></p>
                    <p><strong>Start Date:</strong> <?php echo $task['start_date']; ?></p>
                    <p><strong>Deadline:</strong> <?php echo $task['deadline']; ?></p>
                    <p><strong>PM Comments:</strong> <?php echo $task['pm_comment']; ?></p>
                    <a href="../controller/dev-task-controller.php?action=view_task&task_id=<?php echo $task['task_id']; ?>" class="button-primary">View</a>
                </div>
            <?php } ?>
        </div>
    </div>

</div>

</body>
</html>
