<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Proposal - TeamSync</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>

<?php include 'admin-navbar.php'; ?>

<div class="project-container">
    <h1><?php echo $project['name']; ?></h1>
    <div class="project-details">
        <p><strong>Client Name:</strong> <?php echo $clientName; ?></p>
        <p><strong>Description:</strong> <?php echo $project['description']; ?></p>
        <p><strong>Deadline:</strong> <?php echo $project['deadline']; ?></p>
    </div>

    <form action="../controller/admin-project-controller.php?action=assign_pm" method="post" class="assign-pm-form">
        <input type="hidden" name="project_id" value="<?php echo $project['project_id']; ?>">

        <div class="form-group">
            <label for="pm_id">Assign Project Manager:</label>
        </div>

        <div class="form-group">
            <select id="pm_id" name="pm_id" required>
                <option value="">Select Project Manager</option>
                <?php
                foreach ($pms as $pm) {
                    echo "<option value='{$pm['userid']}'>#{$pm['userid']} {$pm['firstname']} {$pm['lastname']} - Ongoing Projects: {$pm['project_count']}</option>";
                }
                ?>
            </select>
        </div>        

        <div class="form-buttons">
            <button type="submit" class="button-primary">Assign PM</button>
        </div>
    </form>

</div>

</body>
</html>
