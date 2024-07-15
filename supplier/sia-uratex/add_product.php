<?php
require "includes/db.inc.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $size = mysqli_real_escape_string($conn, $_POST['size']);
    $color = mysqli_real_escape_string($conn, $_POST['color']);
    $thickness = mysqli_real_escape_string($conn, $_POST['thickness']);
    $warranty = mysqli_real_escape_string($conn, $_POST['warranty']);
    $thumbnail = mysqli_real_escape_string($conn, $_POST['thumbnail']);
    $currency = mysqli_real_escape_string($conn, $_POST['currency']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);

    $query = "INSERT INTO tblproducts (name, type, price, size, color, thickness, warranty, thumbnail, currency, quantity)
              VALUES ('$name', '$type', '$price', '$size', '$color', '$thickness', '$warranty', '$thumbnail', '$currency', '$quantity')";

    if (mysqli_query($conn, $query)) {
        echo "New record created successfully";
    } else {
        error_log("Error: " . $query . "<br>" . mysqli_error($conn)); // Log the error
        echo "Error occurred while inserting data.";
    }
}
?>
