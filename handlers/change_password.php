<?php

session_start();

$password = $_POST['password'];
$password2 =  $_POST['password2'];

if($password === $password2) {
    $username = $_SESSION['user'];

    require_once "connect.php";

    $conn = @new mysqli($host, $db_user, $db_password, $db_name, $db_port);

    $passhash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "UPDATE `users` SET `password` = '$passhash' WHERE `user` = '$username'";

    if (mysqli_query($conn, $sql)) {
        unset($_SESSION['user']);
        unset($_SESSION['kod']);
        header('Location: ../changed.php');
    } else {
        echo "Błąd podczas aktualizacji hasła: " . mysqli_error($conn);
    }
    
} else {
    $_SESSION['error'] = '<span style="color:red">Password do not match!</span>';
    header('Location: ../new_password.php');
}

$conn->close();

?>