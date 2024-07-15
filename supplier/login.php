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