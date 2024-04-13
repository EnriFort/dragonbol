<?php
// Start the session
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect user to login page if not logged in
    header("Location: login.html");
    exit;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection (replace with your database connection code)
    $servername = "localhost";
    $username = "enri";
    $password = "password";
    $database = "dragonbol";
    $conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Handle form data
    $user_id = $_SESSION['user_id'];
    $post_title = $_POST["post_title"]; 
    $post_text = $_POST["post_text"];
    $post_image = $_FILES["post_image"]["name"];

    // Upload post image
    $target_dir = "../post_images/";
    $target_file = $target_dir . basename($_FILES["post_image"]["name"]);
    move_uploaded_file($_FILES["post_image"]["tmp_name"], $target_file);

    // Get current date and time
    $created_at = date("Y-m-d H:i:s");

    // Insert post data into the database, including the creation date
    $sql = "INSERT INTO posts (user_id, post_title, post_text, post_image, created_at) VALUES ('$user_id', '$post_title', '$post_text', '$post_image', '$created_at')";
    if ($conn->query($sql) === TRUE) {
        echo "New post added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close database connection
    $conn->close();
}

// Redirect user back to index page after form submission
header("Location: ../index.php");
exit;
?>
