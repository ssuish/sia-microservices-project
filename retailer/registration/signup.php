<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Retail Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/e6ae4c2598.js" crossorigin="anonymous"></script>
    <style>
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
            background: radial-gradient(circle at 10% 20%, rgba(255, 193, 7, 1), transparent 50%),
                radial-gradient(circle at 60% 80%, rgba(220, 53, 69, 1), transparent 50%),
                radial-gradient(circle at 70% 10%, rgba(0, 123, 255, 0.5), transparent 50%);
            background-color: #007bff;
            /* Adjusted fallback color to lean towards red */
            background-size: 300% 300%;
            animation: bubblyAnimation 15s ease infinite;
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
    </style>
</head>

<body class="bubblyAnimation">
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
        </symbol>
    </svg>
    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    $pageTitle = 'Sign In';
    require "includes/db.inc.php";
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['signup'])) {
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $email = $_POST['regEmail'];
            $username = $_POST['regUsername'];
            $password = $_POST['regPassword'];
            $repeatPassword = $_POST['regRepeatPassword'];

            if (empty($firstName) || empty($lastName) || empty($email) || empty($username) || empty($password) || empty($repeatPassword)) {
                echo '
                <div class="alert-container">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                Please fill out all the fields.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                </div>';
            } else {

                include 'includes/form_validation.php';

                if (empty($errors)) {
                    $hashedPassword = sha1($password);

                    // Check if username already exists
                    $queryCheck = "SELECT * FROM tbluseraccounts WHERE username = ?";
                    $stmtCheck = mysqli_prepare($conn, $queryCheck);
                    mysqli_stmt_bind_param($stmtCheck, "s", $username);
                    mysqli_stmt_execute($stmtCheck);
                    $resultCheck = mysqli_stmt_get_result($stmtCheck);

                    if (mysqli_num_rows($resultCheck) > 0) {
                        echo '
                        <div class="alert-container">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        Your account already exists.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        </div>
                        ';
                    } else {
                        // Insert new user
                        $queryInsert = "INSERT INTO tbluseraccounts (firstName, lastName, email, username, password) VALUES (?, ?, ?, ?, ?)";
                        $stmtInsert = mysqli_prepare($conn, $queryInsert);
                        mysqli_stmt_bind_param($stmtInsert, "sssss", $firstName, $lastName, $email, $username, $hashedPassword);
                        $resultInsert = mysqli_stmt_execute($stmtInsert);

                        if ($resultInsert) {
                            echo '
                            <div class="alert-container">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Account created successfully.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            </div>
                        ';
                        } else {
                            echo '
                            <div class="alert-container">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                            <div>
                                Error creating account. Please try again.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            </div>
                            </div>
                        ';
                        }
                    }

                    mysqli_stmt_close($stmtCheck);
                    mysqli_stmt_close($stmtInsert);
                    mysqli_close($conn);
                } else {
                    $errors = array_merge(
                        usernameValidate($username),
                        passwordValidate($password),
                        repeatPasswordValidate($password, $repeatPassword),
                        emailValidate($email)
                    );

                    if (!empty($errors)) {
                        foreach ($errors as $error) {
                            echo '
                            <div class="alert-container">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            ' . htmlspecialchars($error) . '
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            </div>
                            ';
                        }
                    }
                }
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
    <div>
        <div class="text-light">
            <div class="container-md mx-auto d-flex justify-content-center align-items-center flex-column" style="min-height: 100vh; max-width: 40%;">
                <h1 class="display-1 mb-5">Sign Up</h1>
                <div>
                    <form id="signupForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" novalidate>
                        <div class="row mb-3">
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
                                <div id="emailHelpBlock" class="form-text text-light">
                                    Email must be valid.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="formControlInputUsername" class="form-label">Username</label>
                                <input type="text" class="form-control" id="formControlInputUsername" name="regUsername" aria-describedby="usernameHelpBlock" placeholder="dan.angelo" required>
                                <div id="usernameHelpBlock" class="form-text text-light">
                                    Username must be at least 3 characters long.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="inputPassword" class="form-label">Password</label>
                                <input type="password" id="inputPassword" class="form-control" name="regPassword" aria-describedby="passwordHelpBlock" required>
                                <div id="passwordHelpBlock" class="form-text text-light">
                                    Your password must be 8-20 characters long, contain letters, numbers, and special characters.
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="inputPasswordRepeat" class="form-label">Repeat Password</label>
                                <input type="password" id="inputRepeatPassword" class="form-control" name="regRepeatPassword" aria-describedby="repeatPasswordHelpBlock" required>
                                <div id="repeatPasswordHelpBlock" class="form-text text-light">
                                    Your password must be similar.
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center align-items-center mb-3">
                            <button type="submit" class="btn btn-primary w-50" name="signup" id="signupButton">Sign Up</button>
                        </div>
                        <p class="text-center mb-5">Already have an account? <a href="./login.php">Log in</a></p>
                    </form>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var form = document.getElementById('signupForm');
                            var usernameInput = document.getElementById('formControlInputUsername');
                            var passwordInput = document.getElementById('inputPassword');
                            var repeatPasswordInput = document.getElementById('inputRepeatPassword');
                            var emailInput = document.getElementById('formControlInputEmail');
                            var usernameHelpBlock = document.getElementById('usernameHelpBlock');
                            var passwordHelpBlock = document.getElementById('passwordHelpBlock');
                            var emailHelpBlock = document.getElementById('emailHelpBlock');
                            var signupButton = document.getElementById('signupButton');
                            var inputs = form.querySelectorAll('input')

                            function validatePassword(password) {
                                var re = /^(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/;
                                return re.test(password);
                            }

                            function validateEmail(email) {
                                var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                                return re.test(email.toLowerCase());
                            }

                            form.addEventListener('input', function(event) {
                                var isUsernameNotEmpty = usernameInput.value.trim() !== "";
                                var isUsernameLongEnough = usernameInput.value.length >= 3;
                                var isPasswordValid = validatePassword(passwordInput.value);
                                var isEmailValid = validateEmail(emailInput.value);
                                var doPasswordsMatch = passwordInput.value === repeatPasswordInput.value;

                                // Clear previous messages
                                usernameHelpBlock.textContent = '';
                                passwordHelpBlock.textContent = 'Your password must be 8-20 characters long, contain letters, numbers, and special characters.';
                                emailHelpBlock.textContent = ''; // Clear email help block message

                                if (!isUsernameNotEmpty || !isUsernameLongEnough) {
                                    usernameHelpBlock.textContent = "Username cannot be empty and must be at least 3 characters long.";
                                    usernameInput.classList.add('is-invalid');
                                } else {
                                    usernameInput.classList.remove('is-invalid');
                                }

                                if (!isPasswordValid) {
                                    passwordHelpBlock.textContent = "Password must be 8-20 characters long, contain letters, numbers, and special characters.";
                                    passwordInput.classList.add('is-invalid');
                                } else if (!doPasswordsMatch) {
                                    passwordHelpBlock.textContent = "Passwords do not match.";
                                    passwordInput.classList.add('is-invalid');
                                    repeatPasswordInput.classList.add('is-invalid');
                                } else {
                                    passwordInput.classList.remove('is-invalid');
                                    repeatPasswordInput.classList.remove('is-invalid');
                                }

                                if (!isEmailValid) {
                                    emailHelpBlock.textContent = "Please enter a valid email address.";
                                    emailInput.classList.add('is-invalid');
                                } else {
                                    emailInput.classList.remove('is-invalid');
                                }
                            }, false);
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>