<?php
use PHPMailer\PHPMailer\PHPMailer;
require '..\vendor\autoload.php' ; 
session_start();

// if ((!isset($_POST['username'])) || (!isset($_POST['password']))) {
//     header('Location: admin.php');
//     exit();
// }

$email = $_POST['username'];

$_SESSION['user'] = $email;

require_once "connect.php";

$conn = @new mysqli($host, $db_user, $db_password, $db_name, $db_port);

// Sprawdzenie połączenia
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Zmienna przechowująca adres e-mail, którego szukasz
$email_to_find = $email;

$sql2 = "SELECT user from users where user = '$email'";

$result = mysqli_query($conn, $sql2);

if (empty($email_to_find)) {
    $_SESSION['error'] = '<span style="color:red">E-mail field cannot be empty!</span>';
    header('Location: ../recover.php');
    die;
}

if ($result->num_rows != 1) {
    $_SESSION['error'] = '<span style="color:red">Wrong e-mail!</span>';
    header('Location: ../recover.php');
    die;
};


$min = 1000000000; // Minimum 10-digit number
$max = 9999999999; // Maximum 10-digit number
$randomNumber = mt_rand($min, $max);

// Nowa wartość kolumny 'kod'
$new_kod_value = $randomNumber;

// Zapytanie do bazy danych
$sql = "UPDATE `users` SET `2fa_code`='$new_kod_value' WHERE `user`='$email_to_find'";

if ($conn->query($sql) === TRUE) {

    //mail section:
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.wp.pl';
    $mail->SMTPAuth = true;
    $mail->Username = 'appsec@wp.pl';
    $mail->Password = '';
    $mail->SMTPSecure = "ssl";
    $mail->Port = 465;

    $mail->setFrom('appsec@wp.pl', 'AppSec - Verification Code');
    $mail->addAddress($email);
    $mail->Subject = 'Verification code';
    $mail->isHTML(TRUE);
    $mail->Body = "<html> Your verification code: ".$new_kod_value."</html>";

    if(!$mail->send()){
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
        die; 
    } 
    header('Location: ../recover_code.php');
} else {
    $_SESSION['error'] = '<span style="color:red">Wrong e-mail!</span>';
    header('Location: ../recover.php');
}

// Zamykanie połączenia
$conn->close();
?>