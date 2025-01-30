<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - TeamSync</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
    </header>

    <section id="projects">
    <h2>Project Statistics</h2>
    <div>
        <h3>Total Projects</h3>
        <p><?php echo $totalProjectsCount; ?></p>

        <h3>Active Projects</h3>
        <p><?php echo $activeProjectsCount; ?></p>

        <h3>Completed Projects</h3>
        <p><?php echo $completedProjectsCount; ?></p>

        <h3>Pending Project Approvals</h3>
        <p><?php echo $pendingProjectsCount; ?></p>
    </div>
</section>

<section id="users">
    <h2>User Statistics</h2>
    <div>
        <h3>Total Users</h3>
        <p><?php echo $allUsersCount; ?></p>

        <h3>Total Clients</h3>
        <p><?php echo $allClientsCount; ?></p>

        <h3>Total Project Managers</h3>
        <p><?php echo $allPMsCount; ?></p>

        <h3>Total Developers</h3>
        <p><?php echo $allDevelopersCount; ?></p>
    </div>
    </section>

    <section>
        <h2>Quick Links</h2>
        <a href="create-user.php">Create New User</a>
        <a href="assign-projects.php">Assign/Reassign Projects</a>
        <a href="../controller/admin-project-controller.php?action=show_all_proposals">View Proposals</a>
        <a href="../controller/admin-project-controller.php?action=show_all_projects">View Projects</a>
    </section>
</body>
</html>
