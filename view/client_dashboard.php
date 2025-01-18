<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Dashboard - TeamSync</title>
</head>
<body>

    <!-- Welcome Section -->
    <header>
        <h1>Welcome, <?php echo $clientName; ?>!</h1>
        <a href="../view/submit_proposal.php">Submit New Proposal</a>
    </header>

    <!-- Project Overview -->
    <section>
        <h2>Project Overview</h2>
        <div>
            <span>Active Projects: <?php echo $activeCount; ?></span>
            <span>Pending Projects: <?php echo $pendingCount; ?></span>
            <span>Completed Projects: <?php echo $completedCount; ?></span>
        </div>
    </section>

    <!-- Project List -->
    <section>
        <h2>Project List</h2>
        <table>
            <thead>
                <tr>
                    <th>Project Name</th>
                    <th>Status</th>
                    <th>Deadline</th>
                    <th>Progress</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($projects as $project) { ?>
                <tr>
                    <td><a href="project_details.php?project_id=<?php echo $project['project_id']; ?>"><?php echo $project['name']; ?></a></td>
                    <td><?php echo $project['status']; ?></td>
                    <td><?php echo $project['deadline']; ?></td>
                    <td><?php echo $project['progress']; ?>%</td>
                </tr>
                <?php } ?>
                <tr><td><input type="button" value="Logout" onclick="window.location.href='../view/logout.php';"></td></tr>
            </tbody>
        </table>
    </section>

        
</body>
</html>
