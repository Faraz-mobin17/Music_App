<?php

session_unset();
session_destroy();
setcookie('username', '', time() - 86400);
setcookie('password', '', time() - 86400);
header("Location: index.php");
