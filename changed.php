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
  <!-- <form onsubmit="submitForm(); return false;"> -->
    <div class="container">
      Password changed successfully!
      <?php
    if(isset($_SESSION['error']))
    {
      echo $_SESSION['error'];
      unset($_SESSION['error']);
    }
  ?>
    </br>
      <a href="admin.php">Log in!</a>
      </br></br>
      
    
    </div>
  
  <!-- <script>
        function submitForm() {
            const username = document.getElementById("username").value;
            const password = document.getElementById("password").value;
 
            // Haszowanie hasła za pomocą bcrypt.js
            bcrypt.hash(password, 10, function(err, hash) {
                if (err) {
                    console.error(err);
                } else {
                    // Wysyłanie hasza hasła do serwera PHP
                    sendDataToServer(username, hash);
                }
            });
        }
 
        function sendDataToServer(username, hashedPassword) {
            // Użyj AJAX, aby przesłać dane do skryptu PHP
            const data = {
                username: username,
                password: hashedPassword
            };
 
            $.ajax({
                type: "POST",
                url: "login.php",
                data: data,
                success: function(response) {
                    // Obsłuż odpowiedź z serwera (np. przekierowanie na stronę powitalną)
                    console.log(response);
                }
            });
        }
    </script> -->


</body>
</html>

