<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PM Dashboard - TeamSync</title>
    <link rel="stylesheet" href="../css/pm-dashboard.css">
    <script src="../js/pm-dashboard.js" defer></script>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">TeamSync</div>
        <div class="nav-links">
            <a href="../controller/user-dashboard-controller.php">Home</a>
            <a href="../controller/pm-project-controller.php?action=show_all">Show All Projects</a>
            <a href="../controller/profile-controller.php?action=view">Profile</a>
            <a href="../controller/user-logout-controller.php">Logout</a>
            <span class="pm-name"><?php echo $pmName; ?></span>
        </div>
    </nav>


    <!-- Main Content -->
    <div class="container">

        <!-- Search Section -->
        <div class="search-container">
            <input type="hidden" id="userid" value="<?php echo $_SESSION['userid']; ?>">
            <input type="text" id="searchQuery" placeholder="Search...">
            <select id="searchFilter">
                <option value="all">All</option>
                <option value="projects">Projects</option>
                <option value="tasks">Tasks</option>
                <option value="developers">Developers</option>
            </select>
        </div>
        <div id="searchResults"></div>

        <!-- Ongoing Projects -->
        <div class="project-section">
            <h2>Ongoing Projects</h2>
            <div class="project-grid">
                <?php foreach ($ongoingProjects as $project) { ?>
                    <div class="project-card">
                        <h3><?php echo $project['name']; ?></h3>
                        <p>Progress: <?php echo $project['progress']; ?>%</p>
                        <a href="../controller/pm-project-controller.php?action=view&project_id=<?php echo $project['project_id']; ?>">View</a>
                    </div>
                <?php } ?>
            </div>
        </div>

        <!-- Completed Projects -->
        <div class="project-section">
            <h2>Completed Projects</h2>
            <div class="project-grid">
                <?php foreach ($completedProjects as $project) {
                    if ($project['status'] == 'Completed') { ?>
                        <div class="project-card completed">
                            <h3><?php echo $project['name']; ?></h3>
                            <p>Progress: <?php echo $project['progress']; ?>%</p>
                            <a href="../controller/pm-project-controller.php?action=view&project_id=<?php echo $project['project_id']; ?>">View</a>
                        </div>
                <?php }
                } ?>
            </div>
        </div>

        <!-- Pending Project Approvals -->
        <div class="project-section">
            <h2>Pending Project Approvals</h2>
            <div class="project-grid">
                <?php foreach ($pendingProposals as $project) { ?>
                    <div class="project-card pending">
                        <h3><?php echo $project['name']; ?></h3>
                        <p>Progress: <?php echo $project['progress']; ?>%</p>
                        <a href="../controller/pm-project-controller.php?action=view_proposal&project_id=<?php echo $project['project_id']; ?>">View Proposal</a>
                    </div>
                <?php } ?>
            </div>
        </div>

        <!-- Pending Task Approvals -->
        <div class="project-section">
            <h2>Pending Task Approvals</h2>
            <div class="project-grid">
                <?php
                $projectTasks = [];
                foreach ($pendingTaskApprovals as $task) {
                    $projectTasks[$task['project_id']][] = $task;
                }

                foreach ($ongoingProjects as $project) {
                    if (isset($projectTasks[$project['project_id']])) {
                        foreach ($projectTasks[$project['project_id']] as $task) { ?>
                            <div class="project-card pending-task">
                                <h3><?php echo $task['name']; ?></h3>
                                <p>Project: <?php echo $project['name']; ?></p>
                                <a href="../controller/pm-task-controller.php?action=view&task_id=<?php echo $task['task_id']; ?>">Review Task</a>
                            </div>
                <?php }
                    }
                }
                ?>
            </div>
        </div>

    </div>

</body>

</html>