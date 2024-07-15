<?php
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
                            <h3>logo here</h3>
                        </div>
                        <!-- search form -->
                        <div class="d-flex justify-content-lg-end justify-content-md-end justify-content-center collapse navbar-collapse" id="navbarSupportedContent">
                            <form method="POST" action="" class="d-flex">
                                <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search" style="border-radius: 25px;">
                                <button class="bg-transparent border-0" type="submit" name="btnSearch"><i class="bi bi-search"></i></button>
                            </form>
                        </div>
                    </div>
                </nav>
                
                <!-- table label -->
                <div class="row p-lg-5 p-3 text-lg-start text-center m-0">
                    <h1 class="col-lg-6 col-md-12">Item List</h1>
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
                            
                                    // query to search data from search form
                                    $query = "SELECT * FROM tblproducts
                                        WHERE productID LIKE '$search%'
                                        OR name LIKE '$search%'
                                        OR type LIKE '$search%'
                                        OR price LIKE '$search%'
                                        OR size LIKE '$search%'
                                        OR color LIKE '$search%'
                                        OR thickness LIKE '$search%'
                                        OR warranty LIKE '$search%'
                                        OR thumbnail LIKE '$search%'
                                        OR currency LIKE '$search%';";
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
                                        <a href="edit_product.php?editProductID=<?php echo $row['productID'];?>" name="btnEdit" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                        <!-- delete button -->
                                        <a href="includes/delete_product.inc.php?productID=<?php echo $row['productID'];?>" class="btn btn-danger"><i class="bi bi-trash3"></i></a>
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
                                        <a href="edit_product.php?editProductID=<?php echo $row['productID'];?>" name="btnEdit" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                        <!-- delete button -->
                                        <a href="includes/delete_product.inc.php?productID=<?php echo $row['productID'];?>" class="btn btn-danger"><i class="bi bi-trash3"></i></a>
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
                <div class="text-end py-5 pe-5">                    
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
                                                    <input type="text" class="form-control" name="size" id="size"  placeholder="" required>
                                                    <label for="date" class="form-label">Size<i class="text-danger">*</i></label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" name="color" id="color"  placeholder="" required>
                                                    <label for="date" class="form-label">Color<i class="text-danger">*</i></label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" name="thickness" id="thickness"  placeholder="" required>
                                                    <label for="date" class="form-label">Thickness<i class="text-danger">*</i></label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" name="warranty" id="warranty"  placeholder="" required>
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
                                                    <input type="text" class="form-control" name="currency" id="currency"  placeholder="" required>
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
            </div>
            
        </div>
    </div> 
</body>
</html>