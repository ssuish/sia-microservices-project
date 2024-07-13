<?php
session_start();
require "./includes/db.inc.php";
error_reporting(E_ALL);
ini_set('display errors', 1);
if (isset($_POST["btnDownload"])) {
    if (!$conn) {
        die("Failed to connect to the server" . mysqli_connect_error());
    } else {
        header('Content-type: txt/csv; charset=utf-8');
        header('Content-disposition:attachment; filename=download.csv');
        $output = fopen('php://output', 'w');
        fputcsv($output, array('productID', 'name', 'type', 'price', 'size', 'color', 'thickness', 'warranty', 'thumbnail', 'currency'));

        if (isset($_POST["search"])) {
            $search = $_POST['search'];
            $query = "SELECT * FROM tblproducts
                                        WHERE productID LIKE '%$search%'
                                        OR name LIKE '%$search%'
                                        OR type LIKE '%$search%'
                                        OR price LIKE '%$search%'
                                        OR size LIKE '%$search%'
                                        OR color LIKE '%$search%'
                                        OR thickness LIKE '%$search%');
                                        OR warranty LIKE '%$search%'
                                        OR thumbnail LIKE '%$search%'
                                        OR currency LIKE '%$search%';";
        } else {
            $query = "select * from tblproducts order by productID asc";
        }

        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                fputcsv($output, $row);
            }
            fclose($output);
        }

        unset($_SESSION['search']);
    }
}
