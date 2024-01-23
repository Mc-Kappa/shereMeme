<?php

    session_start();
    
    if((isset($_SESSION['logged'])) && ($_SESSION['logged']==true))
    {
      header('Location: index.php');
      exit();
    }
  ?>

<!doctype html>
<html>
<head>
<title>App Security Project</title>
<meta name="description" content="Login page">
<link rel="stylesheet" href="login_style.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
<?php 
        if(!isset($_SESSION['logged']))
        {
        echo "<a href='gallery.php'>Browse gallery as guest</a>";
        }
        ?>
  <!-- <form onsubmit="submitForm(); return false;"> -->
    <form action="handlers/login.php" method="post">
    <div class="container">
      <h2>Log in</h2>
      E-mail:<br/>
      <input type = "text" name = "username" placeholder="Enter E-mail" class = "box"/>
      </br>
      Password:<br/>
      <input type = "password" name = "password" placeholder="Enter Password" class = "box" />
      </br>
      <button type="submit">Login</button>
      </br>
      <?php
    if(isset($_SESSION['error']))
    {
      echo $_SESSION['error'];
      unset($_SESSION['error']);
    }
  ?>
    </br>
      <a href="register.php">or register</a>
      </br></br>
      <a href="recover.php">forgot your password?</a>
    
    </div>
  
  </form>

</body>
</html>

