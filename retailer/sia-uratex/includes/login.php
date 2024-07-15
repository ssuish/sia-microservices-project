<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 5685e2c4923a7179007dd7aba65b66b17ee06366
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <style>
    :root {
        /* Define color variables for easier maintenance */
        --color1: #383330;
        --color2: #C78853;
        --color3: #864622;
        --color4: #D4BDA1;
        --color5: #A6A288;
        --color6: #BBB78D;
    }

    .gradient-custom {
        /* Fallback for old browsers */
        background: var(--color1);

        /* Chrome 10-25, Safari 5.1-6 */
        background: -webkit-linear-gradient(to right, var(--color1), var(--color2), var(--color3), var(--color4), var(--color5), var(--color6));

        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        background: linear-gradient(to right, var(--color1), var(--color2), var(--color3), var(--color4), var(--color5), var(--color6));

        /* Ensuring smoother transitions */
        background-size: 300% 100%;
        animation: gradientAnimation 15s ease infinite;
        padding: 20px; /* Adding padding for better content readability */
        border-radius: 10px; /* Adding border radius for a modern look */
        color: #fff; /* Setting text color to white for better contrast */
        font-family: 'Arial', sans-serif; /* Applying a user-friendly font */
        text-align: center; /* Center-align text */
    }

    .gradient-custom:hover {
        animation: gradientHoverAnimation 5s ease infinite;
    }

    @keyframes gradientAnimation {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    @keyframes gradientHoverAnimation {
        0% { background-position: 50% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 50% 50%; }
    }
</style>


</head>
<body>
<section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4">
            <!-- form redirects to login.inc.php -->
            <form method="POST" action="login.inc.php">
              <h2 class="fw-bold text-uppercase">Login</h2>
              <p class="text-white-50 mb-5">Please enter your login and password!</p>

              <div data-mdb-input-init class="form-outline form-white mb-4">
                <input type="text" name="txtEmail" id="txtEmail" class="form-control form-control-lg" placeholder="Username" />
              </div>

              <div data-mdb-input-init class="form-outline form-white mb-4">
                <input type="password" name="txtPassword" id="txtPassword" class="form-control form-control-lg" placeholder="Password"/>
              </div>

              <p class="small"><a class="text-white-50" href="#!">Forgot password?</a></p>

              <button class="btn btn-outline-light btn-lg px-5" type="submit" name="btnSubmit">Login</button>

              <div class="d-flex justify-content-center text-center mt-4 pt-1">
                <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                <a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
              </div>
            </form>
            </div>

            <div>
              <p class="mb-0">If not an admin <a href="../../login.php" class="text-white-50 fw-bold">Go Back</a>
              </p>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
<<<<<<< HEAD
=======
=======
</html>
>>>>>>> 5685e2c4923a7179007dd7aba65b66b17ee06366
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <style>
    :root {
        /* Define color variables for easier maintenance */
        --color1: #383330;
        --color2: #C78853;
        --color3: #864622;
        --color4: #D4BDA1;
        --color5: #A6A288;
        --color6: #BBB78D;
    }

    .gradient-custom {
        /* Fallback for old browsers */
        background: var(--color1);

        /* Chrome 10-25, Safari 5.1-6 */
        background: -webkit-linear-gradient(to right, var(--color1), var(--color2), var(--color3), var(--color4), var(--color5), var(--color6));

        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        background: linear-gradient(to right, var(--color1), var(--color2), var(--color3), var(--color4), var(--color5), var(--color6));

        /* Ensuring smoother transitions */
        background-size: 300% 100%;
        animation: gradientAnimation 15s ease infinite;
        padding: 20px; /* Adding padding for better content readability */
        border-radius: 10px; /* Adding border radius for a modern look */
        color: #fff; /* Setting text color to white for better contrast */
        font-family: 'Arial', sans-serif; /* Applying a user-friendly font */
        text-align: center; /* Center-align text */
    }

    .gradient-custom:hover {
        animation: gradientHoverAnimation 5s ease infinite;
    }

    @keyframes gradientAnimation {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    @keyframes gradientHoverAnimation {
        0% { background-position: 50% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 50% 50%; }
    }
</style>


</head>
<body>
<section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4">
            <!-- form redirects to login.inc.php -->
            <form method="POST" action="login.inc.php">
              <h2 class="fw-bold text-uppercase">Login</h2>
              <p class="text-white-50 mb-5">Please enter your login and password!</p>

              <div data-mdb-input-init class="form-outline form-white mb-4">
                <input type="text" name="txtEmail" id="txtEmail" class="form-control form-control-lg" placeholder="Username" />
              </div>

              <div data-mdb-input-init class="form-outline form-white mb-4">
                <input type="password" name="txtPassword" id="txtPassword" class="form-control form-control-lg" placeholder="Password"/>
              </div>

              <p class="small"><a class="text-white-50" href="#!">Forgot password?</a></p>

              <button class="btn btn-outline-light btn-lg px-5" type="submit" name="btnSubmit">Login</button>

              <div class="d-flex justify-content-center text-center mt-4 pt-1">
                <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                <a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
              </div>
            </form>
            </div>

            <div>
              <p class="mb-0">If not an admin <a href="../../login.php" class="text-white-50 fw-bold">Go Back</a>
              </p>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
<<<<<<< HEAD
>>>>>>> 2ca820e6270aed379519dc69bfb6c06aaec24b64
=======
>>>>>>> 5685e2c4923a7179007dd7aba65b66b17ee06366
</html>