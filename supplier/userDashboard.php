<?php
session_start();
if (!isset($_SESSION['name']) && !isset($_SESSION['user_id'])) {
  header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Coolex - User Dashboard</title>
  <!-- Company icon -->
  <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
  <!-- MDB -->
  <link rel="stylesheet" href="css/mdb.min.css" />
</head>

<body>
  <!-- Start your project here-->
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary sticky-top d-flex flex-column">
    <!-- Container wrapper -->
    <div class="container-fluid">
      <!-- Toggle button -->
      <button data-mdb-collapse-init class="navbar-toggler" type="button" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Collapsible wrapper -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Navbar brand -->
        <a class="navbar-brand mt-2 mt-lg-0" href="#">
          <img src="./img/mdb-favicon.ico" height="15" alt="MDB Logo" loading="lazy" />
        </a>
        <!-- Left links -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="#?type=mattresses">Mattresses</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#?type=pillows">Pillows</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#?type=accessories">Accessories</a>
          </li>
        </ul>
        <!-- Left links -->
      </div>
      <!-- Collapsible wrapper -->

      <!-- Right elements -->
      <div class="d-flex align-items-center">
        <!-- Search Collapsable -->
        <a class="text-reset me-3" data-mdb-collapse-init data-mdb-ripple-init href="#collapseSearch" role="button" aria-expanded="false" aria-controls="collapseSearch">
          <i class="fas fa-magnifying-glass"></i>
        </a>

        <!-- Elements when user is login -->
        <!-- Checkout -->
        <div class="dropdown">
          <a class="text-reset me-3" href="./#" role="button">
            <i class="fas fa-shopping-cart"></i>
            <span class="badge rounded-pill badge-notification bg-danger">1</span>
          </a>
        </div>
        <!-- Avatar -->
        <div class="dropdown">
          <a data-mdb-dropdown-init class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuAvatar" role="button" aria-expanded="false">
            <img src="./img/user.jpg" class="rounded-circle" height="25" alt="Black and White Portrait of a Man" loading="lazy" />
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
            <li>
              <a class="dropdown-item" href="./logout.php">Logout</a>
            </li>
          </ul>
        </div>
      </div>
      <!-- Right elements -->
    </div>
    <!-- Container wrapper -->

    <!-- Search Collapse Content -->
    <div class="my-4 collapse col-lg-8" id="collapseSearch">
      <form action="" class="search" method="get">
        <div class="input-group">
          <div class="form-outline" data-mdb-input-init>
            <input id="search-input" type="search" id="form1" class="form-control" name="search"/>
            <label class="form-label" for="form1">Search Items</label>
          </div>
          <button id="search-button" type="button" class="btn btn-primary" name="search">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </form>
    </div>
  </nav>
  <!-- Navbar -->

  <header class="mb-5">
    <div class="p-5 text-center bg-image" style="
          background-image: url('https://mdbcdn.b-cdn.net/img/new/slides/041.webp');
          height: 400px;
        ">
      <div class="mask" style="background-color: rgba(0, 0, 0, 0.6)">
        <div class="d-flex justify-content-center align-items-center h-100">
          <div class="text-white">
            <h1 class="display-1 mb-3">Coolex</h1>
            <h4 class="mb-3">Welcome <?php echo "Welcome! " . $_SESSION['name'] ?></h4>
            <a data-mdb-ripple-init class="btn btn-outline-light btn-lg" href="#!" role="button">Call to action</a>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Categorized products table -->
  <section>
    <h1 class="display-4 mx-5">Mattresses</h1>

    <?php

    require "includes/db.inc.php";
    $user_id = $_SESSION['user_id'];
    $type = isset($_GET['type']) ? $_GET['type'] : null;
    $search = isset($_GET['search']) ? $_GET['search'] : null;

    if ($type) {
      // If $type is not null, filter the items by type
      $query = "SELECT * FROM `tblproducts` WHERE `type` = ? ORDER BY itemName DESC";
      $stmt = mysqli_prepare($conn, $query);
      mysqli_stmt_bind_param($stmt, "s", $type);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
    } else if ($search) {
      // If $search is not null, filter the items by search
      $query = "SELECT * FROM `tblproducts` WHERE `itemName` LIKE CONCAT('%', ?, '%') ORDER BY itemName DESC";
      $stmt = mysqli_prepare($conn, $query);
      mysqli_stmt_bind_param($stmt, "s", $search);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
    } else {
      // If $type is null, do not filter the items
      $query = "SELECT * FROM `tblproducts` ORDER BY itemName DESC";
      $result = mysqli_query($conn, $query);
    }

    $num_rows = mysqli_num_rows($result);

    ?>

    <p class="lead m-5">Showing <?php echo $num_rows ?> product/s</p>
    <div class="text-center mx-5">
      <div class="row">

        <?php

        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {

            $itemName = $row['itemName'];
            $size = $row['size'];
            $price = $row['price'];
            $currency = $row['currency'];
            $type = $row['type'];
            $thickness = $row['thickness'];
            $color = $row['color'];
            $warranty = $row['warranty'];

        ?>
            <!-- Product Card -->
            <div class="col-lg-3 col-md-6 mb-4">
              <div class="card">
                <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light" data-mdb-ripple-color="light">
                  <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/12.jpg" class="w-100" />
                  <a href="#">
                    <div class="mask">
                      <div class="d-flex justify-content-start align-items-end h-100">
                        <h5><span class="badge bg-dark ms-2">NEW</span></h5>
                      </div>
                    </div>
                    <div class="hover-overlay">
                      <div class="mask" style="background-color: rgba(251, 251, 251, 0.15)"></div>
                    </div>
                  </a>
                </div>
                <div class="card-body">
                  <a href="" class="text-reset">
                    <h5 class="card-title mb-2"><?php echo $itemName; ?></h5>
                  </a>
                  <a href="" class="text-reset">
                    <p>Size: <?php echo $size; ?></p>
                  </a>
                  <h6 class="mb-3 price"><?php echo $currency . " " . $price; ?></h6>

                  <a class="btn btn-primary" href="#" role="button">Buy Now!</a>
                  <a class="btn btn-secondary" data-mdb-ripple-init data-mdb-modal-init href="#exampleModalToggle1" role="button">Learn More</a>

                  <!-- First modal dialog -->
                  <div class="modal fade" id="exampleModalToggle1" aria-hidden="true" aria-labelledby="exampleModalToggleLabel1" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalToggleLabel1"><?php echo $itemName; ?></h5>
                          <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                          <!-- Modal Contents -->
                          <ul class="list-group list-group-light">
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                              <div class="d-flex align-items-center">
                                <div class="fw-bold">Type</div>
                                <div class="ms-2 text-muted"><?php echo $type ?></div>
                              </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                              <div class="d-flex align-items-center">
                                <div class="fw-bold">Size</div>
                                <div class="ms-2 text-muted"><?php echo $size ?></div>
                              </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                              <div class="d-flex align-items-center">
                                <div class="fw-bold">Thickness</div>
                                <div class="ms-2 text-muted"><?php echo $thickness ?></div>
                              </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                              <div class="d-flex align-items-center">
                                <div class="fw-bold">Color</div>
                                <div class="ms-2 text-muted"><?php echo $color ?></div>
                              </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                              <div class="d-flex align-items-center">
                                <div class="fw-bold">Price</div>
                                <div class="ms-2 text-muted"><?php echo $currency . " " . $price; ?></div>
                              </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                              <div class="d-flex align-items-center">
                                <div class="fw-bold">Warranty</div>
                                <div class="ms-2 text-muted"><?php echo $warranty ?></div>
                              </div>
                            </li>
                          </ul>

                        </div>
                        <div class="modal-footer">
                          <div class="modal-footer">
                            <a href="#"> <!-- Link to checkout page -->
                              <button type="button" class="btn btn-secondary" data-mdb-ripple-init data-mdb-dismiss="modal">Buy Now!</button></a>
                            <button class="btn btn-primary" data-mdb-ripple-init data-mdb-target="#exampleModalToggle22" data-mdb-modal-init data-mdb-dismiss="modal">
                              Add to Cart
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Second modal dialog -->
                  <div class="modal fade" id="exampleModalToggle22" aria-hidden="true" aria-labelledby="exampleModalToggleLabel22" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalToggleLabel22">Thank you for shopping!</h5>
                          <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          [Product Name] was added to your shopping cart! 🥳
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-mdb-ripple-init data-mdb-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>

            </div>

        <?php
          }
        } else {
          echo '<p class="lead m-5">No products found</p>';
        }
        ?>

  </section>

  <footer>
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2); color: #7c7a7a">
      © 2024 Copyright:
      <a class="text-white" href="#">Coolex.com.ph</a>
    </div>
  </footer>

  <!-- End your project here-->

  <!-- MDB -->
  <script type="text/javascript" src="js/mdb.umd.min.js"></script>
  <!-- Custom scripts -->
  <script type="text/javascript"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>