<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - TeamSync</title>
    <link rel="stylesheet" href="../css/dashboard.css">
    <script src="../js/admin.js" defer></script>
</head>
<body>

<?php include 'admin-navbar.php'; ?>

<!-- Main Container -->
<div class="container">

<!-- Search Section -->
<div class="search-container">
    <input type="hidden" id="userid" value="<?php echo $_SESSION['userid']; ?>">
    <input type="text" id="searchQuery" placeholder="Search...">
    <select id="searchFilter">
        <option value="all">All</option>
        <option value="projects">Projects</option>
        <option value="tasks">Tasks</option>
        <option value="users">Users</option>
    </select>
</div>
<div id="searchResults"></div>


<h2>Project Statistics</h2>
<br>
    <!-- Project Statistics Section -->
    <div class="stats-section">
        <a href="../controller/admin-project-controller.php?action=show_all_projects" class="stats-card">
            <div>
                <h3>Total Projects</h3>
                <p><?php echo $totalProjectsCount; ?></p>
            </div>
        </a>
        <a href="../controller/admin-project-controller.php?action=all_active_projects" class="stats-card">
            <div>
                <h3>Active Projects</h3>
                <p><?php echo $activeProjectsCount; ?></p>
            </div>
        </a>
        <a href="../controller/admin-project-controller.php?action=all_completed_projects" class="stats-card">
            <div>
                <h3>Completed Projects</h3>
                <p><?php echo $completedProjectsCount; ?></p>
            </div>
        </a>
        <a href="../controller/admin-project-controller.php?action=show_all_proposals" class="stats-card">
            <div>
                <h3>Pending Project Proposals</h3>
                <p><?php echo $pendingProjectsCount; ?></p>
            </div>
        </a>
        <a href="../controller/admin-project-controller.php?action=all_rejected_projects" class="stats-card">
            <div>
                <h3>Rejected Project Proposals</h3>
                <p><?php echo $rejectedProjectsCount; ?></p>
            </div>
        </a>
    </div>
    <br>

<h2>User Statistics</h2>
<br>
    <!-- User Statistics Section -->
    <div class="stats-section">
        <a href="../controller/admin-user-controller.php?action=show_all" class="stats-card">
            <div>
                <h3>Total Users</h3>
                <p><?php echo $allUsersCount; ?></p>
            </div>
        </a>
        <a href="../controller/admin-user-controller.php?action=all_admins" class="stats-card">
            <div>
                <h3>Admins</h3>
                <p><?php echo $allAdminsCount; ?></p>
            </div>
        </a>
        <a href="../controller/admin-user-controller.php?action=all_pms" class="stats-card">
            <div>
                <h3>Project Managers</h3>
                <p><?php echo $allPMsCount; ?></p>
            </div>
        </a>
        <a href="../controller/admin-user-controller.php?action=all_devs" class="stats-card">
            <div>
                <h3>Developers</h3>
                <p><?php echo $allDevelopersCount; ?></p>
            </div>
        </a>
        <a href="../controller/admin-user-controller.php?action=all_clients" class="stats-card">
            <div>
                <h3>Clients</h3>
                <p><?php echo $allClientsCount; ?></p>
            </div>
        </a>
    </div>

</div>

</body>
</html>
