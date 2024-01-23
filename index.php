<?php
    session_start();

    //if(!isset($_SESSION['logged']))
    //{

    header('Location: gallery.php');
    exit();
    /* 
    }

    require_once "handlers/connect.php";

    $conn = @new mysqli($host, $db_user, $db_password, $db_name, $db_port);

    // Sprawdzenie połączenia
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Pobranie istniejących komentarzy
    $sql = "SELECT * FROM comments ORDER BY date DESC";
    $result = $conn->query($sql);

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
    <?php echo "<p>".$_SESSION['user']." logged in [<a href='handlers/logout.php'>Log out!</a>]</p>";?>
</div>

<div class="header">
    <a href='upload.php'>Upload your image</a>
</div>

<div class="container">
    <img src="img/rick.gif" style="text-align: center;">
  </br>
    <!-- <audio id="myAudio" controls autoplay loop>
        <source src="audio/rick.mp3" type="audio/mp3">
    </audio> -->
    <br/>
    <div class="comments">
    <?php
    // Wyświetlanie istniejących komentarzy
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
          echo "<p><strong>" . $row["author"] . "</strong> - " . $row["date"] . "<br>";
          echo  $row["text"] . "</p>";
      }
    } else {
      echo "No comments yet.";
    };

    // Formularz do dodawania nowego komentarza
    echo '<form method="post" action="handlers/add_comment.php">
          <label for="text">Add comment:</label><br/>
          <br/>
          <textarea name="text" required></textarea><br>
          <br/>
          <input type="submit" value="Add Comment">
          <br/>
        </form>';
    
    ?>

  </div>
</div>

<?php
  $conn->close();
?>
</body>
</html>
*/