<?php
require_once '../model/session-manager-model.php';

startSession();

if (sessionExists('errorMessages')) {
    $errorMessages = getSession('errorMessages');
    echo '<ul>';
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
    <link rel="stylesheet" href="../scripts/css/validation.css">
    <script src="../scripts/js/validation.js" defer></script>
</head>

<body>

    <header>
        <h1>Submit New Proposal</h1>
    </header>

    <section>
        <form id="proposalForm" action="../controller/client-submit-proposal-controller.php" method="post"
            onsubmit="validateProposalForm(event)">
            <table>
                <tr>
                    <td><label for="name">Project Name:</label></td>
                    <td><input type="text" id="proposalname" name="proposalname"></td>
                    <td>
                        <p class="error-message" id="nameError"></p>
                    </td>
                </tr>
                <tr>
                    <td><label for="description">Project Description:</label></td>
                    <td><textarea id="description" name="description" rows="10" cols="50"></textarea></td>
                    <td>
                        <p id="descriptionError" class="error-message"></p>
                    </td>
                </tr>
                <tr>
                    <td><label for="deadline">Deadline:</label></td>
                    <td><input type="date" id="proposaldeadline" name="proposaldeadline"></td>
                    <td>
                        <p id="deadlineError" class="error-message"></p>
                    </td>

                </tr>
                <tr>
                    <td><button type="submit">Submit Proposal</button></td>
                </tr>
                <tr>
                    <td><input type="button" value="Back"
                            onclick="window.location.href='../controller/user-dashboard-controller.php';"></td>
                </tr>
            </table>
        </form>
    </section>

</body>

</html>