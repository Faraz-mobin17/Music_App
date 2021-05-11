<?php
include("../../config.php");
if (isset($_POST['name']) && isset($_POST['username'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];

    $query = mysqli_query($con, "DELETE FROM playlists WHERE name='$name'");
} else {
    echo "Name or username params not passed into file";
}
