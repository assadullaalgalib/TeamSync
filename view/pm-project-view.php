<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Project - TeamSync</title>
    <link rel="stylesheet" href="../css/pm-project-view,taskadd,projectedit.css">
</head>
<body>

<div class="project-container">
    <h1><?php echo $project['name']; ?></h1>

    <div class="project-details">
        <p><strong>Client Name:</strong> <?php echo $clientName; ?></p>
        <p><strong>Description:</strong> <?php echo $project['description']; ?></p>
        <p><strong>Start Date:</strong> <?php echo $project['start_date']; ?></p>
        <p><strong>Deadline:</strong> <?php echo $project['deadline']; ?></p>
        <p><strong>Status:</strong> <span class="status <?php echo strtolower(str_replace(' ', '-', $project['status'])); ?>">
            <?php echo $project['status']; ?>
        </span></p>
        <p><strong>Progress:</strong> <?php echo number_format($project['progress'], 2); ?>%</p>
        <?php if (!empty($project['client_feedback'])) { ?>
            <p><strong>Client Feedback:</strong> <?php echo $project['client_feedback']; ?></p>
        <?php } ?>
    </div>

    <h2>Tasks</h2>
    <ul class="task-list">
        <?php foreach ($tasks as $task) { ?>
            <li>
                <a class="task-link" href="../controller/pm-task-controller.php?action=view&task_id=<?php echo $task['task_id']; ?>">
                    <?php echo $task['name']; ?>
                </a>
            </li>
        <?php } ?>
    </ul>

    <?php if ($project['status'] != 'Completed') { ?>
        <a class="button-primary" href="../controller/pm-task-controller.php?action=add&project_id=<?php echo $project['project_id']; ?>">Add Task</a>
    <?php } ?>

    <?php if ($project['progress'] == 100 && $project['status'] != 'Completed') { ?>
        <a class="button-dark" href="../controller/pm-project-controller.php?action=handover&project_id=<?php echo $project['project_id']; ?>">Handover Project</a>
    <?php } ?>

    <div class="form-buttons">
        <form action="../controller/pm-project-controller.php?action=edit" method="post">
            <input type="hidden" name="project_id" value="<?php echo $project['project_id']; ?>">
            <button type="submit" class="button-primary">Edit Project</button>
        </form>

        <form action="../controller/pm-project-controller.php?action=delete" method="post">
            <input type="hidden" name="project_id" value="<?php echo $project['project_id']; ?>">
            <button type="submit" class="button-danger">Delete Project</button>
        </form>
    </div>

    <a href="../controller/user-dashboard-controller.php" class="button-dark">Home</a>
</div>

</body>
</html>
