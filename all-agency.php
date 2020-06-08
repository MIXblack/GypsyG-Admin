<?php 

	// error_reporting(0);

    $page = 'all-agency.php';
    $title = 'All Agency | GypsyG';
    $description = 'Ecommerce, Daily needs';
	$keywords = '';

	// Include ParseCreateAgency page
	include_once('partials/parseCreateAgency.php');

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
						<h4 class="page-title">All Agency</h4>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
							<li class="breadcrumb-item active" aria-current="page">All Agency</li>
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
											<a class="nav-link btn btn-light" href="agency-pending.php">PENDING REQUESTS</a>
										</li>

										<li class="nav-item m-2">
											<a class="nav-link btn btn-primary" href="all-agency.php">ALL AGENCY</a>
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
										$sql = "SELECT * FROM agency WHERE super_admin = $user_id AND status != 'Pending' ORDER BY id DESC";

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
													<th>PHONE</th>
													<th>EMAIL ID</th>
													<th>BRANCH</th>
													<th>PACKAGE</th>
													<th>STATUS</th>
													<th>REMARKS</th>
													<th>Action</th>
												</tr>
											</thead>

											<tbody>
												<?php 
													
													$i = 1;

													if (!empty($result)) {

														foreach($result as $row) {

															if($row['status'] == "Blocked") {
												?>

																<tr class="text-center bg-table-danger">
																	<th scope="row"><?php echo $i++; ?></th>

																	<td>
																		<div class="d-flex">
																			<span class="avatar avatar-md  d-block brround cover-image mr-3" data-image-src="<?php echo $row['profile']; ?>"></span> 
																			<span><?php echo $row['name']; ?></span>
																		</div>
																	</td>
																	
																	<td><?php echo $row['phone']; ?></td>

																	<td><?php echo $row['email']; ?></td>

																	<td><?php echo $row['branch']; ?></td>

																	<td><?php echo $row['package']; ?></td>

																	<?php if($row['status'] == 'Active') : ?>
																		<td class="text-success"><?php echo $row['status']; ?></td>
																	<?php else: ?>
																		<td class="text-danger"><?php echo $row['status']; ?></td>
																	<?php endif; ?>

																	<td><?php echo $row['block_remark']; ?></td>

																	<td>
																		<a href="view-single-agency.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm mb-2" title="View">
																			<i class="fa fa-eye" aria-hidden="true"></i>
																		</a>

																		<a href="create-agency.php?edit=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm mb-2" title="Edit">
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

																		<a href="all-agency.php?del=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?');" class="btn btn-light text-danger btn-sm mb-2" title="Delete">
																		<i class="fa fa-times" aria-hidden="true"></i>
																		</a>
																	</td>
																</tr>

															<?php } else { ?>

																<tr class="text-center bg-table-success">
																	<th scope="row"><?php echo $i++; ?></th>

																	<td>
																		<div class="d-flex">
																			<span class="avatar avatar-md  d-block brround cover-image mr-3" data-image-src="<?php echo $row['profile']; ?>"></span> 
																			<span><?php echo $row['name']; ?></span>
																		</div>
																	</td>
																	
																	<td><?php echo $row['phone']; ?></td>

																	<td><?php echo $row['email']; ?></td>

																	<td><?php echo $row['branch']; ?></td>

																	<td><?php echo $row['package']; ?></td>

																	<?php if($row['status'] == 'Active') : ?>
																		<td class="text-success"><?php echo $row['status']; ?></td>
																	<?php else: ?>
																		<td class="text-danger"><?php echo $row['status']; ?></td>
																	<?php endif; ?>

																	<td><?php echo $row['block_remark']; ?></td>

																	<td>
																		<a href="view-single-agency.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm mb-2" title="View">
																			<i class="fa fa-eye" aria-hidden="true"></i>
																		</a>

																		<a href="create-agency.php?edit=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm mb-2" title="Edit">
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

																		<a href="all-agency.php?del=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?');" class="btn btn-light text-danger btn-sm mb-2" title="Delete">
																		<i class="fa fa-times" aria-hidden="true"></i>
																		</a>
																	</td>
																</tr>

															<?php } ?>

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

		<!-- ================================ MODAL ======================== -->
			<!-- User Block Modal -->
			<div class="modal fade" id="block" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content ">
						<div class="modal-header pd-x-20">
							<h6 class="modal-title">User Id = # <span id="block_id"></span></h6>

							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						
						<form action="all-agency.php" method="post">
						
							<div class="modal-body pd-20">
								<div class="form-group">
									<label class="col-form-label">Remark</label>
									<textarea required class="form-control" name="block_remark" rows="4" placeholder="Comment..."></textarea>
								</div>

								<input type="hidden" name="user_id" id="user_block_id">
							</div><!-- modal-body -->

							<div class="modal-footer">
								<button type="submit" name="block_btn" class="btn btn-primary mr-3">
									<i class="fa fa-paper-plane" aria-hidden="true"></i> &nbsp;
									Submit
								</button>
								<button type="button" class="btn btn-light text-danger" data-dismiss="modal">Close</button>
							</div>

						</form>
					</div>
				</div>
			</div>

			<!-- User Active Modal -->
			<div class="modal fade" id="active" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content ">
						<div class="modal-header pd-x-20">
							<h6 class="modal-title">User Id = #<span id="activate_id"></span></h6>

							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						
						<form action="all-agency.php" method="post">
						
							<div class="modal-body pd-20">
								<div class="form-group">
									<label class="col-form-label">Remark</label>
									<textarea required class="form-control" name="activate_remark" rows="4" placeholder="comment..."></textarea>
								</div>

								<input type="hidden" name="user_id" id="user_activate_id">
							</div><!-- modal-body -->

							<div class="modal-footer">
								<button type="submit" name="activate_btn" class="btn btn-primary mr-3">
									<i class="fa fa-paper-plane" aria-hidden="true"></i> &nbsp;
									Submit
								</button>
								<button type="button" class="btn btn-light text-danger" data-dismiss="modal">Close</button>
							</div>

						</form>
					</div>
				</div>
			</div>
		<!-- ================================ MODAL ======================== -->

<?php include('include/footer.php'); ?>   

<script type="text/javascript">
	$(document).on("click", ".userBlock", function () {
	var id = $(this).data('id');
	$(".modal-body #user_block_id").val(id);
	$("#block_id").text(id);
			});
</script>

<script type="text/javascript">
	$(document).on("click", ".userActivate", function () {
	var id = $(this).data('id');
	$(".modal-body #user_activate_id").val(id);
	$("#activate_id").text(id);
			});
</script>