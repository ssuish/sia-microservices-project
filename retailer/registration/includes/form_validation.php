<<<<<<< HEAD
<?php

function usernameValidate($username) {
    $errors = [];
    if (strlen($username) < 4) {
        $errors[] = 'Username must be at least 4 characters long.';
    }
    return $errors;
}

function passwordValidate($password) {
    $errors = [];
    if (empty($password)) {
        $errors[] = 'Password must not be empty.';
    }
    /*if (strlen($password) < 8 || strlen($password) > 20) {
        $errors[] = 'Password must be 8-20 characters long.';
    }
    if (!preg_match('/[A-Za-z]/', $password) || !preg_match('/[0-9]/', $password) || !preg_match('/[^A-Za-z0-9]/', $password)) {
        $errors[] = 'Password must contain letters, numbers, and special characters.';
    }*/
    return $errors;
}

function emailValidate($email) {
    $errors = [];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email address.';
    }
    return $errors;
}

function repeatPasswordValidate($password, $repeatPassword) {
    $errors = [];
    if ($password !== $repeatPassword) {
        $errors[] = 'Passwords do not match.';
    }
    return $errors;
=======
<?php

function usernameValidate($username) {
    $errors = [];
    if (strlen($username) < 4) {
        $errors[] = 'Username must be at least 4 characters long.';
    }
    return $errors;
}

function passwordValidate($password) {
    $errors = [];
    if (empty($password)) {
        $errors[] = 'Password must not be empty.';
    }
    /*if (strlen($password) < 8 || strlen($password) > 20) {
        $errors[] = 'Password must be 8-20 characters long.';
    }
    if (!preg_match('/[A-Za-z]/', $password) || !preg_match('/[0-9]/', $password) || !preg_match('/[^A-Za-z0-9]/', $password)) {
        $errors[] = 'Password must contain letters, numbers, and special characters.';
    }*/
    return $errors;
}

function emailValidate($email) {
    $errors = [];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email address.';
    }
    return $errors;
}

function repeatPasswordValidate($password, $repeatPassword) {
    $errors = [];
    if ($password !== $repeatPassword) {
        $errors[] = 'Passwords do not match.';
    }
    return $errors;
>>>>>>> 2ca820e6270aed379519dc69bfb6c06aaec24b64
}