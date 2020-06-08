<?php 

	error_reporting(0);

    $page = 'package-setup.php';
    $title = 'Package Setup | GypsyG';
    $description = 'Ecommerce, Daily needs';
	$keywords = '';

	// Include ParseProfile page
	include_once('partials/parseProfile.php');

	// Include ParseBranch page
	include_once('partials/parsePackageSetup.php');

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
						<h4 class="page-title">Package Setup</h4>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
							<li class="breadcrumb-item active" aria-current="page">Package Setup</li>
						</ol>
					</div>

					<div class="row row-deck">
						<!-- Create Pin code -->
						<div class="col-lg-4">
							<div class="card">
								
								<div class="card-header">
									<h5>Create Agency Package</h5>
								</div>

								<div class="card-body">
									<!-- Display Messages -->
									<div>									
										<?php if (isset($msg)) { echo $msg; } ?>
									</div>

									<div class="clearfix"></div>

									<div class="mix-box">
										<form action="package-setup.php" method="post">
                                            <div class="form-group">
												<label class="form-label" for="name">
													Package Name
													<span class="text-danger">*</span> 
												</label>
												
												<input type="text" name="package_name" class="form-control" placeholder="Enter package name" value="<?php echo $package_name; ?>">

												<small class="text-danger"><?php echo $package_name_error;?></small>
                                            </div>
                                            
                                            <div class="form-group">
												<label class="form-label" for="pin">
													Amount
													<span class="text-danger">*</span> 
												</label>

												<input type="number" name="amount" class="form-control" placeholder="Enter package amount" value="<?php echo $amount; ?>">

												<small class="text-danger"><?php echo $amount_error;?></small>
											</div>

											<div class="form-group">
												<label class="form-label" for="pin">
													package for
													<span class="text-danger">*</span> 
												</label>

												<select class="form-control select2-show-search select2" name="package_for" data-placeholder="Choose Browser">
													<option value="">Select</option>
													<option value="Prime Agency" <?php if($package_for == "Prime Agency") { echo "selected"; } ?>>Prime Agency</option>

													<option value="Vendor" <?php if($package_for == "Vendor") { echo "selected"; } ?>>Vendor</option>

													<option value="Seller" <?php if($package_for == "Seller") { echo "selected"; } ?>>Seller</option>
												</select>

												<small class="text-danger"><?php echo $package_for_error;?></small>
											</div>
                                            
                                            <!-- newly added field -->
                                            <input type="hidden" name="id" value="<?php if(isset($id)) echo $id; ?>">

											<div class="form-group">
                                                <?php if ($update == true): ?>
                                                    <button class="btn btn-primary btn-block mt-4" name="update_agency_package" type="submit">
                                                        UPDATE
                                                    </button>
                                                <?php else: ?>
                                                    <button class="btn btn-primary btn-block mt-4" name="add_agency_package" type="submit">
                                                        ADD PACKAGE
                                                    </button>
                                                <?php endif ?>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-8">
							<div class="card">

								<div class="card-header">
									<h5>All Agency Package</h5>
								</div>

								<div class="card-body">

									<?php 

										// Create SQL Insert Statement
										$sql = "SELECT * FROM agency_package ORDER BY id DESC";

										// Use PDO Prepared to sanitize data
										$stmt = $db->prepare($sql);

										$stmt->execute();

										$result = $stmt->fetchAll();

									?>             

									<div class="table-responsive">
										<table id="example2" class="hover table-bordered border-top-0 border-bottom-0" >
											<thead>
												<tr class="text-center">
                                                    <th>#</th>
													<th>NAME</th>
													<th>AMOUNT</th>
													<th>TYPE</th>
													<th>ACTION</th>
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
                                                        <td><?php echo $row['name']; ?></td>
                                                        <td>&#8377; <?php echo number_format($row['amount']); ?></td>
														<td><?php echo $row['package_for']; ?></td>
														
														<td>
                                                            <a href="package-setup.php?edit=<?php echo $row['id']; ?>" title="edit" class="btn btn-primary btn-sm">
                                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                                            </a>

                                                            <a href="package-setup.php?del=<?php echo $row['id']; ?>" title="Delete" onclick="return confirm('Are you sure?');" class="btn btn-danger btn-sm">
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
				</div>
			</div>
		</div>

<?php include('include/footer.php'); ?>   