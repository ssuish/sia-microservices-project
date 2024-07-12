<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Retail Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$pageTitle = 'Log In';
require "includes/db.inc.php";
session_start();

if (isset($_SESSION['uid'])) {
    header('Location: ../userDashboard.php');
    exit;
}

if (isset($_SERVER['REQUEST_METHOD']) == 'POST') {
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        include 'includes/form_validation.php';

        if (empty($errors)){
            $hashedPassword = sha1($password);

            $query = "SELECT * FROM tbluseraccounts WHERE username = '$username' AND password = '$hashedPassword'";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                $resultSet = mysqli_fetch_assoc($result);
                $_SESSION['tbluseraccounts'] = $username;
                $_SESSION['uid'] = $resultSet['userID'];

                echo '
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Logged in successfully.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                ';

                header('Location: ../userDashboard.php');
            } else {
                echo '
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Username, email, or password is incorrect.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                ';
            }
        }
        else {
            $errors = array_merge(
                usernameValidate($username),
                passwordValidate($password)
            );

            if (!empty($errors)) {
                foreach ($errors as $error) {
                    echo '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            ' . htmlspecialchars($error) . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        ';
                }
            }
        }
    }
}
?>
    <div class="card shadow">
        <div class="card-body">
            <div class="container-md mx-auto d-flex justify-content-center align-items-center flex-column" style="min-height: 100vh;">
                <h1 class="card-title display-1 mb-5">Log In</h1>
                <div class="">
                    <form id="loginForm" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                        <div class="mb-3">
                            <label for="formControlInputUsername" class="form-label">Username</label>
                            <input type="text" class="form-control" id="formControlInputUsername" name="username" placeholder="dan.angelo" required>
                        </div>
                        <div class="mb-5">
                            <label for="inputPassword" class="form-label">Password</label>
                            <input type="password" id="inputPassword" class="form-control" name="password" aria-describedby="passwordHelpBlock" required>
                            <div id="passwordHelpBlock" class="form-text">
                                Your password must be 8-20 characters long, contain letters, numbers, and special characters.
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" name="login">Log In</button>
                        <a type="button" class="btn btn-secondary" href="./signup.php">Sign up instead</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>