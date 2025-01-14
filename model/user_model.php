<?php
// user_model.php - Model file for user-related database operations

function insertUser($first_name, $last_name, $username, $email, $password, $roleid) {
    $conn = getDbConnection();

    // Prepare the SQL query to insert the user
    $sql = "INSERT INTO usr (firstname, lastname, username, email, password, roleid) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $first_name, $last_name, $username, $email, $password, $roleid);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}

function authenticateUser($email, $password) {
    $conn = getDbConnection();

    // Prepare the SQL query to check the user
    $sql = "SELECT * FROM usr WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if ($password === $user['password']) {
            return $user; // Return user data if password matches
        }
    }

    // Return null if no match
    return null;
}
?>
