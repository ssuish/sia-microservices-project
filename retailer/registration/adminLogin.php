    <!DOCTYPE html>
    <html>

    <head>
        <title>Admin Login</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://kit.fontawesome.com/e6ae4c2598.js" crossorigin="anonymous"></script>
        <style>
            html {
                height: 100%;
                margin: 0;
                padding: 0;
            }

            .container {
                display: flex;
                height: 100%;
            }

            .left-side {
                flex: 70%;
                padding: 20px;
                background-color: #f1f1f1;
            }

            .right-side {
                flex: 30%;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .card {
                width: 80%;
            }

            @keyframes bubblyAnimation {
                0% {
                    background-position: 0% 50%;
                }

                50% {
                    background-position: 100% 50%;
                }

                100% {
                    background-position: 0% 50%;
                }
            }

            body {
                background: radial-gradient(circle at 10% 20%, rgba(255, 193, 7, 0.8), transparent 50%),
                    radial-gradient(circle at 60% 80%, rgba(220, 53, 69, 0.8), transparent 50%),
                    radial-gradient(circle at 70% 10%, rgba(0, 123, 255, 0.3), transparent 50%);
                background-color: #212529;
                /* Adjusted fallback color to lean towards red */
                background-size: 300% 300%;
                animation: bubblyAnimation 15s ease infinite;
            }

            .glassify {
                background: rgba(255, 255, 255, 0.25);
                backdrop-filter: blur(5px);
                border-radius: 10px;
                padding: 20px;
            }

            .alert-container {
                position: fixed;
                bottom: 2vh;
                /* Position it 2% from the bottom of the viewport */
                right: 2vh;
                /* Position it 2% from the right of the viewport */
                width: auto;
                /* Adjust based on your design */
                z-index: 1050;
                /* Ensure it's above other content */
            }
        </style>
    </head>

    <body>
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
            </symbol>
            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
            </symbol>
        </svg>
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
                if (!empty($_POST['username']) && !empty($_POST['password'])) {
                    $username = $_POST['username'];
                    $password = $_POST['password'];

                    include 'includes/form_validation.php';

                    if (empty($errors)) {
                        $hashedPassword = sha1($password);

                        $query = "SELECT * FROM tbluseraccounts WHERE username = '$username' AND password = '$hashedPassword'";
                        $result = mysqli_query($conn, $query);

                        if (mysqli_num_rows($result) > 0) {
                            $resultSet = mysqli_fetch_assoc($result);

                            if (empty($resultSet["role"])) {
                                echo '
                            <div class="alert-container">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                            You do not have permission to login. Please return to <a href="./login.php">user login.</a>.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            </div>
                            ';
                            } else {
                                $_SESSION['tbluseraccounts'] = $username;
                                $_SESSION['uid'] = $resultSet['userID'];

                                echo '
                            <div class="alert-container">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                            Logged in successfully.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            </div>
                        ';

                                header('Location: ../userDashboard.php');
                                exit;
                            }
                        } else {
                            echo '
                            <div class="alert-container">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                            Username, email, or password is incorrect.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            </div>
                        ';
                        }
                    } else {
                        $errors = array_merge(
                            usernameValidate($username),
                            passwordValidate($password)
                        );

                        if (!empty($errors)) {
                            foreach ($errors as $error) {
                                echo '
                                <div class="alert-container">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                <div>
                                ' . htmlspecialchars($error) . '
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                </div>
                            ';
                            }
                        }
                    }
                } else {
                    echo '
                <div class="alert-container">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                Username and password must not be empty.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                </div>';
                }
            }
        }
        ?>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="../img/logo.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
                    Coolex
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <!-- Navigation links can be added here -->
                </div>
            </div>
        </nav>
        <div class="container glassify">
            <div class="left-side p-5">
                <h2 class="display-3 mb-5">Welcome to Coolex Admin!</h2>
                <h3 class="display-5">Company Announcements:</h3>
                <ul>
                    <li>To have an admin account, create an user account by clicking signup button then ask the support to grant you the privileges.</li>
                </ul>
                <h3 class="display-5 mt-5">Guidelines for Admins:</h3>
                <ul class="list-group">
                    <li class="list-group-item"><b>Ensure data security -</b> Admins should prioritize the security of customer data and implement measures to protect sensitive information.</li>
                    <li class="list-group-item"><b>Regularly update product inventory -</b> Admins should keep the product inventory up to date, adding new products and removing discontinued ones.</li>
                    <li class="list-group-item"><b>Monitor user reviews and feedback -</b> Admins should regularly check and respond to user reviews and feedback to improve customer satisfaction and address any issues.</li>
                </ul>
            </div>
            <div class="right-side">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Login</h2>
                        <form id="loginForm" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" novalidate>
                            <div class="form-group">
                                <div class="mb-3">
                                    <label for="formControlInputUsername" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="formControlInputUsername" name="username" placeholder="admin" aria-describedby="usernameHelpBlock" required>
                                    <div id="usernameHelpBlock" class="form-text text-muted">
                                        Username must be at least 3 characters long.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="inputPassword" class="form-label">Password</label>
                                    <input type="password" id="inputPassword" class="form-control" name="password" placeholder="********" aria-describedby="passwordHelpBlock" required>
                                    <div id="passwordHelpBlock" class="form-text text-muted">
                                        Your password must be 8-20 characters long, contain letters, numbers, and special characters.
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center align-items-center mb-3">
                                    <button type="submit" class="btn btn-primary w-50" name="login">Login</button>
                                </div>
                                <p class="text-center">Don't have an account? <a href="./signup.php">Register now!</a></p>
                                <p class="text-center mb-3"><a href="./login.php">Return to User Login</a></p>
                            </div>
                        </form>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                var form = document.getElementById('loginForm');
                                var usernameInput = document.getElementById('formControlInputUsername');
                                var passwordInput = document.getElementById('inputPassword');
                                var usernameHelpBlock = document.getElementById('usernameHelpBlock');
                                var passwordHelpBlock = document.getElementById('passwordHelpBlock');

                                function validatePassword(password) {
                                    var re = /^(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/;
                                    return re.test(password);
                                }

                                form.addEventListener('input', function(event) {
                                    var isUsernameNotEmpty = usernameInput.value.trim() !== "";
                                    var isPasswordValid = validatePassword(passwordInput.value);

                                    // Clear previous messages
                                    usernameHelpBlock.textContent = '';
                                    passwordHelpBlock.textContent = 'Your password must be 8-20 characters long, contain letters, numbers, and special characters.';

                                    if (!isUsernameNotEmpty) {
                                        usernameHelpBlock.textContent = "Username cannot be empty.";
                                        usernameInput.classList.add('is-invalid'); // Bootstrap class for invalid input
                                    } else {
                                        usernameInput.classList.remove('is-invalid');
                                    }

                                    if (!isPasswordValid) {
                                        passwordHelpBlock.textContent = "Password must be 8-20 characters long, contain letters, numbers, and special characters.";
                                        passwordInput.classList.add('is-invalid');
                                    } else {
                                        passwordInput.classList.remove('is-invalid');
                                    }
                                }, false);
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>