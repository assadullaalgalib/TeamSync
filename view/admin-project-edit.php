<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Project - TeamSync</title>
    <link rel="stylesheet" href="../css/main.css">
    <script src="../js/admin.js" defer></script>
</head>
<body>

<?php include 'admin-navbar.php'; ?>

<div class="project-container">
    <h1>Edit Project</h1>
    <p><strong>Client Name: <?php echo $project['client_name']; ?></strong></p>

    <form action="../controller/admin-project-controller.php?action=edit_project" method="post" class="project-form" onsubmit="return validateProjectForm(event)">
        <input type="hidden" name="project_id" value="<?php echo $project['project_id']; ?>">

        <div class="form-group">
            <label for="project_name">Project Name:</label>
            <input type="text" id="project_name" name="project_name" value="<?php echo $project['name']; ?>">
            <p class="error-message" id="projectNameError"></p>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description"><?php echo $project['description']; ?></textarea>
            <p class="error-message" id="descriptionError"></p>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" name="start_date" value="<?php echo $project['start_date']; ?>">
                <p class="error-message" id="startDateError"></p>
            </div>

            <div class="form-group">
                <label for="deadline">Deadline:</label>
                <input type="date" id="deadline" name="deadline" value="<?php echo $project['deadline']; ?>">
                <p class="error-message" id="deadlineError"></p>
            </div>
        </div>

        <div class="form-group">
            <label for="pm_id">Project Manager:</label>
            <select id="pm_id" name="pm_id" required>
                <?php
                foreach ($pms as $pm) {
                    $selected = ($pm['userid'] == $project['pm_id']) ? 'selected' : '';
                    echo "<option value='{$pm['userid']}' {$selected}>[{$pm['userid']}] {$pm['firstname']} {$pm['lastname']} - Ongoing Projects: {$pm['project_count']}</option>";
                }
                ?>
            </select>
            <p class="error-message" id="pmIdError"></p>
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <select id="status" name="status" required>
                <?php
                $statuses = ['Approved', 'In Progress', 'Handed Over', 'Completed'];
                foreach ($statuses as $status) {
                    $selected = ($status == $project['status']) ? 'selected' : '';
                    echo "<option value='{$status}' {$selected}>{$status}</option>";
                }
                ?>
            </select>
            <p class="error-message" id="statusError"></p>
        </div>

        <div class="form-buttons">
            <button type="submit" class="button-primary">Update Project</button>
            <a href="../controller/admin-project-controller.php?action=view_project&project_id=<?php echo $project['project_id']; ?>" class="button-dark">Back to Project</a>
        </div>
    </form>
</div>

</body>
</html>
