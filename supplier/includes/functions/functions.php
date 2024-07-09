<?php
// This is the "Frontend Section" functions


function checkUserStatus($user) {
    global $con;

    // Checking if the user (Normal Users only (not Admins)) exists in the database
    $stmtx = $con->prepare('SELECT `Username` , `RegStatus` FROM `users` WHERE `Username` = ? AND `RegStatus` = 0');
    $stmtx->execute(array($user));
    $status = $stmtx->rowCount();


    return $status;
}


function checkItem($column, $table, $value) {
    global $con;
    $stmt = $con->prepare("SELECT COUNT(*) AS count FROM $table WHERE $column = ?");
    $stmt->execute(array($value));
    $result = $stmt->fetch();
    return $result['count'];
}



function getTitle() {
    global $pageTitle; // Every file in this project has its own $pageTitle variable which holds its name (at the top of the file)

    if (isset($pageTitle)) {
        return $pageTitle;
    } else {
        return 'Default Title';
    }
}


function redirectHome($theMsg, $url = NULL, $seconds = 3) { // 3 seconds as a default value for $seconds if not specified
    if ($url === Null) { // If it is left without anything
        $url  = 'index.php';
        $link = 'HomePage';
    } else {
        if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== '') { // This is to avoid the PHP error message that will appear if the user starting from that specific page and there wasn't any page originally coming from
            $url = $_SERVER['HTTP_REFERER']; // the page you are coming from
            $link = 'the Previous Page';
        } else { // Here there is no page $_SERVER['HTTP_REFERER'] can refe to because user is starting from that specific page already
            $url  = 'index.php';
            $link = 'HomePage';
        }
        /* $url = isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== '' ? $_SERVER['HTTP_REFERER'] : 'index.php'; */ //The same previous if condition code using the Ternary Operator
    }
    echo $theMsg;
    echo "<div class='alert alert-info'>You will be redirected to $link after $seconds seconds...</div>";
    header("refresh:$seconds;url=$url"); // Redirection after a certain time duration you want
    exit();
}

