<!DOCTYPE html>
<html>
<head>
    <title>Client Dashboard - TeamSync</title>
    <script src="../js/client-dashboard.js" defer></script>
</head>
<body>

    <!-- Welcome Section -->
    <header>
        <h1>Welcome, <?php echo $clientName; ?>!</h1>
        <a href="../view/client-submit-proposal.php">Submit New Proposal</a>
    </header>

    <!-- Project Overview -->
    <section>
        <h2>Project Overview</h2>
        <!-- Store the userid in a hidden element -->
        <input type="hidden" id="userid" value="<?php echo $_SESSION['userid']; ?>">
        
        <h3>Search</h3>
        <input type="text" id="searchQuery" placeholder="Search...">
        <div id="searchResults"></div>

        <div>
        <span><a href="../controller/client-dashboard-controller.php?action=all">All Projects: <?php echo $allProjectsCount; ?></a></span>
            <span><a href="../controller/client-dashboard-controller.php?action=active">Active Projects: <?php echo $activeProjectsCount; ?></a></span>
            <span><a href="../controller/client-dashboard-controller.php?action=pending">Pending Projects: <?php echo $pendingProjectsCount; ?></a></span>
            <span><a href="../controller/client-dashboard-controller.php?action=completed">Completed Projects: <?php echo $completedProjectsCount; ?></a></span>
            <span><a href="../controller/client-dashboard-controller.php?action=handedover">Handed Over Projects: <?php echo $handedoverProjectsCount; ?></a></span>
            <span><a href="../controller/client-dashboard-controller.php?action=rejected">Rejected Projects: <?php echo $rejectedProjectsCount; ?></a></span>
        </div>
    </section>

    <!-- Project List -->
    <section>
        <h2><?php echo $projectType; ?> Projects</h2>
        <table border=1>
            <thead>
                <tr>
                    <th>Project ID</th>
                    <th>Project Name</th>
                    <th>Description</th>
                    <th>Start Date</th>
                    <th>Deadline</th>
                    <th>Status</th>
                    <th>Progress</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($projects as $project) { ?>
                <tr>
                    <td><?php echo $project['project_id']; ?></td>
                    <td><a href="../controller/client-project-controller.php?action=view&project_id=<?php echo $project['project_id']; ?>"><?php echo $project['name']; ?></a>
                    <td><?php echo $project['description']; ?></td>
                    <td><?php echo $project['start_date']; ?></td>
                    <td><?php echo $project['deadline']; ?></td>
                    <td><?php echo $project['status']; ?></td>
                    <td><?php echo $project['progress']; ?>%</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </section>

    <a href="../controller/user-logout-controller.php">Logout</a>

</body>
</html>
