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

<p><strong>Client Name:</strong> <?php echo $project['client_name']; ?></p>
<p><strong>Project Manager Name:</strong> <?php echo $project['pm_name']; ?></p>
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
            <a href="../controller/admin-task-controller.php?action=view&task_id=<?php echo $task['task_id']; ?>"><?php echo $task['name']; ?></a>
        </li>
    <?php } ?>
</ul>
<br>


<!-- Edit Project Form -->
<h3>Edit Project</h3>
<form action="../controller/admin-project-controller.php?action=show_edit_project_form" method="post">
    <input type="hidden" name="project_id" value="<?php echo $project['project_id']; ?>">
    <button type="submit">Edit Project</button>
</form>

<a href="../controller/admin-project-controller.php?action=show_all_projects">Back to All Projects</a>
<a href="../controller/user-dashboard-controller.php">Home</a>

</body>
</html>
