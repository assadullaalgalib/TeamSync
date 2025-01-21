


<!DOCTYPE html>
<html>
<head>
    <title>Active Task - TeamSync</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<h2>Task Details</h2>
<table>
    <tr>
        <td>Task Name:</td>
        <td><?php echo $task['name']; ?></td>
    </tr>
    <tr>
        <td>Project Name:</td>
        <td><?php echo $task['project_name']; ?></td>
    </tr>
    <tr>
        <td>Managed By:</td>
        <td><?php echo $task['pm_name']; ?></td>
    </tr>
    <tr>
        <td>Status:</td>
        <td><?php echo $task['status']; ?></td>
    </tr>
    <tr>
        <td>Start Date:</td>
        <td><?php echo $task['start_date']; ?></td>
    </tr>
    <tr>
        <td>Deadline:</td>
        <td><?php echo $task['deadline']; ?></td>
    </tr>
    <tr>
        <td>PM Comments:</td>
        <td><?php echo $task['pm_comment']; ?></td>
    </tr>
</table>

<h2>Submit Task</h2>
<form action="task_controller.php?action=submit_task" method="post" enctype="multipart/form-data">
    <input type="hidden" name="task_id" value="<?php echo $task['task_id']; ?>">
    <table>
        <tr>
            <td><label for="file">Select file:</label></td>
            <td><input type="file" name="file" id="file" required></td>
        </tr>
        <tr>
            <p id="fileMessage">
                <?php 
                if (isset($_SESSION['fileMessage'])) {
                    echo $_SESSION['fileMessage'];
                    unset($_SESSION['fileMessage']);
                }
                ?>
            </p>
        <tr>
            <td><input type="button" value="Back" onclick="window.location.href='../controller/dashboard_controller.php'"></td>
            <td colspan="2"><button type="submit">Submit</button></td>
        </tr>
    </table>
</form>


<script src="../js/scripts.js"></script>
</body>
</html>
