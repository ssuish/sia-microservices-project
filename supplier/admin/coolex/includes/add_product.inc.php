<<<<<<< HEAD
<?php
session_start();
if (!isset($_SESSION['username']) && !isset($_SESSION['email'])) {
    header("Location: ../admin_dashboard.php");
    exit;
}

require "db.inc.php";

function uploadFile($file, $targetDir) {
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
    $targetFile = $targetDir . basename($file["name"]);

    // Check if image file is a actual image or fake image
    $check = getimagesize($file["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        $uploadOk = 0;
    }

    // Check file size
    if ($file["size"] > 500000) {
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        return false;
    } else {
        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            return $targetFile;
        } else {
            return false;
        }
    }
}

if (isset($_POST['btnAddItem'])) {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $size = $_POST['size'];
    $color = $_POST['color'];
    $thickness = $_POST['thickness'];
    $warranty = $_POST['warranty'];
    $currency = $_POST['currency'];

    $thumbnail = $_FILES["thumbnail"];
    $thumbnailUrl = uploadFile($thumbnail, "uploads/");

    if ($thumbnailUrl) {
        $stmt = $conn->prepare("INSERT INTO tblproducts (name, type, price, size, color, thickness, warranty, thumbnail, currency) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $name, $type, $price, $size, $color, $thickness, $warranty, $thumbnailUrl, $currency);
        $stmt->execute();
        $stmt->close();

        header("location: ../admin_dashboard.php");
        exit;
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
=======
<?php
session_start();
if (!isset($_SESSION['username']) && !isset($_SESSION['email'])) {
    header("Location: ../admin_dashboard.php");
    exit;
}

require "db.inc.php";

function uploadFile($file, $targetDir) {
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
    $targetFile = $targetDir . basename($file["name"]);

    // Check if image file is a actual image or fake image
    $check = getimagesize($file["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        $uploadOk = 0;
    }

    // Check file size
    if ($file["size"] > 500000) {
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        return false;
    } else {
        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            return $targetFile;
        } else {
            return false;
        }
    }
}

if (isset($_POST['btnAddItem'])) {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $size = $_POST['size'];
    $color = $_POST['color'];
    $thickness = $_POST['thickness'];
    $warranty = $_POST['warranty'];
    $currency = $_POST['currency'];

    $thumbnail = $_FILES["thumbnail"];
    $thumbnailUrl = uploadFile($thumbnail, "uploads/");

    if ($thumbnailUrl) {
        $stmt = $conn->prepare("INSERT INTO tblproducts (name, type, price, size, color, thickness, warranty, thumbnail, currency) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $name, $type, $price, $size, $color, $thickness, $warranty, $thumbnailUrl, $currency);
        $stmt->execute();
        $stmt->close();

        header("location: ../admin_dashboard.php");
        exit;
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
>>>>>>> 2ca820e6270aed379519dc69bfb6c06aaec24b64
?>