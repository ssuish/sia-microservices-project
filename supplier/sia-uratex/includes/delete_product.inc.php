<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 5685e2c4923a7179007dd7aba65b66b17ee06366
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
<<<<<<< HEAD
=======
=======
?>
>>>>>>> 5685e2c4923a7179007dd7aba65b66b17ee06366
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
<<<<<<< HEAD
>>>>>>> 2ca820e6270aed379519dc69bfb6c06aaec24b64
=======
>>>>>>> 5685e2c4923a7179007dd7aba65b66b17ee06366
?>