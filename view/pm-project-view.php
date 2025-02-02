<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Project - TeamSync</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>

<?php include 'pm-navbar.php'; ?>

<div class="project-container">
    <h1><?php echo $project['name']; ?></h1>

    <div class="project-details">
        <p><strong>Client Name:</strong> <?php echo $clientName; ?></p>
        <p><strong>Description:</strong> <?php echo $project['description']; ?></p>
        <p><strong>Start Date:</strong> <?php echo $project['start_date']; ?></p>
        <p><strong>Deadline:</strong> <?php echo $project['deadline']; ?></p>

        <p><strong>Status:</strong> 
            <span class="status" data-status="<?php echo ($project['status']); ?>">
                <?php echo $project['status']; ?>
            </span>
        </p>

        <p><strong>Progress:</strong> <?php echo number_format($project['progress'], 2); ?>%</p>
        <?php if (!empty($project['client_feedback'])) { ?>
            <p><strong>Client Feedback:</strong> <?php echo $project['client_feedback']; ?></p>
        <?php } ?>
    </div>

    <h2>Tasks</h2>
    <div class="task-list">
        <?php foreach ($tasks as $task) { ?>
            <div class="task-item">
                <a href="../controller/pm-task-controller.php?action=view&task_id=<?php echo $task['task_id']; ?>" class="task-button"><?php echo $task['name']; ?></a>
            </div>
        <?php } ?>
    </div>

    <div class="project-buttons">
        <?php if ($project['status'] != 'Completed') { ?>
            <a class="button-primary" href="../controller/pm-task-controller.php?action=add&project_id=<?php echo $project['project_id']; ?>">Add Task</a>
        <?php } else { ?>
            <div class="button-placeholder"></div>
        <?php } ?>

        <?php if ($project['progress'] == 100 && $project['status'] != 'Completed') { ?>
            <a class="button-dark" href="../controller/pm-project-controller.php?action=handover&project_id=<?php echo $project['project_id']; ?>">Handover Project</a>
        <?php } else { ?>
            <div class="button-placeholder"></div>
        <?php } ?>
    </div>


    <div class="form-buttons">
        <form action="../controller/pm-project-controller.php?action=edit" method="post" >
            <input type="hidden" name="project_id" value="<?php echo $project['project_id']; ?>">
            <button type="submit" class="button-primary form">Edit Project</button>
        </form>
    </div>
    <div class="form-buttons">
        <form action="../controller/pm-project-controller.php?action=delete" method="post">
            <input type="hidden" name="project_id" value="<?php echo $project['project_id']; ?>">
            <button type="submit" class="button-danger" onclick="return confirm('Are you sure you want to delete this project?')">Delete Project</button>
        </form>
    </div>

</div>

</body>
</html>