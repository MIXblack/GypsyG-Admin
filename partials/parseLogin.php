<?php

    // error_reporting(0);

    // Include Session File
	include_once('resource/session.php');

	// Include Database Conncection Script File
	include_once('resource/database.php');

	// Include Utilities File
    include_once('resource/utilities.php');
    
    $username_error = "";
    $password_error = "";

    // ============== START LOGIN PROCESS ===============
	if (isset($_POST['login_btn'], $_POST['token'])) {

        // Validate the token
        if(validate_token($_POST['token'])) {

            /** 
             *  Process the form
            */

            // Collect from data
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Check user click remember box or not?
            isset($_POST['remember']) ? $remember = $_POST['remember'] : $remember = "";

            // ============ FORM VALIDATION =========================
				if(empty($username)) {
					$username_error = "Username is required";
				}

				else if(empty($password)) {
					$password_error = "Password is required";
                }
                
             // ============ FORM VALIDATION =========================

            else if (empty($msg)) {

                // Check if user exist in the database
                $sql = "SELECT * FROM admins WHERE username = :username";

                $stmt = $db->prepare($sql);

                $stmt->execute(array(':username' => $username));

                if ($row = $stmt->fetch()) {

                    $id = $row['id'];
                    $hashed_password = $row['password'];
                    $username = $row['username'];
                    $email = $row['email'];
                    $name = $row['name'];

                    if (password_verify($password, $hashed_password)) {

                        // Login the User
                        prepAdminLogin($id, $username, $email, $name, $remember);

                    } else {
                        
                        $msg = "<script>
                                    swal({
                                    title: \"Oops..\",
                                    text: \"Invalid password\",
                                    type: 'error',
                                    confirmButtonText: \"Ok\" });
                                </script>";

                    }

                } else {

                    $msg = "<script>
                            swal({
                            title: \"Oops..\",
                            text: \"Account doesn't exist\",
                            type: 'error',
                            confirmButtonText: \"Ok\" });
                        </script>";

                }

            } else {

                $msg = flashMessage("Sorry, something want wrong. Please try again");

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
                            window.location.href = 'login.php';
                        }, 1000);
                    </script>";

        }

    }

    // ============== END LOGIN PROCESS ===============

