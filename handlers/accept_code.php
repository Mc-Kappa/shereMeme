<?php

session_start();

// if ((!isset($_POST['username'])) || (!isset($_POST['password']))) {
//     header('Location: admin.php');
//     exit();
// }

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
    header('Location: ../recover_code.php');
    die;
}

$sql = "SELECT * FROM `users` WHERE `2fa_code` = $code_to_find";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    require_once "connect.php";

    $conn = @new mysqli($host, $db_user, $db_password, $db_name, $db_port);

    $sql = "UPDATE `users` SET `2fa_code` = NULL WHERE `user` = '$user'";

    mysqli_query($conn, $sql);

    $_SESSION['kod'] = $code_to_find;

    // Kod znajduje się w co najmniej jednym rekordzie
    header('Location: ../new_password.php');

} else {
    // Kod nie istnieje w żadnym rekordzie
    $_SESSION['error'] = '<span style="color:red">Wrong code!</span>';
    header('Location: ../recover_code.php');
}

// Zamykanie połączenia
$conn->close();
?>