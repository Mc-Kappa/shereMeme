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

$code = $_POST['2fa'];
require_once "connect.php";

$conn = @new mysqli($host, $db_user, $db_password, $db_name, $db_port);

// Sprawdzenie połączenia
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Zmienna przechowująca adres e-mail, którego szukasz
$code_to_find = $code;

if (empty($code_to_find)) {
    $_SESSION['error'] = '<span style="color:red">Code field cannot be empty!</span>';
    header('Location: ../2fa_login.php');
    die;
}

$factor_regex = "^[0-9]{10}$";
if(!preg_match('/'.$factor_regex.'/', $code_to_find))
{
  
  $_SESSION['error'] = '<span style="color:red">Insert only digits or code is too short/long </span>';
  header('Location: ../2fa_login.php');
  die; 
}

$user = $_SESSION['user'];

$sql = "SELECT 2fa_code FROM `users` WHERE `user` = '$user'";
$result = $conn->query($sql);

$row = $result->fetch_assoc();

if (($result->num_rows > 0) && ($row['2fa_code'] === $code_to_find )) {
  
    require_once "connect.php";

    $conn = @new mysqli($host, $db_user, $db_password, $db_name, $db_port);

    $sql = "UPDATE `users` SET `2fa_code` = NULL WHERE `user` = '$user'";

    mysqli_query($conn, $sql);

    $sql4 = "UPDATE users SET verified = 1 WHERE user = '$user'";

    mysqli_query($conn, $sql4);

    $_SESSION['kod'] = $code_to_find;

    $_SESSION['logged'] = true;

    // Kod znajduje się w co najmniej jednym rekordzie
    header('Location: ../gallery.php');

} else {
    // Kod nie istnieje w żadnym rekordzie
    $_SESSION['error'] = '<span style="color:red">Wrong code!</span>';
    header('Location: ../2fa_login.php');
}

// Zamykanie połączenia
$conn->close();
?>