<?php 

    $server_name = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "dbRetailSystem";

    $conn = mysqli_connect($server_name, $db_username, $db_password, $db_name);

    if (!$conn) {
        die("failed to connect to server".mysqli_connect_error());
    }
?>