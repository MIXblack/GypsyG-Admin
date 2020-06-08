<?php 

	// error_reporting(0);

    $page = 'branch.php';
    $title = 'Branch Setup | GypsyG';
    $description = 'Ecommerce, Daily needs';
	$keywords = '';

	// Include ParseProfile page
	include_once('partials/parseProfile.php');

	// Include ParseBranch page
	include_once('partials/parseBranch.php');

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
						<h4 class="page-title">Branch</h4>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
							<li class="breadcrumb-item active" aria-current="page">Branch</li>
						</ol>
					</div>

					<div class="row row-deck">
						<!-- Create Pin code -->
						<div class="col-lg-4">
							<div class="card">
								
								<div class="card-header">
									<h5>Create Branch</h5>
								</div>

								<div class="card-body">
									<!-- Display Messages -->
									<div>									
										<?php if (isset($msg)) { echo $msg; } ?>
									</div>

									<div class="clearfix"></div>

									<div class="mix-box">
										<form action="branch.php" method="post">
                                            <div class="form-group">
												<label class="form-label" for="name">
													Branch Name
													<span class="text-danger">*</span> 
												</label>
												
												<input type="text" name="branch_name" class="form-control" placeholder="Enter branch name" value="<?php echo $branch_name; ?>">

												<small class="text-danger"><?php echo $branch_name_error;?></small>
                                            </div>
                                            
                                            <?php if ($update == true): ?>

                                            <?php else: ?>
                                                <div class="form-group">
                                                    <label class="form-label" for="state">
                                                        Pin Code
                                                        <span class="text-danger">*</span> 
                                                    </label>

                                                    <select class="form-control select2-show-search select2" name="pin" data-placeholder="Choose Browser">
                                                        <option value="">Select</option>
                                                        
                                                        <?php 

                                                            // Create SQL Insert Statement
                                                            $sql = "SELECT * FROM pin_code ORDER BY id DESC";

                                                            // Use PDO Prepared to sanitize data
                                                            $stmt = $db->prepare($sql);

                                                            $stmt->execute();

                                                            $result = $stmt->fetchAll();

                                                            if (!empty($result)) {

                                                                foreach($result as $row) {
                                                        ?>

                                                                    <option value="<?php echo $row['pin']; ?>"><?php echo $row['pin']; ?>(<?php echo $row['city']; ?>)</option>

                                                        <?php 

                                                                }
                                                            }

                                                        ?>
                                                    </select>

                                                    <small class="text-danger"><?php echo $pin_error;?></small>
                                                </div>
                                            <?php endif ?>
                                            
                                            
                                            <!-- newly added field -->
                                            <input type="hidden" name="id" value="<?php if(isset($id)) echo $id; ?>">

											<div class="form-group">
                                                <?php if ($update == true): ?>
                                                    <button class="btn btn-primary btn-block mt-4" name="update_branch" type="submit">
                                                        UPDATE
                                                    </button>
                                                <?php else: ?>
                                                    <button class="btn btn-primary btn-block mt-4" name="add_branch" type="submit">
                                                        ADD BRANCH
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
									<h5>All Branchs</h5>
								</div>

								<div class="card-body">

									<?php 

										// Create SQL Insert Statement
										$sql = "SELECT * FROM branch ORDER BY id DESC";

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
                                                    <th>PIN CODE</th>
                                                    <th>CITY</th>
                                                    <th>STATE</th>
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
                                                        <td><?php echo $row['pin']; ?></td>
                                                        <td><?php echo $row['city']; ?></td>
                                                        <td><?php echo $row['state']; ?></td>
                                                        <td>
                                                            <a href="branch.php?edit=<?php echo $row['id']; ?>" title="edit" class="btn btn-primary btn-sm">
                                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                                            </a>

                                                            <a href="branch.php?del=<?php echo $row['id']; ?>" title="Delete" onclick="return confirm('Are you sure?');" class="btn btn-danger btn-sm">
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