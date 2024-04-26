<?php
// Start the session
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect user to login page if not logged in
    header("Location: login.php");
    exit;
}
// Check if the form is submitted and a file is uploaded
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["new_profile_image"]["tmp_name"]) && !empty($_FILES["new_profile_image"]["tmp_name"])) {

    $config = parse_ini_file('D:\xampp\htdocs\config.ini');
    $servername = $config['hostname'];
    $username = $config['username'];
    $password = $config['password'];
    $database = $config['database'];

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
    $check = getimagesize($_FILES["new_profile_image"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size (limit to 500KB)
    if ($_FILES["new_profile_image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow only specific file formats (JPG, JPEG, PNG, GIF)
    $allowed_formats = array("jpg", "jpeg", "png", "gif");
    if (!in_array($imageFileType, $allowed_formats)) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // Move uploaded file to target directory
        if (move_uploaded_file($_FILES["new_profile_image"]["tmp_name"], $target_file)) {
            // Update profile image path in database
            $profile_image_path = $target_file;
            $sql = "UPDATE saiyans SET profile_image = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $profile_image_path, $user_id);
            if ($stmt->execute()) {
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
}
else {
    header("Location: profile.php");
}

?>
