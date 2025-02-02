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
            <div class="stats-card">
                <a href="../controller/client-dashboard-controller.php?action=all">All Projects</a>
                <p><?php echo $allProjectsCount; ?></p>
            </div>
            <div class="stats-card">
                <a href="../controller/client-dashboard-controller.php?action=active">Active Projects</a>
                <p><?php echo $activeProjectsCount; ?></p>
            </div>
            <div class="stats-card">
                <a href="../controller/client-dashboard-controller.php?action=pending">Pending Projects</a>
                <p><?php echo $pendingProjectsCount; ?></p>
            </div>
            <div class="stats-card">
                <a href="../controller/client-dashboard-controller.php?action=completed">Completed Projects</a>
                <p><?php echo $completedProjectsCount; ?></p>
            </div>
            <div class="stats-card">
                <a href="../controller/client-dashboard-controller.php?action=handedover">Handed Over Projects</a>
                <p><?php echo $handedoverProjectsCount; ?></p>
            </div>
            <div class="stats-card">
                <a href="../controller/client-dashboard-controller.php?action=rejected">Rejected Projects</a>
                <p><?php echo $rejectedProjectsCount; ?></p>
            </div>
        </div>
    </section>

    <!-- Project List Section -->
    <section class="project-section">
        <h2><?php echo $projectType; ?> Projects</h2>
        <div class="project-container">
            <?php foreach ($projects as $project) { ?>
                <div class="project-card">
                    <h3><?php echo $project['name']; ?></h3>
                    <p><strong>Project ID:</strong> <?php echo $project['project_id']; ?></p>
                    <p><strong>Description:</strong> <?php echo $project['description']; ?></p>
                    <p><strong>Start Date:</strong> <?php echo $project['start_date']; ?></p>
                    <p><strong>Deadline:</strong> <?php echo $project['deadline']; ?></p>
                    <p><strong>Status:</strong> <?php echo $project['status']; ?></p>
                    <p><strong>Progress:</strong> <?php echo $project['progress']; ?>%</p>
                    <a href="../controller/client-project-controller.php?action=view&project_id=<?php echo $project['project_id']; ?>" class="button-primary">View</a>
                </div>
            <?php } ?>
        </div>
    </section>
</div>

</body>
</html>
