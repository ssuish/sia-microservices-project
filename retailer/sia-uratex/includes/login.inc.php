
<?php 
    require "db1.inc.php";

    if (isset($_POST['btnSubmit'])) {
        $email = $_POST['txtEmail'];
        $password = $_POST['txtPassword'];
        $hashedPass = sha1($password);


        $query = "SELECT * FROM tbluseraccounts WHERE username = '$email' AND password = '$hashedPass'";

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
?>