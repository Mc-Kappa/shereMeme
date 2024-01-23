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
<meta name="description" content="Register page">
<link rel="stylesheet" href="login_style.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
  <!-- <form onsubmit="submitForm(); return false;"> -->
  <form action="handlers/handler.php" method="post">
    <div class="container">
    <h2>Register</h2>
      E-mail:<br/>
      <input type = "text" name = "email" placeholder="Enter E-mail" class = "box"/>
      </br>
      Password:<br/>
      <input type = "password" name = "password" placeholder="Enter Password" class = "box" />
      </br>
      Confirm Password:</br>
      <input type = "password" name = "password2" placeholder="Enter Password Again" class = "box" />
      </br>
      <button type="submit">Register</button>
      </br>
      <?php
    if(isset($_SESSION['error']))
    {
      echo $_SESSION['error'];
      unset($_SESSION['error']);
    }
  ?>
      </br>
      <a href="admin.php">or log in</a>
    </div>
  
  </form>
<!-- 
  <script>
        function submitForm() {
            const username = document.getElementById("username").value;
            const password = document.getElementById("password").value;
            const password2 = document.getElementById("password2").value;

            var valid = true;

            if(password != password2) {
              valid = false;
            }
 
            // Haszowanie hasła za pomocą bcrypt.js
            bcrypt.hash(password, 10, function(err, hash) {
                if (err) {
                    console.error(err);
                } else {
                    // Wysyłanie hasza hasła do serwera PHP
                    sendDataToServer(username, hash, valid);
                }
            });
        }
 
        function sendDataToServer(username, hashedPassword, valid) {
            // Użyj AJAX, aby przesłać dane do skryptu PHP
            const data = {
                username: username,
                password: hashedPassword,
                valid: valid
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
    </script>
   -->
</body>
</html>

