<<<<<<< HEAD
<?php
session_start();
require "includes/db.inc.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <title></title>
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
    </style>

    <script>
        function confirmDelete(productID) {
            if (confirm("Are you sure you want to delete this item?")) {
                window.location.href = 'includes/delete_product.inc.php?productID=' + productID;
            }
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
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_POST['btnSearch'])) {
                                // post from search form
                                $search = $_POST['search'];
                                $_SESSION['search'] = $search;

                                // query to search data from search form
                                $query = "SELECT * FROM tblproducts
                                        WHERE productID LIKE '%$search%'
                                        OR name LIKE '%$search%'
                                        OR type LIKE '%$search%'
                                        OR price LIKE '%$search%'
                                        OR size LIKE '%$search%'
                                        OR color LIKE '%$search%'
                                        OR thickness LIKE '%$search%'
                                        OR warranty LIKE '%$search%'
                                        OR thumbnail LIKE '%$search%'
                                        OR currency LIKE '%$search%';";
                                $result = mysqli_query($conn, $query);

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                        <tr>
                                            <!-- table data -->
                                            <td><?php echo $row["productID"]; ?></td>
                                            <td><?php echo $row["name"]; ?></td>
                                            <td><?php echo $row["type"]; ?></td>
                                            <td><?php echo $row["price"]; ?></td>
                                            <td><?php echo $row["size"]; ?></td>
                                            <td><?php echo $row["color"]; ?></td>
                                            <td><?php echo $row["thickness"]; ?></td>
                                            <td><?php echo $row["warranty"]; ?></td>
                                            <td><?php echo $row["thumbnail"]; ?></td>
                                            <td><?php echo $row["currency"]; ?></td>
                                            <td>
                                                <!-- edit button -->
                                                <a href="edit_product.php?editProductID=<?php echo $row['productID']; ?>" name="btnEdit" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                                <!-- delete button -->
                                                <button onclick="confirmDelete(<?php echo $row['productID']; ?>)" class="btn btn-danger"><i class="bi bi-trash3"></i></button>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                                <?php } else {
                                $query = "SELECT * FROM tblproducts"; //select all products
                                $result = mysqli_query($conn, $query);

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                        <tr>
                                            <!-- table data -->
                                            <td><?php echo $row["productID"]; ?></td>
                                            <td><?php echo $row["name"]; ?></td>
                                            <td><?php echo $row["type"]; ?></td>
                                            <td><?php echo $row["price"]; ?></td>
                                            <td><?php echo $row["size"]; ?></td>
                                            <td><?php echo $row["color"]; ?></td>
                                            <td><?php echo $row["thickness"]; ?></td>
                                            <td><?php echo $row["warranty"]; ?></td>
                                            <td><?php echo $row["thumbnail"]; ?></td>
                                            <td><?php echo $row["currency"]; ?></td>
                                            <td>
                                                <!-- edit button -->
                                                <a href="edit_product.php?editProductID=<?php echo $row['productID']; ?>" name="btnEdit" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                                <!-- delete button -->
                                                <button onclick="confirmDelete(<?php echo $row['productID']; ?>)" class="btn btn-danger"><i class="bi bi-trash3"></i></button>
                                            </td>
                                        </tr>
                            <?php
                                    }
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- add item button -->
                <div class="text-end py-2 pe-2">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addItemModal">
                        Add Item
                    </button>

                    <!-- Modal -->
                    <!-- form redirects to includes/add_product.php -->
                    <form method="POST" action="includes/add_product.inc.php">
                        <div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" name="name" id="name" placeholder="" required>
                                                    <label for="date" class="form-label">Name<i class="text-danger">*</i></label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" name="type" id="type" placeholder="" required>
                                                    <label for="date" class="form-label">Type<i class="text-danger">*</i></label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-floating mb-3">
                                                    <input type="number" class="form-control" name="price" id="price" placeholder="" step=".01" required>
                                                    <label for="date" class="form-label">Price<i class="text-danger">*</i></label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" name="size" id="size" placeholder="" required>
                                                    <label for="date" class="form-label">Size<i class="text-danger">*</i></label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" name="color" id="color" placeholder="" required>
                                                    <label for="date" class="form-label">Color<i class="text-danger">*</i></label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" name="thickness" id="thickness" placeholder="" required>
                                                    <label for="date" class="form-label">Thickness<i class="text-danger">*</i></label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" name="warranty" id="warranty" placeholder="" required>
                                                    <label for="date" class="form-label">Warranty<i class="text-danger">*</i></label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-floating mb-3">
                                                    <input type="file" class="form-control" name="thumbnail" id="thumbnail" required>
                                                    <label for="thumbnail" class="form-label">Thumbnail<i class="text-danger">*</i></label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" name="currency" id="currency" placeholder="" required>
                                                    <label for="date" class="form-label">Currency<i class="text-danger">*</i></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- modal buttons -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="btnAddItem">Add</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- download button -->
                <div class="text-center py-5 pe-5">
                    <form action="./downloadRecords.php" method="POST">
                    <button type="submit" name="btnDownload" class="btn btn-primary" data-mdb-ripple-init>Download CSV</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</body>

</html>
=======
<?php
require "includes/db.inc.php";

session_start();  

if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
  }

// Fetch sizes from MattressProductSize table
$sizeQuery = "SELECT `Size` FROM `MattressProductSize`";
$sizeResult = mysqli_query($conn, $sizeQuery);
$sizes = [];
if (mysqli_num_rows($sizeResult) > 0) {
    while ($row = mysqli_fetch_assoc($sizeResult)) {
        $sizes[] = $row['Size'];
    }
}

// Fetch types from ProductsType table
$typeQuery = "SELECT `Type` FROM `ProductsType`";
$typeResult = mysqli_query($conn, $typeQuery);
$types = [];
if (mysqli_num_rows($typeResult) > 0) {
    while ($row = mysqli_fetch_assoc($typeResult)) {
        $types[] = $row['Type'];
    }
}

// Fetch thicknesses from Thickness table
$thicknessQuery = "SELECT `Thickness` FROM `Thickness`";
$thicknessResult = mysqli_query($conn, $thicknessQuery);
$thicknesses = [];
if (mysqli_num_rows($thicknessResult) > 0) {
    while ($row = mysqli_fetch_assoc($thicknessResult)) {
        $thicknesses[] = $row['Thickness'];
    }
}

// Fetch warranties from Warranty table
$warrantyQuery = "SELECT `Warranty` FROM `Warranty`";
$warrantyResult = mysqli_query($conn, $warrantyQuery);
$warranties = [];
if (mysqli_num_rows($warrantyResult) > 0) {
    while ($row = mysqli_fetch_assoc($warrantyResult)) {
        $warranties[] = $row['Warranty'];
    }
}

// Fetch currencies from Currency table
$currencyQuery = "SELECT `Currency` FROM `Currency`";
$currencyResult = mysqli_query($conn, $currencyQuery);
$currencies = [];
if (mysqli_num_rows($currencyResult) > 0) {
    while ($row = mysqli_fetch_assoc($currencyResult)) {
        $currencies[] = $row['Currency'];
    }
}

// Fetch product types for sorting from ProductsType table
$productTypeQuery = "SELECT DISTINCT Type FROM ProductsType";
$productTypeResult = mysqli_query($conn, $productTypeQuery);
$productTypes = [];
if (mysqli_num_rows($productTypeResult) > 0) {
    while ($row = mysqli_fetch_assoc($productTypeResult)) {
        $productTypes[] = $row['Type'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <title>Supplier Damn Admin Dashboard</title>
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

        .table-responsive {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal-content {
            animation: slideIn 0.5s ease-in-out;
        }

        @keyframes slideIn {
            from { transform: translateY(100%); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .btn-custom {
        color: white;
        padding: 10px 10px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-add {
        background-color: #000080; /* Navy */
    }

    .btn-add:hover {
        background-color: #000066; /* Darker Navy */
    }

    .btn-download {
        background-color: #000066; /* Green */
    }

    .btn-download:hover {
        background-color: #45a049; /* Darker Green */
    }
    /* Base styles for floating messages */
    .floating-message {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: #333;
    color: #fff;
    padding: 10px 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0,0,0,0.5);
    z-index: 1000;
    opacity: 0;
    transition: opacity 0.5s ease-in-out, transform 0.5s ease-in-out;
    transform: translateY(100%);
}

.floating-message.show {
    opacity: 1;
    transform: translateY(0);
}

.floating-message.hidden {
    opacity: 0;
    transform: translateY(100%);
}

#downloadPrompt button {
    margin: 0 5px;
    padding: 5px 10px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

#confirmDownload {
    background: #4CAF50; /* Green */
    color: white;
}

#cancelDownload {
    background: #f44336; /* Red */
    color: white;
}


    </style>
    
    <script>
        function confirmDelete(productID) {
            if (confirm("Are you sure you want to delete this item?")) {
                window.location.href = 'includes/delete_product.inc.php?productID=' + productID;
            }
        }

        function sortTableByType() {
            const selectedType = document.getElementById('productType').value;
            window.location.href = `admin_dashboard.php?type=${selectedType}`;
        }
    </script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- content -->
            <div class="col position-relative px-0 min-vh-70">
                <!-- navbar -->
                <nav class="navbar navbar-expand-lg navbar-light bg-transparent border border-bottom">
                    <div class="container-fluid">
                        <div>
                            <img src="../img/orotex.png" class="rounded-circle" height="60" alt="User Avatar" loading="lazy" />
                        </div>
                        <div class="d-flex justify-content-lg-end justify-content-md-end justify-content-center collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- logout button -->
                            <a href="includes/logout.php" class="text-secondary pe-2">Logout</a>
                        </div>
                    </div>
                </nav>
                
                <!-- table label and sorting -->
                <div class="row p-lg-5 p-3 text-lg-start text-center m-0">
                    <div class="col-lg-6 col-md-12">
                        <h1>Item List</h1>
                    </div>
                    <!-- search form and sorting -->
<div class="col-lg-6">
    <div class="d-flex justify-content-lg-end justify-content-md-end justify-content-center collapse navbar-collapse" id="navbarSupportedContent">
        <form method="POST" action="" class="d-flex text-end me-3">
            <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search" style="border-radius: 25px;">
            <button class="bg-transparent border-0" type="submit" name="btnSearch"><i class="bi bi-search"></i></button>
        </form>
        <select id="productType" class="form-select" onchange="sortTableByType()">
            <option value="">All Types</option>
            <?php foreach ($productTypes as $productType) { ?>
                <option value="<?php echo htmlspecialchars($productType); ?>" <?php if(isset($_GET['type']) && $_GET['type'] == $productType) echo 'selected'; ?>><?php echo htmlspecialchars($productType); ?></option>
            <?php } ?>
        </select>
    </div>
</div>

                </div>
               
                <!-- item list table -->
                <div class="table-responsive px-5 pb-5">
                    <table class="table table-hover text-nowrap">
                        <thead class="text-white" style="background-color: #000066;">
                            <!-- table headers -->
                            <tr>
                                <th scope="col">Item ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Type</th>
                                <th scope="col">Price</th>
                                <th scope="col">Size</th>
                                <th scope="col">Color</th>
                                <th scope="col">Thickness</th>
                                <th scope="col">Warranty</th>
                                <th scope="col">Thumbnail</th>
                                <th scope="col">Currency</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $typeFilter = isset($_GET['type']) ? $_GET['type'] : '';
                                $query = "SELECT * FROM tblproducts";
                                if ($typeFilter) {
                                    $query .= " WHERE type='$typeFilter'";
                                }

                                if (isset($_POST['btnSearch'])) {
                                    // post from search form
                                    $search = $_POST['search'];
                            
                                    // query to search data from search form
                                    $query .= " WHERE productID LIKE '%$search%'
                                        OR name LIKE '%$search%'
                                        OR type LIKE '%$search%'
                                        OR price LIKE '%$search%'
                                        OR size LIKE '%$search%'
                                        OR color LIKE '%$search%'
                                        OR thickness LIKE '%$search%'
                                        OR warranty LIKE '%$search%'
                                        OR thumbnail LIKE '%$search%'
                                        OR currency LIKE '%$search%'
                                        OR quantity LIKE '%$search%'";
                                }

                                $result = mysqli_query($conn, $query);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr>
                                    <!-- table data -->
                                    <td><?php echo $row["ItemID"]; ?></td>
                                    <td><?php echo $row["name"]; ?></td>
                                    <td><?php echo $row["type"]; ?></td>
                                    <td><?php echo $row["price"]; ?></td>
                                    <td><?php echo $row["size"]; ?></td>
                                    <td><?php echo $row["color"]; ?></td>
                                    <td><?php echo $row["thickness"]; ?></td>
                                    <td><?php echo $row["warranty"]; ?></td>
                                    <td><?php echo $row["thumbnail"]; ?></td>
                                    <td><?php echo $row["currency"]; ?></td>
                                    <td><?php echo $row["quantity"]; ?></td>
                                    <td>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal" 
                                        data-id="<?php echo $row['productID']; ?>" 
                                        data-name="<?php echo $row['name']; ?>" 
                                        data-type="<?php echo $row['type']; ?>" 
                                        data-price="<?php echo $row['price']; ?>" 
                                        data-size="<?php echo $row['size']; ?>" 
                                        data-color="<?php echo $row['color']; ?>" 
                                        data-thickness="<?php echo $row['thickness']; ?>" 
                                        data-warranty="<?php echo $row['warranty']; ?>" 
                                        data-thumbnail="<?php echo $row['thumbnail']; ?>" 
                                        data-currency="<?php echo $row['currency']; ?>" 
                                        data-quantity="<?php echo $row['quantity']; ?>">
                                            <i class="bi bi-pencil-square text-primary"></i> <!-- Changed color to primary for edit -->
                                        </a>
                                        <a href="#" onclick="confirmDelete(<?php echo $row['productID']; ?>)">
                                            <i class="bi bi-trash text-danger ps-2"></i> <!-- Changed color to danger for delete -->
                                        </a>

                                    </td>
                                </tr>
                            <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='12' class='text-center'>No data found</td></tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- button to trigger modal -->
                <!-- button to trigger modal -->
<div class="d-flex justify-content-lg-end justify-content-md-end justify-content-center px-5 pb-5">
    <button type="button" class="btn text-white" style="background-color: #000066;" data-bs-toggle="modal" data-bs-target="#addProductModal">
        Add Product
    </button>
    <div>&nbsp;</div>
    <!-- Download Form -->
    <form method="POST" action="downloadRecords.php" class="me-3">
                        <input type="hidden" name="search" value="<?php echo htmlspecialchars($search); ?>">
                        <button type="submit" name="btnDownload" class="btn btn-download btn-custom my-3 fs-6 px-4">Download Data</button>
                    </form>
                    <!-- Floating message containers -->
<div id="downloadPrompt" class="floating-message hidden">
    <p>Do you want to download this file?</p>
    <button id="confirmDownload">Yes</button>
    <button id="cancelDownload">No</button>
</div>

<div id="successMessage" class="floating-message hidden">
    <p>File downloaded successfully!</p>
</div>

<div id="errorMessage" class="floating-message hidden">
    <p>Failed to download the file.</p>
</div>


                </div>
            </div>
        </div>
    </div>

<!-- modal form for adding a product -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <!-- modal header -->
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- modal body with form -->
            <div class="modal-body">
                <form action="includes/add_product.inc.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-select" id="type" name="type" required>
                            <?php foreach ($types as $type) { ?>
                                <option value="<?php echo htmlspecialchars($type); ?>"><?php echo htmlspecialchars($type); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" class="form-control" id="price" name="price" required>
                    </div>
                    <div class="mb-3">
                        <label for="size" class="form-label">Size</label>
                        <select class="form-select" id="size" name="size" required>
                            <?php foreach ($sizes as $size) { ?>
                                <option value="<?php echo htmlspecialchars($size); ?>"><?php echo htmlspecialchars($size); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="color" class="form-label">Color</label>
                        <input type="text" class="form-control" id="color" name="color" required>
                    </div>
                    <div class="mb-3">
                        <label for="thickness" class="form-label">Thickness</label>
                        <select class="form-select" id="thickness" name="thickness" required>
                            <?php foreach ($thicknesses as $thickness) { ?>
                                <option value="<?php echo htmlspecialchars($thickness); ?>"><?php echo htmlspecialchars($thickness); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="warranty" class="form-label">Warranty</label>
                        <select class="form-select" id="warranty" name="warranty" required>
                            <?php foreach ($warranties as $warranty) { ?>
                                <option value="<?php echo htmlspecialchars($warranty); ?>"><?php echo htmlspecialchars($warranty); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="thumbnail" class="form-label">Thumbnail</label>
                        <input type="file" class="form-control" id="thumbnail" name="thumbnail">
                    </div>
                    <div class="mb-3">
                        <label for="currency" class="form-label">Currency</label>
                        <select class="form-select" id="currency" name="currency" required>
                            <?php foreach ($currencies as $currency) { ?>
                                <option value="<?php echo htmlspecialchars($currency); ?>"><?php echo htmlspecialchars($currency); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" required>
                    </div>
                    <div class="row mb-3">
            <div class="col">
                <label for="itemID" class="form-label">Item ID</label>
                <input type="text" class="form-control" id="itemID" name="itemID" required>
            </div>
        </div>
                    <!-- submit button -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn text-white" style="background-color: #000066;">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


   <!-- modal form for product details -->
<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <!-- modal header -->
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Product Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- modal body with form inputs -->
            <div class="modal-body">
                <form action="includes/edit_product.inc.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="productID" id="productID">
                    <input type="hidden" name="existingThumbnail" id="existingThumbnail">
                    <!-- form inputs -->
                    <div class="row mb-3">
                        <div class="col">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="col">
                            <label for="type" class="form-label">Type</label>
                            <select class="form-select" id="type" name="type" required>
                                <?php foreach ($types as $type) { ?>
                                    <option value="<?php echo htmlspecialchars($type); ?>"><?php echo htmlspecialchars($type); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="price" class="form-label">Price</label>
                            <input type="text" class="form-control" id="price" name="price" required>
                        </div>
                        <div class="col">
                            <label for="size" class="form-label">Size</label>
                            <select class="form-select" id="size" name="size" required>
                                <?php foreach ($sizes as $size) { ?>
                                    <option value="<?php echo htmlspecialchars($size); ?>"><?php echo htmlspecialchars($size); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="color" class="form-label">Color</label>
                            <input type="text" class="form-control" id="color" name="color" required>
                        </div>
                        <div class="col">
                            <label for="thickness" class="form-label">Thickness</label>
                            <select class="form-select" id="thickness" name="thickness" required>
                                <?php foreach ($thicknesses as $thickness) { ?>
                                    <option value="<?php echo htmlspecialchars($thickness); ?>"><?php echo htmlspecialchars($thickness); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="warranty" class="form-label">Warranty</label>
                            <select class="form-select" id="warranty" name="warranty" required>
                                <?php foreach ($warranties as $warranty) { ?>
                                    <option value="<?php echo htmlspecialchars($warranty); ?>"><?php echo htmlspecialchars($warranty); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col">
                            <label for="thumbnail" class="form-label">Thumbnail</label>
                            <input type="file" class="form-control" id="thumbnail" name="thumbnail">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="currency" class="form-label">Currency</label>
                            <select class="form-select" id="currency" name="currency" required>
                                <?php foreach ($currencies as $currency) { ?>
                                    <option value="<?php echo htmlspecialchars($currency); ?>"><?php echo htmlspecialchars($currency); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" required>
                        </div>
                    </div>
                    <!-- submit button -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn text-white" style="background-color: #000066;">Save</button>
             
                    

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
     
    <!-- scripts for modal data population -->
    <script>
    var modal = document.getElementById('modal');
    modal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var productID = button.getAttribute('data-id');
        var name = button.getAttribute('data-name');
        var type = button.getAttribute('data-type');
        var price = button.getAttribute('data-price');
        var size = button.getAttribute('data-size');
        var color = button.getAttribute('data-color');
        var thickness = button.getAttribute('data-thickness');
        var warranty = button.getAttribute('data-warranty');
        var thumbnail = button.getAttribute('data-thumbnail');
        var currency = button.getAttribute('data-currency');
        var quantity = button.getAttribute('data-quantity');
        
        var modalTitle = modal.querySelector('.modal-title');
        var productIDInput = modal.querySelector('#productID');
        var nameInput = modal.querySelector('#name');
        var typeInput = modal.querySelector('#type');
        var priceInput = modal.querySelector('#price');
        var sizeInput = modal.querySelector('#size');
        var colorInput = modal.querySelector('#color');
        var thicknessInput = modal.querySelector('#thickness');
        var warrantyInput = modal.querySelector('#warranty');
        var thumbnailInput = modal.querySelector('#thumbnail');
        var currencyInput = modal.querySelector('#currency');
        var quantityInput = modal.querySelector('#quantity');
        var existingThumbnailInput = modal.querySelector('#existingThumbnail');

        if (productID) {
            modalTitle.textContent = 'Update Product';
            productIDInput.value = productID;
            nameInput.value = name;
            typeInput.value = type;
            priceInput.value = price;
            sizeInput.value = size;
            colorInput.value = color;
            thicknessInput.value = thickness;
            warrantyInput.value = warranty;
            existingThumbnailInput.value = thumbnail;
            currencyInput.value = currency;
            quantityInput.value = quantity;
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    var form = document.querySelector('#addProductModal form');
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        var formData = new FormData(form);
        
        fetch('includes/add_product.inc.php', {
            method: 'POST',
            body: formData
        }).then(response => response.text())
          .then(data => {
              console.log(data); // Log the response from the server
              if (data.includes('success')) {
                  alert('Product added successfully!');
                  $('#addProductModal').modal('hide');
                  location.reload(); // Reload the page or update UI as needed
              } else {
                  alert('Error adding product');
              }
          })
          .catch(error => {
              console.error('Error:', error);
          });
    });
});

</script>

<script>
        // Modal handling script
        var modal = document.getElementById('modal');
        modal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var productID = button.getAttribute('data-id');
            var name = button.getAttribute('data-name');
            var type = button.getAttribute('data-type');
            var price = button.getAttribute('data-price');
            var size = button.getAttribute('data-size');
            var color = button.getAttribute('data-color');
            var thickness = button.getAttribute('data-thickness');
            var warranty = button.getAttribute('data-warranty');
            var thumbnail = button.getAttribute('data-thumbnail');
            var currency = button.getAttribute('data-currency');
            var quantity = button.getAttribute('data-quantity');
            
            var modalTitle = modal.querySelector('.modal-title');
            var productIDInput = modal.querySelector('#productID');
            var nameInput = modal.querySelector('#name');
            var typeInput = modal.querySelector('#type');
            var priceInput = modal.querySelector('#price');
            var sizeInput = modal.querySelector('#size');
            var colorInput = modal.querySelector('#color');
            var thicknessInput = modal.querySelector('#thickness');
            var warrantyInput = modal.querySelector('#warranty');
            var existingThumbnailInput = modal.querySelector('#existingThumbnail');
            var currencyInput = modal.querySelector('#currency');
            var quantityInput = modal.querySelector('#quantity');

            if (productID) {
                modalTitle.textContent = 'Update Product';
                productIDInput.value = productID;
                nameInput.value = name;
                typeInput.value = type;
                priceInput.value = price;
                sizeInput.value = size;
                colorInput.value = color;
                thicknessInput.value = thickness;
                warrantyInput.value = warranty;
                existingThumbnailInput.value = thumbnail;
                currencyInput.value = currency;
                quantityInput.value = quantity;
            }
        });

        // Floating messages
        document.querySelector('.btn-download').addEventListener('click', function() {
            document.getElementById('downloadPrompt').classList.add('show');
        });

        document.getElementById('confirmDownload').addEventListener('click', function() {
            // Trigger download and show success message
            document.getElementById('downloadPrompt').classList.remove('show');
            document.getElementById('successMessage').classList.add('show');
        });

        document.getElementById('cancelDownload').addEventListener('click', function() {
            document.getElementById('downloadPrompt').classList.remove('show');
        });

        // Form submission via fetch API
        document.addEventListener('DOMContentLoaded', function() {
            var form = document.querySelector('#addProductModal form');
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                var formData = new FormData(form);
                
                fetch('includes/add_product.inc.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(result => {
                    // Handle success, e.g., show a success message or update the table
                    console.log(result);
                })
                .catch(error => {
                    // Handle error
                    console.error('Error:', error);
                });
            });
        });
    </script>


    <!-- script for delete confirmation -->
    <script>
        function confirmDelete(productID) {
            if (confirm("Are you sure you want to delete this product?")) {
                window.location.href = 'includes/delete_product.inc.php?productID=' + productID;
            }
        }
    </script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybVu2z2iE95RIM3h7zxcg/eek1XpVfGkK8H1mWkFmBp4vmVor" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93q9Bcez5l6l2OYhhVC/p7JBop69G5jgyKtX5bEIvT6i8eN8K13nP9p7C7E6DH" crossorigin="anonymous"></script>
</body>
</html>
>>>>>>> 2ca820e6270aed379519dc69bfb6c06aaec24b64
