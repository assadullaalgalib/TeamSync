<?php
require_once '../model/session-manager-model.php';

if (sessionExists('userid')) {
    destroySession();
    header('Location: ../index.php');
    exit();

} else {
    header('Location: ../view/user-login.php');
    exit();
}
