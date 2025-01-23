<?php
include_once 'model/session-manager-model.php';

startSession();

if (sessionExists('userid') && sessionExists('roleid')) {

    header('Location: controller/user-dashboard-controller.php');
    exit();
} else {

    header('Location: view/user-login.php');
    exit();
}
?>
