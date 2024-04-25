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
    $post_title = strip_tags($_POST["post_title"]); // Strip HTML tags
    $post_text = strip_tags($_POST["post_text"]); 
    $post_image = $_FILES["post_image"]["name"];
    $post_category = strip_tags($_POST["post_category"]); 

    // Sanitize post title and text using filter_var as well
    $post_title = filter_var($post_title, FILTER_SANITIZE_STRING);
    $post_text = filter_var($post_text, FILTER_SANITIZE_STRING);
    $post_category = filter_var($post_category, FILTER_SANITIZE_STRING);

    
    // Check if an image file is uploaded
    if (!empty($_FILES["post_image"]["name"])) {
        $target_dir = "../post_images/";
        $target_file = $target_dir . basename($_FILES["post_image"]["name"]);

        // Check file type
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
            exit;
        }

        // Check file size
        if ($_FILES["post_image"]["size"] > 5000000) { // 5MB limit
            echo "Sorry, your file is too large.";
            exit;
        }

        // Generate a unique filename
        $post_image = uniqid() . "." . $imageFileType;
        $target_file = $target_dir . $post_image;

        // Move uploaded file to the destination directory
        if (!move_uploaded_file($_FILES["post_image"]["tmp_name"], $target_file)) {
            echo "Sorry, there was an error uploading your file.";
            exit;
        }
    } else {
        // No image uploaded
        $post_image = "";
    }

    // Get current date and time
    $created_at = date("Y-m-d H:i:s");

    // Insert post data into the database, including the creation date
    $sql = "INSERT INTO posts (user_id, post_title, post_text, post_image, created_at, post_category) VALUES ('$user_id', '$post_title', '$post_text', '$post_image', '$created_at', '$post_category')";
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
