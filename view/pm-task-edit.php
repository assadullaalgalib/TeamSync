<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task - TeamSync</title>
    <link rel="stylesheet" href="../css/pm-task-view-edit-projectproposal.css">
</head>
<body>

<div class="project-container">
    <h1>Edit Task</h1>

    <form action="../controller/pm-task-controller.php?action=update" method="post" class="task-form">
        <input type="hidden" name="task_id" value="<?php echo $task['task_id']; ?>">
        <input type="hidden" name="project_id" value="<?php echo $task['project_id']; ?>">

        <div class="form-group">
            <label for="task_name">Task Name:</label>
            <input type="text" id="task_name" name="task_name" value="<?php echo $task['name']; ?>">
        </div>

        <div class="form-group">
            <label for="task_description">Task Description:</label>
            <textarea id="task_description" name="task_description"><?php echo $task['description']; ?></textarea>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" name="start_date" value="<?php echo $task['start_date']; ?>">
            </div>

            <div class="form-group">
                <label for="deadline">Deadline:</label>
                <input type="date" id="deadline" name="deadline" value="<?php echo $task['deadline']; ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="developer_id">Assign Developer:</label>
            <select id="developer_id" name="developer_id">
                <option value="">Select Developer</option>
                <?php foreach ($developers as $developer) { ?>
                    <option value="<?php echo $developer['userid']; ?>" <?php echo ($developer['userid'] == $task['developer_id']) ? 'selected' : ''; ?>>
                        [<?php echo $developer['userid']; ?>] <?php echo $developer['firstname'] . ' ' . $developer['lastname']; ?> - Ongoing Tasks: <?php echo $developer['task_count']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="form-buttons">
            <button type="submit" class="button-primary">Update Task</button>
            <a href="../controller/user-dashboard-controller.php" class="button-dark">Back to Dashboard</a>
        </div>
    </form>
</div>

</body>
</html>
