<?php 

	// error_reporting(0);

    $page = 'create-agency.php';
    $title = 'Create Agency | GypsyG';
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
						<h4 class="page-title">Create Agency</h4>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
							<li class="breadcrumb-item active" aria-current="page">Create Agency</li>
						</ol>
					</div>

					<!-- START CONTENT -->
					<div class="row">
						<div class="col-lg-12 col-xl-12 mx-auto">
							<div class="panel panel-primary mb-2">
								<div class=" ">
									<ul class="nav nav-pills">
										<li class="nav-item m-2">
											<a class="nav-link btn btn-primary" href="create-agency.php">CREATE AGENCY</a>
										</li>

										<li class="nav-item m-2">
											<a class="nav-link btn btn-light" href="agency-pending.php">PENDING REQUESTS</a>
										</li>

										<li class="nav-item m-2">
											<a class="nav-link btn btn-light" href="all-agency.php">ALL AGENCY</a>
										</li>
									</ul>
								</div>
							</div>

							<div class="card">
								<div class="card-header">
									<small><span class="text-danger">*</span> All fields are mandatory</small>
								</div>

								<div class="card-body">
									<div class="mix-box-2">
										<!-- Display Messages -->
										<div>									
											<?php if (isset($msg)) { echo $msg; } ?>

											<?php if (!empty($form_errors)) { echo show_errors($form_errors); } ?>
										</div>

										<div class="clearfix"></div>

										<form class="form-horizontal" action="create-agency.php" method="post" enctype="multipart/form-data">
											<div class="row">
												<div class="col-lg-6 col-md-6 col-xl-6">
													<?php if ($update == true): ?>
													<?php else: ?>
														<!-- Profile -->
														<div class="form-group ">
															<div class="row">
																<div class="col-md-4">
																	<label class="form-label">
																		Profile Picture
																		<span class="text-danger">*</span>
																	</label>
																</div>

																<div class="col-md-8">
																	<input type="file" name="agency_profile" class="form-control" value="<?php if(isset($agency_profile)) echo $agency_profile; ?>">

																	<small class="text-danger"><?php echo $agency_profile_error; ?></small>
																</div>
															</div>
														</div>
													<?php endif; ?>
													
													<!-- Name -->
													<div class="form-group ">
														<div class="row">
															<div class="col-md-4">
																<label class="form-label">
																	Name
																	<span class="text-danger">*</span>
																</label>
															</div>

															<div class="col-md-8">
																<input type="text" name="agency_name" class="form-control" value="<?php if(isset($agency_name)) echo $agency_name; ?>" placeholder="Enter full name">

																<small class="text-danger"><?php echo $agency_name_error;?></small>
															</div>
														</div>
													</div>

													<!-- DOB -->
													<div class="form-group ">
														<div class="row">
															<div class="col-md-4">
																<label class="form-label">
																	Date of Birth
																	<span class="text-danger">*</span>
																</label>
															</div>

															<div class="col-md-8">
																<input type="date" name="dob" class="form-control" value="<?php if(isset($dob)) echo $dob; ?>" placeholder="Enter full name">

																<small class="text-danger"><?php echo $dob_error;?></small>
															</div>
														</div>
													</div>

													<!-- Gender -->
													<div class="form-group ">
														<div class="row">
															<div class="col-md-4">
																<label class="form-label">
																	Gender
																	<span class="text-danger">*</span>
																</label>
															</div>

															<div class="col-md-8">
																<input type="radio" name="gender" value="male" <?php if ($gender == "male") echo "checked"; ?>>
																<label for="male">Male</label>

																<input type="radio" name="gender" value="female" <?php if ($gender == "female") echo "checked"; ?>>
																<label for="female">Female</label>

																<input type="radio" name="gender" value="other" <?php if ($gender == "other") echo "checked"; ?>>
																<label for="other">Other</label>

																<small class="text-danger"><?php echo $gender_error;?></small>
															</div>
														</div>
													</div>

													<!-- Address -->
													<div class="form-group ">
														<div class="row">
															<div class="col-md-4">
																<label class="form-label">
																	Address
																	<span class="text-danger">*</span>
																</label>
															</div>

															<div class="col-md-8">
																<textarea name="address" class="form-control" placeholder="Enter address"><?php if(isset($address)) echo $address; ?></textarea>

																<small class="text-danger"><?php echo $address_error;?></small>
															</div>
														</div>
													</div>
													
													<!-- State -->
													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label class="form-label" for="pin">
																	State
																	<span class="text-danger">*</span> 
																</label>
															</div>

															<div class="col-md-8">
																<select class="form-control select2-show-search select2" name="state" data-placeholder="Choose Browser">
																	<option value="">Select</option>
																	<option value="Andaman and Nicobar Islands" value="<?php if($state === 'Andaman and Nicobar Islands') echo 'Selected'; ?>">Andaman and Nicobar Islands</option>

																	<option value="Andhra Pradesh" <?php if($state === 'Andhra Pradesh') echo 'Selected'; ?>>Andhra Pradesh</option>

																	<option value="Arunachal Pradesh" <?php if($state === 'Arunachal Pradesh') echo 'Selected'; ?>>Arunachal Pradesh</option>

																	<option value="Assam" <?php if($state === 'Assam') echo 'Selected'; ?>>Assam</option>

																	<option value="Bihar" <?php if($state === 'Bihar') echo 'Selected'; ?>>Bihar</option>

																	<option value="Chandigarh" <?php if($state === 'Chandigarh') echo 'Selected'; ?>>Chandigarh</option>

																	<option value="Chhattisgarh" <?php if($state === 'Chhattisgarh') echo 'Selected'; ?>>Chhattisgarh</option>

																	<option value="Dadra & Nagar Haveli and Daman & Diu" <?php if($state === 'Dadra & Nagar Haveli and Daman & Diu') echo 'Selected'; ?>>Dadra & Nagar Haveli and Daman & Diu</option>

																	<option value="Delhi" <?php if($state === 'Delhi') echo 'Selected'; ?>>Delhi</option>

																	<option value="Goa" <?php if($state === 'Goa') echo 'Selected'; ?>>Goa</option>
																	
																	<option value="Gujarat" <?php if($state === 'Gujarat') echo 'Selected'; ?>>Gujarat</option>

																	<option value="Haryana" <?php if($state === 'Haryana') echo 'Selected'; ?>>Haryana</option>

																	<option value="Himachal Pradesh" <?php if($state === 'Himachal Pradesh') echo 'Selected'; ?>>Himachal Pradesh</option>

																	<option value="Jammu and Kashmir" <?php if($state === 'Jammu and Kashmir') echo 'Selected'; ?>>Jammu and Kashmir</option>

																	<option value="Jharkhand" <?php if($state === 'Jharkhand') echo 'Selected'; ?>>Jharkhand</option>

																	<option value="Karnataka" <?php if($state === 'Karnataka') echo 'Selected'; ?>>Karnataka</option>

																	<option value="Kerala" <?php if($state === 'Kerala') echo 'Selected'; ?>>Kerala</option>

																	<option value="Ladakh" <?php if($state === 'Ladakh') echo 'Selected'; ?>>Ladakh</option>

																	<option value="Lakshadweep" <?php if($state === 'Lakshadweep') echo 'Selected'; ?>>Lakshadweep</option>

																	<option value="Madhya Pradesh" <?php if($state === 'Madhya Pradesh') echo 'Selected'; ?>>Madhya Pradesh</option>

																	<option value="Manipur" <?php if($state === 'Manipur') echo 'Selected'; ?>>Manipur</option>
																	
																	<option value="Meghalaya" <?php if($state === 'Meghalaya') echo 'Selected'; ?>>Meghalaya</option>

																	<option value="Mizoram" <?php if($state === 'Mizoram') echo 'Selected'; ?>>Mizoram</option>

																	<option value="Nagaland" <?php if($state === 'Nagaland') echo 'Selected'; ?>>Nagaland</option>

																	<option value="Odisha" <?php if($state === 'Odisha') echo 'Selected'; ?>>Odisha</option>

																	<option value="Puducherry" <?php if($state === 'Puducherry') echo 'Selected'; ?>>Puducherry</option>

																	<option value="Punjab" <?php if($state === 'Punjab') echo 'Selected'; ?>>Punjab</option>

																	<option value="Rajasthan" <?php if($state === 'Rajasthan') echo 'Selected'; ?>>Rajasthan</option>

																	<option value="Sikkim" <?php if($state === 'Sikkim') echo 'Selected'; ?>>Sikkim</option>

																	<option value="Tamil Nadu" <?php if($state === 'Tamil Nadu') echo 'Selected'; ?>>Tamil Nadu</option>

																	<option value="Telangana" <?php if($state === 'Telangana') echo 'Selected'; ?>>Telangana</option>

																	<option value="Tripura" <?php if($state === 'Tripura') echo 'Selected'; ?>>Tripura</option>

																	<option value="Uttar Pradesh" <?php if($state === 'Uttar Pradesh') echo 'Selected'; ?>>Uttar Pradesh</option>

																	<option value="Uttarakhand" <?php if($state === 'Uttarakhand') echo 'Selected'; ?>>Uttarakhand</option>

																	<option value="West Bengal" <?php if($state === 'West Bengal') echo 'Selected'; ?>>West Bengal</option>
																</select>

																<small class="text-danger"><?php echo $state_error;?></small>
															</div>
														</div>
													</div>

													<!-- City -->
													<div class="form-group ">
														<div class="row">
															<div class="col-md-4">
																<label class="form-label">
																	City
																	<span class="text-danger">*</span>
																</label>
															</div>

															<div class="col-md-8">
																<input type="text" name="city" class="form-control" value="<?php if(isset($city)) echo $city; ?>" placeholder="Enter city">

																<small class="text-danger"><?php echo $city_error;?></small>
															</div>
														</div>
													</div>

													<!-- Pin Code -->
													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label class="form-label" for="pin">
																	Pin Code
																	<span class="text-danger">*</span> 
																</label>
															</div>

															<div class="col-md-8">
																<input type="number" name="pin" class="form-control" placeholder="Enter 6 digit code" value="<?php echo $pin; ?>">

																<small class="text-danger"><?php echo $pin_error;?></small>
															</div>
														</div>
													</div>
												</div>

												<div class="col-lg-6 col-md-6 col-xl-6">
													<!-- Company -->
													<div class="form-group ">
														<div class="row">
															<div class="col-md-4">
																<label class="form-label">
																	Company Name
																</label>
															</div>

															<div class="col-md-8">
																<input type="text" name="company" class="form-control" value="<?php if(isset($company)) echo $company; ?>" placeholder="Enter company name">
															</div>
														</div>
													</div>

													<?php if ($update == true): ?>
													<?php else: ?>
														<!-- Doument & Id -->
														<div class="form-group">
															<div class="row">
																<div class="col-md-4">
																	<label class="form-label text-dark">
																		ID Proof
																		<span class="text-danger">*</span> 
																	</label>
																</div>

																<div class="col-md-8">
																	<select class="form-control select2-show-search select2" name="id_proof" onchange="showDiv('hidden_div', this)" data-placeholder="Choose Browser">
																		<option value="">Select</option>
																		<option value="Aadhar Card">Aadhar Card</option>
																		<option value="Pen Card">Pen Card</option>
																		<option value="Voter Id">Voter Id</option>
																		<option value="Driving Licence">Driving Licence</option>
																	</select>
																	
																	<div id="hidden_div">
																		<input type="file" name="id_document[]" multiple class="form-control">
																	</div>

																	<small class="text-danger"><?php echo $id_proof_error;?></small>
																</div>
															</div>
														</div>

														<!-- Branch -->
														<div class="form-group">
															<div class="row">
																<div class="col-md-4">
																	<label class="form-label text-dark">
																		Branch
																		<span class="text-danger">*</span> 
																	</label>
																</div>
																
																<div class="col-md-8">
																	<select class="form-control select2-show-search select2" name="branch" data-placeholder="Choose Browser">
																		<option value="">Select</option>
																		
																		<?php 

																			// Create SQL Insert Statement
																			$sql = "SELECT * FROM branch WHERE status = '0' ORDER BY id DESC";

																			// Use PDO Prepared to sanitize data
																			$stmt = $db->prepare($sql);

																			$stmt->execute();

																			$result = $stmt->fetchAll();

																			if (!empty($result)) {

																				foreach($result as $row) {
																		?>

																					<option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?> (<?php echo $row['pin']; ?>)</option>

																		<?php 

																				}
																			}

																		?>
																	</select>

																	<small class="text-danger"><?php echo $branch_error;?></small>
																</div>
															</div>
														</div>

														<!-- Package -->
														<div class="form-group">
															<div class="row">
																<div class="col-md-4">
																	<label class="form-label text-dark">
																		Package
																		<span class="text-danger">*</span> 
																	</label>
																</div>
																
																<div class="col-md-8">
																	<select class="form-control select2-show-search select2" name="package" data-placeholder="Choose Browser">
																		<option value="">Select</option>
																		
																		<?php 

																			// Create SQL Insert Statement
																			$sql = "SELECT * FROM agency_package WHERE package_for = 'Prime Agency' ORDER BY id DESC";

																			// Use PDO Prepared to sanitize data
																			$stmt = $db->prepare($sql);

																			$stmt->execute();

																			$result = $stmt->fetchAll();

																			if (!empty($result)) {

																				foreach($result as $row) {
																		?>

																					<option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?> (&#8377; <?php echo number_format($row['amount']); ?>)</option>

																		<?php 

																				}
																			}

																		?>
																	</select>

																	<small class="text-danger"><?php echo $package_error;?></small>
																</div>
															</div>
														</div>
													<?php endif ?>

													<!-- Phone -->
													<div class="form-group ">
														<div class="row">
															<div class="col-md-4">
																<label class="form-label">
																	Mobile Number
																	<span class="text-danger">*</span>
																</label>
															</div>

															<div class="col-md-8">
																<input type="text" name="phone" class="form-control" value="<?php if(isset($phone)) echo $phone; ?>" placeholder="Enter mobile no.">

																<small class="text-danger"><?php echo $phone_error;?></small>
															</div>
														</div>
													</div>

													<!-- Email Id -->
													<div class="form-group ">
														<div class="row">
															<div class="col-md-4">
																<label class="form-label">
																	Email Id
																	<span class="text-danger">*</span>
																</label>
															</div>

															<div class="col-md-8">
																<input type="text" name="agency_email" class="form-control" value="<?php if(isset($agency_email)) echo $agency_email; ?>" placeholder="Enter email id">

																<small class="text-danger"><?php echo $agency_email_error;?></small>
															</div>
														</div>
													</div>
													
													<!-- Password -->
													<?php if ($update == true): ?>
													<?php else: ?>
														<div class="form-group ">
															<div class="row">
																<div class="col-md-4">
																	<label class="form-label">
																		Password
																		<span class="text-danger">*</span>
																	</label>
																</div>

																<div class="col-md-8">
																	<input type="text" name="password" class="form-control" value="<?php echo randomPassword(); ?>" placeholder="Enter password">

																	<small class="text-danger"><?php echo $password_error;?></small>
																</div>
															</div>
														</div>
													<?php endif ?>

													<input type="hidden" name="agency_id" value="<?php if(isset($agency_id)) echo $agency_id; ?>">
												</div>
											</div>

											<div class="form-group mb-0 row">
												<div class="col-md-4 mt-4 mx-auto">
													<?php if ($update == true): ?>
														<button type="submit" name="update_agency" class="btn btn-primary waves-effect waves-light btn-block">
															UPDATE
														</button>
													<?php else: ?>
														<button type="submit" name="add_agency" class="btn btn-primary waves-effect waves-light btn-block">
															CREATE AGENCY
														</button>
													<?php endif ?>
												</div>
											</div>
										</form>
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