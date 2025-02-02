<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Project - TeamSync</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>

<?php include 'admin-navbar.php'; ?>

<div class="project-container">
    <h1><?php echo $project['name']; ?></h1>

    <div class="project-details">
        <p><strong>Client Name:</strong> <?php echo $project['client_name']; ?></p>
        <p><strong>Project Manager Name:</strong> <?php echo $project['pm_name']; ?></p>
        <p><strong>Description:</strong> <?php echo $project['description']; ?></p>
        <p><strong>Start Date:</strong> <?php echo $project['start_date']; ?></p>
        <p><strong>Deadline:</strong> <?php echo $project['deadline']; ?></p>

        <p><strong>Status:</strong> 
            <span class="status" data-status="<?php echo ($project['status']); ?>">
                <?php echo $project['status']; ?>
            </span>
        </p>

        <p><strong>Progress:</strong> <?php echo $project['progress']; ?>%</p>
        <?php if (!empty($project['client_feedback'])) { ?>
            <p><strong>Client Feedback:</strong> <?php echo $project['client_feedback']; ?></p>
        <?php } ?>
    </div>

    <h2>Tasks</h2>
    <div class="task-list">
        <?php foreach ($tasks as $task) { ?>
            <div class="task-item">
                <a href="../controller/admin-task-controller.php?action=view&task_id=<?php echo $task['task_id']; ?>" class="task-button"><?php echo $task['name']; ?></a>
            </div>
        <?php } ?>
    </div>
    <br>


    <form action="../controller/admin-project-controller.php?action=show_edit_project_form" method="post" class="edit-project-form">
        <input type="hidden" name="project_id" value="<?php echo $project['project_id']; ?>">
        <button type="submit" class="button-primary">Edit Project</button>
    </form>

    <div class="card-actions">
                    <a href="../controller/admin-project-controller.php?action=delete_project&project_id=<?php echo $project['project_id']; ?>" class="button-danger" onclick="return confirm('Are you sure you want to delete this project?');">Delete Project</a>
                </div>

</div>

</body>
</html>
