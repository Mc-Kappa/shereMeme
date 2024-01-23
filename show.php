<?php
    session_start();
    
    require_once "handlers/connect.php";

    $conn = @new mysqli($host, $db_user, $db_password, $db_name, $db_port);

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

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

      echo "<a href='gallery.php'>Back to main gallery</a>";

    ?>
</div>

<div class="container">
    <?php
        $image_id = $_GET['id'];

        $hack_protection = "%^[0-9]+$%";

        if(!preg_match($hack_protection, $image_id))
        {
          $_SESSION['hacking'] = TRUE; 
          header('Location: gallery.php');
          die() ; 
        }

        $sql = "SELECT src FROM images WHERE id='$image_id'";
        $result = $conn->query($sql);
        
        $row = $result->fetch_assoc();

        // Wyświetlanie obrazków
        if ($result->num_rows > 0) {
                echo "<div>";
                echo "<img src='handlers/" . $row["src"] . "' style=width:300px alt='Image'>";
                echo "</div>";
            }
        else
        {
          header("Location: gallery.php"); 
        }

            // Pobranie istniejących komentarzy
        $sql = "SELECT * FROM comments WHERE image = '$image_id' ORDER BY date DESC";
        $result = $conn->query($sql);

      echo  '<div class="comments">';

    // Wyświetlanie istniejących komentarzy
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
          echo "<p><strong>" . $row["author"] . "</strong> - " . $row["date"] . "<br>";
          echo  $row["text"] . "</p>";
      }
    } else {
      echo "No comments yet.";
    };

    if(isset($_SESSION['logged']))
    {
          // Formularz do dodawania nowego komentarza
        echo '<form method="post" action="handlers/add_comment.php?id='.$image_id.'">
        <label for="text">Add comment:</label><br/>
        <br/>
        <textarea name="text" required></textarea><br>
        <br/>
        <input type="submit" value="Add Comment">
        <br/>
      </form>';
      if (isset($_SESSION['hacking']) && $_SESSION['hacking'] == TRUE)
      {
        echo '<p><strong>HACKING NOT ALLOWED!</strong></p>';
        unset($_SESSION['hacking']) ; 
        die(); 
      }

    }
    
  echo '</div>';
        
        // Zamknięcie połączenia z bazą danych
        $conn->close();

    ?>
   
</div>

</body>
</html>