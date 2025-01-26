<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Task - TeamSync</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<h1>Project: <?php echo $project['name']; ?></h1>
<h2>Add Task</h2>

<form action="../controller/pm-task-controller.php?action=create" method="post">
    <input type="hidden" name="project_id" value="<?php echo $_GET['project_id']; ?>">

    <label for="task_name">Task Name:</label>
    <input type="text" id="task_name" name="task_name"><br>

    <label for="task_description">Task Description:</label>
    <textarea id="task_description" name="task_description"></textarea><br>

    <label for="start_date">Start Date:</label>
    <input type="date" id="start_date" name="start_date"><br>

    <label for="deadline">Deadline:</label>
    <input type="date" id="deadline" name="deadline"><br>

    <label for="developer_id">Assign Developer:</label>
    <select id="developer_id" name="developer_id">
        <option value="">Select Developer</option>
        <?php
        // Populate the dropdown with developers from the controller
        foreach ($developers as $developer) {
            echo "<option value='{$developer['userid']}'>[{$developer['userid']}] {$developer['firstname']} {$developer['lastname']} - Ongoing Tasks: {$developer['task_count']}</option>";
        }
        ?>
    </select><br><br>

    <button type="submit">Add Task</button>
</form>


</body>
</html>
