<?php

session_start();

require_once "connect.php";

$conn = @new mysqli($host, $db_user, $db_password, $db_name, $db_port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

if(isset($_SESSION['user']))
{
    $user = $_SESSION['user'];

    $sql = "SELECT is_admin FROM users where user = '$user'";

    $result = $conn->query($sql);

    $row = $result -> fetch_assoc();

    $_SESSION['is_admin'] = $row['is_admin'];
    
}

?>