<div id="navBarContainer">
	<nav class="navBar">
		<span onclick="openPage('home.php')" role="link" tabindex="0" class="logo">
			<!-- <img src="assets/images/icons/play.png" alt="play image">
			 -->
			<div class="home-page-icon">
				<!-- <i class="fas fa-music fa-2x"></i> -->
				<img src="assets/images/icons/favicon.ico" alt="play image" style="width: 100%;height:auto;">
			</div>
		</span>
		<div class="group">
			<div class="navItem">
				<span onclick="openPage('search.php')" role="link" tabindex="0" class="navItemLink">Search
					<img src="assets/images/icons/search.png" alt="search icon" class="icon">

				</span>
			</div>
		</div>
		<div class="group">
			<div class="navItem">
				<span onclick="openPage('browse.php')" role="link" tabindex="0" class="navItemLink">Browse</span>
			</div>
			<div class="navItem">
				<span onclick="openPage('yourMusic.php')" role="link" tabindex="0" class="navItemLink">Your Music</span>
			</div>
			<div class="navItem">
				<span onclick="openPage('settings.php')" role="link" tabindex="0" class="navItemLink" style="text-transform: capitalize;"><?php echo $userloggedin->getUsername(); ?></span>
			</div>
			<div class="navItem btn-danger">
				<!-- <span onclick="openPage('logout.php')" role="link" tabindex="0" class="navItemLink">Logout</span> -->
				<a href="logout.php" role="link" tabindex="0" class="navItemLink " style="color:white;">Logout</a>
			</div>
		</div>
	</nav>
</div>