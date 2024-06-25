<?php

$config = parse_ini_file('D:\xampp\htdocs\config.ini');
$servername = $config['hostname'];
$username = $config['username'];
$password = $config['password'];
$database = $config['database'];

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Start the session
session_start();

// Register user
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

    // Prepare and bind SQL statement
    $sql = "INSERT INTO saiyans (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
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

