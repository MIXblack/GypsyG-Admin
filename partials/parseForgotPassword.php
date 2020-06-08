<?php 

    // Include Session File
	include_once('resource/session.php');

    // Include Database Conncection Script File
	include_once('resource/database.php');

	// Include Utilities File
	include_once('resource/utilities.php');

	// Include Send Email File
    include_once('resource/send-email.php');
    
    // Error Variables
    $email_error = "";
	$token_error = "";
    $password_error = "";
    $confirm_password_error = "";

    //process the form if the Reset Password button is clicked
    if(isset($_POST['update_password_btn'], $_POST['token'])) {

        // Validate the token
        if(validate_token($_POST['token'])) {

            /** 
             *  Process the form
            */

            //collect form data and store in variables
            $email = $_POST['email'];
            $reset_token = $_POST['reset_token'];
            $password1 = $_POST['new_password'];
            $password2 = $_POST['confirm_password'];
            $msg = '';

            $password_parttern = '/^\S*(?=\S{8,15})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$/';
            $email_parttern = '/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/';
			// $email_parttern = '/^([A-Z\a-z\d\._-]+)@(aai).(aero)$/';

            // ============ FORM VALIDATION =========================
            
				if(empty($email)) {
					$email_error = "Email is required";
				}

				else if(empty($reset_token)) {
                    $token_error = "Token is required";
                }

                else if(empty($password1)) {
                    $password_error = "Password is required";
                }

                else if(empty($password2)) {
                    $confirm_password_error = "Confirm Password is required";
                }

				else if(!preg_match($email_parttern, $email)){

					$msg = "<script>
							swal({
							title: \"Incorrect Email\",
							text: \"Please use valid email id\",
							type: 'error',
							confirmButtonText: \"Ok\" });
                        </script>";
						
				}

				else if ($password1 != $password2) {

					$msg = "<script>
							swal({
							title: \"Oops..\",
							text: \"Passwords does not matched.\",
							type: 'error',
							confirmButtonText: \"Ok\" });
                        </script>";
						
				}

				else if(!preg_match($password_parttern, $password1)){
					
					$msg = "<script>
								swal({
								title: \"Oops..\",
								text: \"Password should be minimun 8 characters, consisting of A-Z & a-z letters, numericals and special characters.\",
								type: 'error',
                                confirmButtonText: \"Ok\" });
                            </script>";

                }
                
            // ============ FORM VALIDATION =========================

            //check if error array is empty, if yes process form data
            else if(empty($msg)) {

                try {

                    // Validate email and token
                    $validateSql = "SELECT * FROM password_resets WHERE email = :email";
                    $validateStmt = $db->prepare($validateSql);
                    $validateStmt->execute([
                        ':email' => $email
                    ]);

                    $isValid = true;

                    if($rows = $validateStmt->fetch()) {

                        // Email found
                        $stored_token = $rows['token'];
                        $expire_time = $rows['expire_time'];

                        // Check token
                        if($stored_token !== $reset_token) {

                            $isValid = false;

                            $msg = "<script>
                                    swal({
                                    title: \"Invalid Token\",
                                    text: \"You have entered an invalid token\",
                                    type: 'error',
                                    confirmButtonText: \"Ok\" });
                                </script>";

                        }

                        // Check expire time
                        if($expire_time < date('Y-m-d H:i:s')) {

                            $isValid = false;

                            // Delete token
                            $db->exec("DELETE FROM password_resets WHERE email = '$email' AND token = '$stored_token'");

                            $msg = "<script>
                                    swal({
                                    title: \"Expired Token\",
                                    text: \"This reset token has expired, request a new one\",
                                    type: 'error',
                                    confirmButtonText: \"Ok\" });
                                </script>";

                        }

                    } else {

                        $isValid = false;
                        goto invalid_email;

                    }

                    // If token verification pass
                    if($isValid) {

                        //create SQL select statement to verify if email address input exist in the database
                        $sqlQuery = "SELECT id,name FROM admins WHERE email =:email";

                        //use PDO prepared to sanitize data
                        $statement = $db->prepare($sqlQuery);

                        //execute the query
                        $statement->execute(array(':email' => $email));

                        //check if record exist
                        if($rs = $statement->fetch()){
                            //hash the password
                            $hashed_password = password_hash($password1, PASSWORD_DEFAULT);
                            $id = $rs['id'];
                            $name = $rs['name'];

                            //SQL statement to update password
                            $sqlUpdate = "UPDATE admins SET password =:password WHERE id=:id";

                            //use PDO prepared to sanitize SQL statement
                            $statement = $db->prepare($sqlUpdate);

                            //execute the statement
                            $statement->execute(array(':password' => $hashed_password, ':id' => $id));

                            if ($statement->rowCount() == 1) {

                                // Delete token
                                $db->exec("DELETE FROM password_resets WHERE email = '$email' AND token = '$stored_token'");

                            }

                            // Prepare email body
                            $mail_body = '<html>
										<body style="color:#333; font-family: Arial, Helvetica, sans-serif; line-height:1.8em;">
											<div style="text-align:center;">
												
												<h1 style="font-size:2rem; margin-bottom:30px;">Password Updated!</h1>

												<p style="font-size:1rem;">Your password has been successfully updated on GypsyG, please click below button to login your account.</p>

												<center>
													<div style="width:200px; padding:10px; background-color:#3c4ba8; color:#fff; margin-top:40px; margin-bottom:40px;">
														<a style="text-decoration:none; color:#fff;" target="_blank" href="http://localhost/MIXblack/GypsyG/Code/Company/login.php">Login</a>
													</div>
												</center>

												<p style="margin-bottom:20px; font-size:1rem;">
													In case of any discrepancy, please contact with Administrator
												</p>

												<p style="margin-bottom:40px; font-size:1rem; color:red;">
													Don\'t reply to this mail
												</p>

												<p style="font-size:1rem;">
                                                    <small>Copyright © 2014-'.date('Y').' <strong>Gypsyg</strong>. All rights reserved</small>
                                                </p>

                                                <small style="text-align:center; font-size:.8rem;">
                                                    Designed by <a href="https://www.mixblack.co.in" target="_blank">MIXblack</a>
                                                </small>
											</div>
										</body>
                                    </html>';

                            $mail->addAddress($email, $name);
                            $mail->Subject = "Message from GypsyG.";
                            $mail->Body = $mail_body;

                            // Error Handling for PHPMailer
                            if(!$mail->Send()) {

                                $msg = "<script>
                                            swal({
                                            title: \"Oops..\",
                                            text: \"Email sending failed: $mail->ErrorInfo, error\",
                                            type: 'error',
                                            confirmButtonText: \"Ok\" });
                                        </script>"; 

                            } else {
                                
                                $msg = "<script>
                                            swal({
                                            title: \"Updated!\",
                                            text: \"$name your password has been updated successfully.\",
                                            type: 'success',
                                            timer: 2000,
                                            showConfirmButton: false });

                                            setTimeout(function(){
                                                window.location.href = 'login.php';
                                            }, 1000);
                                        </script>";

                            }

                            

                        } else {

                            invalid_email:
                            
                            $msg = "<script>
                                    swal({
                                    title: \"Incorrect Email\",
                                    text: \"Please enter registered email id.\",
                                    type: 'error',
                                    confirmButtonText: \"Ok\" });
                                </script>"; 

                        }

                    }

                } catch (PDOException $ex){

                    $msg = flashMessage("An error occurred: " .$ex->getMessage());
                }


            } else {

                $msg = flashMessage("Sorry, something want wrong. Please try again.");

            }

        } else {

            // Throw an error
            $msg = "<script>
                        swal({
                        title: \"Oops..\",
                        text: \"This request originates from an unknown source, posible attack\",
                        type: 'error',
                        timer: 2000,
                        showConfirmButton: false });

                        setTimeout(function(){
                            window.location.href = 'reset-password.php';
                        }, 1000);
                    </script>";

        }


    } 
    
    //process the form if the Forgot Password button is clicked
    else if (isset($_POST['reset_password_btn'], $_POST['token'])) {

        // Validate the token
        if(validate_token($_POST['token'])) {

            /** 
             *  Process the form
            */
            // Collect form data and store in variables
            $email = $_POST['email'];

            // $email_parttern = '/^([A-Z\a-z\d\._-]+)@(aai).(aero)$/';
            $email_parttern = '/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/';

			// ============ FORM VALIDATION =========================
				if(empty($email)) {
					$email_error = "Email is required";
                }
                
                else if(!preg_match($email_parttern, $email)){

					$msg = "<script>
							swal({
							title: \"Incorrect Email\",
							text: \"Please use valid email id\",
							type: 'error',
							confirmButtonText: \"Ok\" });
                        </script>"; 
						
                }
            // ============ FORM VALIDATION =========================

            // Check if error array is empty, if yes process form data
            else if (empty($msg)) {

                try {

                    // Create SQL select statement to verify if email address input exist in the database
                    $sql = "SELECT * FROM admins WHERE email = :email";

                    // Use PDO prepared to sanitize data
                    $stmt = $db->prepare($sql);

                    // Execute the query
                    $stmt->execute(array(':email' => $email));

                    // Check if record exist
                    if($row = $stmt->fetch()) {

                        $name = $row['name'];
                        $email = $row['email'];
                        $admin_id = $row['id'];

                        // Create and store token
                        $expire_time = date('Y-m-d H:i:s', strtotime('10 minutes'));
                        $random_string = base64_encode(openssl_random_pseudo_bytes(10));
                        $reset_token = strtoupper(preg_replace('/[^A-Za-z0-9\-]/', '', $random_string));

                        $insertToken = "INSERT INTO password_resets (email, token, expire_time) VALUES (:email, :token, :expire_time)";
                        $token_stmt = $db->prepare($insertToken);
                        $token_stmt->execute([
                            ':email' => $email,
                            ':token' => $reset_token,
                            ':expire_time' => $expire_time
                        ]);

                        // Prepare email body
                        $mail_body = '<html>
                                        <body style="color:#333; font-family: Arial, Helvetica, sans-serif; line-height:1.8em;">
                                            <div style="text-align:center;">
                                                
                                                <h1 style="font-size:2rem; margin-bottom:30px;">Hi '.$name.'!</h1>

                                                <p style="font-size:1rem;">To reset your login password, please click on the button below.</p>

                                                <p style="font-size:1rem;">Token: '.$reset_token.'</p>

                                                <center>
                                                    <div style="width:200px; padding:10px; background-color:#3c4ba8; color:#fff; margin-top:40px; margin-bottom:40px;">
                                                        <a style="text-decoration:none; color:#fff;" target="_blank" href="http://localhost/MIXblack/GypsyG/Code/Company/reset-password.php">Update Password</a>
                                                    </div>
                                                </center>

                                                <p style="margin-bottom:40px; font-size:1rem;">
                                                    In case of any discrepancy, please contact with Administrator
                                                </p>

                                                <p style="margin-bottom:40px; font-size:1rem; color:red;">
                                                    Don\'t reply to this mail
                                                </p>

                                                <p style="font-size:1rem;">
                                                    <small>Copyright © 2014-'.date('Y').' <strong>Gypsyg</strong>. All rights reserved</small>
                                                </p>

                                                <small style="text-align:center; font-size:.8rem;">
                                                    Designed by <a href="https://www.mixblack.co.in" target="_blank">MIXblack</a>
                                                </small>
                                            </div>
                                        </body>
                                    </html>';

                        $mail->addAddress($email, $name);
                        $mail->Subject = "Password Recovery Message from GypsyG.";
                        $mail->Body = $mail_body;

                        // Error Handling for PHPMailer
                        if(!$mail->Send()) {

                            $msg = "<script>
                                        swal({
                                        title: \"Oops..\",
                                        text: \"Email sending failed: $mail->ErrorInfo, error\",
                                        type: 'error',
                                        confirmButtonText: \"Ok\" });
                                    </script>"; 

                        } else {

                            $msg = "<script>
                                        swal({
                                        title: \"Link Send!\",
                                        text: \"Password reset link sent successfully, please check your email id.\",
                                        type: 'success',
                                        timer: 2000,
                                        showConfirmButton: false });

                                        setTimeout(function(){
                                            window.location.href = 'forgot-password.php';
                                        }, 1000);
                                    </script>";

                        }
                        

                    }  else {

                        $msg = "<script>
                                    swal({
                                    title: \"Incorrect Email\",
                                    text: \"Please enter registered email id.\",
                                    type: 'error',
                                    confirmButtonText: \"Ok\" });
                                </script>"; 
        
                    }

                } catch (PDOException $ex) {

                    $msg = flashMessage("An error occurred: " . $ex->getMessage());

                }


            } else {

                $msg = flashMessage("Something goes wrong..");

            }


        } else {

            // Throw an error
            $msg = "<script>
                        swal({
                        title: \"Oops..\",
                        text: \"This request originates from an unknown source, posible attack\",
                        type: 'error',
                        timer: 2000,
                        showConfirmButton: false });

                        setTimeout(function(){
                            window.location.href = 'forgot-password.php';
                        }, 1000);
                    </script>";

        }


    }