<?php
session_start();
if (!isset($_SESSION['username']) && !isset($_SESSION['email'])) {
    header("Location: includes/login.php");
}
?>

<?php 
    require "db.inc.php";

    // delete function
    if (isset($_GET['productID'])) {
        // get row id to delete
        $id = $_GET['productID'];

        // query to data data from tblproducts
        $conn->query("DELETE FROM `tblproducts` WHERE productID = $id");

        // redirect to admin_dashboard.php
        header("location: ../admin_dashboard.php");
    }
?>