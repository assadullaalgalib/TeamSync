<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task - TeamSync</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<h1>Edit Task</h1>

<form action="../controller/pm-task-controller.php?action=update" method="post">
    <input type="hidden" name="task_id" value="<?php echo $task['task_id']; ?>">
    <input type="hidden" name="project_id" value="<?php echo $task['project_id']; ?>">

    <label for="task_name">Task Name:</label>
    <input type="text" id="task_name" name="task_name" value="<?php echo $task['name']; ?>"><br>

    <label for="task_description">Task Description:</label>
    <textarea id="task_description" name="task_description"><?php echo $task['description']; ?></textarea><br>

    <label for="start_date">Start Date:</label>
    <input type="date" id="start_date" name="start_date" value="<?php echo $task['start_date']; ?>"><br>

    <label for="deadline">Deadline:</label>
    <input type="date" id="deadline" name="deadline" value="<?php echo $task['deadline']; ?>"><br>

    <label for="developer_id">Assign Developer:</label>
    <select id="developer_id" name="developer_id">
        <option value="">Select Developer</option>
        <?php
        // Populate the dropdown with developers from the controller
        foreach ($developers as $developer) {
            $selected = ($developer['userid'] == $task['developer_id']) ? 'selected' : '';
            echo "<option value='{$developer['userid']}' {$selected}>[{$developer['userid']}] {$developer['firstname']} {$developer['lastname']} - Ongoing Tasks: {$developer['task_count']}</option>";
        }
        ?>
    </select><br><br>

    <button type="submit">Update Task</button>
</form>

<a href="../controller/user-dashboard-controller.php">Home</a>

</body>
</html>
