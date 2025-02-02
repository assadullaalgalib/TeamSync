<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Project - TeamSync</title>
    <link rel="stylesheet" href="../css/main.css">
    <script src="../js/pm.js" defer></script>
</head>
<body>

<?php include 'pm-navbar.php'; ?>

<div class="project-container">
    <h1>Edit Project</h1>

    <form action="../controller/pm-project-controller.php?action=update" method="post" onsubmit="return validateEditProjectForm(event)">
        <input type="hidden" name="project_id" value="<?php echo $project['project_id']; ?>">

        <label for="project_name">Project Name:</label>
        <input type="text" id="project_name" name="project_name" value="<?php echo $project['name']; ?>">
        <p class="error-message" id="projectNameError"></p>

        <p><strong>Client Name:</strong> <?php echo $clientName; ?></p>

        <label for="description">Description:</label>
        <textarea id="description" name="description"><?php echo $project['description']; ?></textarea>
        <p class="error-message" id="descriptionError"></p>

        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date" value="<?php echo $project['start_date']; ?>">
        <p class="error-message" id="startDateError"></p>

        <label for="deadline">Deadline:</label>
        <input type="date" id="deadline" name="deadline" value="<?php echo $project['deadline']; ?>">
        <p class="error-message" id="deadlineError"></p>

        <div class="form-buttons">
            <button type="submit" class="button-primary">Update Project</button>
        </div>
    </form>
</div>

</body>
</html>
