<?php
require "includes/db.inc.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect and sanitize form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $size = mysqli_real_escape_string($conn, $_POST['size']);
    $color = mysqli_real_escape_string($conn, $_POST['color']);
    $thickness = mysqli_real_escape_string($conn, $_POST['thickness']);
    $warranty = mysqli_real_escape_string($conn, $_POST['warranty']);
    $currency = mysqli_real_escape_string($conn, $_POST['currency']);
    $quantity = (int)$_POST['quantity'];

    // Handle file upload
    $thumbnail = '';
    if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['thumbnail']['tmp_name'];
        $fileName = $_FILES['thumbnail']['name'];
        $fileType = $_FILES['thumbnail']['type'];
        $fileSize = $_FILES['thumbnail']['size'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
        $uploadFileDir = './uploads/';
        $dest_path = $uploadFileDir . $newFileName;
        
        if(move_uploaded_file($fileTmpPath, $dest_path)) {
            $thumbnail = $newFileName;
        }
    }

    // Insert into database
    $query = "INSERT INTO tblproducts (name, type, price, size, color, thickness, warranty, thumbnail, currency, quantity)
              VALUES ('$name', '$type', '$price', '$size', '$color', '$thickness', '$warranty', '$thumbnail', '$currency', '$quantity')";

    if (mysqli_query($conn, $query)) {
        echo "Product added successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
