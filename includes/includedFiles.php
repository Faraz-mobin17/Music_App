<?php

if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    include("includes/config.php");
    include("includes/classes/User.php");
    include("includes/classes/Artist.php");
    include("includes/classes/Album.php");
    include("includes/classes/Song.php");
    include("includes/classes/Playlist.php");

    if (isset($_SESSION['userloggedin'])) {
        $userloggedin = new User($con, $_SESSION['userloggedin']);
    } else {

        echo "Username variable not found.check openpage js func";
        exit();
    }
} else {
    include("includes/header.php");
    include("includes/footer.php");
    isset($_SERVER['REQUEST_URI']) ? $url = $_SERVER['REQUEST_URI'] : '';
    echo "<script>openPage('{$url}')</script>";
    exit();
}
