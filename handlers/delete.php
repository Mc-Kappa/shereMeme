<?php
// Tworzenie połączenia z bazą danych (tak jak wcześniej)
session_start();

if(!isset($_SESSION['logged']))
{
  header('Location: gallery.php');
  exit();
} 
//elseif ($_SESSION['is_admin'] != 1)
//{
//    header('Location: gallery.php');
//    exit();
//}

require_once "connect.php";

$conn = @new mysqli($host, $db_user, $db_password, $db_name, $db_port);
if (isset($_GET['id']) && isset($_GET['type']) && isset($_GET['origin'])) {

    $from = $_GET['origin'] ; 
    $id = $_GET['id'];
    $privilege = $_SESSION['is_admin'] ;
    $user = $_SESSION['user'] ; 

    if($from != 'user' && $from !='admin' )
    {
        $_SESSION['hacking'] = TRUE ;
        header('Location: ../user_panel.php');
        die(); 
    }
    if ($from == 'admin' && $privilege != 1)
    {
        $_SESSION['hacking'] = TRUE ;
        header('Location: ../user_panel.php');
        die();  
    }

    
    if ($_GET['type']=='comment'){
        if($from == 'user')
        {
            $sql = "SELECT author FROM comments where id='$id'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            if ($row['author'] != $user) {
                $_SESSION['hacking'] = TRUE ;
                header('Location: ../user_panel.php');
                die();
                }
        }        
    $sql = "DELETE FROM comments WHERE id = '$id'"; // Zastąp 'table_name' odpowiednią nazwą tabeli.
    mysqli_query($conn, $sql);
        if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully.";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
}
    elseif ($_GET['type']=='img'){
    
        if($from == 'user')
        {
            $sql = "SELECT author FROM images where id='$id'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            if ($row['author'] != $user) {
            $_SESSION['hacking'] = TRUE ;
            header('Location: ../user_panel.php');
            die();
            }
        }    

    $sql = "SELECT src FROM images WHERE id = '$id'"; // Zastąp 'table_name' odpowiednią nazwą tabeli.
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
        if(file_exists($row['src']))
        {
            if (unlink($row['src']))
            { 
                $sql = "DELETE FROM images WHERE id = '$id';"; // Zastąp 'table_name' odpowiednią nazwą tabeli.
                $result = $conn->query($sql);
                $sql = "DELETE FROM comments WHERE image = '$id';"; // Zastąp 'table_name' odpowiednią nazwą tabeli.
                $result = $conn->query($sql);
            }
        } 
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    
} else {
    echo "Invalid or missing ID.";
}

}
$conn->close();
if ($from == 'admin')
{
    header('Location: ../admin_panel.php'); 
}
else
{
    header('Location: ../user_panel.php'); 
}

?>