<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Proposal - TeamSync</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<h1><?php echo $project['name']; ?></h1>
<p><strong>Client Name:</strong> <?php echo $clientName; ?></p>
<p><strong>Description:</strong> <?php echo $project['description']; ?></p>
<p><strong>Deadline:</strong> <?php echo $project['deadline']; ?></p>

<form action="../controller/admin-project-controller.php?action=assign_pm" method="post">
    <input type="hidden" name="project_id" value="<?php echo $project['project_id']; ?>">

    <label for="pm_id">Assign Project Manager:</label>
    <select id="pm_id" name="pm_id" required>
        <option value="">Select Project Manager</option>
        <?php
        // Populate the dropdown with PMs from the controller
        foreach ($pms as $pm) {
            echo "<option value='{$pm['userid']}'>[{$pm['userid']}] {$pm['firstname']} {$pm['lastname']} - Ongoing Projects: {$pm['project_count']}</option>";
        }
        ?>
    </select><br><br>

    <button type="submit">Assign PM</button>
</form>

</body>
</html>
