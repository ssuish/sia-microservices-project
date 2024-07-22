<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once './config.php';
require_once './vendor/autoload.php'; // Ensure the Google API PHP Client is loaded

session_start(); // Ensure session is started to use $_SESSION

// authenticate code from Google OAuth Flow
if (isset($_GET['code'])) {
    /*
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['id']);

    // get profile info
    $google_oauth = new Google_Service_Oauth2($client); // Make sure Google_Service_Oauth2 is correctly defined
    $google_account_info = $google_oauth->userinfo->get(); // Correctly access userinfo
    $userinfo = [
        'email' => $google_account_info['email'],
        'first_name' => $google_account_info['givenName'],
        'last_name' => $google_account_info['familyName'],  
        'verifiedEmail' => $google_account_info['verifiedEmail'],
        'token' => $google_account_info['id'],
    ];

    echo "Binding parameters: " . $userinfo['email'];

    // Ensure $userinfo is defined and is an array before using it
    if (!isset($userinfo) || !is_array($userinfo)) {
        echo "User information is not available.";
        die();
    }

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM tblgoogleuseraccounts WHERE email = ?");
    $stmt->bind_param("s", $userinfo['email']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User exists
        $userinfo = $result->fetch_assoc();
        $token = $userinfo['token'];
    } else {
        // User doesn't exist, insert new record
        $insertStmt = $conn->prepare("INSERT INTO tblgoogleuseraccounts (email, firstName, lastName, token, verifiedEmail) VALUES (?, ?, ?, ?, ?)");
        if ($insertStmt === false) {
            error_log("Prepare failed: " . $conn->error);
            echo "<script>alert('An error occurred during the prepare statement.'); window.location.href='/errorPage.php';</script>";
            exit();
        }

        $insertStmt->bind_param("ssss", $userinfo['email'], $userinfo['first_name'], $userinfo['last_name'], $userinfo['token'], $userinfo['verifiedEmail']);
        if (!$insertStmt->execute()) {
            echo "<script>alert('An error occurred during the execute statement.'); window.location.href='/errorPage.php';</script>";
            exit;
        }

        // Check if the user was successfully inserted
        if ($insertStmt->affected_rows > 0) {
            echo "User registered successfully.";
        } else {
            echo "User could not be registered.";
        }
    }

    // save user data into session
    $_SESSION['user_token'] = $token;
    */

    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['user_token']);

    // get profile info
    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();
    $userinfo = [
        'email' => $google_account_info['email'],
        'first_name' => $google_account_info['givenName'],
        'last_name' => $google_account_info['familyName'],
        'full_name' => $google_account_info['name'],
        'verifiedEmail' => $google_account_info['verifiedEmail'],
        'token' => $google_account_info['id'],
    ];

    // checking if user is already exists in database
    $sql = "SELECT * FROM tblgoogleuseraccounts WHERE email ='{$userinfo['email']}'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // user is exists
        $userinfo = mysqli_fetch_assoc($result);
        $token = $userinfo['token'];
    } else {
        // user is not exists
        $sql = "INSERT INTO tblgoogleuseraccounts (firstName, lastName, fullName, email, verifiedEmail, token) VALUES ( '{$userinfo['first_name']}', '{$userinfo['last_name']}', '{$userinfo['full_name']}', '{$userinfo['email']}', '{$userinfo['verifiedEmail']}', '{$userinfo['token']}')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $token = $userinfo['token'];
        } else {
            echo "User is not created";
            die();
        }
    }

    // save user data into session
    $_SESSION['user_token'] = $token;
} else {
    if (!isset($_SESSION['user_token'])) {
        header("Location: ../index.php");
        die();
    }

    // checking if user is already exists in database
    $sql = "SELECT * FROM tblgoogleuseraccounts WHERE token = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $_SESSION['user_token']);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        // user exists
        $userinfo = $result->fetch_assoc();
    }
}
