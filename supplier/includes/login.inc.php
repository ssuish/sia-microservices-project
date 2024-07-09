<?php
require "db.inc.php";

if (isset($_POST['btnLogin']))
{
    $username = $_POST['txtUsername'];
    $pass = $_POST['txtPassword'];

    $query = "SELECT * FROM `tbluseraccounts` WHERE `username` = '$username' AND `password` = '$pass'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0)
    {
        session_start();

        $resultSet = mysqli_fetch_assoc($result);
        $_SESSION["name"] = $resultSet["username"];
        $_SESSION["user_id"] = $resultSet["userID"];

        mysqli_close($conn);

        header("location: ../userDashboard.php");

    }
    else
    {
?>
        <script language="javascript">
            alert("Invalid username or password");
            window.location.href = "../login.php";
        </script>
<?php
        //echo "Invalid email or password";
    }
}
else 
{
    die("There is some error");
}

mysqli_close($conn);

?>