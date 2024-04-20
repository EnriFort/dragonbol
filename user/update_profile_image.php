<?php
// Start the session
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect user to login page if not logged in
    header("Location: login.php");
    exit;
}

// Database connection
$servername = "localhost";
$username = "enri"; 
$password = "password"; 
$database = "dragonbol"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user ID from session
$user_id = $_SESSION['user_id'];

// File upload handling for new profile image
$target_dir = "../user_images/"; // Directory where uploaded files will be stored
$target_file = $target_dir . basename($_FILES["new_profile_image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["new_profile_image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}


// Check file size
if ($_FILES["new_profile_image"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif") {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["new_profile_image"]["tmp_name"], $target_file)) {
        echo "The file " . basename($_FILES["new_profile_image"]["name"]) . " has been uploaded.";
        // Update profile image path in database
        $profile_image_path = $target_file;
        $sql = "UPDATE saiyans SET profile_image = '$profile_image_path' WHERE id = $user_id";
        if ($conn->query($sql) === TRUE) {
            echo "Profile image updated successfully";
            // Redirect user to profile page
            header("Location: profile.php");
            exit;
        } else {
            echo "Error updating profile image: " . $conn->error;
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

$conn->close();
?>
