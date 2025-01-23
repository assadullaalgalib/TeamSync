<?php

function getDbConnection() {

    //Local Database Connection
    $dbhost = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "teamsyncdb";
    
    $conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    return $conn;
}
?>
