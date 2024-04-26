<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>About</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/about.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    
    <style>
        body {
          background-color: #b3d4fc;
          margin: 0;
          padding: 0;
        }
        hr {
          width: 100%;
          border: 0;
          height: 1px;
          background-image: linear-gradient(to right, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.75), rgba(255, 255, 255, 0));
        }
        .bio {
          text-align: justify;
          text-justify: inter-word;
        }
    </style>
</head>
<body>
    
  <div class="topnav">
    <a  href="index.php">Home</a>
    <a class="active" href="about.php">About</a>
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
    
    <div class="about-section">
      <h2>Our Team</h2>
      <p>Meet the Founder: Discover the Vision Behind DragonBol Hub</p>
    </div>
    <hr>
    <div class="row">
        <div class="column">
          <div class="card">
            <img src="img/eric.jpg" alt="Eric" style="width:100%">
            <div class="container">
              <h2>Eric</h2>
              <p class="title">Founder</p>
              <p class="bio">
                Hey there, I'm <strong>Eric</strong>! 🐉 I'm a huge fan of DragonBall and all things related to it. 
                You can often find me binge-watching episodes or discussing theories with fellow fans.
                Aside from being a devoted Dragon Ball enthusiast, I'm also passionate about web development. 
                I'm the creator of this website, where I've combined my love for coding with my favorite anime. 
                It's been an exciting journey bringing this project to life, and I'm thrilled to share it with 
                fellow fans like you!
              </p>
              <p>eric@gmail.com</p>
              <p><button class="button">Contact</button></p>
            </div>
          </div>
        </div>

        <div class="column">
          <div class="card">
            <img src="img/elle.jpg" alt="Elle" style="width:100%">
            <div class="container">
              <h2>Elle</h2>
              <p class="title">Technical Support</p>
              <p class="bio">
                Meet <strong>Elle</strong>, the go-to tech whiz on the forum! With a knack 
                for untangling even the trickiest of tech snarls, Elle is dedicated 
                to ensuring a smooth forum experience for all users. From troubleshooting 
                glitches to offering handy tips and tricks, Elle serves as the forum's tech 
                superhero. A fun fact about Elle: she once programmed a robot to make her breakfast every morning! 🤖🍳
              </p>
              <p>elle@icloud.com</p>
              <p><button class="button">Contact</button></p>
            </div>
          </div>
        </div>


        <div class="column">
          <div class="card">
            <img src="img/emme.webp" alt="Mike" style="width:100%">
            <div class="container">
              <h2>Emme</h2>
              <p class="title">Community Manager</p>
              <p class="bio">
                Meet <strong>Emme</strong>, a vibrant individual with a deep passion for the finer details in life. An avid fan of the
                animated series DragonBall, emme's favorite character is <strong><span style=color:violet>Bulma</span></strong>, whose intelligence and resourcefulness
                he greatly admires. When he's not immersed in the world of anime, emme can be found cheering
                enthusiastically for his favorite football team, AS Roma. His loyalty to the team is as steadfast as his
                admiration for Bulma &lt3, making every game an exciting event in his weekly routine. Emme's blend of
                interests showcases his unique personality, mixing animated adventures with the thrilling world of football.
                His birthday is 14/04 remember to wish him a happy birthday!!!
              </p>
              <p>emme@gmail.com</p>
              <p><button class="button">Contact</button></p>
            </div>
          </div>
        </div>

        <div class="column">
          <div class="card">
            <img src="img/dam.webp" alt="Dam" style="width:100%">
            <div class="container">
              <h2>Dam</h2>
              <p class="title">Moderator</p>
              <p class="bio">
                Greetings, everyone! Meet <strong>Dam</strong>, your friendly neighborhood moderator. 
                Passionate about cultivating a positive and welcoming community, Dam 
                is dedicated to ensuring that the forum remains a safe and respectful 
                space for all users. From guiding discussions to resolving conflicts, 
                Dam is committed to fostering a vibrant and inclusive forum environment.
              </p>
              <p>dam@aruba.it</p>
              <p><button class="button">Contact</button></p>
            </div>
          </div>
        </div>        

        

      </div>


    <footer class="copyright">
        <div>
            DragonBol Hub - Copyright © 2024. All rights reserved by Eric
        </div>
    </footer>

</body>
</html>