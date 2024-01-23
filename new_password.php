<?php

    session_start();
    
    if((isset($_SESSION['logged'])) && ($_SESSION['logged']==true))
    {
      header('Location: index.php');
      exit();
    }

    if (empty($_SESSION['user']))
    {
      header('Location: gallery.php');
      exit();
    } elseif (empty($_SESSION['kod']))
    {
      header('Location: gallery.php');
      exit();
    };
  ?>

<!doctype html>
<html>
<head>
<title>App Security Project</title>
<meta name="description" content="Register page">
<link rel="stylesheet" href="login_style.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
  <!-- <form onsubmit="submitForm(); return false;"> -->
  <form action="handlers/change_password.php" method="post">
    <div class="container">
    <h2>Change password</h2>
      Password:<br/>
      <input type = "password" name = "password" placeholder = "Enter Password" class = "box" />
      </br>
      Confirm Password:</br>
      <input type = "password" name = "password2" placeholder = "Enter Password Again" class = "box" />
      </br>
      <button type="submit">Change</button>
      </br>
      <?php
    if(isset($_SESSION['error']))
    {
      echo $_SESSION['error'];
      unset($_SESSION['error']);
    }
  ?>
  
  </form>

</body>
</html>

