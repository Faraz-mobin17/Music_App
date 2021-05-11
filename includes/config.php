<?php
ob_start();
session_start();
$timezone = date_default_timezone_set("Asia/Kolkata");
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "slotify";

$con = mysqli_connect($servername,$username,$password,$dbname);

if (mysqli_connect_error())
    echo "failed to connect to mysqli".mysqli_connect_error();