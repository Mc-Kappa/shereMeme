<?php

    session_start();
    
    if((isset($_SESSION['logged'])) && ($_SESSION['logged']==true))
    {
      header('Location: index.php');
      exit();
    } elseif (empty($_SESSION['user']))
    {
      header('Location: gallery.php');
      exit();
    };

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
  <form action="handlers/login_accept_code.php" method="post">
    <div class="container">
      <h2>Log in</h2>
      Code received:<br/>
      <input type = "text" name = "2fa" placeholder="Enter code" class = "box"/>
      </br>
      <button type="submit">Confirm</button>
      </br>
      <?php
      
    if(isset($_SESSION['error']))
    {
      echo $_SESSION['error'];
      unset($_SESSION['error']);
    }
    
  ?>
    </div>
  
  </form>
  
</body>
</html>

