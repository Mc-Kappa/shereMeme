<?php
    session_start();

    if(!isset($_SESSION['logged']))
    {
      header('Location: gallery.php');
      exit();
    } 
    // elseif ($_SESSION['is_admin'] != 1)
    // {
    //     header('Location: gallery.php');
    //     exit();
    // }
    
    require_once "connect.php";

    $conn = @new mysqli($host, $db_user, $db_password, $db_name, $db_port);

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  ?>

<!doctype html>
<html>
<head>
<title>App Security Project</title>
<meta name="description" content="Main page">
<link href='https://fonts.googleapis.com/css?family=Lato:400' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="../style.css">

</head>
<body>
<div class="logout">
    <?php echo "<p>".$_SESSION['user']." logged in [<a href='handlers/logout.php'>Log out!</a>]</p>";?>
</div>

<div class="header">
    <a href='../gallery.php'>Back to main gallery</a>
</div>

<div class="container">
    <?php 
    if ($_GET['type']=="comment")
    {
        echo'<p>Really want to delete this comment?</p>';
    } 
    elseif ($_GET['type']=="img")
    {
        echo'<p>Really want to delete this image?</p>';        
    }
    ?>
        <a href="delete.php?type=<?php echo $_GET['type']?>&origin=<?php echo $_GET['origin']?>&id=<?php echo $_GET['id'];?>"><input type="button" value="Yes"></a>
        <?php
        if ($_SESSION['is_admin'] == 1)
        {
            echo '<a href="../admin_panel.php"><input type="button" value="No way"></a>' ; 
        }
        elseif ($_SESSION['is_admin'] == 1 && $_GET['origin']=='user')
        {
            echo '<a href="../user_panel.php"><input type="button" value="No way"></a>' ;
        }
        else{
            echo '<a href="../user_panel.php"><input type="button" value="No way"></a>' ; 
        }
        unset($_GET['id'], $_GET['type'], $_GET['origin']);
        die(); 
        ?>
</div>

</body>
</html>