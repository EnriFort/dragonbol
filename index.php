<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DragonBol fanpage</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    <style>
        
        body {
            background-color:#b3d4fc;
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
            max-width: 500px;
        }
        .div-paragraph{
            
            text-align: justify;
            text-justify: inter-word;
            margin: left;
            line-height: 25px;
        }
        .posts-sec {
            text-transform: uppercase;
            color: #fef679;
            text-shadow: 1px 1px #d9b308;
        }

        .post-form {
            width: 100%;
            background-color: #6fa7e9;
            border-radius: 8px;
            padding: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border: 1px solid #092c56;
            max-width: 770px;
        }

        .post-form input[type="text"],
        .post-form textarea {
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #bad5f5;
        }

        .container {
            display: grid;
            align-items: center; 
            grid-template-columns: 1fr 3fr ;
            column-gap: 5px;
        }

        .text {
            font-size: 20px;
        }

        hr {
          width: 100%;
          border: 0;
          height: 1px;
          background-image: linear-gradient(to right, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.75), rgba(255, 255, 255, 0));
        }

    </style>
</head>
<body>

    <div class="topnav">
        <a class="active" href="index.php">Home</a>
        <a href="about.php">About</a>
        <div class="login-container">
            <?php
                // Start the session
                session_start();
                $isLoggedIn = isset($_SESSION['user_id']);

                // Check if user is logged in
                if (isset($_SESSION['user_id'])) {
                    echo '<a href="user/profile.php">Profile</a>';
                    echo '<a href="user/logout.php">Logout</a>';
                } else {
                    echo '<a href="user/login.html"> Login</a>';
                    echo '<a href="user/register.html"> Register</a>';
                }
            ?>  
        </div>
    </div>
    
    <div class="div-entry-content">
        
        <h1 class="entry-title">DragonBol Hub<img src="img/flyingNimbus.png" alt="Dragon Ball Logo" width="70px" style="vertical-align: middle; padding-left: 10px;"></h1>
        <figcaption style="font-size: 1em;"><strong>Unleash Your Inner Saiyan: Where Fans Gather to Power Up!</strong></figcaption>
        <br>


        <div class="container">
            <div>
                <img src="img/goku.jpg" alt="goku" width="200" height="400">
            </div>
            <div>
                <p class="div-paragraph text">
                    Dive deep into the multiverse of Dragon Ball as fans unite to dissect episodes,
                    analyze characters, speculate on theories, and celebrate the epic legacy of this iconic series. Whether you're a seasoned warrior or a newly awakened fan, join us in exploring every aspect of the Dragon Ball universe. From intense debates to sharing fan art, 
                    DragonBol Hub is your ultimate destination for all things Dragon Ball. Welcome, fellow Saiyans, to your home away from home!
                    
                </p>
            </div>
        </div>
  
        <hr>
        <!-- Post Form -->
        <?php if ($isLoggedIn): ?>
            <div class="post-form">
                <h3>Add a Post</h3>
                <form action="post/submit_post.php" method="POST" enctype="multipart/form-data">
                    <label for="post_title">Title:</label>
                    <input type="text" id="post_title" name="post_title" required>
                    <label for="post_category">Category:</label>
                    <select id="post_category" name="post_category">
                        <option value="discussion">discussion</option>
                        <option value="image">image</option>
                        <option value="question">question</option>
                    </select>
                    <label for="post_image">Image:</label>
                    <input type="file" id="post_image" name="post_image" accept="image/*">
                    <br>
                    <br>
                    <label for="post_text">Text:</label>
                    <br>
                    <textarea id="post_text" placeholder="Write your post here..." name="post_text" rows="4" style="width: 85%;" required></textarea>
                    <br>
                    <br>
                    <input type="submit" value="Post">
                </form>
            </div>
        <?php endif; ?> 

    </div>

        
    <?php
        // Include PHP script to fetch and display posts
        include 'post/display_posts.php';
    ?>

    <footer class="copyright">
        <div>
            DragonBol Hub - Copyright © 2024. All rights reserved by Eric
        </div>
    </footer>

</body>
</html>
