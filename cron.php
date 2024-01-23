<?php

    require_once "handlers/connect.php";

    $connection = @new mysqli($host, $db_user, $db_password, $db_name, $db_port);

    $sql = "DELETE FROM users WHERE CURRENT_TIMESTAMP > DATE_ADD(last_login, INTERVAL 5 MINUTE) AND verified = 0";

    mysqli_query($connection, $sql);

    $connection->close();

?>