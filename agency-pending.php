<?php 

	// error_reporting(0);

    $page = 'agency-pending.php';
    $title = 'Agency Pending | GypsyG';
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
						<h4 class="page-title">Pending Agency</h4>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
							<li class="breadcrumb-item active" aria-current="page">Pending Agency</li>
						</ol>
					</div>

					<!-- START CONTENT -->
					<div class="row">
						<div class="col-lg-12 col-xl-12 mx-auto">
							<div class="panel panel-primary mb-2">
								<div class=" ">
									<ul class="nav nav-pills">
										<li class="nav-item m-2">
											<a class="nav-link btn btn-light" href="create-agency.php">CREATE AGENCY</a>
										</li>

										<li class="nav-item m-2">
											<a class="nav-link btn btn-primary" href="agency-pending.php">PENDING REQUESTS</a>
										</li>

										<li class="nav-item m-2">
											<a class="nav-link btn btn-light" href="all-agency.php">ALL AGENCY</a>
										</li>
									</ul>
								</div>
							</div>

							<div class="card">
								<div class="card-body">
									<!-- Display Messages -->
									<div>									
										<?php if (isset($msg)) { echo $msg; } ?>

										<?php if (!empty($form_errors)) { echo show_errors($form_errors); } ?>
									</div>
									
									<?php 

										$user_id = $_SESSION['id'];

										// Create SQL SELECT Statement
										$sql = "SELECT * FROM agency WHERE super_admin = $user_id AND status = 'Pending' ORDER BY id DESC";

										// Use PDO Prepared to sanitize data
										$stmt = $db->prepare($sql);

										$stmt->execute();

										$result = $stmt->fetchAll();

									?>  

									<div class="table-responsive">
										<table id="example" class="table table-striped table-bordered" >
											<thead>
												<tr>
													<th>#</th>
													<th>NAME</th>
													<th>DOB</th>
													<th>GENDER</th>
													<th>PHONE</th>
													<th>EMAIL ID</th>
													<th>BRANCH</th>
													<th>PACKAGE</th>
													<th>STATUS</th>
													<th>Action</th>
												</tr>
											</thead>

											<tbody>
												<?php 
													
													$i = 1;

													if (!empty($result)) {

														foreach($result as $row) {
												?>

													<tr class="text-center">
														<th scope="row"><?php echo $i++; ?></th>
														<td>
															<div class="d-flex">
																<span class="avatar avatar-md d-block brround cover-image mr-3" data-image-src="<?php echo $row['profile']; ?>"></span> 
																<span class="mt-2"><?php echo $row['name']; ?></span>
															</div>
														</td>
														
														<td><?php echo $row['dob']; ?></td>
														<td><?php echo $row['gender']; ?></td>
														<td><?php echo $row['phone']; ?></td>
														<td><?php echo $row['email']; ?></td>
														<td><?php echo $row['branch']; ?></td>
														<td><?php echo $row['package']; ?></td>
														<td><?php echo $row['status']; ?></td>

														<td>
															<a href="single-.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm mb-2" title="View">
																<i class="fa fa-eye" aria-hidden="true"></i>
															</a>

															<a href="single-.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm mb-2" title="Edit">
																<i class="fa fa-pencil" aria-hidden="true"></i>
															</a>

															<?php if ($row['block'] === '0') { ?>

																<a href="#" data-id="<?php echo $row['id']; ?>" class="btn btn-danger btn-sm userBlock mb-2" data-toggle="modal" data-target="#block"  title="Block">
																	<i class="fa fa-ban" aria-hidden="true"></i>
																</a>

															<?php } else { ?>

																<a href="#" data-id="<?php echo $row['id']; ?>" class="btn btn-success btn-sm userActivate mb-2" data-toggle="modal" data-target="#active"  title="Activate">
																	<i class="fa fa-check" aria-hidden="true"></i>

																</a>

															<?php } ?>

															<a href="all-dls.php?del=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?');" class="btn btn-light text-danger btn-sm mb-2" title="Delete">
															<i class="fa fa-times" aria-hidden="true"></i>
															</a>
														</td>
													</tr>

												<?php 
											
														}
													}
												
												?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- END CONTENT -->
				</div>
			</div>
		</div>

<?php include('include/footer.php'); ?>   