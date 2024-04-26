<?php



// Read database configuration from config.ini
$config = parse_ini_file('D:\xampp\htdocs\config.ini');

// Assign database credentials to variables
$servername = $config['hostname'];
$username = $config['username']; 
$password = $config['password'];
$database = $config['database'];

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
