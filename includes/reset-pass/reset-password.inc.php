<?php

if (isset($_POST['reset-password-submit'])) {
    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST["pwd-repeat"];

    if (empty($password) || empty($passwordRepeat)) {
        echo "Please enter do not leave the password feild blank";
        exit();
    } else if ($password != $passwordRepeat) {
        echo "Password do not match";
        exit();
    }
    $currentDate = date("U");
    require '../config.php';
} else {
    header("Location: register.php");
}