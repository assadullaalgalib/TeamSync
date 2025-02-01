<?php
session_start();
require_once('../model/user-model.php');

$action = $_GET['action'] ?? 'view_profile';

switch ($action) {
    case 'view_profile':
        showProfilePage();
        break;

    case 'edit_profile':
        showEditProfilePage();
        break;

    case 'update_profile':
        updateUser();
        break;

    case 'delete_profile_picture':
        deleteProfilePicture();
        break;

    case 'delete_account':
        deleteAccount();
        break;

    default:
        header("Location: ../controller/user-dashboard-controller.php");
        break;
}

function showProfilePage() {
    $userid = $_SESSION['userid'];
    $user = getUserDetailsById($userid);
    include('../view/user-profile-view.php');
}

function showEditProfilePage() {
    $userid = $_SESSION['userid'];
    $user = getUserDetailsById($userid);
    include('../view/user-profile-edit.php');
}

function updateUser() {
    $userid = $_POST['userid'];
    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $profile_picture = null;
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == UPLOAD_ERR_OK) {
        $fileType = mime_content_type($_FILES['profile_picture']['tmp_name']);
        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        $maxFileSize = 5 * 1024 * 1024; // 5MB

        if (in_array($fileType, $allowedTypes) && $_FILES['profile_picture']['size'] <= $maxFileSize) {
            $profile_picture = file_get_contents($_FILES['profile_picture']['tmp_name']);
        } else {
            $_SESSION['error'] = "Invalid file type or file too large. Please upload a JPEG, PNG, or GIF image under 5MB.";
            header("Location: ../controller/user-profile-controller.php?action=edit_profile&userid=$userid");
            exit();
        }
    }

    if ($profile_picture === null) {
        $existingUser = getUserDetailsById($userid);
        $profile_picture = $existingUser['profile_picture'];
    }

    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    } else {
        $hashed_password = null;
    }

    $success = editUser($userid, $first_name, $last_name, $name, $email, $hashed_password, $profile_picture);

    if ($success) {
        $_SESSION['message'] = "Profile updated successfully";
    } else {
        $_SESSION['error'] = "Failed to update profile";
    }

    header("Location: ../controller/user-profile-controller.php?action=view_profile");
    exit();
}

function deleteProfilePicture() {
    $userid = $_POST['userid'];
    $profile_picture = file_get_contents('../images/default-profile.png');

    $success = updateProfilePicture($userid, $profile_picture);

    if ($success) {
        $_SESSION['message'] = "Profile picture deleted successfully";
    } else {
        $_SESSION['error'] = "Failed to delete profile picture";
    }

    header("Location: ../controller/user-profile-controller.php?action=edit_profile&userid=$userid");
    exit();
}

function deleteAccount() {
    $userid = $_POST['userid'];

    $success = removeUser($userid);

    if ($success) {
        $_SESSION['message'] = "Account deleted successfully";
        session_destroy();
    } else {
        $_SESSION['error'] = "Failed to delete account";
    }

    header("Location: ../index.php"); // Redirect to home page after account deletion
    exit();
}
?>
