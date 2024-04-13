<?php
$servername = "localhost";
$username = "enri"; // default username for XAMPP
$password = "password"; // default password for XAMPP
$database = "dragonbol"; // replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to execute SQL queries and return results
function executeQuery($sql) {
    global $conn;
    $result = $conn->query($sql);
    if (!$result) {
        die("Query failed: " . $conn->error);
    }
    return $result;
}
?>
