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

<form action="../controller/pm-project-controller.php?action=approve_reject_proposal" method="post">
    <input type="hidden" name="project_id" value="<?php echo $project['project_id']; ?>">
    <button type="submit" name="action" value="approve">Approve</button>
    <button type="submit" name="action" value="reject">Reject</button>
</form>

</body>
</html>
