<<<<<<< HEAD
<?php

session_start();
// echo "<pre>MY SESSION ARRAY ELEMENTS ARE: \n", print_r($_SESSION), '(from the FrontEnd login.php)</pre>';


$pageTitle = 'Login/Signup'; 


// If there's a user registerd in the Session, redirect the user to eCommerce\index.php
if (isset($_SESSION['tbluseraccounts'])) { // VERY IMPORTANT: SESSION OF NORMAL USERS MUST BE DIFFERENT THAN ADMIN'S SESSION
    header('Location: index.php');
} // Session will be planted at the end of this page before the Markup (HTML)



include 'init.php';


// Checking if the user is coming through a POST HTTP Request and not from copy/paste of the URL i.e. a GET Request (coming from the form at the end of this page)
if ($_SERVER['REQUEST_METHOD'] == 'POST') { // There are TWO possibilities: Coming from the Login HTML Form Button Or Signup HTML Form Button    // if the HTML Form is submitted with a POST method/verb HTTP Request


    if (isset($_POST['login'])) { 
        $username  = $_POST['username'];
        $password  = $_POST['password'];
    
        $formErrors = array(); 
    
        if (isset($username)) {
            $filteredUser = htmlspecialchars($username);
    
            if (strlen($filteredUser) < 4) {
                $formErrors[] = 'Username must be more than 3 characters';
            }
        }
    
        if (isset($password)) {
            if (empty($password)) { 
                $formErrors[] = 'Password can\'t be empty';
            }
        }
    
        if (empty($formErrors)) {
            $hashedPass = sha1($password); 
            $stmt = $con->prepare('SELECT `UserID`, `Username`, `Password` FROM `tbluseraccounts` WHERE `Username` =? AND `Password` =?'); 
            $stmt->execute(array(
                $username, $hashedPass
            ));
    
            $get = $stmt->fetch();
    
            $count = $stmt->rowCount(); 
            if ($count > 0) { 
                $_SESSION['tbluseraccounts'] = $user; 
                $_SESSION['uid']  = $get['UserID']; 
    
                header('Location: userDashboard.php');
                exit(); // Stop the script from executing further
            } else {
                $formErrors[] = 'Username or password is incorrect';
            }
        }
    
    } else { // coming from the "Signup" HTML Form Button (not from the "Login" HTML Form button) -- Note that we gave the button <input> itself an HTML 'name' attribute (    name="signup"    and the other    name="login"    )
    // echo $_POST['username'];

    // Errors array for Validation
    $formErrors = array(); // to print the Validation Errors in the errors div down below in this page

    $username  = $_POST['username'];
    $password  = $_POST['password']; // Password
    $password2 = $_POST['password2']; // Password confirmation
    $email     = $_POST['email'];
    $firstname = $_POST['Firstname'];
    $lastname  = $_POST['Lastname'];

    // Validation
    if (isset($username)) {
        // $filteredUser = filter_var($username, FILTER_SANITIZE_STRING); // https://www.php.net/manual/en/filter.filters.sanitize.php#:~:text=FILTER_FLAG_NO_ENCODE_QUOTES.%20(Deprecated%20as%20of%20PHP%208.1.0%2C%20use%20htmlspecialchars()%20instead.)
        $filteredUser = htmlspecialchars($username); // https://www.php.net/manual/en/filter.filters.sanitize.php#:~:text=FILTER_FLAG_NO_ENCODE_QUOTES.%20(Deprecated%20as%20of%20PHP%208.1.0%2C%20use%20htmlspecialchars()%20instead.)

        if (strlen($filteredUser) < 4) {
            $formErrors[] = 'Username must be more than 3 characters';
        }
    }

    if (isset($firstname)) {
        $filteredFirstname = htmlspecialchars($firstname);

        if (strlen($filteredFirstname) < 2) {
            $formErrors[] = 'Firstname must be more than 1 character';
        }
    }

    if (isset($lastname)) {
        $filteredLastname = htmlspecialchars($lastname);

        if (strlen($filteredLastname) < 2) {
            $formErrors[] = 'Lastname must be more than 1 character';
        }
    }

    // Password validation contains TWO errors
    if (isset($password) && isset($password2)) {
        if (empty($password)) { // to gurantee/make sure that user must enter a password and don't leave the password field empty
            $formErrors[] = 'Password can\'t be empty';
        }

        // Password Confirmation
        if(sha1($password) !== sha1($password2)) {
            $formErrors[] = 'Passwords don\'t match each other';
        }
    }

    if (isset($email)) {
        $filteredEmail = filter_var($email, FILTER_SANITIZE_EMAIL);

        if (filter_var($filteredEmail, FILTER_VALIDATE_EMAIL) != true) {
            $formErrors[] = 'This email is not valid';
        }
    }

    // Checking if there are no errors, then proceed to Signup (adding) the user to database
    if (empty($formErrors)) {
        // Checking if the user already exists in the database `users` table
        // $check = checkItem('`Username`', '`users`', $username);

        if ($check == 1) { // this means that the user already exists
                $formErrors[] = 'This user already exists';
        } else { // go on / proceed
            // Inserting User info into database
            $stmt = $con->prepare('INSERT INTO `tbluseraccounts` (`username`, `password`, `Email`, `firstName`, `lastName`, `userRole`, `Date`) VALUES (:zuser, :zpass, :zmail, :zfirstname, :zlastname,"retailer", now())');
            $stmt->execute(array(
                'zuser' => $username,
                'zpass' => sha1($password), // the hash-ed form of the password
                'zmail' => $email,
                'zfirstname' => $firstname,
                'zlastname' => $lastname
            ));

            //Echoing a Success Message
            $succesMsg = 'Congratz, You Are Now A Registered User'; // will be echo-ed down below in this file
        }
    }
}
}

?>

    <div class="container login-page"> <!-- Login/Signup page -->

        <!-- Note: We'll switch Login form or Signup form using jQuery. Check eCommerce\layout\js\front.js -->
        <h1 class="text-center"><span class="selected" data-class="login">Login</span> | <span data-class="signup">SignUp</span></h1> <!-- The CSS Class "selected" and the Custom HTML data-* Attribute are used by jQuery to switch between showing Login and Signup HTML Forms -->

        <!-- Note: We'll switch Login form or Signup form using jQuery. Check eCommerce\layout\js\front.js -->



      <!--Start: Login Form-->
<form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST"> 
    <!--Input divs are used for jQuery astrisk CSS-->
    <!--HTML5 Validation-->
    <div class="input-container"><input pattern=".{4,}" title="Username must be more than 3 characters" class="form-control" type="text" name="username" autocomplete="off" placeholder="Type Your Username" required></div>
    <div class="input-container"><input minlength="6" class="form-control" type="password" name="password"  autocomplete="new-password" placeholder="Type Your Password"       required></div>
    <input class="btn btn-primary btn-block" type="submit" name="login" value="Login"> 
</form>
<!--End: Login Form-->




        <!--Start: Signup Form-->
        <form class="signup" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST"> <!-- class="signup" will be used by jQuery to show the relevant HTML Form (to switch between the Login / SignUp HTML Forms). Check layout/js/front.js -->
            <!--Input divs are used for jQuery astrisk CSS-->
            <!--HTML5 Validation-->
            <div class="input-container"><input pattern=".{4,}" title="Username must be more than 3 characters" class="form-control" type="text" name="username" autocomplete="off" placeholder="Type Your Username" required></div>
            <div class="input-container"><input pattern=".{4,}" title="Firstname must be more than 1 character" class="form-control" type="text" name="Firstname" autocomplete="off" placeholder="Type Your Firstname" required></div>
            <div class="input-container"><input pattern=".{4,}" title="Lastname must be more than 1 character" class="form-control" type="text" name="Lastname" autocomplete="off" placeholder="Type Your Lastname" required></div>
            <div class="input-container"><input minlength="6" class="form-control" type="password" name="password"  autocomplete="new-password" placeholder="Type Your Password"       required></div>
            <div class="input-container"><input minlength="6" class="form-control" type="password" name="password2" autocomplete="new-password" placeholder="Type Your Password Again" required></div>
            <div class="input-container"><input               class="form-control" type="email"    name="email"                                 placeholder="Type A Valid Email"       required></div>
            <input class="btn btn-success btn-block" type="submit" name="signup" value="Signup"> <!--We gave the button <input> itself an HTML name attribute    name="signup"    to distinguish it from other HTML forms buttons to be used up there in this file to decide whether the user is comming from a Login or a Signup HTML Form using the $_POST superglobal -->
        </form>
        <!--End: Signup Form-->



        <!--Start: A div for Showing errors-->
        <div class="the-errors text-center">
<?php
            if (!empty($formErrors)) { // If there are errors, show them
                foreach ($formErrors as $error) {
                    echo '<div class="msg error">' . $error . '</div>';
                }
            }

            if (isset($succesMsg)) {
                echo '<div class="msg success">' . $succesMsg . '</div>';
            }
?>
        </div>
        <!--End: A div for Showing errors-->


    </div>


<?php



// Footer
include $tpl . 'footer.php';






=======
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
$pageTitle = 'Login/Signup';

if (isset($_SESSION['username'])) {
    header('Location: index.php');
}

include 'init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $formErrors = array();

        if (isset($username)) {
            $filteredUser = htmlspecialchars($username);
            if (strlen($filteredUser) < 4) {
                $formErrors[] = 'Username must be more than 3 characters';
            }
        }

        if (isset($password)) {
            if (empty($password)) {
                $formErrors[] = 'Password can\'t be empty';
            }
        }

        if (empty($formErrors)) {
            $hashedPass = sha1($password);
            $stmt = $con->prepare('SELECT `UserID`, `Username`, `Password` FROM `tbluseraccounts` WHERE `Username` =? AND `Password` =?');
            $stmt->execute(array($username, $hashedPass));
            $get = $stmt->fetch();
            $count = $stmt->rowCount();

            if ($count > 0) {
                $_SESSION['tbluseraccounts'] = $username;
                $_SESSION['uid'] = $get['UserID'];
                header('Location: userDashboard.php');
                exit();
            } else {
                $formErrors[] = 'Username or password is incorrect';
            }
        }
    } else {
        $formErrors = array();
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];
        $email = $_POST['email'];
        $firstname = $_POST['Firstname'];
        $lastname = $_POST['Lastname'];

        if (isset($username)) {
            $filteredUser = htmlspecialchars($username);
            if (strlen($filteredUser) < 4) {
                $formErrors[] = 'Username must be more than 3 characters';
            }
        }

        if (isset($firstname)) {
            $filteredFirstname = htmlspecialchars($firstname);
            if (strlen($filteredFirstname) < 1) {
                $formErrors[] = 'Firstname must be more than 0 character';
            }
        }

        if (isset($lastname)) {
            $filteredLastname = htmlspecialchars($lastname);
            if (strlen($filteredLastname) < 1) {
                $formErrors[] = 'Lastname must be more than 0 character';
            }
        }

        if (isset($password) && isset($password2)) {
            if (empty($password)) {
                $formErrors[] = 'Password can\'t be empty';
            }
            if (sha1($password) !== sha1($password2)) {
                $formErrors[] = 'Passwords don\'t match each other';
            }
        }

        if (isset($email)) {
            $filteredEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
            if (filter_var($filteredEmail, FILTER_VALIDATE_EMAIL) != true) {
                $formErrors[] = 'This email is not valid';
            }
        }

        if (empty($formErrors)) {
            $stmt = $con->prepare('INSERT INTO `tbluseraccounts` (`username`, `password`, `Email`, `firstName`, `lastName`, `Date`) VALUES (:zuser, :zpass, :zmail, :zfirstname, :zlastname,  now())');
            $stmt->execute(array(
                'zuser' => $username,
                'zpass' => sha1($password),
                'zmail' => $email,
                'zfirstname' => $firstname,
                'zlastname' => $lastname
            ));

            $succesMsg = 'Congratz, You Are Now A Registered User';
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $pageTitle; ?></title>
    <style>
        .input-container {
            position: relative;
            margin-bottom: 20px;
        }

        .input-container input {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }

        .input-container label {
            position: absolute;
            top: 10px;
            left: 10px;
            pointer-events: none;
            transition: all 0.2s ease-out;
            color: #9e9e9e;
        }

        .input-container input:focus + label,
        .input-container input:not(:placeholder-shown) + label {
            top: -15px;
            left: 10px;
            font-size: 12px;
            color: #3f51b5;
        }

        .login, .signup {
            display: none;
        }

        .login.active, .signup.active {
            display: block;
        }
    </style>
</head>
<body>
    <div class="container login-page">
        <h1 class="text-center">
            <span class="selected" data-class="login">Login</span> | 
            <span data-class="signup">SignUp</span>
        </h1>

        <form class="login active" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST"> 
            <div class="input-container">
                <input pattern=".{4,}" title="Username must be more than 3 characters" class="form-control" type="text" name="username" autocomplete="off" placeholder=" " required>
                <label for="username">Type Your Username</label>
            </div>
            <div class="input-container">
                <input minlength="6" class="form-control" type="password" name="password" autocomplete="new-password" placeholder=" " required>
                <label for="password">Type Your Password</label>
            </div>
            <input class="btn btn-primary btn-block" type="submit" name="login" value="Login"> 
        </form>

        <form class="signup" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="input-container">
                <input pattern=".{4,}" title="Username must be more than 3 characters" class="form-control" type="text" name="username" autocomplete="off" placeholder=" " required>
                <label for="username">Type Your Username</label>
            </div>
            <div class="input-container">
                <input pattern=".{4,}" title="Firstname must be more than 1 character" class="form-control" type="text" name="Firstname" autocomplete="off" placeholder=" " required>
                <label for="Firstname">Type Your Firstname</label>
            </div>
            <div class="input-container">
                <input pattern=".{4,}" title="Lastname must be more than 1 character" class="form-control" type="text" name="Lastname" autocomplete="off" placeholder=" " required>
                <label for="Lastname">Type Your Lastname</label>
            </div>
            <div class="input-container">
                <input minlength="6" class="form-control" type="password" name="password" autocomplete="new-password" placeholder=" " required>
                <label for="password">Type Your Password</label>
            </div>
            <div class="input-container">
                <input minlength="6" class="form-control" type="password" name="password2" autocomplete="new-password" placeholder=" " required>
                <label for="password2">Type Your Password Again</label>
            </div>
            <div class="input-container">
                <input class="form-control" type="email" name="email" placeholder=" " required>
                <label for="email">Type A Valid Email</label>
            </div>
            <input class="btn btn-success btn-block" type="submit" name="signup" value="Signup"> 
        </form>

        <div class="the-errors text-center">
            <?php 
                if (!empty($formErrors)) {
                    foreach($formErrors as $error) {
                        echo '<div class="msg error">' . $error . '</div>';
                    }
                }
                if (isset($succesMsg)) {
                    echo '<div class="msg success">' . $succesMsg . '</div>';
                }
            ?>
        </div>
    </div>

    <script>
        const loginForm = document.querySelector('.login');
        const signupForm = document.querySelector('.signup');
        const toggleButtons = document.querySelectorAll('h1 span');

        toggleButtons.forEach(button => {
            button.addEventListener('click', () => {
                toggleButtons.forEach(btn => btn.classList.remove('selected'));
                button.classList.add('selected');
                
                if (button.dataset.class === 'login') {
                    loginForm.classList.add('active');
                    signupForm.classList.remove('active');
                } else {
                    signupForm.classList.add('active');
                    loginForm.classList.remove('active');
                }
            });
        });
    </script>
</body>
</html>
>>>>>>> 2ca820e6270aed379519dc69bfb6c06aaec24b64
