<?php
require_once '../model/session-manager-model.php';

startSession();

if (sessionExists('errorMessages')) {
    $errorMessages = getSession('errorMessages');
    echo '<ul class="error-messages">';
    foreach ($errorMessages as $message) {
        echo "<li>$message</li>";
    }
    echo '</ul>';
    removeSession('errorMessages');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit New Proposal - TeamSync</title>
    <link rel="stylesheet" href="../css/main.css">
    <script src="../scripts/js/user.js" defer></script>
</head>
<body>

<?php include 'client-navbar.php'; ?>

<div class="project-container">
    <header>
        <h1>Submit New Proposal</h1>
    </header>

    <section>
        <form id="proposalForm" action="../controller/client-submit-proposal-controller.php" method="post" class="proposal-form" onsubmit="validateProposalForm(event)">
            <div class="form-group">
                <label for="name">Project Name:</label>
                <input type="text" id="proposalname" name="proposalname">
                <p class="error-message" id="nameError"></p>
            </div>
            <div class="form-group">
                <label for="description">Project Description:</label>
                <textarea id="description" name="description" rows="10" cols="50"></textarea>
                <p id="descriptionError" class="error-message"></p>
            </div>
            <div class="form-group">
                <label for="deadline">Deadline:</label>
                <input type="date" id="proposaldeadline" name="proposaldeadline">
                <p id="deadlineError" class="error-message"></p>
            </div>
            <div class="form-buttons">
                <button type="submit" class="button-primary">Submit Proposal</button>
                <input type="button" value="Back" class="button-dark" onclick="window.location.href='../controller/user-dashboard-controller.php';">
            </div>
        </form>
    </section>
</div>

</body>
</html>
