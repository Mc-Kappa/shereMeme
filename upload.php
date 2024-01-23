<?php
    session_start();

    if(!isset($_SESSION['logged']))
    {
      header('Location: gallery.php');
      exit();
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
    <?php echo "<p>".$_SESSION['user']." logged in [<a href='handlers/logout.php'>Log out!</a>]</p>";?>
</div>

<div class="header">
    <a href='gallery.php'>Back to main gallery</a>
</div>

<div class="container">
    <h2>Upload Image</h2>
    <h5>Allowed only .jpg, .jpeg, .png, .gif files</h5>
        <form action="handlers/upload_image.php" method="post" enctype="multipart/form-data">
            <label for="image">Select Image:</label><br/>
            <input type="file" name="image" accept="image/*" required><br>

            <input type="submit" value="Upload">
            
        </form>
</div>

</body>
</html>