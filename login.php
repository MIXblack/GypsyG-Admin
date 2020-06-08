<?php 

    error_reporting(0);

    $page = 'login.php';
    $title = 'Login | GypsyG';
    $description = '';
	$keywords = '';

	// Include Login Parse File
	include('partials/parseLogin.php'); 

    // Include Header File
    include('include/home-header.php'); 

?>

        <!-- START LOGIN SECTION -->
        <section class="hero-section ptb-100 background-img full-screen" style="background: url('home-assets/img/background/hero-bg-1.jpg')no-repeat center center / cover">
            <div class="container">
                <div class="row align-items-center justify-content-between pt-5 pt-sm-5 pt-md-5 pt-lg-0">
                    <div class="col-md-7 col-lg-6">
                        <div class="hero-content-left text-white">
                            <h1 class="text-white">Welcome Back !</h1>

                            <p class="lead">
                                Keep your face always toward the sunshine - and shadows will fall behind you.
                            </p>
                        </div>
                    </div>

                    <div class="col-md-5 col-lg-5">
                        <div class="card login-signup-card shadow-lg mb-0">
                            <div class="card-body px-md-5 py-5">
                                <div class="mb-5">
                                    <h5 class="h3">Login</h5>
                                    <p class="text-muted mb-0">Sign in to your account to continue.</p>
                                </div>

                                <!-- Display Messages -->
                                <div>									
                                    <?php if (isset($msg)) { echo $msg; } ?>
                                </div>

                                <!--login form-->
                                <form class="login-signup-form" action="login.php" name="login_page" method="post">
                                    <div class="form-group">
                                        <label class="pb-1">
                                            Username or Email
                                            <span class="text-danger">*</span>
                                        </label>

                                        <div class="input-group input-group-merge">
                                            <div class="input-icon">
                                                <span class="ti-user color-primary"></span>
                                            </div>

                                            <input type="text" name="username" class="form-control" placeholder="Enter your username or email" value="<?php if(isset($username)) echo $username; ?>">
										</div>
										
										<small class="text-danger"><?php echo $username_error;?></small>
                                    </div>

                                    <!-- Password -->
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col">
                                                <label class="pb-1">
                                                    Password
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

                                    <div class="my-4">
                                        <div class="custom-control custom-checkbox mb-3">
                                            <input type="checkbox" name="remember" class="custom-control-input" id="check-terms">
                                            <label class="custom-control-label" for="check-terms">Remember Me?</label>
                                        </div>
                                    </div>

                                    <input type="hidden" name="token" value="<?php if(function_exists('_token')) echo _token(); ?>">

                                    <!-- Submit -->
                                    <button type="submit" name="login_btn" class="btn btn-lg btn-block solid-btn border-radius mt-4 mb-3">
                                        Sign in
                                    </button>

                                </form>
                            </div>

                            <div class="card-footer bg-transparent border-top px-md-5">
                                Forgot Password? <a href="forgot-password.php" class="small">Send reset link</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bottom-img-absolute">
                <img src="home-assets/img/background/hero-bg-shape-1.svg" alt="wave shape" class="img-fluid">
            </div>
        </section>
        <!-- END LOGIN SECTION -->

<?php 

    // Include Footer File
    include('include/home-footer.php'); 
    
?>