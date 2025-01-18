<?php
// db.php - Database connection file

function getDbConnection() {

    
    //Local Database Connection
    $dbhost = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "teamsyncdb";
    

    //Online Database Connection
    // $dbhost = "sql113.infinityfree.com";
    // $dbusername = "if0_38107243";
    // $dbpassword = "tsdb1234";
    // $dbname = "if0_38107243_teamsyncdb";
    

    // Create connection
    $conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    return $conn;
}
?>