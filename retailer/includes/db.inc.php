<?php
    $server_name = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "dbsalesenterprisesystem";

    $conn = mysqli_connect($server_name, $db_username, $db_password, $db_name);

    if (!$conn)
        die("failed to connect to the server" . mysqli_connect_error());
    else
        //echo "connected successfully";
?>