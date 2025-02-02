<?php
session_start();
include '../model/user-model.php';
include '../model/project-model.php';
include '../model/task-model.php';

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'show_create_user':
        showCreateUser();
        break;

    case 'create_user':
        createUser();
        break;
    
    case 'view_user':
        viewUser();
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
    
    case 'delete_profile_picture':
        deleteProfilePicture();
        break;

    case 'show_all':
        showAllUsers();
        break;

    case 'all_clients':
        showAllClients();
        break;

    case 'all_pms':
        showAllPMs();
        break;

    case 'all_devs':
        showAllDevs();
        break;    
    
    case 'all_admins':
        showAllAdmins();
        break;

    // Other actions...

    default:
        header("Location: ../view/admin-dashboard.php");
        break;
}

function viewUser() {
    $userId = $_SESSION['userid'];
    $adminName = getUserName($userId);

    $userid = $_GET['userid'];
    $user = getUserDetailsById($userid);
    include '../view/admin-user-view.php';
}

function showCreateUser() {

    $userId = $_SESSION['userid'];
    $adminName = getUserName($userId);

    include '../view/admin-user-create.php';
}

function createUser() {
    $userId = $_SESSION['userid'];
    $adminName = getUserName($userId);

    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $roleid = $_POST['role'];

    $errorMessages = [];

    // First Name validation
    if (empty($first_name)) {
        $errorMessages[] = "Please enter a First name.";
    }

    // Last Name validation
    if (empty($last_name)) {
        $errorMessages[] = "Please enter a Last name.";
    }

    // Username validation
    if (empty($name)) {
        $errorMessages[] = "Please enter a Username.";
    }

    // Email validation
    if (empty($email)) {
        $errorMessages[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessages[] = "Invalid email format.";
    } elseif (emailExists($email)) {
        $errorMessages[] = "Email already exists. Please enter a different email.";
    }

    // Password validation (only if password is provided)
    if (!empty($password) && (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[^a-zA-Z0-9]/', $password))) {
        $errorMessages[] = "Password must be at least 8 characters long, with at least one uppercase letter, one lowercase letter, and one special character.";
    }

    // Confirm password validation
    if ($password !== $confirm_password) {
        $errorMessages[] = "Passwords do not match.";
    }

    // Role validation
    if (empty($roleid)) {
        $errorMessages[] = "Please select a role.";
    }

    // If there are validation errors, redirect to create user page with error messages
    if (!empty($errorMessages)) {
        $_SESSION['errorMessages'] = $errorMessages;
        header("Location: ../controller/admin-user-controller.php?action=show_create_user");
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


function showAllClients() {
    $userId = $_SESSION['userid'];
    $adminName = getUserName($userId);

    $users = getAllClientDetails();
    include '../view/admin-user-showall.php';
}

function showAllPMs() {
    $userId = $_SESSION['userid'];
    $adminName = getUserName($userId);

    $users = getAllPMDetails();
    include '../view/admin-user-showall.php';
}

function showAllDevs() {
    $userId = $_SESSION['userid'];
    $adminName = getUserName($userId);

    $users = getAllDevDetails();
    include '../view/admin-user-showall.php';
}

function showAllAdmins() {
    $userId = $_SESSION['userid'];
    $adminName = getUserName($userId);

    $users = getAllAdminDetails();
    include '../view/admin-user-showall.php';
}

function showAllUsers() {
    $userId = $_SESSION['userid'];
    $adminName = getUserName($userId);

    $users = getAllUserDetails();
    include '../view/admin-user-showall.php';
}

function showEditUserForm() {
    $userId = $_SESSION['userid'];
    $adminName = getUserName($userId);

    $userid = $_GET['userid'];
    $user = getUserById($userid);
    include '../view/admin-user-edit.php';
}

function updateUser() {
    $userId = $_SESSION['userid'];
    $adminName = getUserName($userId);

    $userid = $_POST['userid'];
    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $roleid = $_POST['role'];
    $password = $_POST['password'];

    $errorMessages = [];

    // First Name validation
    if (empty($first_name)) {
        $errorMessages[] = "Please enter a First name.";
    }

    // Last Name validation
    if (empty($last_name)) {
        $errorMessages[] = "Please enter a Last name.";
    }

    // Username validation
    if (empty($name)) {
        $errorMessages[] = "Please enter a Username.";
    }

    // Email validation
    $existingUser = getUserById($userid);
    if (empty($email)) {
        $errorMessages[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessages[] = "Invalid email format.";
    } elseif ($email !== $existingUser['email'] && emailExists($email)) {
        $errorMessages[] = "Email already exists. Please enter a different email.";
    }

    // Password validation (only if password is provided)
    if (!empty($password) && (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[^a-zA-Z0-9]/', $password))) {
        $errorMessages[] = "Password must be at least 8 characters long, with at least one uppercase letter, one lowercase letter, and one special character.";
    }

    // If there are validation errors, redirect back to edit user page with error messages
    if (!empty($errorMessages)) {
        $_SESSION['errorMessages'] = $errorMessages;
        header("Location: ../controller/admin-user-controller.php?action=edit&userid=$userid");
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $profile_picture = null;
    
        if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == UPLOAD_ERR_OK) {
            $fileType = mime_content_type($_FILES['profile_picture']['tmp_name']);
            $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
            $maxFileSize = 5 * 1024 * 1024; // 5MB
    
            if (in_array($fileType, $allowedTypes) && $_FILES['profile_picture']['size'] <= $maxFileSize) {
                $profile_picture = file_get_contents($_FILES['profile_picture']['tmp_name']);
            } else {
                $_SESSION['error'] = "Invalid file type or file too large. Please upload a JPEG, PNG, or GIF image under 5MB.";
                header("Location: ../controller/admin-user-controller.php?action=edit&userid=$userid");
                exit();
            }
        }
    
        // If no new profile picture is uploaded, keep the existing one
        if ($profile_picture === null) {
            // Fetch existing profile picture from database
            $existingUser = getUserById($userid); // Assuming this function exists to get user details by ID
            $profile_picture = $existingUser['profile_picture'];
        }

        // Hash the password if it is provided
        if (!empty($password)) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        } else {
            $hashed_password = null; // No password change
        }
    
        $success = editUserAdmin($userid, $first_name, $last_name, $name, $email, $hashed_password, $roleid, $profile_picture);
    
        if ($success) {
            $_SESSION['message'] = "User updated successfully";
            header("Location: ../controller/admin-user-controller.php?action=show_all");
        } else {
            $_SESSION['error'] = "Failed to update user";
            header("Location: ../controller/admin-user-controller.php?action=edit&userid=$userid");
        }
    }

}

function deleteUser() {
    $userId = $_SESSION['userid'];
    $adminName = getUserName($userId);

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

function deleteProfilePicture() {
    $userId = $_SESSION['userid'];
    $adminName = getUserName($userId);

    $userid = $_POST['userid'];
    $profile_picture = file_get_contents('../images/default-profile.png');

    $success = updateProfilePicture($userid, $profile_picture);

    if ($success) {
        $_SESSION['message'] = "Profile picture deleted successfully";
    } else {
        $_SESSION['error'] = "Failed to delete profile picture";
    }

    header("Location: ../controller/admin-user-controller.php?action=edit&userid=$userid");
    exit();
}
