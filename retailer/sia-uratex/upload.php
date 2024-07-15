<?php
session_start();
require "includes/db1.inc.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST["btnUpload"]) && isset($_FILES["txtFile"])) {
    $file = $_FILES["txtFile"]["tmp_name"];

    if (($handle = fopen($file, "r")) !== FALSE) {
        // Skip the first row (header row)
        fgetcsv($handle, 1000, ",");

        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $productID = $data[0];
            $name = $data[1];
            $type = $data[2];
            $price = $data[3];
            $size = $data[4];
            $color = $data[5];
            $thickness = $data[6];
            $warranty = $data[7];
            $thumbnail = $data[8];
            $currency = $data[9];

            $query = "INSERT INTO tblproducts (productID, name, type, price, size, color, thickness, warranty, thumbnail, currency) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                      ON DUPLICATE KEY UPDATE
                      name = VALUES(name), type = VALUES(type), price = VALUES(price), size = VALUES(size),
                      color = VALUES(color), thickness = VALUES(thickness), warranty = VALUES(warranty), 
                      thumbnail = VALUES(thumbnail), currency = VALUES(currency)";

            $stmt = $conn->prepare($query);
            $stmt->bind_param('ssssssssss', $productID, $name, $type, $price, $size, $color, $thickness, $warranty, $thumbnail, $currency);
            $stmt->execute();
        }
        fclose($handle);
    }

    $_SESSION['message'] = "CSV file successfully imported!";
    header("Location: admin_Dashboard.php");
    exit();
} else {
    $_SESSION['error'] = "Please upload a valid CSV file.";
    header("Location: admin_Dashboard.php");
    exit();
}
