<?php 

	// error_reporting(0);

    $page = 'view-single-agency.php';
    $title = 'View Record | GypsyG';
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

			<!-- Main Content -->
			<div class="app-content  my-3 my-md-5">
				<div class="side-app">
					<div class="page-header">
						<h4 class="page-title">
                            <a href="all-agency.php">
                                << Back 
                            </a>
                        </h4>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
							<li class="breadcrumb-item active" aria-current="page">View Agency</li>
						</ol>
					</div>
                    
                    <!-- START CONTENT -->
                    <?php 

                        $id = $_GET['id'];
        
                        // Create SQL SELECT Statement
                        $sql = "SELECT * FROM agency WHERE id = $id";
        
                        // Use PDO Prepared to sanitize data
                        $stmt = $db->prepare($sql);
        
                        $stmt->execute();
        
                        $result = $stmt->fetchAll();
        
                        if (!empty($result)) {
        
                            foreach($result as $row) {

                    ?>  

                        <div class="row">
							<div class="col-lg-4 col-xl-3">
								<div class="card card-profile cover-image" data-image-src="<?php echo $url; ?>assets/images/other/profile-bg.jpg">
									<div class="card-body text-center">
										<div>
											<img src="<?php echo $row['profile']; ?>" alt="user_profile" class="card-profile-img">
										</div>

										<h3 class="mb-1 text-white">
											<?php echo $row['company']; ?>
                                        </h3>

                                        <?php if($row['status'] == 'Active') : ?>
                                            <span class="btn btn-success btn-sm">* <?php echo $row['status']; ?></span>
                                        <?php else: ?>
                                            <span class="btn btn-danger btn-sm">* <?php echo $row['status']; ?></span>
                                        <?php endif; ?>
									</div>
								</div>

								<div class="card card-profile cover-image ">
									<div class="card-body text-center">
										<div class="row">
											<div class="col-md-12">
												<a href="create-agency.php?edit=<?php echo $row['id']; ?>" class="btn btn-warning text-white mr-2 mt-2 btn-block">
													<span class="fa fa-pencil"></span> &nbsp; Edit Profile
												</a>
											</div>

											<div class="col-md-12">
												<a href="change-password.php" class="btn btn-success mt-2 btn-block">
													<i class="fa fa-refresh" aria-hidden="true"></i> &nbsp; Reset Password
												</a>
											</div>
										</div>
									</div>
                                </div>
                                
                                <div class="card">
                                    <div class="card-header">
										<h4 class="card-title">Documents</h4>
                                    </div>
                                    
									<div class="card-body text-center">

									</div>
								</div>
							</div>

							<div class="col-lg-8 col-xl-9">
								<div class="card">
									<div class="card-header">
										<h4 class="card-title">Personal Information</h4>
									</div>

									<div class="card-body">
										<div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="media-list">
                                                            <!-- Record 1 -->
                                                            <div class="media mt-1 pb-2">
                                                                <div class="mediaicon">
                                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="card-body ml-5 p-1">
                                                                    <h6 class="mediafont text-dark">Name</h6>
                                                                    <p class="d-block"><?php echo $row['name']; ?></p>
                                                                </div>
                                                                <!-- media-body -->
                                                            </div>
                                                        </div>
                                                        <!-- media-list -->
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="media-list">
                                                            <!-- Record 1 -->
                                                            <div class="media mt-1 pb-2">
                                                                <div class="mediaicon">
                                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="card-body ml-5 p-1">
                                                                    <h6 class="mediafont text-dark">Date of Birth</h6>
                                                                    <p class="d-block"><?php echo $row['dob']; ?></p>
                                                                </div>
                                                                <!-- media-body -->
                                                            </div>
                                                        </div>
                                                        <!-- media-list -->
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="media-list">
                                                            <!-- Record 1 -->
                                                            <div class="media mt-1 pb-2">
                                                                <div class="mediaicon">
                                                                    <i class="fa fa-<?php echo $row['gender']; ?>" aria-hidden="true"></i>
                                                                </div>

                                                                <div class="card-body ml-5 p-1">
                                                                    <h6 class="mediafont text-dark">Gender</h6>
                                                                    <p class="d-block"><?php echo $row['gender']; ?></p>
                                                                </div>
                                                                <!-- media-body -->
                                                            </div>
                                                        </div>
                                                        <!-- media-list -->
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="media-list">
                                                            <!-- Record 1 -->
                                                            <div class="media mt-1 pb-2">
                                                                <div class="mediaicon">
                                                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="card-body ml-5 p-1">
                                                                    <h6 class="mediafont text-dark">Phone Number</h6>
                                                                    <p class="d-block"><?php echo $row['phone']; ?></p>
                                                                </div>
                                                                <!-- media-body -->
                                                            </div>
                                                        </div>
                                                        <!-- media-list -->
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="media-list">
                                                            <!-- Record 1 -->
                                                            <div class="media mt-1 pb-2">
                                                                <div class="mediaicon">
                                                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="card-body ml-5 p-1">
                                                                    <h6 class="mediafont text-dark">Email Id</h6>
                                                                    <p class="d-block"><?php echo $row['email']; ?></p>
                                                                </div>
                                                                <!-- media-body -->
                                                            </div>
                                                        </div>
                                                        <!-- media-list -->
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="media-list">
                                                            <!-- Record 1 -->
                                                            <div class="media mt-1 pb-2">
                                                                <div class="mediaicon">
                                                                    <i class="fa fa-home" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="card-body ml-5 p-1">
                                                                    <h6 class="mediafont text-dark">Address</h6>
                                                                    <p class="d-block"><?php echo $row['address']; ?></p>
                                                                </div>
                                                                <!-- media-body -->
                                                            </div>
                                                        </div>
                                                        <!-- media-list -->
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="media-list">
                                                            <!-- Record 1 -->
                                                            <div class="media mt-1 pb-2">
                                                                <div class="mediaicon">
                                                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="card-body ml-5 p-1">
                                                                    <h6 class="mediafont text-dark">State</h6>
                                                                    <p class="d-block"><?php echo $row['state']; ?></p>
                                                                </div>
                                                                <!-- media-body -->
                                                            </div>
                                                        </div>
                                                        <!-- media-list -->
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="media-list">
                                                            <!-- Record 1 -->
                                                            <div class="media mt-1 pb-2">
                                                                <div class="mediaicon">
                                                                    <i class="fa fa-bookmark" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="card-body ml-5 p-1">
                                                                    <h6 class="mediafont text-dark">City</h6>
                                                                    <p class="d-block"><?php echo $row['city']; ?></p>
                                                                </div>
                                                                <!-- media-body -->
                                                            </div>
                                                        </div>
                                                        <!-- media-list -->
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="media-list">
                                                            <!-- Record 1 -->
                                                            <div class="media mt-1 pb-2">
                                                                <div class="mediaicon">
                                                                    <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="card-body ml-5 p-1">
                                                                    <h6 class="mediafont text-dark">Pin Code</h6>
                                                                    <p class="d-block"><?php echo $row['pin_code']; ?></p>
                                                                </div>
                                                                <!-- media-body -->
                                                            </div>
                                                        </div>
                                                        <!-- media-list -->
                                                    </div>
                                                </div>
                                            </div>
										</div>
									</div>
                                </div>
                                
                                <div class="card">
									<div class="card-header">
										<h4 class="card-title">Official Information</h4>
									</div>

									<div class="card-body">
										<div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="media-list">
                                                            <!-- Record 1 -->
                                                            <div class="media mt-1 pb-2">
                                                                <div class="mediaicon">
                                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="card-body ml-5 p-1">
                                                                    <h6 class="mediafont text-dark">Branch</h6>
                                                                    <p class="d-block"><?php echo $row['branch']; ?></p>
                                                                </div>
                                                                <!-- media-body -->
                                                            </div>
                                                        </div>
                                                        <!-- media-list -->
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="media-list">
                                                            <!-- Record 1 -->
                                                            <div class="media mt-1 pb-2">
                                                                <div class="mediaicon">
                                                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="card-body ml-5 p-1">
                                                                    <h6 class="mediafont text-dark">Package</h6>
                                                                    <p class="d-block"><?php echo $row['package']; ?></p>
                                                                </div>
                                                                <!-- media-body -->
                                                            </div>
                                                        </div>
                                                        <!-- media-list -->
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="media-list">
                                                            <!-- Record 1 -->
                                                            <div class="media mt-1 pb-2">
                                                                <div class="mediaicon">
                                                                    <i class="fa fa-university" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="card-body ml-5 p-1">
                                                                    <h6 class="mediafont text-dark">Bank</h6>
                                                                    <p class="d-block"><?php echo $row['bank']; ?></p>
                                                                </div>
                                                                <!-- media-body -->
                                                            </div>
                                                        </div>
                                                        <!-- media-list -->
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="media-list">
                                                            <!-- Record 1 -->
                                                            <div class="media mt-1 pb-2">
                                                                <div class="mediaicon">
                                                                    <i class="fa fa-sitemap" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="card-body ml-5 p-1">
                                                                    <h6 class="mediafont text-dark">Branch</h6>
                                                                    <p class="d-block"><?php echo $row['bank_branch']; ?></p>
                                                                </div>
                                                                <!-- media-body -->
                                                            </div>
                                                        </div>
                                                        <!-- media-list -->
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="media-list">
                                                            <!-- Record 1 -->
                                                            <div class="media mt-1 pb-2">
                                                                <div class="mediaicon">
                                                                    <i class="fa fa-credit-card" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="card-body ml-5 p-1">
                                                                    <h6 class="mediafont text-dark">Accound Number</h6>
                                                                    <p class="d-block"><?php echo $row['account_no']; ?></p>
                                                                </div>
                                                                <!-- media-body -->
                                                            </div>
                                                        </div>
                                                        <!-- media-list -->
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="media-list">
                                                            <!-- Record 1 -->
                                                            <div class="media mt-1 pb-2">
                                                                <div class="mediaicon">
                                                                    <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="card-body ml-5 p-1">
                                                                    <h6 class="mediafont text-dark">IFSC Code</h6>
                                                                    <p class="d-block"><?php echo $row['ifsc_code']; ?></p>
                                                                </div>
                                                                <!-- media-body -->
                                                            </div>
                                                        </div>
                                                        <!-- media-list -->
                                                    </div>
                                                </div>
                                            </div>
										</div>
									</div>
                                </div>
                            </div>
                            <!-- col-lg-8 -->
						</div>
                    
                                
                    <?php

                            } 
                            
                        }
                        
                    ?>
					<!-- END CONTENT -->
                    
				</div>
			</div>
		</div>

<?php include('include/footer.php'); ?>   