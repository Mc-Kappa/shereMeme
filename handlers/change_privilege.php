<?php
// Tworzenie połączenia z bazą danych (tak jak wcześniej)
session_start();

if(!isset($_SESSION['logged']))
{
  header('Location: gallery.php');
  exit();
} elseif ($_SESSION['is_admin'] != 1)
{
    header('Location: gallery.php');
    exit();
}

require_once "connect.php";

    $conn = @new mysqli($host, $db_user, $db_password, $db_name, $db_port);

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $id = $_GET['id'];

  if (isset($_GET['id']) && isset($_GET['is_admin']) && $_GET['id'] != 1) {
    if($_GET['is_admin'] == 0)
    {

        $sql = "UPDATE users SET is_admin = 1 WHERE id = $id";


    } else {

        $sql = "UPDATE users SET is_admin = 0 WHERE id = $id";
    }

    mysqli_query($conn, $sql);

  }

  header('Location: ../admin_panel.php')



?>