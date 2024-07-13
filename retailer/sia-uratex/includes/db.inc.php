<<<<<<< HEAD
<?php 

    $server_name = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "dbsalesenterprisesystem";

    $conn = mysqli_connect($server_name, $db_username, $db_password, $db_name);

    if (!$conn) {
        die("failed to connect to server".mysqli_connect_error());
    }
=======
<?php 

    $server_name = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "dbsalesenterprisesystem";

    $conn = mysqli_connect($server_name, $db_username, $db_password, $db_name);

    if (!$conn) {
        die("failed to connect to server".mysqli_connect_error());
    }
>>>>>>> 2ca820e6270aed379519dc69bfb6c06aaec24b64
?>