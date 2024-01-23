<?php

    require_once "handlers/refresh_admin.php";

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

</head>
<body>
<div class="logout">
    <?php echo "<p>".$_SESSION['user']." logged in [<a href='handlers/logout.php'>Log out!</a>]</p>";?>
</div>

<div class="header">
    <a href='gallery.php'>Back to main gallery</a>
</div>

<div class="container">
    <?php

        // Wyświetlanie komentarzy
        echo "<h2>Comments</h2>";
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Author</th><th>Date</th><th>Text</th><th>Delete</th></tr>";
        $user = $_SESSION['user'] ; 
        $sql_comments = "SELECT * FROM comments where author ='$user'";
        $result_comments = $conn->query($sql_comments);
        
        if ($result_comments->num_rows > 0) {
            while ($row = $result_comments->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["author"] . "</td>";
                echo "<td>" . $row["date"] . "</td>";
                echo "<td>" . $row["text"] . "</td>";
                echo "<td><a href='handlers/decision.php?type=comment&origin=user&id=" . $row["id"] . "'>Usuń</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No comments available.</td></tr>";
        }
        
        echo "</table>";
        
        // Wyświetlanie obrazów
        echo "<h2>Images</h2>";
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Author</th><th>Source</th><th>Date</th><th>Delete</th></tr>";
        
        $sql_images = "SELECT * FROM images where author ='$user'";
        $result_images = $conn->query($sql_images);
        
        if ($result_images->num_rows > 0) {
            while ($row = $result_images->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["author"] . "</td>";
                echo "<td><img src='handlers/" . $row["src"] . "' alt='Image' style=width:40px></td>";
                echo "<td>" . $row["date"] . "</td>";
                echo "<td><a href='handlers/decision.php?type=img&origin=user&id=" . $row["id"] . "'>Usuń</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No images available.</td></tr>";
        }
        echo "</table>";
        if (isset($_SESSION['hacking']) && $_SESSION['hacking'] == TRUE)
        {
          echo "<p><strong>HACKING NOT ALLOWED! </strong></p>" ; 
          unset($_SESSION['hacking']); 
        }
        // Zamknięcie połączenia z bazą danych
        $conn->close();
        

    ?>
   
</div>

</body>
</html>