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

// Retrieve user information from the database
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM saiyans WHERE id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    // User found, fetch user details
    $row = $result->fetch_assoc();
    $username = $row["username"];
    $email = $row["email"];
    $profile_image = $row["profile_image"];
} else {
    header("Location: login.php");
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    <style>
        body {  
            background-color: #b3d4fc;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #6fa7e9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border: 1px solid #092c56
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        p {
            margin-bottom: 10px;
        }
        .profile-image {
            width: 150px; /* Adjust size as needed */
            height: 150px; /* Adjust size as needed */
            border-radius: 50%; /* Make the image round */
            border: 1px solid #000;
            display: block;
            margin: 0 auto;
            margin-bottom: 20px;
        }
        .update-profile-form {
            margin-top: 20px;
            text-align: center;
        }
        .update-profile-form input[type="file"] {
            margin-bottom: 10px;
        }
        .back-button {
            text-align: left;
            margin-bottom: 20px;
        }

        .img-special:hover {
            /* Start the shake animation and make the animation last for 0.5 seconds */
            animation: shake 0.5s;

            /* When the animation is finished, start again */
            animation-iteration-count: infinite;
        }

        @keyframes shake {
            0% { transform: translate(1px, 1px) rotate(0deg); }
            10% { transform: translate(-1px, -2px) rotate(-1deg); }
            20% { transform: translate(-3px, 0px) rotate(1deg); }
            30% { transform: translate(3px, 2px) rotate(0deg); }
            40% { transform: translate(1px, -1px) rotate(1deg); }
            50% { transform: translate(-1px, 2px) rotate(-1deg); }
            60% { transform: translate(-3px, 1px) rotate(0deg); }
            70% { transform: translate(3px, 1px) rotate(-1deg); }
            80% { transform: translate(-1px, -1px) rotate(1deg); }
            90% { transform: translate(1px, 2px) rotate(0deg); }
            100% { transform: translate(1px, -2px) rotate(-1deg); }
        }


    </style>
</head>
<body>


    <div class="topnav">
            <a href="../index.php">Home</a>
            <a href="../about.html">About</a>
            <div class="login-container">
                <?php
                    // Start the session

                    $isLoggedIn = isset($_SESSION['user_id']);

                    // Check if user is logged in
                    if (isset($_SESSION['user_id'])) {
                        echo '<a class="active" href="user/profile.php">Profile</a>';
                        echo '<a href="user/../logout.php">Logout</a>';
                    } else {
                        echo '<a href="user/login.html"> Login</a>';
                        echo '<a href="user/register.html"> Register</a>';
                    }
                ?>  
            </div>
    </div>


    <div class="container">
        
        <h2>User Profile</h2>
        <div style="text-align: center;";>
            <p><strong>Username:</strong> <?php echo $username; ?></p>
            <p><strong>Email:</strong> <?php echo $email; ?></p>
        </div>
        <img src="<?php echo $profile_image; ?>" alt="Profile Image" class="profile-image">
        
        <!-- Form for updating profile image -->
        <div class="update-profile-form">
            <h3>Change Profile Image</h3>
            <form action="update_profile_image.php" method="POST" enctype="multipart/form-data">
                <label for="new_profile_image">Choose a new profile image:</label>
                <input type="file" id="new_profile_image" name="new_profile_image" accept="image/*">
                <br>
                <input type="submit" value="Change">
            </form>
        </div>
    </div>

    <footer class="copyright">
        <div>
            DragonBol Hub - Copyright © 2024. All rights reserved by Eric
        </div>
    </footer>

    <img class = "img-special" src="../img/pualGoku.png" height="250px" >
</body>
</html>