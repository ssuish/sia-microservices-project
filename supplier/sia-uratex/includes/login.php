<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
        }

        .gradient-custom {
            background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));
        }

        .card {
            border-radius: 1rem;
            background-color: #ffffff;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            animation: slideIn 1s ease-in-out;
        }

        @keyframes slideIn {
            0% {
                transform: translateY(50px);
                opacity: 0;
            }

            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .form-control {
            border-radius: 0.75rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            box-shadow: 0 0 5px rgba(37, 117, 252, 0.8);
            border-color: #2575fc;
        }

        .btn-outline-light {
            border-radius: 0.375rem;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-outline-light:hover {
            background-color: #2575fc;
            border-color: #2575fc;
            transform: scale(1.05);
        }

        .social-icons a {
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .social-icons a:hover {
            transform: scale(1.2);
            color: #2575fc;
        }

        .fade-in {
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        .shake {
            animation: shake 0.5s;
        }

        @keyframes shake {
            0%, 100% {
                transform: translateX(0);
            }

            25%, 75% {
                transform: translateX(-10px);
            }

            50% {
                transform: translateX(10px);
            }
        }

        .spinner-border {
            display: none;
        }

        .btn-loading .spinner-border {
            display: inline-block;
        }

        .btn-loading .btn-text {
            display: none;
        }

        .btn-google {
            background-color: #4285F4;
            color: white;
            border-radius: 0.375rem;
            width: 100%;
        }

        .btn-google:hover {
            background-color: #357ae8;
            border-color: #357ae8;
        }

        .btn-google .fa-google {
            margin-right: 10px;
        }
        .btn-outline-light {
    border-color: #2575fc; /* Blue border color */
    color: #2575fc; /* Blue text color */
    border-radius: 0.375rem;
    transition: all 0.3s ease;
    width: 100%;
}

.btn-outline-light:hover {
    background-color: #2575fc; /* Blue background on hover */
    border-color: #2575fc; /* Blue border color on hover */
    color: #ffffff; /* White text color on hover */
    transform: scale(1.05);
}

    </style>
</head>

<body>
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card text-dark text-center fade-in">
                        <div class="card-body p-5">

                            <div class="mb-md-5 mt-md-4">
                                <form method="POST" action="login.inc.php" id="loginForm">
                                    <h2 class="fw-bold text-uppercase">Login</h2>
                                    <p class="text-dark-50 mb-5">Please enter your login and password!</p>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input type="text" name="txtEmail" id="txtEmail"
                                            class="form-control form-control-lg" placeholder="Username" />
                                    </div>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input type="password" name="txtPassword" id="txtPassword"
                                            class="form-control form-control-lg" placeholder="Password" />
                                    </div>

                                    <p class="small"><a class="text-dark-50" href="#!">Forgot password?</a></p>

                                    <button class="btn btn-outline-light btn-lg px-5" type="submit"
                                        name="btnSubmit" id="submitBtn">
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        <span class="btn-text">Login</span>
                                    </button>

                                    <div class="mt-4">
                                        <button class="btn btn-google btn-lg" id="google-signin" type="button">
                                            <i class="fab fa-google"></i> Sign in with Google
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <div>
                                <p class="mb-0">If not an admin <a href="../../login.php"
                                        class="text-dark-50 fw-bold">Go Back</a></p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function (e) {
            const email = document.getElementById('txtEmail').value;
            const password = document.getElementById('txtPassword').value;

            if (!email || !password) {
                e.preventDefault();
                document.querySelector('.card').classList.add('shake');
                setTimeout(() => {
                    document.querySelector('.card').classList.remove('shake');
                }, 500);
            } else {
                document.getElementById('submitBtn').classList.add('btn-loading');
            }
        });
    </script>
</body>

</html>
