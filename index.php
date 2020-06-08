<?php 

	error_reporting(0);

    $page = 'index.php';
    $title = 'GypsyG | Gypsy Granary Hub Marketing Pvt. Ltd.';
    $description = 'Ecommerce, Daily needs';
	$keywords = '';

	// Include ParseProfle page
	include_once('partials/parseProfile.php');

	// redirect user to login page if they're not logged in
	include('session-restrict-admin.php');

	guard();

	// Include Header File
	include('include/header.php'); 

?>

	<!-- START CONTENT -->
	<div class="page">
		<div class="page-main">
		
			<!-- Include Sidebar -->
			<?php include('include/sidebar.php'); ?>

			<div class="app-content  my-3 my-md-5">
				<div class="side-app">
					<!-- Breadcrumb -->
					<div class="page-header">
						<h4 class="page-title">Dashboard</h4>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.php">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
						</ol>
					</div>

					<div class="row">
						<!-- Total Earned -->
						<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3 ">
							<div class="card overflow-hidden">
								<div class="card-body">
									<div class="float-left">
										<h5 class="">Total Earned</h5>
										<h2 class="text-dark  mt-0 "> <i class="fa fa-inr"></i> 7,00,000</h2>
									</div>
									
									<div class="float-right">
										<div class="mt-4">
											<i class="fa fa-3x fa-pie-chart" aria-hidden="true"></i>
										</div>
									</div>
								</div>
								<a href="sell-report.php">
									<div class="card-footer bg-primary text-white">
										View Report
									</div>
								</a>
							</div>
						</div>

						<!-- Coin Balance -->
						<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3 ">
							<div class="card overflow-hidden">
								<div class="card-body">
									<div class="float-left">
										<h5 class="">Total Agency</h5>
										<h2 class="text-dark  mt-0 ">10</h2>
									</div>
									
									<div class="float-right">
										<div class="mt-4">
											<i class="fa fa-3x fa-sitemap" aria-hidden="true"></i>
										</div>
									</div>
								</div>
								<a href="agency-lists.php">
									<div class="card-footer bg-primary text-white">
										View Agency's
									</div>
								</a>
							</div>
						</div>

						<!-- Total DL -->
						<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3 ">
							<div class="card overflow-hidden">
								<div class="card-body">
									<div class="float-left">
										<h5 class="">Total Vendor</h5>
										<h2 class="text-dark  mt-0 ">100</h2>
									</div>
									
									<div class="float-right">
										<div class="mt-4">
											<i class="fa fa-3x fa-user-plus" aria-hidden="true"></i>
										</div>
									</div>
								</div>
								<a href="dl-lists.php">
									<div class="card-footer bg-primary text-white">
										View Vendor's
									</div>
								</a>
							</div>
						</div>

						<!-- Total Game Played -->
						<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3 ">
							<div class="card overflow-hidden">
								<div class="card-body">
									<div class="float-left">
										<h5 class="">Total Seller</h5>
										<h2 class="text-dark  mt-0 ">150</h2>
									</div>
									
									<div class="float-right">
										<div class="mt-4">
											<i class="fa fa-3x fa-star" aria-hidden="true"></i>
										</div>
									</div>
								</div>
								<a href="game-wise-report.php">
									<div class="card-footer bg-primary text-white">
										View Seller's
									</div>
								</a>
							</div>
						</div>

						<!-- Today Games -->
						<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3 ">
							<div class="card overflow-hidden">
								<div class="card-body">
									<div class="float-left">
										<h5 class="">Total Customer</h5>
										<h2 class="text-dark  mt-0 ">5,000</h2>
									</div>
									
									<div class="float-right">
										<div class="mt-4">
											<i class="fa fa-3x fa-users" aria-hidden="true"></i>
										</div>
									</div>
								</div>
								<a href="game-wise-report.php">
									<div class="card-footer bg-primary text-white">
										View Customers
									</div>
								</a>
							</div>
						</div>

						<!-- Active Tables -->
						<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3 ">
							<div class="card overflow-hidden">
								<div class="card-body">
									<div class="float-left">
										<h5 class="">Live Orders</h5>
										<h2 class="text-dark  mt-0 ">4,657</h2>
									</div>
									
									<div class="float-right">
										<div class="mt-4">
											<i class="fa fa-3x fa-shopping-bag" aria-hidden="true"></i>
										</div>
									</div>
								</div>
								<a href="active-tables.php">
									<div class="card-footer bg-primary text-white">
										View Orders 
									</div>
								</a>
							</div>
						</div>

						<!-- Active Players -->
						<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3 ">
							<div class="card overflow-hidden">
								<div class="card-body">
									<div class="float-left">
										<h5 class="">Active Area</h5>
										<h2 class="text-dark  mt-0 ">50</h2>
									</div>
									
									<div class="float-right">
										<div class="mt-4">
											<i class="fa fa-3x fa-map-marker" aria-hidden="true"></i>
										</div>
									</div>
								</div>
								<a href="active-players.php">
									<div class="card-footer bg-primary text-white">
										View Pin Codes
									</div>
								</a>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>

<?php include('include/footer.php'); ?>   