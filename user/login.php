<?php

// Define dynamic CSS values
$fontColor = 'red';

// Database connection
$servername = "localhost";
$username = "enri"; 
$password = "password"; 
$database = "dragonbol"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Start the session
session_start();

// Login user
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM saiyans WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (md5($password) === $row["password"]) { // Check if MD5 hash matches
            // Store user ID in session variable
            $_SESSION['user_id'] = $row['id'];
            // Redirect user to profile page
            header("Location: profile.php");
            exit;
        } else {
            echo '<div style="color: ' . $fontColor . ';">';
            echo '<br>';
            echo "<strong><h2>Invalid Password</h2></strong>";
            echo '</div>';
            include 'login.html';
        }
    } else {
        echo '<body style="background-color: #dac579;">';
        echo '<div style="color: ' . $fontColor . '; text-align: center;">';
        echo '<br>';
        echo "<strong><h2>User not found</h2></strong>";
        echo '<img src="../img/yamca.webp" width=700px height=500px>';
        echo '</body>';
    }
}

$conn->close();
?>
