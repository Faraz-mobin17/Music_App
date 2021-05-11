<?php
include("includes/config.php"); ?>
<?php include("includes/classes/Artist.php"); ?>
<?php include("includes/classes/Album.php"); ?>
<?php include("includes/classes/Song.php"); ?>
<?php include("includes/classes/User.php"); ?>
<?php
if (isset($_SESSION['userloggedin'])) {
	$un = $_SESSION['userloggedin']; // username is stored here
	$userloggedin = new User($con, $_SESSION['userloggedin']);
	echo "<script>userloggedin = '{$un}';</script>"; // $userloggedin->getUsername() can also be done
} else {
	header("Location: register.php");
}

?>
<html>

<head>
	<title>Welcome to Slotify!</title>

	<link rel="stylesheet" href="style.css">
	<script src="https://kit.fontawesome.com/3dee8755de.js" crossorigin="anonymous"></script>
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/script.js"></script>

</head>

<body>

	<div id="mainContainer">
		<div id="topContainer">
			<?php include("includes/navBarContainer.php"); ?>

			<div id="mainViewContainer">
				<div id="mainContent">