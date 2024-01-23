<?php
use PHPMailer\PHPMailer\PHPMailer;
require '..\vendor\autoload.php' ; 
session_start();

function valid_email($str) {
	return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
}

$email = $_POST['email'];
$password = $_POST['password'];
$password2 =  $_POST['password2'];

$vd = true;

// $valid_email = true;

require_once "connect.php";

$connection = @new mysqli($host, $db_user, $db_password, $db_name, $db_port);

if ($connection->connect_error) {
    die("Błąd połączenia: " . $connection->connect_error);
}

$query = "SELECT user FROM `users` WHERE `user` = '$email'";

$result = mysqli_query($connection, $query);

$connection->close();

if ($password == $password2)
 {
 	
 } else {
    $vd = false;
 }

 if ($email == "") //email
 {
    $vd = false;
 }
 elseif (!valid_email($email)) 
 {
    $vd = false;
 }elseif ($result->num_rows > 0) {

	$vd = false;
};

if (strlen($password) < 8) 
 {
    $vd = false;
 };



if($vd == true) {
    require_once "connect.php";

    $connection = @new mysqli($host, $db_user, $db_password, $db_name, $db_port);

    // Check connection
    if ($connection->connect_errno != 0) {
        $_SESSION['sql_error'] = "Error: " . $connection->connect_errno;
    }
    else {
        $passhash = password_hash($password, PASSWORD_DEFAULT);

        $min = 1000000000; // Minimum 10-digit number
        $max = 9999999999; // Maximum 10-digit number
        $randomNumber = mt_rand($min, $max);

        // Nowa wartość kolumny 'kod'
        $new_kod_value = $randomNumber;

        $ip = $_SERVER['REMOTE_ADDR'];

        $_SESSION['user'] = $email;

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
        } else {
            echo 'Message has been sent';
            $sqlquery = "INSERT INTO `users` (`user`, `password`, `2fa_code`, `last_ip`, `last_login`, `is_admin`) VALUES ('$email', '$passhash', '$new_kod_value', '$ip', NOW(), '0')";
            mysqli_query($connection, $sqlquery);
        }

    header('Location: ../2fa_login.php');
    

    }

    } else {
        $_SESSION['error'] = '<span style="color:red">Validation Failed!</span>';
        header('Location: ../register.php');
    }

    $connection->close();

?>