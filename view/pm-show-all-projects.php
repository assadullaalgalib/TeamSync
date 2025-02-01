<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Projects - TeamSync</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/pm-show-all-projects.css"> <!-- Link to external CSS -->
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">TeamSync</div>
        <ul class="nav-links">
            <li><a href="../controller/user-dashboard-controller.php">Home</a></li>
            <li><a href="../controller/pm-project-controller.php?action=show_all">Projects</a></li>
            <!-- <li><a href="../controller/profile-controller.php?action=view">Profile</a></li> -->
            <li><a href="../controller/user-logout-controller.php">Logout</a></li>
        </ul>
    </nav>

    <!-- Main Container -->
    <div class="container">
        <h1>All Projects</h1>

        <!-- Project Grid -->
        <div class="project-grid">
            <?php foreach ($projects as $project) { ?>
                <div class="project-card">
                    <h3><?php echo $project['name']; ?></h3>
                    <div class="project-details">
                        <p>Client: <?php echo $project['client_name']; ?></p>
                        <p>Description: <?php echo $project['description']; ?></p>
                        <p>Start Date: <?php echo $project['start_date']; ?></p>
                        <p>Deadline: <?php echo $project['deadline']; ?></p>
                        <p>Status: <?php echo $project['status']; ?></p>
                        <p>Progress: <?php echo $project['progress']; ?>%</p>
                        <p>Client Feedback: <?php echo $project['client_feedback']; ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

</body>
</html>
