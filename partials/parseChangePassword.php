<?php 

    error_reporting(0);

    // Include Database Conncection Script File
	include_once('resource/database.php');

	// Include Session File
	include_once('resource/session.php');

	// Include Utilities File
    include_once('resource/utilities.php');

    // Initialize Variables
	$current_password = "";
    $password_error = "";
    $confirm_password_error = "";

    // Error Variables
    $current_password_error = "";
    $password_error = "";
    $confirm_password_error = "";

    // Company Password Change
    if(isset($_POST['update_password'])) {

       /** 
            *  Process the form
        */
            
        $id = $_POST['id'];
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];


        // ============ FORM VALIDATION =========================

            if(empty($current_password)) {
                $current_password_error = "Current password is required";
            }

            else if(empty($new_password)) {
                $password_error = "Password is requierd";
            }

            else if(empty($confirm_password)) {
                $confirm_password_error = "Confirm password is requierd";
            }

            else if ($new_password != $confirm_password) {

                $msg = "<script>
                        swal({
                        title: \"Oops..\",
                        text: \"Passwords does not matched.\",
                        type: 'error',
                        confirmButtonText: \"Ok\" });
                    </script>";
                    
            }

        // ============ FORM VALIDATION =========================


        // Check if error array is empty, if yes process form data
        else if(empty($msg)) {

            try {

                // Process request // Check if the old password is correct
                $sql = "SELECT password FROM admin WHERE id = :id";

                // Use PDO prepared to sanitize data
                $stmt = $db->prepare($sql);

                // Update the record in the database
                $stmt->execute(array(':id' => $id));

                // Check if record is found
                if($row = $stmt->fetch()) {

                    $password_from_db = $row['password'];

                    if(password_verify($current_password, $password_from_db)) {

                        // Hashed new password
                        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                        // SQL statement for update password
                        $sql = "UPDATE admin SET password = :password WHERE id = :id";
                        $stmt = $db->prepare($sql);
                        $stmt->execute(array(':password' => $hashed_password, ':id' => $id));

                        if($stmt->rowCount() === 1) {

                            $msg = "<script>
                                    swal({
                                    title: \"Updated!\",
                                    text: \"Your password has been updated.\",
                                    type: 'success',
                                    timer: 3000,
                                    showConfirmButton: false });

                                    setTimeout(function(){
                                        window.location.href = 'settings.php';
                                    }, 2000);
                                </script>";

                        } else {

                            $msg = "<script>
                                    swal({
                                    title: \"Oops..\",
                                    text: \"No changes saved\",
                                    type: 'error',
                                    confirmButtonText: \"Ok\" });
                                </script>";

                        }

                    } else {

                        $msg = "<script>
                                    swal({
                                    title: \"Oops..\",
                                    text: \"Old password is not correct, please try again\",
                                    type: 'error',
                                    confirmButtonText: \"Ok\" });
                                </script>";

                    }

                }

            } catch (PDOException $ex) {
                $msg = flashMessage("An error occurred in: " . $ex->getMessage());   
            }

        } else {

            $msg = flashMessage("Sorry, something want wrong. Please try again.");

        }

        
    }

