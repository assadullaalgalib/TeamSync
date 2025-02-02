<?php
include_once 'db-connection-model.php';

function emailExists($email) {

    $conn = getDbConnection();
    $sql = "SELECT COUNT(*) 
            FROM usr 
            WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    
    $stmt->close();

    return $count > 0;
}

function getAllUsers()
{
    $conn = getDbConnection();
    $sql = "SELECT * 
            FROM usr";
    $result = $conn->query($sql);

    $users = [];
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }

    $conn->close();
    return $users;
}

function getAllClients()
{
    $conn = getDbConnection();
    $sql = "SELECT * 
            FROM usr 
            WHERE roleid = 4";
    $result = $conn->query($sql);

    $clients = [];
    while ($row = $result->fetch_assoc()) {
        $clients[] = $row;
    }

    $conn->close();
    return $clients;
}

function getAllPMs()
{
    $conn = getDbConnection();
    $sql = "SELECT * 
            FROM usr 
            WHERE roleid = 2";
    $result = $conn->query($sql);

    $pms = [];
    while ($row = $result->fetch_assoc()) {
        $pms[] = $row;
    }

    $conn->close();
    return $pms;
}

function getAllDevelopers()
{
    $conn = getDbConnection();
    $sql = "SELECT * 
            FROM usr 
            WHERE roleid = 3";
    $result = $conn->query($sql);

    $developers = [];
    while ($row = $result->fetch_assoc()) {
        $developers[] = $row;
    }

    $conn->close();
    return $developers;
}

function searchAllUsers($query) {
    $conn = getDbConnection();
    $sql = "SELECT userid, concat(firstname, ' ', lastname) AS name 
            FROM usr 
            WHERE LOWER(name) LIKE ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $query);
    $stmt->execute();
    $result = $stmt->get_result();
    $users = [];

    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }

    $stmt->close();
    $conn->close();
    return $users;
}


function registerUser($first_name, $last_name, $name, $email, $password, $roleid)
{
    $conn = getDbConnection();

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $profile_picture = file_get_contents('../images/default-profile.png');

    $sql = "INSERT INTO usr (firstname, lastname, name, email, password, roleid, profile_picture) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssis", $first_name, $last_name, $name, $email, $hashedPassword, $roleid, $profile_picture);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        return true;
    } else {
        error_log("Insert User Error: " . $stmt->error);
        $stmt->close();
        $conn->close();
        return false;
    }

}

function authenticateUser($email, $password)
{
    $conn = getDbConnection();

    $sql = "SELECT * 
            FROM usr 
            WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            return $user;
        }
    }
    return null;
}

function getUserInfo($userId)
{
    $conn = getDbConnection();
    $sql = "SELECT userid, firstname, lastname, name, email, roleid 
            FROM usr 
            WHERE userid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $stmt->close();
    $conn->close();

    return $user;
}

function getUserName($userId)
{
    $userInfo = getUserInfo($userId);

    $firstname = $userInfo['firstname'] ?? 'Unassigned';
    $lastname = $userInfo['lastname'] ?? '';

    return trim("$firstname $lastname");
}

function getDevelopersWithTaskCounts() {
    $conn = getDbConnection();
    $sql = "SELECT u.userid, u.firstname, u.lastname, COUNT(t.task_id) AS task_count
            FROM usr u
            LEFT JOIN tasks t ON u.userid = t.developer_id AND t.status != 'Completed'
            WHERE u.roleid = 3
            GROUP BY u.userid, u.firstname, u.lastname";
    $result = $conn->query($sql);
    
    $developers = [];
    while ($row = $result->fetch_assoc()) {
        $developers[] = $row;
    }

    $conn->close();
    return $developers;
}

function getPMWithProjectCount() {
    $conn = getDbConnection();
    $sql = "SELECT u.userid, u.firstname, u.lastname, COUNT(p.project_id) AS project_count
            FROM usr u
            LEFT JOIN projects p ON u.userid = p.pm_id AND p.status != 'Completed'
            WHERE u.roleid = 2
            GROUP BY u.userid, u.firstname, u.lastname";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $pms = [];

    while ($row = $result->fetch_assoc()) {
        $pms[] = $row;
    }

    $stmt->close();
    $conn->close();
    return $pms;
}

function getAllUserDetails() {
    $conn = getDbConnection();
    $sql = "SELECT u.userid, u.firstname, u.lastname, u.name, u.email, r.rolename AS role_name
            FROM usr u
            JOIN usr_role r ON u.roleid = r.roleid";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $users = [];

    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }

    $stmt->close();
    $conn->close();
    return $users;
}

function getAllClientDetails() {
    $conn = getDbConnection();
    $sql = "SELECT u.userid, u.firstname, u.lastname, u.name, u.email, r.rolename AS role_name
            FROM usr u
            JOIN usr_role r ON u.roleid = r.roleid
            WHERE u.roleid = 4";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $users = [];

    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }

    $stmt->close();
    $conn->close();
    return $users;
}

function getAllPMDetails() {
    $conn = getDbConnection();
    $sql = "SELECT u.userid, u.firstname, u.lastname, u.name, u.email, r.rolename AS role_name
            FROM usr u
            JOIN usr_role r ON u.roleid = r.roleid
            WHERE u.roleid = 2";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $users = [];

    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }

    $stmt->close();
    $conn->close();
    return $users;
}

function getAllDevDetails() {
    $conn = getDbConnection();
    $sql = "SELECT u.userid, u.firstname, u.lastname, u.name, u.email, r.rolename AS role_name
            FROM usr u
            JOIN usr_role r ON u.roleid = r.roleid
            WHERE u.roleid = 3";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $users = [];

    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }

    $stmt->close();
    $conn->close();
    return $users;
}

function getAllAdminDetails() {
    $conn = getDbConnection();
    $sql = "SELECT u.userid, u.firstname, u.lastname, u.name, u.email, r.rolename AS role_name
            FROM usr u
            JOIN usr_role r ON u.roleid = r.roleid
            WHERE u.roleid = 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $users = [];

    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }

    $stmt->close();
    $conn->close();
    return $users;
}

function getUserDetailsById($userid) {
    $conn = getDbConnection();
    $sql = "SELECT u.userid, u.firstname, u.lastname, u.name, u.email, r.rolename AS role_name, u.profile_picture
            FROM usr u
            JOIN usr_role r ON u.roleid = r.roleid
            WHERE u.userid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userid);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $stmt->close();
    $conn->close();
    return $user;
}


function getUserById($userid) {
    $conn = getDbConnection();
    $sql = "SELECT * 
            FROM usr 
            WHERE userid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userid);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $stmt->close();
    $conn->close();
    return $user;
}

function editUserAdmin($userid, $first_name, $last_name, $username, $email, $password, $roleid, $profile_picture) {
    $conn = getDbConnection();
    if ($password) {
        $sql = "UPDATE usr 
                SET firstname = ?, lastname = ?, name = ?, email = ?, password = ?, roleid = ?, profile_picture = ? 
                WHERE userid = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssisi", $first_name, $last_name, $username, $email, $password, $roleid, $profile_picture, $userid);
    } else {
        $sql = "UPDATE usr 
                SET firstname = ?, lastname = ?, name = ?, email = ?, roleid = ?, profile_picture = ?
                WHERE userid = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssisi", $first_name, $last_name, $username, $email, $roleid, $profile_picture, $userid);
    }

    $success = $stmt->execute();

    $stmt->close();
    $conn->close();
    return $success;
}

function editUser($userid, $first_name, $last_name, $username, $email, $password, $profile_picture) {
    $conn = getDbConnection();
    if ($password) {
        $sql = "UPDATE usr 
                SET firstname = ?, lastname = ?, name = ?, email = ?, password = ?, profile_picture = ? 
                WHERE userid = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssi", $first_name, $last_name, $username, $email, $password, $profile_picture, $userid);
    } else {
        $sql = "UPDATE usr 
                SET firstname = ?, lastname = ?, name = ?, email = ?, profile_picture = ?
                WHERE userid = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $first_name, $last_name, $username, $email, $profile_picture, $userid);
    }

    $success = $stmt->execute();

    $stmt->close();
    $conn->close();
    return $success;
}


function removeUser($userid) {
    $conn = getDbConnection();
    $sql = "DELETE 
            FROM usr 
            WHERE userid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userid);
    $success = $stmt->execute();

    $stmt->close();
    $conn->close();
    return $success;
}

function updateProfilePicture($userid, $profile_picture) {
    $conn = getDbConnection();
    $sql = "UPDATE usr SET profile_picture = ? WHERE userid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $profile_picture, $userid);
    $success = $stmt->execute();

    $stmt->close();
    $conn->close();
    return $success;
}

?>