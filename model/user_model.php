<?php
include_once 'db.php';

function insertUser($first_name, $last_name, $username, $email, $password, $roleid)
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
    return $userInfo['firstname'] . ' ' . $userInfo['lastname'];
}


?>