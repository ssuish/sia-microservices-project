<?php

session_start();



session_unset(); // Unsetting the data (or the session variable)
session_destroy(); // Destroying the session



echo "You have logged out and will be redirected after 3 secondes...";
// header('Location: index.php');



<<<<<<< HEAD
header('REFRESH:3; URL=login.php'); // to be headed/redirected to another page after a certain time duration you exactly want    // Redirect to eCommerce\index.php
=======
header('REFRESH:3; URL=registration/login.php'); // to be headed/redirected to another page after a certain time duration you exactly want    // Redirect to eCommerce\index.php
>>>>>>> 2ca820e6270aed379519dc69bfb6c06aaec24b64
exit();
