<?php
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

// Register user
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        // Retrieve the newly created user's ID
        $user_id = $conn->insert_id;

        // Store user ID in session variable
        $_SESSION['user_id'] = $user_id;

        echo "Registration successful";
        // Redirect user to profile page
        header("Location: profile.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
