<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            /* azzurrino b3d4fc*/
            background-color:#b3d4fc;
            font-family: 'Lato';
            margin: 0px;
        }

        .entry-title {
            font-family: 'Arial Black', sans-serif;
            font-size: 36px;
            color: #fef679;
            text-shadow: 3px 3px #d9b308;
            letter-spacing: 2px;
        }
        .div-entry-content{
            margin: 0 50px 0;
            max-width: 1000px;
            margin-left: 100px; /* Adjust the left margin as needed */
        }
        .div-paragraph{
            text-align: justify;
            text-justify: inter-word;
            margin: left;
            line-height: 25px;
        }
        .posts-sec {
            text-transform: uppercase;
            color: #264cf7;
            text-shadow: 1px 1px #d9b308;
        }
        .post {
            margin-bottom: 20px;
            border: 2px solid #6fa7e9;
            padding: 10px;
            overflow: hidden; /* Clear floats */
            display: flex; /* Use flexbox for layout */
            align-items: left; /* Center vertically */
        }
        .hr{
            color: #002256;
        }

        .category-rectangle {
            display: inline-block;
            padding: 1px 3px; /* Adjust padding as needed */
            color: #fff;
            background-color: blue; /* Background color of the rectangle */
            border: 1px solid #ccc; /* Border color and thickness */
            border-radius: 5px; /* Border radius for rounded corners */
            margin-right: 10px; /* Adjust margin as needed to separate from post title */
        }

        .category-discussion {
            background-color: blue;
        }
        .category-image {
            background-color: green;
        }
        .category-question {
            background-color: orange;
        }

    </style>
</head>
<body>
    <?php
        // Include database connection and functions to retrieve posts
        require_once 'db_connect.php'; // Example: change 'db_connect.php' to your actual database connection script
        require_once 'functions.php';

        // Retrieve selected category from form submission
        $category = $_GET['category'] ?? '';

        // Retrieve posts from the database 
        $posts = getPosts(); 
       
        sort($posts);
        $posts = array_reverse($posts);
    ?>
    
    <!-- Display Posts -->
    <div class="div-entry-content"> 
        <h3 class="posts-sec">Recent Posts:</h3>
    
        <br>
        <?php
            foreach ($posts as $post) {
                echo '<div class="post">';
                
                    // Display profile image with name below
                    echo '<figure>';
                    echo '<img width="80" height="80" src="user_images/' . $post['profile_image'] . '"alt="Profile Image"'. '"/>';
                    echo '<figcaption><small>' . '<font color="#9900FF">'. $post['username'] . '</font>' . ' - ' . $post['created_at'] . '</small></figcaption>';
                    echo '</figure>';
                    
                    // Display post title
                    echo '<div>';
                    echo '<h3 class="post-title">' . $post['post_title'] . '</h3>';

                    
                    if (!empty($post['post_image'])) {
                        $profileImage = $post['post_image'];
                        echo '<img max-width="100%" height="170" src="post_images/' . $post['post_image'] . '" alt="' . $post['post_title'] . '">';
                    }
                    echo '<br>';
                    echo $post['post_text'];
                    echo '</div>';

                echo '</div>';
            }
        ?>
    </div>
</body>
</html>
