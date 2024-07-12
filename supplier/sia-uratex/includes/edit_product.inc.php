<?php
session_start();
if (!isset($_SESSION['username']) && !isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

require "db.inc.php";

if (isset($_POST['productID'])) {
    $id = $_POST['productID'];
    $name = $_POST['name'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $size = $_POST['size'];
    $color = $_POST['color'];
    $thickness = $_POST['thickness'];
    $warranty = $_POST['warranty'];
    $currency = $_POST['currency'];
    $quantity = $_POST['quantity'];

    if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] == UPLOAD_ERR_OK) {
        $thumbnail = $_FILES['thumbnail']['name'];
        $thumbnailTmpName = $_FILES['thumbnail']['tmp_name'];
        $thumbnailDestination = '../uploads/' . basename($thumbnail);
        
        if (move_uploaded_file($thumbnailTmpName, $thumbnailDestination)) {
            // Success
        } else {
            echo "Failed to move uploaded file.";
        }
    } else {
        // Handle no file upload or upload error
        $thumbnail = $_POST['existingThumbnail'];
    }
    

    // Update query
    $query = "UPDATE `tblproducts` SET 
    `name`='$name',
    `type`='$type',
    `price`='$price',
    `size`='$size',
    `color`='$color',
    `thickness`='$thickness',
    `warranty`='$warranty',
    `thumbnail`='$thumbnail',
    `currency`='$currency',
    `quantity`='$quantity' 
    WHERE `productID`='$id'";

if ($conn->query($query) === TRUE) {
    header("Location: ../admin_dashboard.php");
    exit();
} else {
    echo "Error updating record: " . $conn->error;
}

}
?>
