<?php
    session_start();

    if(!isset($_SESSION['logged']))
    {
      header('Location: gallery.php');
      exit();
    }

    require_once "connect.php";

    $conn = @new mysqli($host, $db_user, $db_password, $db_name, $db_port);

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

    $hack_protection = "#^[a-zA-Z0-9.!?, \r\nąćęłńóśźżĄĆĘŁŃÓŚŹŻ]+$#";
    $author = $_SESSION['user'];

    $image = $_GET['id'];

    $text = $_POST['text'];
    if (preg_match($hack_protection, $text))
    {
    $sql = "INSERT INTO comments (author, image, text) VALUES ('$author', '$image', '$text')";
    mysqli_query($conn, $sql);
    }
    else
    {
      $_SESSION['hacking'] = TRUE;  
    }
    $conn->close();

    header('Location: ../show.php?id='.$image);


?>