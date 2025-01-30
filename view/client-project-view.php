<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Project - TeamSync</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/pm-dashboard.js" defer></script>
</head>
<body>

<h1><?php echo $project['name']; ?></h1>

<p><strong>Project Manager:</strong> <?php echo $pmName; ?></p>
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
            <a href="../controller/client-task-controller.php?action=view&task_id=<?php echo $task['task_id']; ?>"><?php echo $task['name']; ?></a>
        </li>
    <?php } ?>
</ul>

<?php if (!empty($project['file_name'])) { ?>
    <p><strong>File Name:</strong> <?php echo $project['file_name']; ?></p>
    <form action="../controller/client-project-controller.php?action=download_file" method="post">
        <input type="hidden" name="project_id" value="<?php echo $project['project_id']; ?>">
        <button type="submit">Download</button>
    </form>
    <p><strong>Upload Time:</strong> <?php echo $project['timestamp']; ?></p>
<?php } ?>

<?php if ($project['status'] == 'Handed Over') { ?>
    <h2>Project Decision</h2>
    <form action="../controller/client-project-controller.php?action=accept_reject" method="post">
        <input type="hidden" name="project_id" value="<?php echo $project['project_id']; ?>">
        <textarea name="client_feedback" rows="4" cols="50" placeholder="Enter your feedback here..."></textarea><br>
        <button type="submit" name="action" value="accept">Accept</button>
        <button type="submit" name="action" value="reject">Reject</button>
    </form>
<?php } ?>


<a href="../controller/client-dashboard-controller.php">Back</a>

</body>
</html>
