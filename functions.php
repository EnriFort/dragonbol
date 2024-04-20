<?php
// Include your database connection script here
require_once 'db_connect.php'; // Adjust the path as needed

// Function to fetch posts from the database
function getPosts() {
    // Initialize an empty array to store posts
    $posts = array();

    // Connect to your database (replace these variables with your actual database credentials)
    $servername = "localhost";
    $username = "enri"; 
    $password = "password"; 
    $database = "dragonbol"; 

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to fetch posts 
    $sql =  "SELECT posts.*, saiyans.username, saiyans.profile_image
             FROM posts 
             INNER JOIN saiyans ON posts.user_id = saiyans.id";
    
    // Execute the query
    $result = $conn->query($sql);

    // Check if any posts were found
    if ($result->num_rows > 0) {
        // Loop through each row in the result set
        while ($row = $result->fetch_assoc()) {
            // Add the row data to the $posts array
            $posts[] = $row;
        }
    }

    // Close the database connection
    $conn->close();

    // Return the array of posts
    return $posts;
}

// Function to fetch posts from the database based on category
function getPostsByCategory($post_category) {
    // Initialize an empty array to store posts
    $posts = array();

    // Connect to your database (replace these variables with your actual database credentials)
    $servername = "localhost";
    $username = "enri"; 
    $password = "password"; 
    $database = "dragonbol"; 

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize the input to prevent SQL injection
    //$category = $conn->real_escape_string($category);

    // SQL query to fetch posts by category
    $sql =  "SELECT posts.*, saiyans.username, saiyans.profile_image
             FROM posts 
             INNER JOIN saiyans ON posts.user_id = saiyans.id
             WHERE post_category = '$post_category'";

    // Execute the query
    $result = $conn->query($sql);

    if ($result === false) {
        exit($conn->error);
    } else {
         // Check if any posts were found
        if ($result->num_rows > 0) {
            // Loop through each row in the result set
            while ($row = $result->fetch_assoc()) {
                // Add the row data to the $posts array
                $posts[] = $row;
            }
        }
    }   

    // Close the database connection
    $conn->close();

    // Return the array of posts
    return $posts;
}


?>
