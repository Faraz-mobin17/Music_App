<?php
if (isset($_POST['loginButton'])) {
    //echo "login button was pressed";
    $username = $_POST['loginUsername'];
    $password = $_POST['loginPassword'];
    // login function
    $result = $account->login($username, $password);

    if ($result == true) {
        $_SESSION['userloggedin'] = $username;
        header("Location: home.php");
    } else {
        echo "some error";
    }
}
