<?php
include("includes/config.php");
$query = "SELECT artworkPath FROM albums";
$result = mysqli_query($con, $query);
?>
<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="assets/images/icons/favicon.ico" type="image/x-icon">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<link rel="stylesheet" href="assets/css/index.css">
	<title>Musify</title>
</head>

<body>
	<section id="cover" class="p-5">
		<div class="container px-5">
			<nav class="navbar navbar-expand-lg navbar-dark bg-transparent rounded justify-content-center">
				<div class="container-fluid">
					<a class="navbar-brand" href="#">Musify</a>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav mx-auto mb-2 mb-lg-0 d-flex justify-content-between">
							<li class="nav-item">
								<a class="nav-link active" aria-current="page" href="#cover">Home</a>
							</li>
							<li class="nav-item">
								<a class="nav-link e" aria-current="page" href="#bottom">Library</a>
							</li>
							<li class="nav-item">
								<a class="nav-link " aria-current="page" href="#pricing">Pricing</a>
							</li>
						</ul>
						<form class="d-flex">

							<a class="btn btn-light fw-bold text-success  px-5" style="border-radius: 200px;" href="register.php">Login</a>
						</form>
					</div>
				</div>
			</nav>
		</div>
		<div class="container px-5 mt-5 h-50 d-flex flex-row align-items-center">
			<h1 class="display-2 text-white fw-bold w-75">Melodies that will help you stay focus.</h1>
		</div>
		<div class="container">
			<div class="mx-5 d-flex flex-start shadow" style="width: 600px;">

				<input type="text" class="form-control py-4" placeholder="Enter your Email..." aria-label="Recipient's username" aria-describedby="basic-addon2" style="border-radius: 200px;outline:none;border:none;">
				<button class="btn text-white myStyle text-uppercase">subscribe</button>
			</div>
		</div>
	</section>
	<section id="bottom" class="p-5">
		<div class="container">
			<h3 class="h3 fw-bold">Featured Melody</h3>
			<div class="row">

				<div class="col-md-3">
					<div class="box">
						<div class="img-container img-one shadow">
							<span class="time">9 min</span>
						</div>
						<h6 class="h6 mt-4 fw-bolder">Moment of Silence</h6>
						<span class="fw-light" style="font-size: 14px;">Thomas Wise</span>
					</div>
				</div>
				<div class="col-md-3">
					<div class="box">
						<div class="img-container img-two shadow">
							<span class="time">5 min</span>
						</div>
						<h6 class="h6 mt-4 fw-bolder">The Sound of nature</h6>
						<span class="fw-light" style="font-size: 14px;">Somanthia William</span>
					</div>
				</div>
				<div class="col-md-3">
					<div class="box">
						<div class="img-container img-three shadow">
							<span class="time">4 min</span>
						</div>
						<h6 class="h6 mt-4 fw-bolder">Fantastic Wave</h6>
						<span class="fw-light" style="font-size: 14px;">Korean Smith</span>
					</div>
				</div>
				<div class="col-md-3">
					<h4 class="h4 fw-bold text-left">Weekly Popular</h4>
					<ol class="pt-4">
						<div class="list-item-container">
							<li class="fw-bold pl-2">Harmony in our life</li>
							<span class="fw-normal" style="font-size: 12px;">1,985,098 played</span>
						</div>
						<div class="list-item-container">
							<li class="fw-bold pl-2">Sound of nature</li>
							<span class="fw-normal" style="font-size: 12px;">1,725,091 played</span>
						</div>
						<div class="list-item-container">
							<li class="fw-bold pl-2">Fantastic Wave</li>
							<span class="fw-normal" style="font-size: 12px;">1,000,000 played</span>
						</div>
					</ol>

				</div>
			</div>

		</div>
	</section>

	<section id="artists" class="p-5">
		<div class="container">
			<h3 class="h3 fw-bold">Artists</h3>

			<div class="d-flex align-items-center justify-content-center">
				<?php
				while ($row = mysqli_fetch_assoc($result)) :
				?>
					<div class="img-artist d-flex align-items-center p-2">
						<img src="<?php echo $row['artworkPath']; ?>" alt="image" class="img-fluid shadow">
					</div>
				<?php endwhile; ?>
			</div>

		</div>
	</section>
	<section id="pricing" class="p-5">
		<div class="container">
			<h3 class="h3 fw-bold">Pricing</h3>
			<br>
			<div class="card-deck mb-3 text-center">
				<div class="row">

					<div class="col-md-4">
						<div class="card mb-4 box-shadow shadow">
							<div class="card-header ">
								<h4 class="my-0 font-weight-normal">Pro</h4>
							</div>
							<div class="card-body">
								<h1 class="card-title pricing-card-title">$15 <small class="text-muted">/ mo</small></h1>
								<ul class="list-unstyled mt-3 mb-4">
									<li>20 users included</li>
									<li>10 GB of storage</li>
									<li>Priority email support</li>
									<li>Help center access</li>
								</ul>
								<a href="register.php" class="btn btn-lg btn-block btn-primary ">Get started</a>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card mb-4 box-shadow shadow">
							<div class="card-header ">
								<h4 class="my-0 font-weight-normal">Free</h4>
							</div>
							<div class="card-body">
								<h1 class="card-title pricing-card-title">$0 <small class="text-muted">/ mo</small></h1>
								<ul class="list-unstyled mt-3 mb-4">
									<li>10 users included</li>
									<li>2 GB of storage</li>
									<li>Email support</li>
									<li>Help center access</li>
								</ul>
								<a href="register" class="btn btn-lg btn-block btn-outline-primary">Sign up for free</a>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card mb-4 box-shadow shadow">
							<div class="card-header">
								<h4 class="my-0 font-weight-normal">Enterprise</h4>
							</div>
							<div class="card-body">
								<h1 class="card-title pricing-card-title">$29 <small class="text-muted">/ mo</small></h1>
								<ul class="list-unstyled mt-3 mb-4">
									<li>30 users included</li>
									<li>15 GB of storage</li>
									<li>Phone and email support</li>
									<li>Help center access</li>
								</ul>
								<button type="button" class="btn btn-lg btn-block btn-primary  ">Contact us</button>
							</div>
						</div>
					</div>
				</div>



			</div>

	</section>



	<footer class="p-5 position-relative">
		<div class="row position-absolute move text-center text-white">
			<div class="col-md-4">
				<ul>
					<li>Phone: 9191919191</li>
					<li>Email: something@something.com</li>
					<li>Fax: XYZ-ABC-DFE</li>
				</ul>
			</div>
			<div class="col-md-4">
				<ul>
					<li>Youtube</li>
					<li>Facebook</li>
					<li>Twitter</li>
				</ul>
			</div>
			<div class="col-md-4">
				<ul>
					<li>Terms and Condition</li>
					<li>Privacy and Policies</li>
					<li>Contact Us</li>
				</ul>
			</div>

		</div>
		<p class="text-center text-white position-absolute fixed-bottom">&copy; 2021 All right Reserved</p>
	</footer>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</body>

</html>