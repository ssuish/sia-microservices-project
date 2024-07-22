<?php
require_once '../vendor/autoload.php'; // Ensure the Google API PHP Client is loaded
require_once '../oauth/secrets.php';

// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");


//Connect to Db
$server_name = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "dbsalesenterprisesystem";

$conn = mysqli_connect($server_name, $db_username, $db_password, $db_name);

if($conn->connect_error){
	die('Connection Failed'.$conn->connect_error);
} 

?>