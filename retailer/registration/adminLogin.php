    <!DOCTYPE html>
    <html>

    <head>
        <title>Admin Login</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
        </style>
    </head>

    <body>
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
                    <li>To have an admin account, ask the support to grant you the privileges.</li>
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
                        <form method="POST" action="login.php">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                            <button type="button" class="btn btn-secondary">Signup</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>