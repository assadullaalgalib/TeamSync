<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Projects - TeamSync</title>
    <link rel="stylesheet" href="../css/pm-project-showall.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar">
    <div class="logo">TeamSync</div>
    <div class="nav-links">
        <a href="../controller/user-dashboard-controller.php">Home</a>
        <a href="../controller/user-logout-controller.php">Logout</a>
        <a href="../controller/user-profile-controller.php?action=view_profile" class="welcome-link">Welcome, <?php echo $pmName; ?>!</a>
        
    </div>
</nav>

<h1>All Projects</h1>

<div class="project-container">
    <?php foreach ($projects as $project) { ?>
        <a href="../controller/pm-project-controller.php?action=view&project_id=<?php echo $project['project_id']; ?>" class="project-card-link">
            <div class="project-card">
                <div class="card-header">
                    <span class="project-id">#<?php echo $project['project_id']; ?></span>
                    <span class="status" data-status="<?php echo $project['status']; ?>">
                        <?php echo $project['status']; ?>
                    </span>
                </div>
                <h2><?php echo $project['name']; ?></h2>
                <p>Client: <?php echo $project['client_name']; ?></p>
                <p>Start Date: <?php echo $project['start_date']; ?></p>
                <p>Deadline: <?php echo $project['deadline']; ?></p>
                <p>Progress: <span class="progress-text"><?php echo $project['progress']; ?>%</span></p>
            </div>
        </a>
    <?php } ?>
</div>



</body>
</html>