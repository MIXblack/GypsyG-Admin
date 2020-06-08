<?php 

    error_reporting(0);

    $page = 'reset-password.php';
    $title = 'Reset Password | GypsyG';
    $description = '';
	$keywords = '';

	// Include Login Parse File
	include('partials/parseLogin.php'); 

    // Include Header File
    include('include/home-header.php'); 

?>

        <!-- START FORGOT PASSWORD SECTION -->
        <section class="hero-section ptb-100 background-img full-screen" style="background: url('home-assets/img/background/hero-bg-3.jpg')no-repeat center center / cover">
            <div class="container">
                <div class="row align-items-center justify-content-between pt-5 pt-sm-5 pt-md-5 pt-lg-0">
                    <div class="col-md-7 col-lg-6">
                        <div class="hero-content-left text-white">
                            <h2 class="text-white">Update Password</h2>

                            <p class="lead">
                            Keep your face always toward the sunshine - and shadows will fall behind you. Continually pursue fully researched niches whereas timely platforms. Credibly parallel task optimal catalysts for change after focused catalysts for change.
                            </p>
                        </div>
                    </div>

                    <div class="col-md-5 col-lg-5">
                        <div class="card login-signup-card shadow-lg mb-0">
                            <div class="card-body px-md-5 py-5">
                                <div class="mb-5">
                                    <h5 class="h3">Password Reset</h5>
                                    <p class="text-muted mb-0">Enter your email to get a password reset link.</p>
                                </div>

                                <!-- Display Messages -->
                                <div>									
                                    <?php if (isset($msg)) { echo $msg; } ?>
                                </div>

                                <!--login form-->
                                <form class="login-signup-form" action="reset-password.php" name="login_page" method="post">

                                    <!-- New Password -->
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col">
                                                <label class="pb-1">
                                                    New Password
                                                    <span class="text-danger">*</span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="input-group input-group-merge">
                                            <div class="input-icon">
                                                <span class="ti-lock color-primary"></span>
                                            </div>

                                            <input type="password" name="password" class="form-control" placeholder="Enter your password">
										</div>
										
										<small class="text-danger"><?php echo $password_error;?></small>
                                    </div>

                                     <!-- New Password -->
                                     <div class="form-group">
                                        <div class="row">
                                            <div class="col">
                                                <label class="pb-1">
                                                    Confirm Password
                                                    <span class="text-danger">*</span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="input-group input-group-merge">
                                            <div class="input-icon">
                                                <span class="ti-lock color-primary"></span>
                                            </div>

                                            <input type="password" name="confirm_password" class="form-control" placeholder="Enter repeat password">
										</div>
										
										<small class="text-danger"><?php echo $confirm_password_error;?></small>
                                    </div>

                                    <input type="hidden" name="token" value="<?php if(function_exists('_token')) echo _token(); ?>">

                                    <!-- Submit -->
                                    <button type="submit" name="reset_password_btn" class="btn btn-lg btn-block solid-btn border-radius mt-4 mb-3">
                                        Update Password
                                    </button>

                                </form>
                            </div>

                            <div class="card-footer bg-transparent border-top px-md-5">
                                Remember your password? <a href="login.php">Log in</a>.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bottom-img-absolute">
                <img src="home-assets/img/background/hero-bg-shape-1.svg" alt="wave shape" class="img-fluid">
            </div>
        </section>
        <!-- END FORGOT PASSWORD SECTION -->

<?php 

    // Include Footer File
    include('include/home-footer.php'); 
    
?>