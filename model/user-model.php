<?php
include_once 'db-connection-model.php';

function registerUser($first_name, $last_name, $username, $email, $password, $roleid)
{
    $conn = getDbConnection();

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usr (firstname, lastname, username, email, password, roleid) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $first_name, $last_name, $username, $email, $hashedPassword, $roleid);

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

    $sql = "SELECT * FROM usr WHERE email = ?";
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
    $sql = "SELECT userid, firstname, lastname, email, roleid FROM usr WHERE userid = ?";
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




?>