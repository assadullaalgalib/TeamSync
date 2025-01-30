<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Projects - TeamSync</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<h1>All Projects</h1>
<table border=1>
    <thead>
        <tr>
            <th>Project ID</th>
            <th>Project Name</th>
            <th>Client Name</th>
            <th>Description</th>
            <th>Deadline</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($projects as $project) { ?>
        <tr>
            <td><?php echo $project['project_id']; ?></td>
            <td><a href="../controller/admin-project-controller.php?action=view_proposal&project_id=<?php echo $project['project_id']; ?>"><?php echo $project['name']; ?></a></td>
            <td><?php echo $project['client_name']; ?></td>
            <td><?php echo $project['description']; ?></td>
            <td><?php echo $project['deadline']; ?></td>
            <td><?php echo $project['status']; ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<a href="../controller/user-dashboard-controller.php">Home</a>

</body>
</html>
