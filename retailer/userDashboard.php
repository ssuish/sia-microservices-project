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
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.1/css/bootstrap.min.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.1/js/bootstrap.min.js"></script>
</head>

<body>
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
        <a class="navbar-brand mt-2 mt-lg-0" href="userDashboard.php">
          <img src="./img/logo.png" height="70" alt="MDB Logo" loading="lazy" />
        </a>
        <!-- Left links -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="./userDashboard.php?type=mattresses">Mattresses</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./userDashboard.php?type=pillows">Pillows</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./userDashboard.php?type=accessories">Accessories</a>
          </li>
        </ul>
        <!-- Left links -->
      </div>
      <!-- Collapsible wrapper -->
      <!-- Search Form -->
      <div class="my-4">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
          <div class="input-group">
            <input type="text" class="form-control" name="search" placeholder="Search for products" />
            <button type="submit" class="btn btn-primary">Search</button>
          </div>
        </form>
      </div>

      <!-- Right elements -->
      <div class="d-flex align-items-center">
        <!-- Search Collapsable -->
        <a class="text-reset me-3" data-mdb-collapse-init data-mdb-ripple-init href="#collapseSearch" role="button" aria-expanded="false" aria-controls="collapseSearch">
          &nbsp;
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
            <img src="./img/avatar.jpg" class="rounded-circle" height="25" alt="User Avatar" loading="lazy" />
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
            <li>
              <a class="dropdown-item" href="logout.php">Logout</a>
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
            <input id="search-input" type="search" id="form1" class="form-control" name="search" />
            <label class="form-label" for="form1">Search Items</label>
          </div>
          <button id="search-button" type="submit" class="btn btn-primary" name="search">
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
            <h4 class="mb-3">Welcome</h4>
            <a data-mdb-ripple-init class="btn btn-outline-light btn-lg" href="logout.php" role="button">Logout</a>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Categorized products table -->
  <section>
    <h1 class="display-4 mx-5">Products</h1>

    <?php
    require "includes/db.inc.php";
    $type = isset($_GET['type']) ? $_GET['type'] : null;
    $search = isset($_GET['search']) ? $_GET['search'] : null;

    if ($type) {
      $query = "SELECT * FROM `tblproducts` WHERE `type` = ? ORDER BY `name` DESC";
      $stmt = mysqli_prepare($conn, $query);
      mysqli_stmt_bind_param($stmt, "s", $type);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
    } else if ($search) {
      $query = "SELECT * FROM `tblproducts` WHERE `name` LIKE CONCAT('%', ?, '%') ORDER BY `name` DESC";
      $stmt = mysqli_prepare($conn, $query);
      mysqli_stmt_bind_param($stmt, "s", $search);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
    } else {
      $query = "SELECT * FROM `tblproducts` ORDER BY `name` DESC";
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
            $name = $row['name'];
            $size = $row['size'];
            $price = $row['price'];
            $currency = $row['currency'];
            $type = $row['type'];
            $thickness = $row['thickness'];
            $color = $row['color'];
            $warranty = $row['warranty'];
            $thumbnail = $row['thumbnail'];

            // Placeholder images based on the product type
            switch ($type) {
              case 'mattresses':
                $imageUrl = 'img/mattress.jpg';
                break;
              case 'pillows':
                $imageUrl = 'https://example.com/pillow.jpg';
                break;
              case 'accessories':
                $imageUrl = 'https://example.com/accessory.jpg';
                break;
              default:
                $imageUrl = 'https://example.com/default.jpg';
                break;
            }
        ?>
        <!-- Product Card -->
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="card">
            <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light" data-mdb-ripple-color="light">
              <img src="img/mattress.jpg"class="w-100" />
              <a href="#" data-bs-toggle="modal" data-bs-target="#productModal" data-item="<?php echo htmlspecialchars(json_encode($row)); ?>">
                <div class="mask">
                  <div class="d-flex justify-content-start align-items-end h-100">
                    <h5><span class="badge bg-dark ms-2">NEW</span></h5>
                  </div>
                </div>
              </a>
            </div>
            <div class="card-body">
              <h5 class="card-title mb-2"><?php echo htmlspecialchars($name); ?></h5>
              <p>Size: <?php echo htmlspecialchars($size); ?></p>
              <h6 class="mb-3 price"><?php echo htmlspecialchars($currency . " " . $price); ?></h6>
              <a class="btn btn-primary" href="#">Buy Now!</a>
              <a class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#productModal" data-item="<?php echo htmlspecialchars(json_encode($row)); ?>">Add to Cart</a>
            </div>
          </div>
        </div>
        <?php
          }
        } else {
          echo "<p>No products found.</p>";
        }
        mysqli_close($conn);
        ?>
      </div>
    </div>
  </section>
  <!-- Modal for product details -->
  <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="productModalLabel">Product Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Modal content will be dynamically inserted here -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Add to Cart</button>
        </div>
      </div>
    </div>
  </div>

  <!-- MDB -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Custom scripts -->
  <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
      var productModal = document.getElementById('productModal');
      productModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // Button that triggered the modal
        var itemData = button.getAttribute('data-item'); // Extract info from data-* attributes

        var item = JSON.parse(itemData);

        var modalTitle = productModal.querySelector('.modal-title');
        var modalBody = productModal.querySelector('.modal-body');

        // Populate the modal with product details
        modalTitle.textContent = item.name;
        modalBody.innerHTML = `
          <ul class="list-group list-group-light">
            <li class="list-group-item d-flex justify-content-between align-items-start">
              <div class="fw-bold">Type</div>
              <div class="text-muted">${item.type}</div>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
              <div class="fw-bold">Size</div>
              <div class="text-muted">${item.size}</div>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
              <div class="fw-bold">Thickness</div>
              <div class="text-muted">${item.thickness}</div>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
              <div class="fw-bold">Color</div>
              <div class="text-muted">${item.color}</div>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
              <div class="fw-bold">Price</div>
              <div class="text-muted">${item.currency} ${item.price}</div>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
              <div class="fw-bold">Warranty</div>
              <div class="text-muted">${item.warranty}</div>
            </li>
          </ul>
        `;
      });
    });
  </script>
</body>

</html>
