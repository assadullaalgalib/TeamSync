<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PM Dashboard - TeamSync</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<h1>Welcome, Project Manager!</h1>
<p>Hello, <?php echo $pmName; ?>. Here's an overview of your current projects and pending task approvals.</p>

<h2>Projects Overview</h2>
<ul>
    <?php foreach ($projects as $project) { ?>
        <li>
            <?php echo $project['name']; ?>
            <a href="../controller/pm-tasks-controller.php?action=view&project_id=<?php echo $project['project_id']; ?>">Manage Tasks</a>
        </li>
    <?php } ?>
</ul>

<h2>Pending Task Approvals</h2>
<ul>
    <?php foreach ($pendingTaskApprovals as $task) { ?>
        <li>
            <?php echo $task['name']; ?>
            <a href="../controller/pm-approvals-controller.php?action=view&task_id=<?php echo $task['task_id']; ?>">Review Task</a>
        </li>
    <?php } ?>
</ul>

<h2>Navigation</h2>
<ul>
    <!-- Project Management Links -->
    <li><a href="../controller/pm-projects-controller.php?action=create">Create New Project</a></li>
    <li><a href="../controller/pm-projects-controller.php?action=view">Manage Projects</a></li>

    <!-- Task Management Links -->
    <li><a href="../controller/pm-tasks-controller.php?action=create">Create New Task</a></li>
    <li><a href="../controller/pm-tasks-controller.php?action=view">Manage Tasks</a></li>
    <li><a href="../controller/pm-approvals-controller.php?action=view">Pending Task Approvals</a></li>
</ul>

</body>
</html>
