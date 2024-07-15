<<<<<<< HEAD
<<<<<<< HEAD
<?php
require "includes/db.inc.php";
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit();
}

// Fetch data for filters and dropdowns
$tables = [
    'sizes' => 'MattressProductSize',
    'types' => 'ProductsType',
    'thicknesses' => 'Thickness',
    'warranties' => 'Warranty',
    'currencies' => 'Currency'
];

$data = [];
foreach ($tables as $key => $table) {
    $query = "SELECT * FROM `$table`";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $data[$key] = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        $data[$key] = [];
    }
}

$productTypes = array_unique(array_column($data['types'], 'Type'));
$sizes = array_column($data['sizes'], 'Size');
$thicknesses = array_column($data['thicknesses'], 'Thickness');
$warranties = array_column($data['warranties'], 'Warranty');
$currencies = array_column($data['currencies'], 'Currency');

if (isset($_POST['btnDownload'])) {
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="products_data.csv"');

    $output = fopen('php://output', 'w');
    fputcsv($output, ['Item ID', 'Name', 'Type', 'Price', 'Size', 'Color', 'Thickness', 'Warranty', 'Thumbnail', 'Currency', 'Quantity']);

    $query = "SELECT * FROM tblproducts";
    if (isset($_POST['search'])) {
        $search = mysqli_real_escape_string($conn, $_POST['search']);
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

    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($output, $row);
    }
    fclose($output);
    exit();
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

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="src/cssheaders/admindash-header.css">
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

        function toggleFloatingMessages() {
            document.getElementById('downloadSuccess').classList.toggle('d-none');
        }
    </script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col position-relative px-0 min-vh-70">
                <nav class="navbar navbar-expand-lg navbar-light bg-transparent border border-bottom">
                    <div class="container-fluid">
                        <div>
                            <img src="../img/orotex.png" class="rounded-circle" height="60" alt="User Avatar" />
                        </div>
                        <div class="d-flex justify-content-lg-end justify-content-md-end justify-content-center collapse navbar-collapse">
                            <a href="includes/logout.php" class="text-secondary pe-2">Logout</a>
                        </div>
                    </div>
                </nav>
                <div class="row p-lg-5 p-3 text-lg-start text-center m-0">
                    <div class="col-lg-6 col-md-12">
                        <h1>Item List</h1>
                    </div>
                    <div class="col-lg-6">
                    <div class="container">
    <div class="row justify-content-end align-items-center">
        <div class="col-auto">
            <form method="POST" action="" class="d-flex align-items-center">
                <input class="form-control me-2 search-input" name="search" type="search" placeholder="Search" style="border-radius: 25px;">
                <button class="search-btn" type="submit" name="btnSearch"><i class="bi bi-search"></i></button>
            </form>
        </div>
        <div class="col-auto">
            <select id="productType" class="form-select" onchange="sortTableByType()">
                <option value="">All Types</option>
                <?php foreach ($productTypes as $productType) { ?>
                    <option value="<?php echo htmlspecialchars($productType); ?>" <?php echo (isset($_GET['type']) && $_GET['type'] == $productType) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($productType); ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="col-auto">
        <form method="POST" action="" class="ms-3">
                                <button type="submit" name="btnDownload" class="btn btn-primary">Download Data</button>
                            </form>
                            <button type="button" class="btn btn-success ms-3" data-bs-toggle="modal" data-bs-target="#addProductModal">
                                <i class="bi bi-plus-circle"></i> Add Product
                            </button>
        </div>
    </div>
</div>
                            
                        </div>
                    </div>
                </div>
                <div id="downloadSuccess" class="alert alert-success d-none" role="alert">
                    Data downloaded successfully!
                </div>
                <div class="table-responsive px-5 pb-5">
                    <table class="table table-hover text-nowrap">
                        <thead class="text-white" style="background-color: #000066;">
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
                                    $search = mysqli_real_escape_string($conn, $_POST['search']);
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
                                    <td><?php echo htmlspecialchars($row["productID"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["name"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["type"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["price"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["size"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["color"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["thickness"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["warranty"]); ?></td>
                                    <td><img src="<?php echo htmlspecialchars($row["thumbnail"]); ?>" alt="Thumbnail" class="img-thumbnail" width="100"></td>
                                    <td><?php echo htmlspecialchars($row["currency"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["quantity"]); ?></td>
                                    <td>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#editProductModal" 
                                            data-id="<?php echo htmlspecialchars($row['productID']); ?>" 
                                            data-name="<?php echo htmlspecialchars($row['name']); ?>" 
                                            data-type="<?php echo htmlspecialchars($row['type']); ?>"
                                            data-price="<?php echo htmlspecialchars($row['price']); ?>"
                                            data-size="<?php echo htmlspecialchars($row['size']); ?>"
                                            data-color="<?php echo htmlspecialchars($row['color']); ?>"
                                            data-thickness="<?php echo htmlspecialchars($row['thickness']); ?>"
                                            data-warranty="<?php echo htmlspecialchars($row['warranty']); ?>"
                                            data-thumbnail="<?php echo htmlspecialchars($row['thumbnail']); ?>"
                                            data-currency="<?php echo htmlspecialchars($row['currency']); ?>"
                                            data-quantity="<?php echo htmlspecialchars($row['quantity']); ?>">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a href="#" onclick="confirmDelete(<?php echo htmlspecialchars($row['productID']); ?>)">
                                            <i class="bi bi-trash3"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                                    }
                                } else {
                                    echo '<tr><td colspan="12" class="text-center">No records found.</td></tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Product Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addProductForm" method="POST" action="includes/add_product.inc.php" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="productName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="productName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="productType" class="form-label">Type</label>
                            <select id="productType" name="type" class="form-select" required>
                                <?php foreach ($productTypes as $type) { ?>
                                    <option value="<?php echo htmlspecialchars($type); ?>"><?php echo htmlspecialchars($type); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="productPrice" class="form-label">Price</label>
                            <input type="number" step="0.01" class="form-control" id="productPrice" name="price" required>
                        </div>
                        <div class="mb-3">
                            <label for="productSize" class="form-label">Size</label>
                            <select id="productSize" name="size" class="form-select" required>
                                <?php foreach ($sizes as $size) { ?>
                                    <option value="<?php echo htmlspecialchars($size); ?>"><?php echo htmlspecialchars($size); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="productColor" class="form-label">Color</label>
                            <input type="text" class="form-control" id="productColor" name="color" required>
                        </div>
                        <div class="mb-3">
                            <label for="productThickness" class="form-label">Thickness</label>
                            <select id="productThickness" name="thickness" class="form-select" required>
    <?php foreach ($thicknesses as $thickness) { ?>
        <option value="<?php echo htmlspecialchars($thickness); ?>"><?php echo htmlspecialchars($thickness); ?></option>
    <?php } ?>
</select>

                        </div>
                        <div class="mb-3">
                            <label for="productWarranty" class="form-label">Warranty</label>
                            <select id="productWarranty" name="warranty" class="form-select" required>
                                <?php foreach ($warranties as $warranty) { ?>
                                    <option value="<?php echo htmlspecialchars($warranty); ?>"><?php echo htmlspecialchars($warranty); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="productThumbnail" class="form-label">Thumbnail URL</label>
                            <input type="text" class="form-control" id="productThumbnail" name="thumbnail">
                            <button type="button" class="btn btn-info mt-2" data-bs-toggle="modal" data-bs-target="#imageSearchModal">Search Images</button>
                        </div>
                        <div class="mb-3">
                            <label for="productCurrency" class="form-label">Currency</label>
                            <select id="productCurrency" name="currency" class="form-select" required>
                                <?php foreach ($currencies as $currency) { ?>
                                    <option value="<?php echo htmlspecialchars($currency); ?>"><?php echo htmlspecialchars($currency); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="productQuantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="productQuantity" name="quantity" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Product Modal -->
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editProductForm" method="POST" action="includes/edit_product.inc.php" enctype="multipart/form-data">
                        <!-- Fields for editing products -->
                        <input type="hidden" id="editProductID" name="productID">
                        <div class="mb-3">
                            <label for="editProductName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="editProductName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editProductType" class="form-label">Type</label>
                            <select id="editProductType" name="type" class="form-select" required>
                                <?php foreach ($productTypes as $type) { ?>
                                    <option value="<?php echo htmlspecialchars($type); ?>"><?php echo htmlspecialchars($type); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editProductPrice" class="form-label">Price</label>
                            <input type="number" step="0.01" class="form-control" id="editProductPrice" name="price" required>
                        </div>
                        <div class="mb-3">
                            <label for="editProductSize" class="form-label">Size</label>
                            <select id="editProductSize" name="size" class="form-select" required>
                                <?php foreach ($sizes as $size) { ?>
                                    <option value="<?php echo htmlspecialchars($size); ?>"><?php echo htmlspecialchars($size); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editProductColor" class="form-label">Color</label>
                            <input type="text" class="form-control" id="editProductColor" name="color" required>
                        </div>
                        <div class="mb-3">
                            <label for="editProductThickness" class="form-label">Thickness</label>
                            <select id="editProductThickness" name="thickness" class="form-select" required>
                                <?php foreach ($thicknesses as $thickness) { ?>
                                    <option value="<?php echo htmlspecialchars($thickness); ?>"><?php echo htmlspecialchars($thickness); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editProductWarranty" class="form-label">Warranty</label>
                            <select id="editProductWarranty" name="warranty" class="form-select" required>
                                <?php foreach ($warranties as $warranty) { ?>
                                    <option value="<?php echo htmlspecialchars($warranty); ?>"><?php echo htmlspecialchars($warranty); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editProductThumbnail" class="form-label">Thumbnail URL</label>
                            <input type="text" class="form-control" id="editProductThumbnail" name="thumbnail">
                            <button type="button" class="btn btn-info mt-2" data-bs-toggle="modal" data-bs-target="#imageSearchModal">Search Images</button>
                        </div>
                        <div class="mb-3">
                            <label for="editProductCurrency" class="form-label">Currency</label>
                            <select id="editProductCurrency" name="currency" class="form-select" required>
                                <?php foreach ($currencies as $currency) { ?>
                                    <option value="<?php echo htmlspecialchars($currency); ?>"><?php echo htmlspecialchars($currency); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editProductQuantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="editProductQuantity" name="quantity" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Search Modal -->
<div class="modal fade" id="imageSearchModal" tabindex="-1" aria-labelledby="imageSearchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageSearchModalLabel">Search Images</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <div class="input-group">
                        <input type="text" class="form-control" id="imageSearchInput" placeholder="Search images..." aria-label="Search images">
                        <button class="btn btn-primary" type="button" id="imageSearchButton">Search</button>
                    </div>
                </div>
                <div id="imageResults" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

    <script>
       document.getElementById('imageSearchButton').addEventListener('click', function() {
    const query = document.getElementById('imageSearchInput').value;
    if (query) {
        fetch(`https://api.unsplash.com/search/photos?query=${query}&client_id=i98jZjuxBkmDZqVBJus0LF2yOKklAKwlS7O6Oz84qyk`)
            .then(response => response.json())
            .then(data => {
                const resultsContainer = document.getElementById('imageResults');
                resultsContainer.innerHTML = '';
                data.results.forEach(image => {
                    const imgElement = document.createElement('img');
                    imgElement.src = image.urls.small;
                    imgElement.alt = image.alt_description;
                    imgElement.classList.add('img-thumbnail');
                    imgElement.style.cursor = 'pointer';
                    imgElement.addEventListener('click', function() {
                        const thumbnailInput = document.getElementById('productThumbnail');
                        thumbnailInput.value = image.urls.small;
                        const editThumbnailInput = document.getElementById('editProductThumbnail');
                        if (editThumbnailInput) {
                            editThumbnailInput.value = image.urls.small;
                        }

                        // Close the image search modal
                        const imageSearchModal = bootstrap.Modal.getInstance(document.getElementById('imageSearchModal'));
                        imageSearchModal.hide();

                        // Reopen the Add or Edit Product modal
                        const addProductModal = bootstrap.Modal.getInstance(document.getElementById('addProductModal'));
                        if (addProductModal) {
                            addProductModal.show();
                        } else {
                            const editProductModal = bootstrap.Modal.getInstance(document.getElementById('editProductModal'));
                            if (editProductModal) {
                                editProductModal.show();
                            }
                        }
                    });
                    resultsContainer.appendChild(imgElement);
                });
            })
            .catch(error => console.error('Error fetching images:', error));
    }
});

    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>


=======
<?php
require "includes/db.inc.php";
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit();
}

// Fetch data for filters and dropdowns
$tables = [
    'sizes' => 'MattressProductSize',
    'types' => 'ProductsType',
    'thicknesses' => 'Thickness',
    'warranties' => 'Warranty',
    'currencies' => 'Currency'
];

$data = [];
foreach ($tables as $key => $table) {
    $query = "SELECT * FROM `$table`";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $data[$key] = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        $data[$key] = [];
    }
}

$productTypes = array_unique(array_column($data['types'], 'Type'));
$sizes = array_column($data['sizes'], 'Size');
$thicknesses = array_column($data['thicknesses'], 'Thickness');
$warranties = array_column($data['warranties'], 'Warranty');
$currencies = array_column($data['currencies'], 'Currency');

if (isset($_POST['btnDownload'])) {
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="products_data.csv"');

    $output = fopen('php://output', 'w');
    fputcsv($output, ['Item ID', 'Name', 'Type', 'Price', 'Size', 'Color', 'Thickness', 'Warranty', 'Thumbnail', 'Currency', 'Quantity']);

    $query = "SELECT * FROM tblproducts";
    if (isset($_POST['search'])) {
        $search = mysqli_real_escape_string($conn, $_POST['search']);
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

    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($output, $row);
    }
    fclose($output);
    exit();
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

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="src/cssheaders/admindash-header.css">
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

        function toggleFloatingMessages() {
            document.getElementById('downloadSuccess').classList.toggle('d-none');
        }
    </script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col position-relative px-0 min-vh-70">
                <nav class="navbar navbar-expand-lg navbar-light bg-transparent border border-bottom">
                    <div class="container-fluid">
                        <div>
                            <img src="../img/orotex.png" class="rounded-circle" height="60" alt="User Avatar" />
                        </div>
                        <div class="d-flex justify-content-lg-end justify-content-md-end justify-content-center collapse navbar-collapse">
                            <a href="includes/logout.php" class="text-secondary pe-2">Logout</a>
                        </div>
                    </div>
                </nav>
                <div class="row p-lg-5 p-3 text-lg-start text-center m-0">
                    <div class="col-lg-6 col-md-12">
                        <h1>Item List</h1>
                    </div>
                    <div class="col-lg-6">
                    <div class="container">
    <div class="row justify-content-end align-items-center">
        <div class="col-auto">
            <form method="POST" action="" class="d-flex align-items-center">
                <input class="form-control me-2 search-input" name="search" type="search" placeholder="Search" style="border-radius: 25px;">
                <button class="search-btn" type="submit" name="btnSearch"><i class="bi bi-search"></i></button>
            </form>
        </div>
        <div class="col-auto">
            <select id="productType" class="form-select" onchange="sortTableByType()">
                <option value="">All Types</option>
                <?php foreach ($productTypes as $productType) { ?>
                    <option value="<?php echo htmlspecialchars($productType); ?>" <?php echo (isset($_GET['type']) && $_GET['type'] == $productType) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($productType); ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="col-auto">
        <form method="POST" action="" class="ms-3">
                                <button type="submit" name="btnDownload" class="btn btn-primary">Download Data</button>
                            </form>
                            <button type="button" class="btn btn-success ms-3" data-bs-toggle="modal" data-bs-target="#addProductModal">
                                <i class="bi bi-plus-circle"></i> Add Product
                            </button>
        </div>
    </div>
</div>
                            
                        </div>
                    </div>
                </div>
                <div id="downloadSuccess" class="alert alert-success d-none" role="alert">
                    Data downloaded successfully!
                </div>
                <div class="table-responsive px-5 pb-5">
                    <table class="table table-hover text-nowrap">
                        <thead class="text-white" style="background-color: #000066;">
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
                                    $search = mysqli_real_escape_string($conn, $_POST['search']);
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
                                    <td><?php echo htmlspecialchars($row["productID"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["name"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["type"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["price"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["size"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["color"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["thickness"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["warranty"]); ?></td>
                                    <td><img src="<?php echo htmlspecialchars($row["thumbnail"]); ?>" alt="Thumbnail" class="img-thumbnail" width="100"></td>
                                    <td><?php echo htmlspecialchars($row["currency"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["quantity"]); ?></td>
                                    <td>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#editProductModal" 
                                            data-id="<?php echo htmlspecialchars($row['productID']); ?>" 
                                            data-name="<?php echo htmlspecialchars($row['name']); ?>" 
                                            data-type="<?php echo htmlspecialchars($row['type']); ?>"
                                            data-price="<?php echo htmlspecialchars($row['price']); ?>"
                                            data-size="<?php echo htmlspecialchars($row['size']); ?>"
                                            data-color="<?php echo htmlspecialchars($row['color']); ?>"
                                            data-thickness="<?php echo htmlspecialchars($row['thickness']); ?>"
                                            data-warranty="<?php echo htmlspecialchars($row['warranty']); ?>"
                                            data-thumbnail="<?php echo htmlspecialchars($row['thumbnail']); ?>"
                                            data-currency="<?php echo htmlspecialchars($row['currency']); ?>"
                                            data-quantity="<?php echo htmlspecialchars($row['quantity']); ?>">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a href="#" onclick="confirmDelete(<?php echo htmlspecialchars($row['productID']); ?>)">
                                            <i class="bi bi-trash3"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                                    }
                                } else {
                                    echo '<tr><td colspan="12" class="text-center">No records found.</td></tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Product Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addProductForm" method="POST" action="includes/add_product.inc.php" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="productName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="productName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="productType" class="form-label">Type</label>
                            <select id="productType" name="type" class="form-select" required>
                                <?php foreach ($productTypes as $type) { ?>
                                    <option value="<?php echo htmlspecialchars($type); ?>"><?php echo htmlspecialchars($type); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="productPrice" class="form-label">Price</label>
                            <input type="number" step="0.01" class="form-control" id="productPrice" name="price" required>
                        </div>
                        <div class="mb-3">
                            <label for="productSize" class="form-label">Size</label>
                            <select id="productSize" name="size" class="form-select" required>
                                <?php foreach ($sizes as $size) { ?>
                                    <option value="<?php echo htmlspecialchars($size); ?>"><?php echo htmlspecialchars($size); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="productColor" class="form-label">Color</label>
                            <input type="text" class="form-control" id="productColor" name="color" required>
                        </div>
                        <div class="mb-3">
                            <label for="productThickness" class="form-label">Thickness</label>
                            <select id="productThickness" name="thickness" class="form-select" required>
    <?php foreach ($thicknesses as $thickness) { ?>
        <option value="<?php echo htmlspecialchars($thickness); ?>"><?php echo htmlspecialchars($thickness); ?></option>
    <?php } ?>
</select>

                        </div>
                        <div class="mb-3">
                            <label for="productWarranty" class="form-label">Warranty</label>
                            <select id="productWarranty" name="warranty" class="form-select" required>
                                <?php foreach ($warranties as $warranty) { ?>
                                    <option value="<?php echo htmlspecialchars($warranty); ?>"><?php echo htmlspecialchars($warranty); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="productThumbnail" class="form-label">Thumbnail URL</label>
                            <input type="text" class="form-control" id="productThumbnail" name="thumbnail">
                            <button type="button" class="btn btn-info mt-2" data-bs-toggle="modal" data-bs-target="#imageSearchModal">Search Images</button>
                        </div>
                        <div class="mb-3">
                            <label for="productCurrency" class="form-label">Currency</label>
                            <select id="productCurrency" name="currency" class="form-select" required>
                                <?php foreach ($currencies as $currency) { ?>
                                    <option value="<?php echo htmlspecialchars($currency); ?>"><?php echo htmlspecialchars($currency); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="productQuantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="productQuantity" name="quantity" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Product Modal -->
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editProductForm" method="POST" action="includes/edit_product.inc.php" enctype="multipart/form-data">
                        <!-- Fields for editing products -->
                        <input type="hidden" id="editProductID" name="productID">
                        <div class="mb-3">
                            <label for="editProductName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="editProductName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editProductType" class="form-label">Type</label>
                            <select id="editProductType" name="type" class="form-select" required>
                                <?php foreach ($productTypes as $type) { ?>
                                    <option value="<?php echo htmlspecialchars($type); ?>"><?php echo htmlspecialchars($type); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editProductPrice" class="form-label">Price</label>
                            <input type="number" step="0.01" class="form-control" id="editProductPrice" name="price" required>
                        </div>
                        <div class="mb-3">
                            <label for="editProductSize" class="form-label">Size</label>
                            <select id="editProductSize" name="size" class="form-select" required>
                                <?php foreach ($sizes as $size) { ?>
                                    <option value="<?php echo htmlspecialchars($size); ?>"><?php echo htmlspecialchars($size); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editProductColor" class="form-label">Color</label>
                            <input type="text" class="form-control" id="editProductColor" name="color" required>
                        </div>
                        <div class="mb-3">
                            <label for="editProductThickness" class="form-label">Thickness</label>
                            <select id="editProductThickness" name="thickness" class="form-select" required>
                                <?php foreach ($thicknesses as $thickness) { ?>
                                    <option value="<?php echo htmlspecialchars($thickness); ?>"><?php echo htmlspecialchars($thickness); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editProductWarranty" class="form-label">Warranty</label>
                            <select id="editProductWarranty" name="warranty" class="form-select" required>
                                <?php foreach ($warranties as $warranty) { ?>
                                    <option value="<?php echo htmlspecialchars($warranty); ?>"><?php echo htmlspecialchars($warranty); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editProductThumbnail" class="form-label">Thumbnail URL</label>
                            <input type="text" class="form-control" id="editProductThumbnail" name="thumbnail">
                            <button type="button" class="btn btn-info mt-2" data-bs-toggle="modal" data-bs-target="#imageSearchModal">Search Images</button>
                        </div>
                        <div class="mb-3">
                            <label for="editProductCurrency" class="form-label">Currency</label>
                            <select id="editProductCurrency" name="currency" class="form-select" required>
                                <?php foreach ($currencies as $currency) { ?>
                                    <option value="<?php echo htmlspecialchars($currency); ?>"><?php echo htmlspecialchars($currency); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editProductQuantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="editProductQuantity" name="quantity" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Search Modal -->
<div class="modal fade" id="imageSearchModal" tabindex="-1" aria-labelledby="imageSearchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageSearchModalLabel">Search Images</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <div class="input-group">
                        <input type="text" class="form-control" id="imageSearchInput" placeholder="Search images..." aria-label="Search images">
                        <button class="btn btn-primary" type="button" id="imageSearchButton">Search</button>
                    </div>
                </div>
                <div id="imageResults" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

    <script>
       document.getElementById('imageSearchButton').addEventListener('click', function() {
    const query = document.getElementById('imageSearchInput').value;
    if (query) {
        fetch(`https://api.unsplash.com/search/photos?query=${query}&client_id=i98jZjuxBkmDZqVBJus0LF2yOKklAKwlS7O6Oz84qyk`)
            .then(response => response.json())
            .then(data => {
                const resultsContainer = document.getElementById('imageResults');
                resultsContainer.innerHTML = '';
                data.results.forEach(image => {
                    const imgElement = document.createElement('img');
                    imgElement.src = image.urls.small;
                    imgElement.alt = image.alt_description;
                    imgElement.classList.add('img-thumbnail');
                    imgElement.style.cursor = 'pointer';
                    imgElement.addEventListener('click', function() {
                        const thumbnailInput = document.getElementById('productThumbnail');
                        thumbnailInput.value = image.urls.small;
                        const editThumbnailInput = document.getElementById('editProductThumbnail');
                        if (editThumbnailInput) {
                            editThumbnailInput.value = image.urls.small;
                        }

                        // Close the image search modal
                        const imageSearchModal = bootstrap.Modal.getInstance(document.getElementById('imageSearchModal'));
                        imageSearchModal.hide();

                        // Reopen the Add or Edit Product modal
                        const addProductModal = bootstrap.Modal.getInstance(document.getElementById('addProductModal'));
                        if (addProductModal) {
                            addProductModal.show();
                        } else {
                            const editProductModal = bootstrap.Modal.getInstance(document.getElementById('editProductModal'));
                            if (editProductModal) {
                                editProductModal.show();
                            }
                        }
                    });
                    resultsContainer.appendChild(imgElement);
                });
            })
            .catch(error => console.error('Error fetching images:', error));
    }
});

    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>


>>>>>>> 5685e2c4923a7179007dd7aba65b66b17ee06366
