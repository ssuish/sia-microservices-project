<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 5685e2c4923a7179007dd7aba65b66b17ee06366
<?php 
    require "db.inc.php";

    if (isset($_POST['btnSubmit'])) {
        $email = $_POST['txtEmail'];
        $pass = $_POST['txtPassword'];

        $query = "SELECT * FROM tbluseraccounts WHERE username = '$email' AND password = '$pass'";

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            session_start();

            $resultSet = mysqli_fetch_assoc($result);
            $_SESSION["username"] = $resultSet["username"];
            $_SESSION["firstname"] = $resultSet["firstname"];
            $_SESSION["email"] = $resultSet["email"];

            mysqli_close($conn);

            header("location: ../admin_dashboard.php");
        }
        else { 
?>
            <script language="javascript">
                alert("Invalid Username or Password");
                window.location.href = "login.php"
            </script>
<?php
        }
    }
    else {
        die("there is some error");
    }mysqli_close($conn);
<<<<<<< HEAD
=======
<?php 
    require "db.inc.php";

    if (isset($_POST['btnSubmit'])) {
        $email = $_POST['txtEmail'];
        $pass = $_POST['txtPassword'];

        $query = "SELECT * FROM tbluseraccounts WHERE username = '$email' AND password = '$pass'";

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            session_start();

            $resultSet = mysqli_fetch_assoc($result);
            $_SESSION["username"] = $resultSet["username"];
            $_SESSION["firstname"] = $resultSet["firstname"];
            $_SESSION["email"] = $resultSet["email"];

            mysqli_close($conn);

            header("location: ../admin_dashboard.php");
        }
        else { 
?>
            <script language="javascript">
                alert("Invalid Username or Password");
                window.location.href = "login.php"
            </script>
<?php
        }
    }
    else {
        die("there is some error");
    }mysqli_close($conn);
>>>>>>> 2ca820e6270aed379519dc69bfb6c06aaec24b64
=======
>>>>>>> 5685e2c4923a7179007dd7aba65b66b17ee06366
?>