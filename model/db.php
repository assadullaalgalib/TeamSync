<?php
// db.php - Database connection file

function getDbConnection() {

    
    //Local Database Connection
    $dbhost = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "teamsyncdb";
    

    // Create connection
    $conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    return $conn;
}
?>
