<?php
include 'db.php';
session_start();

?>

<?php
if (isset($_POST['apply'])) {
	$fname = $_POST['allnames'];
	$idnum = $_POST['id'];
	$service = $_POST['serve'];
	$email = $_POST['email'];
	$residence = $_POST['residence'];
	$phone = $_POST['phone'];

	$query = "INSERT INTO requests(allnames,nationalid,service,status, email,residence, phone) VALUES ('$fname','$idnum', '$service', 'pending','$email','$residence','$phone')";
	$query = mysqli_real_query($conn, $query);
	if (!$query) {
		echo "<div class='text-warning alert alert-warning'><b>Not Sent</b></div> ";
	} else {
		echo "<div class='text-success alert alert-warning'><b>We will call you in a days time.</div>";
	}
}

?>
<!DOCTYPE html>

<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>TUMAINI HOSPITAL - Administrator</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Template by FREEHTML5.CO" />
	<meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive" />
	<meta name="author" content="FREEHTML5.CO" />

	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content="" />
	<meta property="og:image" content="" />
	<meta property="og:url" content="" />
	<meta property="og:site_name" content="" />
	<meta property="og:description" content="" />
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="favicon.ico">

	<!-- <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'> -->

	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<!-- Superfish -->
	<link rel="stylesheet" href="css/superfish.css">

	<link rel="stylesheet" href="css/style.css">


	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

</head>

<body>
	<div id="fh5co-wrapper">
		<div id="fh5co-page">
			<div class="header-top">
				<div class="container">
					<div class="row">
						<div class="col-md-6 col-sm-6 text-left fh5co-link">
							<!-- <a href="#">FAQ</a>
						<a href="#">Forum</a>
						<a href="#">Contact</a> -->
						</div>
						<div class="col-md-12 col-sm-8 text-right fh5co-social">
							<?php
							if (isset($_SESSION['role'])) {
								//welcome 
								// echo $_SESSION['idnumber'];
								$role = $_SESSION['role'];
								$lastname = $_SESSION['lname'];
								$lastname1 = $_SESSION['fname'];

								if ($role == 'admin') {

									echo "<div class='alert alert-info' align ='right'> Welcome:<i class='icon-user icon-red'></i><b>  $lastname1  $lastname        | </b> <a href ='logout.php'><i class='fa fa-bars'></i>			Logout</a>   </div>";
								} else {
									// header('Location:logout.php');
									echo "<script>alert('Error one.');</script>";
								}
							} ?>
						</div>
					</div>
				</div>
			</div>
			<header id="fh5co-header-section" class="sticky-banner">
				<div class="container">
					<div class="nav-header">
						<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle dark"><i></i></a>
						<h1 id="fh5co-logo"><a href="#">TUMAINI HOSPITAL - Administrator</a></h1>
						<!-- START #fh5co-menu-wrap -->
						<nav id="fh5co-menu-wrap" role="navigation">
							<ul class="sf-menu" id="fh5co-primary-menu">
								<li class="active">

								</li>
								<li><a href="#donor">Donors</a></li>
								<li><a href="#feed">Messages</a></li>
								<li><a href="logout.php">Logout</a></li>

							</ul>
						</nav>
					</div>
				</div>
			</header>


			<!-- Start DOnors -->


			<section id="donor" class="slider">

				<div id="fh5co-feature-product" class="fh5co-section-gray">
					<div class="container">
						<div class="row">
							<div class="col-md-12 text-center heading-section">
								<h3>DONATIONS.</h3>



								<table class="table table-default table-border table-striped table-responsive table-hover" border="2.1px">
									<tr class="info">
										<th>Count</th>
										<th>ID NUMBER</th>
										<th>ORGANS</th>
										<th>STATUS</th>
										<th>BLOOD GROUP</th>
										<th>REASON</th>
										<th>RESIDENCE</th>
										<th>Phone Number</th>
										<th>ACTION</th>
									</tr>
									<tbody>
										<?php
										$q1 = "SELECT * FROM DONORS order by count desc";
										$r1 = mysqli_query($conn, $q1);
										while ($ra1 = mysqli_fetch_assoc($r1)) {
											echo "<tr>";
											echo "<td>" . $ra1['count'] . "</td>";
											$count = $ra1['count'];
											$_SESSION['kount'] = $ra1['count'];
											// echo "<td>".$ra1['allnames']."</td>";
											echo "<td>" . $ra1['nationalid'] . "</td>";
											echo "<td>" . $ra1['service'] . "</td>";
											echo "<td>" . $ra1['status'] . "</td>";
											echo "<td>" . $ra1['bloodgroup'] . "</td>";
											echo "<td>" . $ra1['donorreason'] . "</td>";
											echo "<td>" . $ra1['residence'] . "</td>";
											echo "<td>" . $ra1['phone'] . "</td>";
											if ($ra1['status'] == 'pending') {
												echo '<td><a  href="approve1.php?count=' . $count . '" class="btn btn-info">Approve</a></td>';
											} else {
												echo '<td><a  href="view_print2.php?count=' . $count . ' " class="btn btn-primary">Print<span class="glyphicon glyphicon-print"></span></a></td>';
											}
											echo "</tr>";
										}
										?>
									</tbody>
							</div>
							</table>
							<!-- <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p> -->
						</div>
					</div>

					<div class="row row-bottom-padded-md">

					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="feature-text">
								<h3>Love</h3>
								<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
							</div>
						</div>
						<div class="col-md-4">
							<div class="feature-text">
								<h3>Compassion</h3>
								<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
							</div>
						</div>
						<div class="col-md-4">
							<div class="feature-text">
								<h3>Charity</h3>
								<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
							</div>
						</div>
					</div>


				</div>
		</div>
		</section>
		<!-- end:Donors-top -->


		<!-- end:header-top -->

		<section id="about" class="slider">

			<div id="fh5co-feature-product" class="fh5co-section-gray">
				<div class="container">
					<div class="row">
						<div class="col-md-12 text-center heading-section">
							<h3>PATIENTS REQUESTS.</h3>



							<table class="table table-default table-border table-striped table-responsive table-hover" border="2.1px">
								<tr class="info">
									<th>Count</th>
									<th>All-Names</th>
									<th>ID NUMBER</th>
									<th>SERVICE</th>
									<th>STATUS</th>
									<th>EMAIL</th>
									<th>RESIDENCE</th>
									<th>Phone Number</th>
									<th>ACTION</th>
								</tr>
								<tbody>
									<?php
									$q1 = "SELECT * FROM requests order by count desc";
									$r1 = mysqli_query($conn, $q1);
									while ($ra1 = mysqli_fetch_assoc($r1)) {
										echo "<tr>";
										echo "<td>" . $ra1['count'] . "</td>";
										$count = $ra1['count'];
										$_SESSION['kount'] = $ra1['count'];
										echo "<td>" . $ra1['allnames'] . "</td>";
										echo "<td>" . $ra1['nationalid'] . "</td>";
										echo "<td>" . $ra1['service'] . "</td>";
										echo "<td>" . $ra1['status'] . "</td>";
										echo "<td>" . $ra1['email'] . "</td>";
										echo "<td>" . $ra1['residence'] . "</td>";
										echo "<td>" . $ra1['phone'] . "</td>";
										if ($ra1['status'] == 'pending') {
											echo '<td><a  href="approve.php?count=' . $count . '" class="btn btn-info">Approve</a></td>';
										} else {
											echo '<td><a  href="view_print1.php?count=' . $count . ' " class="btn btn-primary">Print<span class="glyphicon glyphicon-print"></span></a></td>';
										}
										echo "</tr>";
									}
									?>
								</tbody>
						</div>
						</table>
						<!-- <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p> -->
					</div>
				</div>

				<div class="row row-bottom-padded-md">

				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="feature-text">
							<h3>Love</h3>
							<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="feature-text">
							<h3>Compassion</h3>
							<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="feature-text">
							<h3>Charity</h3>
							<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
						</div>
					</div>
				</div>


			</div>
	</div>
	</section>

	<!-- END What we do -->

	<section id="feed" class="slider">

		<div id="fh5co-blog-section" class="fh5co-section-gray">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center heading-section animate-box">
						<h3>Contact Us Messages</h3>
						<!-- <p>Drop us a message.</p> -->
					</div>


					<table class="table table-default table-border table-striped table-responsive table-hover" border="2.1px">
						<tr class="info">
							<th>Count</th>
							<th>Firstname</th>
							<th>Lastname</th>
							<th>Email</th>
							<th>Feedback</th>
						</tr>
						<tbody>
							<?php
							$q1 = "SELECT * FROM feedback order by Count desc";
							$r1 = mysqli_query($conn, $q1);
							while ($ra1 = mysqli_fetch_assoc($r1)) {
								echo "<tr>";
								echo "<td>" . $ra1['Count'] . "</td>";
								$count = $ra1['Count'];
								echo "<td>" . $ra1['fname'] . "</td>";
								echo "<td>" . $ra1['lname'] . "</td>";
								echo "<td>" . $ra1['email'] . "</td>";
								echo "<td>" . $ra1['feedback'] . "</td>";
								// echo "<td>".$ra1['email']."</td>";
								// echo "<td>".$ra1['residence']."</td>";
								//	echo "<td>".$ra1['status']."</td>";
								// if($ra1['status']=='pending'){
								// echo '<td><a  href="approve.php?count='.$count.'" class="btn btn-info">Approve</a></td>';
								//  }else{
								//  echo '<td><a  href="view_print.php?count='.$count.'" class="btn btn-primary">Print<span class="glyphicon glyphicon-print"></span></a></td>';
								// }
								echo "</tr>";
							}
							?>
						</tbody>

				</div>

				</table>


			</div>
		</div>

		</div>
		</div>
	</section>
	<!-- fh5co-blog-section -->.
	<section>
		<footer>
			<div id="footer">
				<div class="container">
					<div class="row">
						<div class="col-md-6 col-md-offset-3 text-center">
							<p class="fh5co-social-icons">
								<a href="#"><i class="icon-twitter2"></i></a>
								<a href="#"><i class="icon-facebook2"></i></a>
								<a href="#"><i class="icon-instagram"></i></a>
								<a href="#"><i class="icon-dribbble2"></i></a>
								<a href="#"><i class="icon-youtube"></i></a>
							</p>
							<p>Copyright 2016 Free Html5 <a href="#">Charity</a>. All Rights Reserved. <br>Made with <i class="icon-heart3"></i> by <a href="http://freehtml5.co/" target="_blank">Freehtml5.co</a> / Demo Images: <a href="https://unsplash.com/" target="_blank">Unsplash</a></p>
						</div>
					</div>
				</div>
			</div>
		</footer>


		</div>
		<!-- END fh5co-page -->

		</div>
		<!-- END fh5co-wrapper -->

		<!-- jQuery -->


		<script src="js/jquery.min.js"></script>
		<!-- jQuery Easing -->
		<script src="js/jquery.easing.1.3.js"></script>
		<!-- Bootstrap -->
		<script src="js/bootstrap.min.js"></script>
		<!-- Waypoints -->
		<script src="js/jquery.waypoints.min.js"></script>
		<script src="js/sticky.js"></script>

		<!-- Stellar -->
		<script src="js/jquery.stellar.min.js"></script>
		<!-- Superfish -->
		<script src="js/hoverIntent.js"></script>
		<script src="js/superfish.js"></script>

		<!-- Main JS -->
		<script src="js/main.js"></script>

</body>

</html>