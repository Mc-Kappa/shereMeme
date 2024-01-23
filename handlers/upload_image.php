<?php
// Inicjalizacja sesji (jeśli jeszcze nie jest zainicjowana)
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $author = $_SESSION['user'];

    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == UPLOAD_ERR_OK)
    {
        $fileInfo = pathinfo($_FILES["image"]["name"]);
        $fileExtension = $fileInfo["extension"];
        $allowedExtensions = array("jpg", "jpeg", "png");
        if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
            $_SESSION['hacking'] = TRUE ;
            echo "WYKRYTE!"; 
            header('Location: ../gallery.php') ;  
            die(); 
        }
    }
    else{
        $_SESSION['hacking'] = TRUE ;
        header('Location: ../gallery.php') ;  
        die(); 
    }

    // Przesłane pliki są dostępne w tablicy $_FILES
    $file_name = $_FILES["image"]["name"];
    $file_tmp = $_FILES["image"]["tmp_name"];
    $file_type = $_FILES["image"]["type"];
    $file_size = $_FILES["image"]["size"];

    // Ustawienia katalogu, w którym będą przechowywane pliki obrazków
    $upload_directory = "uploads/";

    // Generowanie unikalnej nazwy pliku, aby uniknąć konfliktów
    $unique_file_name = uniqid() . '_' . $file_name;
    $upload_path = $upload_directory . $unique_file_name;

    // Przeniesienie pliku do katalogu na serwerze
    if (move_uploaded_file($file_tmp, $upload_path)) {
        // Zapisanie informacji do bazy danych
        $sql = "INSERT INTO images (author, src) VALUES ('$author', '$upload_path')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Image uploaded successfully.";
            header('Location: ../gallery.php');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error uploading image.";
    }
}

// Zamknięcie połączenia z bazą danych
$conn->close();

