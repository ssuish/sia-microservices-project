<?php
session_start();
if (!isset($_SESSION['username']) && !isset($_SESSION['email'])) {
    header("Location: includes/login.php");
}
?>
<?php
    require "includes/db.inc.php";
    // $user_id = $_SESSION['user_id'];
    if (isset($_GET['editProductID'])) {
        $id = $_GET['editProductID'];

        $query = "SELECT * FROM tblproducts WHERE productID = $id";
        $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <nav class="navbar navbar-expand-lg navbar-light bg-transparent border border-bottom">
                    <div class="container-fluid">
                        <div class="d-flex justify-content-lg-end justify-content-md-end justify-content-center collapse navbar-collapse" id="navbarSupportedContent">
                            <form class="d-flex">
                                <!-- search form -->
                                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" style="border-radius: 25px;">
                                <button class="bg-transparent border-0" type="submit" name="btnSearch"><i class="bi bi-search"></i></button>
                            </form>
                        </div>
                    </div>
                </nav>
                <div class="row p-lg-5 p-3 text-lg-start text-center m-0">
                    <h1 class="col-lg-6 col-md-12 pb-4">Item Product Item <?php echo $row['productID'] ?></h1>
                    <!-- form redirects to includes/edit_product.inc.php -->
                    <form method="POST" action="includes/edit_product.inc.php">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="hidden" name="productID" id="productID" value="<?php echo $row['productID'] ?>">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="" value="<?php echo $row['name']?>" required>
                                    <label for="date" class="form-label">Name<i class="text-danger">*</i></label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="type" id="type" placeholder="" value="<?php echo $row['type']?>" required>
                                    <label for="date" class="form-label">Type<i class="text-danger">*</i></label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" name="price" id="price" placeholder="" step=".01" value="<?php echo $row['price']?>" required>
                                    <label for="date" class="form-label">Price<i class="text-danger">*</i></label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="size" id="size"  placeholder="" value="<?php echo $row['size']?>" required>
                                    <label for="date" class="form-label">Size<i class="text-danger">*</i></label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="color" id="color"  placeholder="" value="<?php echo $row['color']?>" required>
                                    <label for="date" class="form-label">Color<i class="text-danger">*</i></label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="thickness" id="thickness"  placeholder="" value="<?php echo $row['thickness']?>" required>
                                    <label for="date" class="form-label">Thickness<i class="text-danger">*</i></label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="warranty" id="warranty"  placeholder="" value="<?php echo $row['warranty']?>" required>
                                    <label for="date" class="form-label">Warranty<i class="text-danger">*</i></label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="thumbnail" id="thumbnail"  placeholder="" value="<?php echo $row['thumbnail']?>" required>
                                    <label for="date" class="form-label">Thumbnail<i class="text-danger">*</i></label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="currency" id="currency"  placeholder="" value="<?php echo $row['currency']?>" required>
                                    <label for="date" class="form-label">Currency<i class="text-danger">*</i></label>
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary" name="btnEditItem">
                                Edit Item
                            </button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div> 
</body>
</html>

<?php
            }
        }
    }
?>

