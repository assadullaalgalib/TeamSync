<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Projects - TeamSync</title>
    <link rel="stylesheet" href="../css/showall.css">
</head>
<body>

<?php include 'admin-navbar.php'; ?>

<h1>All Project Proposals</h1>

<div class="project-container">
    <?php foreach ($projects as $project) { ?>
        <a href="../controller/admin-project-controller.php?action=view_proposal&project_id=<?php echo $project['project_id']; ?>" class="project-card-link">
            <div class="project-card">
                <div class="card-header">
                    <span class="project-id">#<?php echo $project['project_id']; ?></span>
                    <span class="status" data-status="<?php echo $project['status']; ?>">
                        <?php echo $project['status']; ?>
                    </span>
                </div>
                <h2><?php echo $project['name']; ?></h2>
                <p>Client: <?php echo $project['client_name']; ?></p>
                <?php if ($project['pm_name']) { ?>
                    <p>Project Manager: <?php echo $project['pm_name']; ?></p>
                <?php } ?>
                <p>Description: <?php echo $project['description']; ?></p>
                <p>Deadline: <?php echo $project['deadline']; ?></p>
                <div class="card-actions">
                </div>
            </div>
        </a>
    <?php } ?>
</div>

</body>
</html>
