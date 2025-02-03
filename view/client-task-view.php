<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Task - TeamSync</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>

<?php include 'client-navbar.php'; ?>

<div class="project-container">
    <h1><?php echo $task['name']; ?></h1>

    <div class="project-details">
        <p><strong>Project Name:</strong> <?php echo $projectName; ?></p>
        <p><strong>Developer Name:</strong> <?php echo $developerName ? $developerName : "Unassigned"; ?></p>
        <p><strong>Task Description:</strong> <?php echo $task['description']; ?></p>
        <p><strong>Start Date:</strong> <?php echo $task['start_date']; ?></p>
        <p><strong>Deadline:</strong> <?php echo $task['deadline']; ?></p>
        <p><strong>Status:</strong> <?php echo $task['status']; ?></p>
    </div>

    <div class="form-buttons">
        <a href="../controller/client-project-controller.php?action=view&project_id=<?php echo $task['project_id']; ?>" class="button-dark">Back to Project</a>
    </div>
</div>

</body>
</html>
