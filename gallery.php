<?php

require_once "handlers/refresh_admin.php";

  ?>

<!doctype html>
<html>
<head>
<title>App Security Project</title>
<meta name="description" content="Main page">
<link href='https://fonts.googleapis.com/css?family=Lato:400' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="style.css">

<script>
    // Odtwarzanie audio po załadowaniu strony
    document.addEventListener('DOMContentLoaded', function() {
      var audio = document.getElementById('myAudio');
      audio.play();
    });
  </script>

</head>
<body>
<div class="logout">
    <?php 
        if(isset($_SESSION['logged']))
        {
        echo "<p>".$_SESSION['user']." logged in [<a href='handlers/logout.php'>Log out!</a>]</p>";
        }
        ?>
</div>

<div class="header">
   
    <?php
    if(isset($_SESSION['logged']))
    {
      echo "<a href='upload.php'>Upload your image</a>";
      if($_SESSION['is_admin'] == 1)
      {
        echo "<a href='user_panel.php'>Access user panel</a>";
        echo "<a href='admin_panel.php'>Access admin panel</a>";
      }
      else
      {
        echo "<a href='user_panel.php'>Access user panel</a>";;
      }
    } else
    {
      echo "<a href='admin.php'>Sign in or sign up</a>";
    }

    ?>
</div>

<div class="container">
    <?php 
        if (isset($_SESSION['hacking']) && $_SESSION['hacking'] == TRUE)
        {
          echo "<p><strong>HACKING NOT ALLOWED! </strong></p>" ; 
          unset($_SESSION['hacking']); 
        }
        $sql = "SELECT * FROM images";
        $result = $conn->query($sql);
        
        // Wyświetlanie obrazków
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div>";
                echo "<a href='show.php?id=" .$row["id"]. "'><img src='handlers/" . $row["src"] . "' style=width:300px alt='Image'></a>";
                echo "</div>";
            }
        } else {
            echo "No images available.";
        }
        
        // Zamknięcie połączenia z bazą danych
        $conn->close();

    ?>
   
</div>

</body>
</html>