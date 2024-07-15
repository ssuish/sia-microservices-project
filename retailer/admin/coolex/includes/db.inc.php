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
>>>>>>> 5685e2c4923a7179007dd7aba65b66b17ee06366
?>