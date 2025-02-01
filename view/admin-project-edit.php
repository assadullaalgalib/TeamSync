<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Project - TeamSync</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<h1>Edit Project</h1>
<p><strong>Client Name: <?php echo $project['client_name']; ?></strong></p>

<form action="../controller/admin-project-controller.php?action=edit_project" method="post">
    <input type="hidden" name="project_id" value="<?php echo $project['project_id']; ?>">

    <label for="project_name">Project Name:</label>
    <input type="text" id="project_name" name="project_name" value="<?php echo $project['name']; ?>"><br>

    

    <label for="description">Description:</label>
    <textarea id="description" name="description"><?php echo $project['description']; ?></textarea><br>

    <label for="start_date">Start Date:</label>
    <input type="date" id="start_date" name="start_date" value="<?php echo $project['start_date']; ?>"><br>

    <label for="deadline">Deadline:</label>
    <input type="date" id="deadline" name="deadline" value="<?php echo $project['deadline']; ?>"><br>

    <label for="pm_id">Project Manager:</label>
    <select id="pm_id" name="pm_id" required>
        <?php
        // Populate the dropdown with PMs from the controller
        foreach ($pms as $pm) {
            $selected = ($pm['userid'] == $project['pm_id']) ? 'selected' : '';
            echo "<option value='{$pm['userid']}' {$selected}>[{$pm['userid']}] {$pm['firstname']} {$pm['lastname']} - Ongoing Projects: {$pm['project_count']}</option>";
        }
        ?>
    </select><br><br>

    <label for="status">Status:</label>
    <select id="status" name="status" required>
        <?php
        $statuses = ['Approved', 'In Progress', 'Handed Over', 'Completed'];
        foreach ($statuses as $status) {
            $selected = ($status == $project['status']) ? 'selected' : '';
            echo "<option value='{$status}' {$selected}>{$status}</option>";
        }
        ?>
    </select><br><br>

    <button type="submit">Update Project</button>
</form>

<a href="../controller/admin-project-controller.php?action=view_project&project_id=<?php echo $project['project_id']; ?>">Back to Project</a>

</body>
</html>
