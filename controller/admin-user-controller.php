<?php
session_start();
include_once '../model/user-model.php';

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'show_create_user':
        showCreateUser();
        break;

    case 'create_user':
        createUser();
        break;

    case 'edit':
        showEditUserForm();
        break;

    case 'update_user':
        updateUser();
        break;

    case 'delete':
        deleteUser();
        break;

    case 'show_all':
        showAllUsers();
        break;

    // Other actions...

    default:
        header("Location: ../view/admin-dashboard.php");
        break;
}

function showCreateUser() {
    header("Location: ../view/admin-user-create.php");
}

function createUser() {
    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $roleid = $_POST['role'];

    if ($password !== $confirm_password) {
        header("Location: ../view/admin-user-create.php?error=Passwords do not match");
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $success = registerUser($first_name, $last_name, $name, $email, $hashed_password, $roleid);

    if ($success) {
        $_SESSION['message'] = "User created successfully";
        header("Location: ../controller/user-dashboard-controller.php");
    } else {
        $_SESSION['error'] = "Failed to create user";
        header("Location: ../controller/user-dashboard-controller.php");
    }

}

function showAllUsers() {
    $users = getAllUserDetails();
    include '../view/admin-user-showall.php';
}

function showEditUserForm() {
    $userid = $_GET['userid'];
    $user = getUserById($userid);
    include '../view/admin-user-edit.php';
}

function updateUser() {
    $userid = $_POST['userid'];
    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $roleid = $_POST['role'];

    if (!empty($_POST['password'])) {
        $password = $_POST['password'];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    } else {
        $hashed_password = null; // No password change
    }

    $success = editUser($userid, $first_name, $last_name, $name, $email, $hashed_password, $roleid);

    if ($success) {
        $_SESSION['message'] = "User updated successfully";
        header("Location: ../controller/admin-user-controller.php?action=show_all");
    } else {
        $_SESSION['error'] = "Failed to update user";
        header("Location: ../controller/admin-user-controller.php?action=edit&userid=$userid");
    }
}

function deleteUser() {
    $userid = $_GET['userid'];
    $success = removeUser($userid);

    if ($success) {
        $_SESSION['message'] = "User deleted successfully";
        header("Location: ../controller/admin-user-controller.php?action=show_all");
    } else {
        $_SESSION['error'] = "Failed to delete user";
        header("Location: ../controller/admin-user-controller.php?action=show_all");
    }
}
