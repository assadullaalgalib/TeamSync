<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Project - TeamSync</title>
    <link rel="stylesheet" href="../css/main.css">
    <script src="../js/client.js" defer></script>
</head>
<body>

<?php include 'client-navbar.php'; ?>

<div class="project-container">
    <h1><?php echo $project['name']; ?></h1>

    <div class="project-details">
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
    </div>

    <h2>Tasks</h2>
    <div class="task-list">
        <?php foreach ($tasks as $task) { ?>
            <div class="task-item">
                <a href="../controller/client-task-controller.php?action=view&task_id=<?php echo $task['task_id']; ?>" class="task-button"><?php echo $task['name']; ?></a>
            </div>
        <?php } ?>
    </div>
    <br>

    <?php if ($project['status'] == 'Handed Over') { ?>
        <h2>Project Decision</h2>
        <form action="../controller/client-project-controller.php?action=accept_reject" method="post" class="project-decision-form">
            <input type="hidden" name="project_id" value="<?php echo $project['project_id']; ?>">
            <textarea name="client_feedback" rows="4" cols="50" placeholder="Enter your feedback here..." class="textarea-feedback"></textarea><br>
            <div class="form-buttons">
                <button type="submit" name="action" value="accept" class="button-primary">Accept</button>
                <button type="submit" name="action" value="reject" class="button-danger">Reject</button>
            </div>
        </form>
    <?php } ?>

    <div class="form-buttons">
        <a href="../controller/client-dashboard-controller.php" class="button-dark">Back</a>
    </div>
</div>

</body>
</html>
