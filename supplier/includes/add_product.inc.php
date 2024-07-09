<?php
session_start();
if (!isset($_SESSION['name']) && !isset($_SESSION['user_id'])) {
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