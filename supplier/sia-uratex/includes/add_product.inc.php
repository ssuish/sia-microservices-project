<<<<<<< HEAD
<?php
session_start();
if (!isset($_SESSION['username']) && !isset($_SESSION['email'])) {
    header("Location: includes/login.php");
}
?>

<?php 
    require "db.inc.php";

    // btnAddItem onclick
    if (isset($_POST['btnAddItem'])) {
        //    post from add item form
            $name = $_POST['name'];
            $type = $_POST['type'];
            $price = $_POST['price'];
            $size = $_POST['size'];
            $color = $_POST['color'];
            $thickness = $_POST['thickness'];
            $warranty = $_POST['warranty'];
            $thumbnail = $_POST['thumbnail'];
            $currency = $_POST['currency'];
    
            // query to insert data to tblproducts
            $conn->query("INSERT INTO `tblproducts`(`name`, `type`, `price`, `size`, `color`, `thickness`, `warranty`, `thumbnail`, `currency`) 
            VALUES ('$name','$type','$price','$size','$color','$thickness','$warranty','$thumbnail','$currency')");

            // redirect to admin_dashboard.php
            header("location: ../admin_dashboard.php");
    }
?>
=======
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
>>>>>>> 2ca820e6270aed379519dc69bfb6c06aaec24b64
