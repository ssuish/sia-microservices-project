<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Retail Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$pageTitle = 'Sign In';
require "includes/db.inc.php";
session_start();

if (isset($_SERVER['REQUEST_METHOD']) == 'POST') {
    if (isset($_POST['signup'])) {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['regEmail'];
        $username = $_POST['regUsername'];
        $password = $_POST['regPassword'];
        $repeatPassword = $_POST['regRepeatPassword'];

        include 'includes/form_validation.php';

        if (empty($errors)){
            $hashedPassword = sha1($password);

            $query = "SELECT * FROM tbluseraccounts WHERE username = '$username' AND password = '$hashedPassword'";
            $result = mysqli_query($conn, $query);

            if ($result) {
                if (mysqli_num_rows($result) < 0) {
                    $insert = $query = "INSERT INTO tbluseraccounts (firstName, lastName, email, username, password, userRole) VALUES ('$firstName', '$lastName', '$email', '$username', '$hashedPassword', 'retailer')";
                    $result = mysqli_query($conn, $insert);

                    echo '
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Account created successfully.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    ';
                } else {
                    echo '
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        Your account already exists.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    ';
                }
            } else {
                echo '
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error creating account. Please try again.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                ';
            }

            mysqli_close($conn);
        }
        else {
            $errors = array_merge(
                usernameValidate($username),
                passwordValidate($password),
                repeatPasswordValidate($password, $repeatPassword),
                emailValidate($email)
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
                <h1 class="card-title display-1 mb-5">Sign Up</h1>
                <div class="">
                    <form id="loginForm" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                        <div class="row mb-5">
                            <div class="col-md-6 mb-3">
                                <label for="formControlInputFirstName" class="form-label">First name</label>
                                <input type="text" class="form-control" id="formControlInputFirstName" name="firstName" placeholder="Dan" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="formControlInputLastName" class="form-label">Last name</label>
                                <input type="text" class="form-control" id="formControlInputLastName" name="lastName" placeholder="Angelo" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="formControlInputEmail" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="formControlInputEmail" name="regEmail" placeholder="name@example.com" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="formControlInputUsername" class="form-label">Username</label>
                                <input type="text" class="form-control" id="formControlInputUsername" name="regUsername" placeholder="dan.angelo" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="inputPassword" class="form-label">Password</label>
                                <input type="password" id="inputPassword" class="form-control" name="regPassword" aria-describedby="passwordHelpBlock" required>
                                <div id="passwordHelpBlock" class="form-text">
                                    Your password must be 8-20 characters long, contain letters, numbers, and special characters.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="inputPasswordRepeat" class="form-label">Repeat Password</label>
                                <input type="password" id="inputPasswordRepeat" class="form-control" name="regRepeatPassword" aria-describedby="passwordHelpBlock" required>
                                <div id="passwordHelpBlock" class="form-text">
                                    Your password must be similar.
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" name="signup">Sign Up</button>
                        <a type="button" class="btn btn-secondary" href="./login.php">I already have an account</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>