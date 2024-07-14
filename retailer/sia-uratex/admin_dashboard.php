<?php
require "includes/db1.inc.php";
session_start(); // Add this to start the session if not already started
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <title>Retailer Admin Dashboard</title>
    <link rel="icon" href="#" type="image/icon type">

    <style>
        .active {
            background-color: #9191ad !important;
        }

        .text {
            color: black;
            font-weight: bold;
            font-size: 20px;
        }

        .btn-awesome {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
            border-radius: 12px;
        }

        .btn-awesome:hover {
            background-color: white;
            color: black;
            border: 2px solid #4CAF50;
        }

        .btn-download {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
            border-radius: 12px;
        }

        .btn-download:hover {
            background-color: white;
            color: black;
            border: 2px solid #4CAF50;
        }
    </style>

    <script>
        function confirmUpload() {
            return confirm('Are you sure you want to upload this file?');
        }
    </script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- content -->
            <div class="col position-relative px-0 min-vh-100">
                <!-- navbar -->
                <nav class="navbar navbar-expand-lg navbar-light bg-transparent border border-bottom">
                    <div class="container-fluid">
                        <div>
                            <img src="../img/logo.png" class="rounded-circle" height="50" alt="User Avatar" loading="lazy" />
                        </div>
                        <div class="d-flex justify-content-lg-end justify-content-md-end justify-content-center collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- logout button -->
                            <a href="includes/logout.php" class="text-secondary pe-2">Logout</a>
                        </div>
                    </div>
                </nav>
                
                <!-- table label -->
                <div class="row p-lg-5 p-3 text-lg-start text-center m-0">
                    <h1 class="col-lg-6 col-md-12">Item List</h1>
                    <!-- search form -->
                    <div class="col-lg-6">
                        <div class="d-flex justify-content-lg-end justify-content-md-end justify-content-center collapse navbar-collapse" id="navbarSupportedContent">
                            <form method="POST" action="" class="d-flex text-end">
                                <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search" style="border-radius: 25px;">
                                <button class="bg-transparent border-0" type="submit" name="btnSearch"><i class="bi bi-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
               
                <!-- item list table -->
                <div class="table-responsive px-5 pb-5">
                    <table class="table table-hover text-nowrap">
                        <thead class="text-white" style="background-color: #000066;">
                            <!-- table headers -->
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Type</th>
                                <th scope="col">Price</th>
                                <th scope="col">Size</th>
                                <th scope="col">Color</th>
                                <th scope="col">Thickness</th>
                                <th scope="col">Warranty</th>
                                <th scope="col">Thumbnail</th>
                                <th scope="col">Currency</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $search = "";
                                if (isset($_POST['btnSearch'])) {
                                    // post from search form
                                    $search = $_POST['search'];
                            
                                    // query to search data from search form
                                    $query = "SELECT * FROM tblproducts
                                        WHERE productID LIKE ? OR name LIKE ? OR type LIKE ? OR price LIKE ? OR size LIKE ? OR color LIKE ? OR thickness LIKE ? OR warranty LIKE ? OR thumbnail LIKE ? OR currency LIKE ?";
                                    $stmt = $conn->prepare($query);
                                    $searchParam = "%$search%";
                                    $stmt->bind_param('ssssssssss', $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $searchParam);
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                            ?>
                                <tr>
                                    <!-- table data -->
                                    <td><?php echo htmlspecialchars($row["productID"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["name"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["type"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["price"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["size"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["color"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["thickness"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["warranty"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["thumbnail"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["currency"]); ?></td>
                                </tr>
                            <?php 
                                        }
                                    }
                                } else {
                                    $query = "SELECT * FROM tblproducts"; //select all products
                                    $result = $conn->query($query);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                            ?>
                                <tr>
                                    <!-- table data -->
                                    <td><?php echo htmlspecialchars($row["productID"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["name"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["type"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["price"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["size"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["color"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["thickness"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["warranty"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["thumbnail"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["currency"]); ?></td>
                                </tr>
                            <?php
                                        }
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                
                <!-- download button -->
                <div class="d-flex justify-content-end pe-5">
                    <!-- Upload Form -->
                    <form name="frmUpload" enctype="multipart/form-data" method="POST" action="upload.php" class="d-flex align-items-center" onsubmit="return confirmUpload()">
                        <input type="file" name="txtFile" class="form-control me-2" required>
                        <button name="btnUpload" class="btn btn-primary btn-sm" style="background-color: #FF7785; color: #fff;" type="submit">Upload</button>
                    </form>
                </div>

                <?php
                if (isset($_SESSION['message'])) {
                    echo '<div class="alert alert-success mt-3 mx-5" role="alert">' . $_SESSION['message'] . '</div>';
                    unset($_SESSION['message']);
                }

                if (isset($_SESSION['error'])) {
                    echo '<div class="alert alert-danger mt-3 mx-5" role="alert">' . $_SESSION['error'] . '</div>';
                    unset($_SESSION['error']);
                }
                ?>

                <!-- add new item button -->
            </div>
        </div>
    </div> 
</body>
</html>
