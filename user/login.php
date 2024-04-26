<?php

$config = parse_ini_file('D:\xampp\htdocs\config.ini');
$servername = $config['hostname'];
$username = $config['username'];
$password = $config['password'];
$database = $config['database'];

// Define dynamic CSS values
$fontColor = 'red';

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Start the session after successful database connection
session_start();

// Login user
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Prepare SQL statement with placeholders
    $sql = "SELECT id, username, password FROM saiyans WHERE username=?";
    $stmt = $conn->prepare($sql);

    // Bind parameters and execute query
    $stmt->bind_param("s", $username);
    $stmt->execute();

    // Get result
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row["password"];

        // Verify password using password_verify function
        if (md5($password) === $row["password"]) {
            // Store user ID in session variable
            $_SESSION['user_id'] = $row['id'];

            // Redirect user to profile page
            header("Location: profile.php");
            exit;
        } else {
            // Invalid password
            echo '<div style="color: ' . $fontColor . ';">';
            echo "<strong><h2>Invalid Password</h2></strong>";
            echo '</div>';
            include 'login.html';
            
        }
    } else {
        // User not found
        echo '<body style="background-color: #dac579;">';
        echo '<div style="color: ' . $fontColor . '; text-align: center;">';
        echo '<br>';
        echo "<strong><h2>USER NOT FOUND</h2></strong>";
        echo '<img src="../img/yamca.webp" width=700px height=500px>';
        echo '</body>';
    }

    // Close prepared statement
    $stmt->close();
}

// Close database connection
$conn->close();

?>
