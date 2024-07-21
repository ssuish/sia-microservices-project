<?php 
require_once 'vendor/autoload.php';



// init configuration
$clientID = '7010837349-7klhculgofu29bmrltnib985m3k1ipjq.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost/SIAGoogle/welcome.php';



// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

//Connect to Db

$server="localhost";//server name
$user="root";		
$pass="";			
$dbname="google_login";//database name


$conn= new mysqli($server,$user,$pass,$dbname);
if($conn->connect_error){
	die('Connection Failed'.$conn->connect_error);
}

?>