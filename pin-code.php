<?php 

	// error_reporting(0);

    $page = 'pin-code.php';
    $title = 'Pin Code Setup | GypsyG';
    $description = 'Ecommerce, Daily needs';
	$keywords = '';

	// Include ParseProfle page
	include_once('partials/parseProfile.php');

	// Include ParsePinCode page
	include_once('partials/parsePinCode.php');

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
						<h4 class="page-title">Pin code</h4>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
							<li class="breadcrumb-item active" aria-current="page">Pin code</li>
						</ol>
					</div>

					<div class="row row-deck">
						<!-- Create Pin code -->
						<div class="col-lg-4">
							<div class="card">
								
								<div class="card-header">
									<h5>Create Pin Code</h5>
								</div>

								<div class="card-body">
									<!-- Display Messages -->
									<div>									
										<?php if (isset($msg)) { echo $msg; } ?>
									</div>

									<div class="clearfix"></div>

									<div class="mix-box">
										<form action="pin-code.php" method="post">
											<div class="form-group">
												<label class="form-label" for="state">
													State
													<span class="text-danger">*</span> 
												</label>

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
											
											<div class="form-group">
												<label class="form-label" for="city">
													City
													<span class="text-danger">*</span> 
												</label>
												
												<input type="text" name="city" class="form-control" placeholder="Enter city name" value="<?php echo $city; ?>">

												<small class="text-danger"><?php echo $city_error;?></small>
											</div>

											<div class="form-group">
												<label class="form-label" for="pin">
													Pin Code
													<span class="text-danger">*</span> 
												</label>

												<input type="number" name="pin" class="form-control" placeholder="Enter 6 digit code" value="<?php echo $pin; ?>">

												<small class="text-danger"><?php echo $pin_error;?></small>
											</div>
                                            
                                            <!-- newly added field -->
                                            <input type="hidden" name="id" value="<?php if(isset($id)) echo $id; ?>">

											<div class="form-group">
                                                <?php if ($update == true): ?>
                                                    <button class="btn btn-primary btn-block mt-4" name="update_pin" type="submit">
                                                        UPDATE
                                                    </button>
                                                <?php else: ?>
                                                    <button class="btn btn-primary btn-block mt-4" name="add_pin" type="submit">
                                                        ADD PIN CODE
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
									<h5>All Pin Codes</h5>
								</div>

								<div class="card-body">

									<?php 

										// Create SQL Insert Statement
										$sql = "SELECT * FROM pin_code ORDER BY id DESC";

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
													<th>STATE</th>
													<th>CITY</th>
													<th>PIN CODE</th>
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
                                                        <td><?php echo $row['state']; ?></td>
                                                        <td><?php echo $row['city']; ?></td>
                                                        <td><?php echo $row['pin']; ?></td>
                                                        <td>
                                                            <a href="pin-code.php?edit=<?php echo $row['id']; ?>" title="edit" class="btn btn-primary btn-sm">
                                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                                            </a>

                                                            <a href="pin-code.php?del=<?php echo $row['id']; ?>" title="Delete" onclick="return confirm('Are you sure?');" class="btn btn-danger btn-sm">
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