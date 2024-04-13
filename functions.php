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
    $sql =  "SELECT posts.*, users.username, users.profile_image
             FROM posts 
             INNER JOIN users ON posts.user_id = users.id";

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
?>