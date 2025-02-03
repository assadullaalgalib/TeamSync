<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Dashboard - TeamSync</title>
    <link rel="stylesheet" href="../css/dashboard.css">
    <script src="../js/client.js" defer></script>
</head>
<body>

<?php include 'client-navbar.php'; ?>

<!-- Main Container -->
<div class="container">

    <!-- Project Overview Section -->
<section class="overview-section">
    <h2>Project Overview</h2>
    <input type="hidden" id="userid" value="<?php echo $_SESSION['userid']; ?>">
    
    <div class="search-container">
        <h3>Search</h3>
        <input type="text" id="searchQuery" placeholder="Search...">
        <div id="searchResults"></div>
    </div>

    <div class="stats-section">
        <a href="../controller/client-dashboard-controller.php?action=all" class="stats-card">
            <div>
                <h3>All Projects</h3>
                <p><?php echo $allProjectsCount; ?></p>
            </div>
        </a>
        <a href="../controller/client-dashboard-controller.php?action=active" class="stats-card">
            <div>
                <h3>Active Projects</h3>
                <p><?php echo $activeProjectsCount; ?></p>
            </div>
        </a>
        <a href="../controller/client-dashboard-controller.php?action=pending" class="stats-card">
            <div>
                <h3>Pending Projects</h3>
                <p><?php echo $pendingProjectsCount; ?></p>
            </div>
        </a>
        <a href="../controller/client-dashboard-controller.php?action=completed" class="stats-card">
            <div>
                <h3>Completed Projects</h3>
                <p><?php echo $completedProjectsCount; ?></p>
            </div>
        </a>
        <a href="../controller/client-dashboard-controller.php?action=handedover" class="stats-card">
            <div>
                <h3>Handed Over Projects</h3>
                <p><?php echo $handedoverProjectsCount; ?></p>
            </div>
        </a>
        <a href="../controller/client-dashboard-controller.php?action=rejected" class="stats-card">
            <div>
                <h3>Rejected Projects</h3>
                <p><?php echo $rejectedProjectsCount; ?></p>
            </div>
        </a>
    </div>
</section>


    <!-- Project List Section -->
<section class="project-section">
    <h2><?php echo $projectType; ?> Projects</h2>
    <div class="project-container">
        <?php foreach ($projects as $project) { ?>
            <a href="../controller/client-project-controller.php?action=view&project_id=<?php echo $project['project_id']; ?>" class="project-card-link">
                <div class="project-card">
                    <div class="card-header">
                        <span class="project-id">#<?php echo $project['project_id']; ?></span>

                        <span class="status" data-status="<?php echo $project['status']; ?>">
                            <?php echo $project['status']; ?>
                        </span>
                        
                    </div>

                    <h3><?php echo $project['name']; ?></h3>
                    <p><strong>Start Date:</strong> <?php echo $project['start_date']; ?></p>
                    <p><strong>Deadline:</strong> <?php echo $project['deadline']; ?></p>
                    <p><strong>Progress:</strong> <?php echo $project['progress']; ?>%</p>
                </div>
            </a>
        <?php } ?>
    </div>
</section>

</div>

</body>
</html>
