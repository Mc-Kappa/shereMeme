<?php
use PHPMailer\PHPMailer\PHPMailer;
require '../vendor/autoload.php' ; 

session_start();

if ((!isset($_POST['username'])) || (!isset($_POST['password']))) {
    header('Location: gallery.php');
    exit();
}

require_once "connect.php";

$connection = @new mysqli($host, $db_user, $db_password, $db_name, $db_port);

if ($connection->connect_errno != 0) {
    echo "Error: " . $connection->connect_errno;
} else {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = htmlentities($username, ENT_QUOTES, "UTF-8");

    $_SESSION['user'] = $username;

    // $password = htmlentities($password, ENT_QUOTES, "UTF-8");

    if ($result = @$connection->query(
        sprintf(
            "select id, user, password, is_admin from users where user = '%s'",
            mysqli_real_escape_string($connection, $username)
        )
    )) {
        $how_many = $result->num_rows;
        if ($how_many > 0) {
            $row = $result->fetch_assoc();

            if (password_verify($password, $row['password'])) {
                // $_SESSION['logged'] = true;
                $_SESSION['is_admin'] = $row['is_admin'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['user'] = $row['user'];

                $sql2 = "UPDATE users SET last_login = NOW() WHERE user = '$username'";

                mysqli_query($connection, $sql2);

                $ip = $_SERVER['REMOTE_ADDR'];

                $sql3 = "UPDATE users SET last_ip = '$ip' WHERE user = '$username'";

                mysqli_query($connection, $sql3);

                $min = 1000000000; // Minimum 10-digit number
                $max = 9999999999; // Maximum 10-digit number
                $randomNumber = mt_rand($min, $max);

                // Nowa wartość kolumny 'kod'
                $new_kod_value = $randomNumber;

                // Zapytanie do bazy danych
                $sqlCode = "UPDATE `users` SET `2fa_code`='$new_kod_value' WHERE `user`='$username'";

                mysqli_query($connection, $sqlCode);

                $_SESSION['kod'] = $new_kod_value;

                //mail section:
                $mail = new PHPMailer();
                $mail->isSMTP();
                $mail->Host = 'smtp.wp.pl';
                $mail->SMTPAuth = true;
                $mail->Username = 'appsec@wp.pl';
                $mail->Password = '';
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;

                $mail->setFrom('appsec@wp.pl', 'AppSec - Verification Code');
                $mail->addAddress($username);
                $mail->Subject = 'Verification code';
                $mail->isHTML(TRUE);
                $mail->Body = "<html> Your verification code: ".$new_kod_value."</html>";

                if(!$mail->send()){
                    echo 'Message could not be sent.';
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                    die; 
                } else {
                    echo 'Message has been sent';
                }
                unset($_SESSION['error']);
                $result->close();

                header('Location: ../2fa_login.php');
            } else {
                $_SESSION['error'] = '<span style="color:red">Invalid username or password!</span>';
                header('Location: ../admin.php');
            }
        } else {
            $_SESSION['error'] = '<span style="color:red">Invalid username or password!</span>';
            header('Location: ../admin.php');
        }
    }

    $connection->close();
}
