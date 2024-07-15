<?php
session_start();
require "includes/db.inc.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST["btnDownload"])) {
    if (!$conn) {
        die("Failed to connect to the server: " . mysqli_connect_error());
    } else {
        // Set the file type
        header('Content-type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=download.csv');

        $output = fopen('php://output', 'w');
        // First row of data to write in CSV -- these are field names
        fputcsv($output, array(
            'productID', 'name', 'type', 'price', 'size',
            'color', 'thickness', 'warranty', 'thumbnail', 'currency'
        ));

        $search = "";
        if (isset($_POST['search'])) {
            $search = $_POST['search'];
            $query = "SELECT * FROM tblproducts
                WHERE productID LIKE ? OR name LIKE ? OR type LIKE ? OR price LIKE ? OR size LIKE ? OR color LIKE ? OR thickness LIKE ? OR warranty LIKE ? OR thumbnail LIKE ? OR currency LIKE ?";
            $stmt = $conn->prepare($query);
            $searchParam = "%$search%";
            $stmt->bind_param('ssssssssss', $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $searchParam);
            $stmt->execute();
            $result = $stmt->get_result();
        } else {
            $query = "SELECT * FROM tblproducts ORDER BY productID ASC";
            $result = $conn->query($query);
        }

        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                fputcsv($output, $row);
            }
        }
        fclose($output);
    }
}
?>
