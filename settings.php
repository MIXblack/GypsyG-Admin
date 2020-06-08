<?php 

	error_reporting(0);

    $page = 'settings.php';
    $title = 'Settings | MIX Ludo';
    $description = 'Play ludo and win excited price, MIX Ludo, mix ludo game';
	$keywords = '';

	// Include ParseProfle page
	include_once('partials/parseProfile.php');

	// redirect user to login page if they're not logged in
	include('session-restrict-admin.php');

	guard();

	// Include Header File
	include('include/header.php'); 

?>

		<div class="page">
			<div class="page-main">
				
				<?php include('include/sidebar.php'); ?>

				<!-- Main Content -->
				<div class="app-content  my-3 my-md-5">
					<div class="side-app">
						<div class="page-header">
							<h4 class="page-title">Settings</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.php">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Settings</li>
							</ol>
						</div>

						<div class="row">
							<div class="col-lg-5 col-xl-4">
								<div>									
									<?php if (isset($msg)) { echo $msg; } ?>
								</div>

								<div class="card card-profile cover-image" data-image-src="assets/images/other/profile-bg.jpg">
									<div class="card-body text-center">
										<div>
											<img src="<?php 
													if($profile_picture !== 'uploads/default.png') {
														echo $profile_picture; 
													} else { ?>
														<?php echo $url; ?>assets/images/other/default-user.png
													<?php }
												
												?>" alt="user_profile" class="card-profile-img">
											<a href="edit-profile.php" class="mix-edit-profile" title="Edit Profile">
												<span class="fa fa-pencil" aria-hidden="true"></span>
											</a>
										</div>

										<h4 class="mb-1 text-white">
											<?php if(isset($name)) echo $name; ?>
										</h4>

										<p class="mb-1 text-white">
											<?php if(isset($email)) echo $email; ?>
										</p>
										
										<a href="edit-profile.php?id=<?php echo $_SESSION['id']; ?>" class="btn btn-warning text-white mr-2 mt-2">
											<span class="fa fa-pencil"></span> &nbsp; Edit Profile
										</a>

										<a href="change-password.php?id=<?php echo $_SESSION['id']; ?>" class="btn btn-success mt-2">
											<i class="fa fa-refresh" aria-hidden="true"></i> &nbsp; Change Password
										</a>
									</div>
								</div>
							</div>

							<div class="col-lg-7 col-xl-8">
								<div class="card">
									<div class="card-header">
										<h4 class="card-title">About me</h4>
									</div>

									<div class="card-body">
										<div class="row">
											<?php 

												$user_id = $_SESSION['id'];

												// Create SQL Insert Statement
												$sql = "SELECT * FROM admin WHERE id = '$user_id'";

												// Use PDO Prepared to sanitize data
												$stmt = $db->prepare($sql);

												$stmt->execute();

												$result = $stmt->fetchAll();

												if (!empty($result)) {

													foreach($result as $row) {

											?>  

														<div class="col-md-6">
															<div class="media-list">
																<!-- Record 1 -->
																<div class="media mt-1 pb-2">
																	<div class="mediaicon">
																		<i class="fa fa-user" aria-hidden="true"></i>
																	</div>
																	<div class="card-body ml-5 p-1">
																		<h6 class="mediafont text-dark">Email</h6>
																		<p class="d-block"><?php echo $row['email']; ?></p>
																	</div>
																	<!-- media-body -->
																</div>
															</div>
															<!-- media-list -->
														</div>

											<?php 
														
													}
												}
											
											?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

<?php include('include/footer.php'); ?>   