<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Projects - TeamSync</title>
    <link rel="stylesheet" href="../css/pm-project-showall.css">
</head>
<body>

<h1>All Projects</h1>

<div class="project-container">
    <?php foreach ($projects as $project) { ?>
        <div class="project-card">
            <div class="card-header">
                <span class="project-id">#<?php echo $project['project_id']; ?></span>
                <span class="status" data-status="<?php echo $project['status']; ?>">
                    <?php echo $project['status']; ?>
                </span>
            </div>
            <h2><?php echo $project['name']; ?></h2>
            <p>Client: <?php echo $project['client_name']; ?></p>
            <p>Description: <?php echo $project['description']; ?></p>
            <p>Start Date: <?php echo $project['start_date']; ?></p>
            <p>Deadline: <?php echo $project['deadline']; ?></p>
            <p>Progress: <span class="progress-text"><?php echo $project['progress']; ?>%</span></p>
            <p>Client Feedback: <?php echo $project['client_feedback']; ?></p>
        </div>
    <?php } ?>
</div>

<a href="../controller/user-dashboard-controller.php" class="btn">Back to Dashboard</a>

</body>
</html>
