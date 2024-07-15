<?php
require '../includes/db.inc.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize form data
    $itemID = mysqli_real_escape_string($conn, $_POST['itemID']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $size = mysqli_real_escape_string($conn, $_POST['size']);
    $color = mysqli_real_escape_string($conn, $_POST['color']);
    $thickness = mysqli_real_escape_string($conn, $_POST['thickness']);
    $warranty = mysqli_real_escape_string($conn, $_POST['warranty']);
    $currency = mysqli_real_escape_string($conn, $_POST['currency']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $thumbnail = mysqli_real_escape_string($conn, $_POST['thumbnail']); // Handle thumbnail as text input

    // Insert data into the database
    $sql = "INSERT INTO tblproducts (ItemID, name, type, price, size, color, thickness, warranty, thumbnail, currency, quantity) 
            VALUES ('$itemID', '$name', '$type', '$price', '$size', '$color', '$thickness', '$warranty', '$thumbnail', '$currency', '$quantity')";

    if (mysqli_query($conn, $sql)) {
        // Redirect to the desired page
        header("Location: http://localhost/SIA/supplier/sia-uratex/admin_dashboard.php");
        exit(); // Ensure no further code is executed after redirect
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close connection
    mysqli_close($conn);
}
?>
