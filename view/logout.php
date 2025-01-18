<?php
if(isset($_SESSION['userid'])) {
    session_unset();
    session_destroy();
    header('Location: ../view/login.php');
}
else {
    header('Location: ../view/login.php');
}




?>