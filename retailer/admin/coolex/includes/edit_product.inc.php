<?php
session_start();
if (!isset($_SESSION['username']) && !isset($_SESSION['email'])) {
    header("Location: includes/login.php");
}
?>

<?php 
    require "db.inc.php";

    if (isset($_POST['btnEditItem'])) {
        //    post from add item form
        $id = $_POST['productID'];
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
        $conn->query("UPDATE `tblproducts` SET 
            `name`='$name',
            `type`='$type',
            `price`='$price',
            `size`='$size',
            `color`='$color',
            `thickness`='$thickness',
            `warranty`='$warranty',
            `thumbnail`='$thumbnail',
            `currency`='$currency' 
            WHERE productID = $id");

        // redirect to admin_dashboard.php
        header("location: ../admin_dashboard.php");
    }
?>