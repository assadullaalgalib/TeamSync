<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PM Dashboard - TeamSync</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/pm-dashboard.js" defer></script>
</head>
<body>

<h1>Welcome, <?php echo $pmName; ?>!</h1>

<h2>Projects Overview</h2>

<!-- Search Section -->
<!-- Store the userid in a hidden element -->
<input type="hidden" id="userid" value="<?php echo $_SESSION['userid']; ?>">

<h3>Search</h3>
<input type="text" id="searchQuery" placeholder="Search...">
<select id="searchFilter">
    <option value="all">All</option>
    <option value="projects">Projects</option>
    <option value="tasks">Tasks</option>
    <option value="developers">Developers</option>
</select>
<div id="searchResults"></div>

<h3>Ongoing Projects</h3>
<ul>
    <?php foreach ($ongoingProjects as $project) { ?>
        <li>
            <strong><?php echo $project['name']; ?></strong>
            <div>Progress: <?php echo $project['progress']; ?>%</div>
            <a href="../controller/pm-project-controller.php?action=view&project_id=<?php echo $project['project_id']; ?>">View</a>
        </li>
    <?php } ?>
</ul>

<h3>Handed Over Projects</h3>
<ul>
    <?php foreach ($handedoverProjects as $project) { ?>
        <li>
            <strong><?php echo $project['name']; ?></strong>
            <a href="../controller/pm-project-controller.php?action=view&project_id=<?php echo $project['project_id']; ?>">View</a>
        </li>
    <?php } ?>
</ul>

<h3>Completed Projects</h3>
<ul>
    <?php foreach ($completedProjects as $project) { 
        if ($project['status'] == 'Completed') { ?>
        <li>
            <strong><?php echo $project['name']; ?></strong>
            <div>Progress: <?php echo $project['progress']; ?>%</div>
            <a href="../controller/pm-project-controller.php?action=view&project_id=<?php echo $project['project_id']; ?>">View</a>
        </li>
    <?php } } ?>
</ul>

<h3>Pending Project Approvals</h3>
<ul>
    <?php foreach ($pendingProposals as $project) { ?>
        <li>
            <strong><?php echo $project['name']; ?></strong>
            <a href="../controller/pm-project-controller.php?action=view_proposal&project_id=<?php echo $project['project_id']; ?>">View Proposal</a>
        </li>
    <?php } ?>
</ul>

<h3>Pending Task Approvals</h3>
<?php
$projectTasks = [];
foreach ($pendingTaskApprovals as $task) {
    $projectTasks[$task['project_id']][] = $task;
}

foreach ($ongoingProjects as $project) {
    if (isset($projectTasks[$project['project_id']])) {
        echo "<h3>{$project['name']}</h3>";
        echo "<ul>";
        foreach ($projectTasks[$project['project_id']] as $task) {
            echo "<li>{$task['name']} <a href='../controller/pm-task-controller.php?action=view&task_id={$task['task_id']}'>Review Task</a></li>";
        }
        echo "</ul>";
    }
}
?>

<h2>Navigation</h2>
<ul>
    <li><a href="../controller/user-dashboard-controller.php">Home</a></li>
    <li><a href="../controller/pm-project-controller.php?action=show_all">Show All Projects</a></li>
    <li><a href="../controller/profile-controller.php?action=view">Profile</a></li>
    <li><a href="../controller/user-logout-controller.php">Logout</a></li>
</ul>

</body>
</html>
