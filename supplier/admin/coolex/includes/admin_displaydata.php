<<<<<<< HEAD
<?php
session_start();
if (!isset($_SESSION['username']) && !isset($_SESSION['email'])) {
    header("Location: admin_dashboard.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>View Services</title>
    <style type="text/css">
        .navbar {
            background: -webkit-linear-gradient(to right, #c05bde, #fff);
            background: linear-gradient(to right, #c05bde, #fff);
        }

        .thead {
            background: -webkit-linear-gradient(to right, #c05bde, #fff);
            background: linear-gradient(to right, #c05bde, #fff);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a href="#" class="navbar-brand">
                <h3>Digital Herbarium - Collections</h3>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto mb2 mb-lg-0">
                    <a href="" class="nav-link" href="#">
                        <?php
                        echo "Hello! " . $_SESSION['firstname'];
                        ?>
                    </a>
                    <a href="" class="nav-link" href="logout.inc.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row justify-content-center my-5">
            <div class="col-10">
                <table class="table table-bordered">
                    <thead class="thead">
                        <tr>
                            <th scope="col">Item ID</th>
                            <th scope="col">Item Name</th>
                            <th scope="col">Color</th>
                            <th scope="col">Material</th>
                            <th scope="col">Material Lining</th>
                            <th scope="col">Sole Lining</th>
                            <th scope="col">Weight</th>
                            <th scope="col">UoM Weight</th>
                            <th scope="col">Width</th>
                            <th scope="col">Heel Height</th>
                            <th scope="col">UoM Heel Height</th>
                            <th scope="col">Description</th>
                            <th scope="col">Price</th>
                            <th scope="col">Currency</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require "db.inc.php";
                        // $user_id = $_SESSION['user_id'];
                        $query = "SELECT * FROM tblProducts ORDER BY itemName ASC"; // WHERE id = '$user_id'
                        $result = mysqli_query($conn, $query);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <tr>
                                    <td><?php echo $row["itemID"]; ?></td>
                                    <td><?php echo $row["itemName"]; ?></td>
                                    <td><?php echo $row["color"]; ?></td>
                                    <td><?php echo $row["material"]; ?></td>
                                    <td><?php echo $row["material_lining"]; ?></td>
                                    <td><?php echo $row["sole_lining"]; ?></td>
                                    <td><?php echo $row["weight"]; ?></td>
                                    <td><?php echo $row["uOm_weight"]; ?></td>
                                    <td><?php echo $row["shoe_width"]; ?></td>
                                    <td><?php echo $row["heel_height"]; ?></td>
                                    <td><?php echo $row["uOm_height"]; ?></td>
                                    <td><?php echo $row["description"]; ?></td>
                                    <td><?php echo $row["price"]; ?></td>
                                    <td><?php echo $row["currency"]; ?></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

=======
<?php
session_start();
if (!isset($_SESSION['username']) && !isset($_SESSION['email'])) {
    header("Location: admin_dashboard.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>View Services</title>
    <style type="text/css">
        .navbar {
            background: -webkit-linear-gradient(to right, #c05bde, #fff);
            background: linear-gradient(to right, #c05bde, #fff);
        }

        .thead {
            background: -webkit-linear-gradient(to right, #c05bde, #fff);
            background: linear-gradient(to right, #c05bde, #fff);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a href="#" class="navbar-brand">
                <h3>Digital Herbarium - Collections</h3>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto mb2 mb-lg-0">
                    <a href="" class="nav-link" href="#">
                        <?php
                        echo "Hello! " . $_SESSION['firstname'];
                        ?>
                    </a>
                    <a href="" class="nav-link" href="logout.inc.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row justify-content-center my-5">
            <div class="col-10">
                <table class="table table-bordered">
                    <thead class="thead">
                        <tr>
                            <th scope="col">Item ID</th>
                            <th scope="col">Item Name</th>
                            <th scope="col">Color</th>
                            <th scope="col">Material</th>
                            <th scope="col">Material Lining</th>
                            <th scope="col">Sole Lining</th>
                            <th scope="col">Weight</th>
                            <th scope="col">UoM Weight</th>
                            <th scope="col">Width</th>
                            <th scope="col">Heel Height</th>
                            <th scope="col">UoM Heel Height</th>
                            <th scope="col">Description</th>
                            <th scope="col">Price</th>
                            <th scope="col">Currency</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require "db.inc.php";
                        // $user_id = $_SESSION['user_id'];
                        $query = "SELECT * FROM tblProducts ORDER BY itemName ASC"; // WHERE id = '$user_id'
                        $result = mysqli_query($conn, $query);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <tr>
                                    <td><?php echo $row["itemID"]; ?></td>
                                    <td><?php echo $row["itemName"]; ?></td>
                                    <td><?php echo $row["color"]; ?></td>
                                    <td><?php echo $row["material"]; ?></td>
                                    <td><?php echo $row["material_lining"]; ?></td>
                                    <td><?php echo $row["sole_lining"]; ?></td>
                                    <td><?php echo $row["weight"]; ?></td>
                                    <td><?php echo $row["uOm_weight"]; ?></td>
                                    <td><?php echo $row["shoe_width"]; ?></td>
                                    <td><?php echo $row["heel_height"]; ?></td>
                                    <td><?php echo $row["uOm_height"]; ?></td>
                                    <td><?php echo $row["description"]; ?></td>
                                    <td><?php echo $row["price"]; ?></td>
                                    <td><?php echo $row["currency"]; ?></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

>>>>>>> 2ca820e6270aed379519dc69bfb6c06aaec24b64
</html>