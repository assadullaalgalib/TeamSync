<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Developer Dashboard - TeamSync</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/dev-dashboard.css">
</head>
<body>

    <!-- Navigation Bar -->
    <div class="navbar">
    <div class="nav-left">
        <a href="profile.php">
            <img src="../images/profile-icon.png" alt="Profile Icon" class="nav-icon"> Profile
        </a>
    </div>
    <div class="nav-right">
        <a href="../controller/user-logout-controller.php">
            <img src="../images/logout-icon.png" alt="Logout Icon" class="nav-icon"> Logout
        </a>
    </div>
</div>

    <!-- Header -->
    <header class="dashboard-header">
        <h1>Welcome, <?php echo $developerName; ?>!</h1>
    </header>

    <!-- Overview Section -->
    <section class="overview-section">
        <p>Active Tasks: <span><?php echo $activeTasksCount; ?></span></p>
        <p>Completed Tasks: <span><?php echo $completedTasksCount; ?></span></p>
    </section>

<!-- Active Tasks Section -->
<section class="tasks-section">
    <h2>
        <img src="../images/active.png" alt="Active Tasks Icon" class="section-icon">
        Active Tasks
    </h2>
    <div class="tasks-table">
        <div class="tasks-header">
            <span>Task Name</span>
            <span>Project Name</span>
            <span>Managed By</span>
            <span>Status</span>
            <span>Start Date</span>
            <span>Deadline</span>
            <span>PM Comments</span>
            <span>Actions</span>
        </div>
        <div class="tasks-body">
            <?php if (!empty($activeTasks)) { ?>
                <?php foreach ($activeTasks as $task) { ?>
                <div class="tasks-row">
                    <span><?php echo $task['name']; ?></span>
                    <span><?php echo $task['project_name']; ?></span>
                    <span><?php echo $task['pm_name']; ?></span>
                    <span><?php echo $task['status']; ?></span>
                    <span><?php echo $task['start_date']; ?></span>
                    <span><?php echo $task['deadline']; ?></span>
                    <span><?php echo $task['pm_comment']; ?></span>
                    <span>
                        <a href="../controller/dev-task-controller.php?action=view_active&task_id=<?php echo $task['task_id']; ?>">View</a>
                    </span>
                </div>
                <?php } ?>
            <?php } else { ?>
                <p>No active tasks available.</p>
            <?php } ?>
        </div>
    </div>
</section>

<!-- Completed Tasks Section -->
<section class="tasks-section">
    <h2>
        <img src="../images/completed.png" alt="Completed Tasks Icon" class="section-icon">
        Completed Tasks
    </h2>
    <div class="tasks-table">
        <div class="tasks-header">
            <span>Task Name</span>
            <span>Project Name</span>
            <span>Managed By</span>
            <span>Status</span>
            <span>Start Date</span>
            <span>Deadline</span>
            <span>PM Comments</span>
            <span>Actions</span>
        </div>
        <div class="tasks-body">
            <?php if (!empty($completedTasks)) { ?>
                <?php foreach ($completedTasks as $task) { ?>
                <div class="tasks-row">
                    <span><?php echo $task['name']; ?></span>
                    <span><?php echo $task['project_name']; ?></span>
                    <span><?php echo $task['pm_name']; ?></span>
                    <span><?php echo $task['status']; ?></span>
                    <span><?php echo $task['start_date']; ?></span>
                    <span><?php echo $task['deadline']; ?></span>
                    <span><?php echo $task['pm_comment']; ?></span>
                    <span>
                        <a href="../controller/dev-task-controller.php?action=view_completed&task_id=<?php echo $task['task_id']; ?>">View</a>
                    </span>
                </div>
                <?php } ?>
            <?php } else { ?>
                <p>No completed tasks available.</p>
            <?php } ?>
        </div>
    </div>
</section>


</body>
</html>
