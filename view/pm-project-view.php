<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Project - TeamSync</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<h1><?php echo $project['name']; ?></h1>

<p><strong>Client Name:</strong> <?php echo $clientName; ?></p>
<p><strong>Description:</strong> <?php echo $project['description']; ?></p>
<p><strong>Start Date:</strong> <?php echo $project['start_date']; ?></p>
<p><strong>Deadline:</strong> <?php echo $project['deadline']; ?></p>
<p><strong>Status:</strong> <?php echo $project['status']; ?></p>
<p><strong>Progress:</strong> <?php echo $project['progress']; ?>%</p>
<?php if (!empty($project['client_feedback'])) { ?>
    <p><strong>Client Feedback:</strong> <?php echo $project['client_feedback']; ?></p>
<?php } ?>

<h2>Tasks</h2>
<ul>
    <?php foreach ($tasks as $task) { ?>
        <li>
            <a href="../controller/pm-task-controller.php?action=view&task_id=<?php echo $task['task_id']; ?>"><?php echo $task['name']; ?></a>
        </li>
    <?php } ?>
</ul>

<?php if ($project['status'] != 'Completed') { ?>
    <a href="../controller/pm-task-controller.php?action=add&project_id=<?php echo $project['project_id']; ?>">Add Task</a>
<?php } ?>

<br>

<!-- Handover Project Link -->
<?php if ($project['progress'] == 100 && $project['status'] != 'Completed') { ?>
    <a href="../controller/pm-project-controller.php?action=handover&project_id=<?php echo $project['project_id']; ?>">Handover Project</a>
<?php } ?>

<!-- Edit Project Form -->
<h3>Edit Project</h3>
<form action="../controller/pm-project-controller.php?action=edit" method="post">
    <input type="hidden" name="project_id" value="<?php echo $project['project_id']; ?>">
    <button type="submit">Edit Project</button>
</form>

<!-- Delete Project Form -->
<h3>Delete Project</h3>
<form action="../controller/pm-project-controller.php?action=delete" method="post">
    <input type="hidden" name="project_id" value="<?php echo $project['project_id']; ?>">
    <button type="submit">Delete Project</button>
</form>

<a href="../controller/user-dashboard-controller.php">Home</a>

</body>
</html>
