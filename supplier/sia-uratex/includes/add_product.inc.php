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

    // Handle file upload
    $thumbnail = $_FILES['thumbnail']['name'];
    $target_dir = "../";
    $target_file = $target_dir . basename($thumbnail);
    move_uploaded_file($_FILES['thumbnail']['tmp_name'], $target_file);

    // Insert data into the database
    $sql = "INSERT INTO tblproducts (ItemID, name, type, price, size, color, thickness, warranty, thumbnail, currency, quantity) 
            VALUES ('$itemID', '$name', '$type', '$price', '$size', '$color', '$thickness', '$warranty', '$thumbnail', '$currency', '$quantity')";

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close connection
    mysqli_close($conn);
}
?>
