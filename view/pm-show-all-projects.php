<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Projects - TeamSync</title>
    <link rel="stylesheet" href="../css/pm-dashboard.css">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">TeamSync</div>
        <div class="nav-links">
            <a href="../controller/user-dashboard-controller.php">Home</a>
            <a href="../controller/user-logout-controller.php">Logout</a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <h1>All Projects</h1>

        <div class="project-grid">
            <?php foreach ($projects as $project) { ?>
                <div class="project-card all-projects">
                    <h3><?php echo $project['name']; ?></h3>
                    <p><strong>Client:</strong> <?php echo $project['client_name']; ?></p>
                    <p><strong>Description:</strong> <?php echo $project['description']; ?></p>
                    <p><strong>Start Date:</strong> <?php echo $project['start_date']; ?></p>
                    <p><strong>Deadline:</strong> <?php echo $project['deadline']; ?></p>
                    <p><strong>Status:</strong> <?php echo $project['status']; ?></p>
                    <p><strong>Progress:</strong> <?php echo $project['progress']; ?>%</p>
                    <p><strong>Feedback:</strong> <?php echo $project['client_feedback']; ?></p>
                </div>
            <?php } ?>
        </div>
    </div>

</body>
</html>
