<?php

	// Include Session File
	include_once('resource/session.php');
	
    // Include Database Conncection Script File
	include_once('resource/database.php');

	// Include Utilities File
	include_once('resource/utilities.php');

	// Include Send Email File
	include_once('resource/send-email.php');

	
    // Initialize Variables
    $agency_profile = "";
    $agency_name = "";
    $dob = "";
    $gender = "";
    $phone = "";
    $address = "";
    $state = "";
    $city = "";
    $pin = "";
    $company = "";
    $id_proof = "";
    $id_document = "";
    $branch = "";
    $package = "";
    $agency_email = "";
    $password = "";

	$id = 0;
    $update = false;
    
    // Error Variables
    $agency_profile_error = "";
    $agency_name_error = "";
    $dob_error = "";
    $gender_error = "";
    $phone_error = "";
    $address_error = "";
    $state_error = "";
    $city_error = "";
    $pin_error = "";
    $id_proof_error = "";
    $branch_error = "";
    $package_error = "";
    $agency_email_error = "";
    $password_error = "";

    // Generate Password Function
    function randomPassword() {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }


    /* ============================= ADD AGENCY ================================= */
        // Add Agency Data
        if (isset($_POST['add_agency'])) {

            /** 
                *  Process the form
            */

            // Initialize an array to store any error message from the form
            $form_errors = array();

            // Collect form data and store in variables
            $id = $_SESSION['id'];
            $agency_profile = $_FILES['agency_profile'];
            $agency_name = $_POST['agency_name'];
            $dob = $_POST['dob'];
            $gender = $_POST['gender'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $state = $_POST['state'];
            $city = $_POST['city'];
            $pin = $_POST['pin'];
            $company = $_POST['company'];
            $id_proof = $_POST['id_proof'];
            $id_document = $_FILES['id_document'];
            $branch = $_POST['branch'];
            $package = $_POST['package'];
            $agency_email = $_POST['agency_email'];
            $password = $_POST['password'];
            $msg = '';

            $email_parttern = '/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/';
            $phone_validate = '/^[6-9][0-9]{9}$/';

            // ============ FORM VALIDATION =========================

                if(empty($agency_profile)) {
                    $agency_profile_error = "Profile is required";
                }

                else if(empty($agency_name)) {
                    $agency_name_error = "Name is required";
                }

                else if(empty($dob)) {
                    $dob_error = "Date of birth is required";
                }

                else if(empty($gender)) {
                    $gender_error = "Gender is required";
                }

                else if(empty($phone)) {
                    $phone_error = "Phone is required";
                }

                else if(!preg_match($phone_validate, $phone)){
                    
                    $msg = "<script>
                                swal({
                                title: \"Oops..\",
                                text: \"Phone number is not valid!\",
                                type: 'error',
                                confirmButtonText: \"Ok\" });
                            </script>";
    
                }

                else if(empty($address)) {
                    $address_error = "Address is required";
                }

                else if(empty($state)) {
                    $state_error = "State is required";
                }

                else if(empty($city)) {
                    $city_error = "City is required";
                }

                else if(empty($pin)) {
                    $pin_error = "Pin Code is required";
                }

                else if(empty($id_proof)) {
                    $id_proof_error = "Id Proof is required";
                }

                else if(empty($branch)) {
                    $branch_error = "Branch is required";
                }

                else if(empty($package)) {
                    $package_error = "Package is required";
                }

                else if(empty($agency_email)) {
                    $agency_email_error = "Email is required";
                }

                else if(empty($password)) {
                    $password_error = "Password is required";
                }

                else if (checkDuplicateAgency($agency_email, $db)) {

                    $msg = "<script>
                            swal({
                            title: \"Oops..\",
                            text: \"Email id is already taken, please try another one.\",
                            type: 'error',
                            confirmButtonText: \"Ok\" });
                        </script>";
                        
                }

                else if(!preg_match($email_parttern, $agency_email)){

                    $msg = "<script>
                            swal({
                            title: \"Oops..\",
                            text: \"Please use valid email id\",
                            type: 'error',
                            confirmButtonText: \"Ok\" });
                        </script>";
                        
                }
                
            // ============ FORM VALIDATION =========================
            
            // Check if error array is empty, if yes process form data and insert record
            else if (empty($msg)) {

                // Secured user password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                
                $random_no = mt_rand(100,999);

                try {

                    // Create SQL Insert Statement
                    $sql = "INSERT INTO agency (name, password, profile, dob, gender, phone, email, company, address, state, city, pin_code, branch, package, status, super_admin) VALUES (:name, :password, :profile, :dob, :gender, :phone, :email, :company, :address, :state, :city, :pin_code, :branch, :package, :status, :super_admin)";

                    $path = uploadProfile($phone, $random_no);

                    // Use PDO prepared to sanitize data
                    $stmt = $db->prepare($sql);

                    if (empty($company)) {

                        // Create SQL Insert Statement
                        $sql = "INSERT INTO agency (name, password, profile, dob, gender, phone, email, address, state, city, pin_code, branch, package, status, super_admin) VALUES (:name, :password, :profile, :dob, :gender, :phone, :email, :address, :state, :city, :pin_code, :branch, :package, :status, :super_admin)";

                        $path = uploadProfile($phone, $random_no);

                        // Use PDO prepared to sanitize data
                        $stmt = $db->prepare($sql);

                        // Add the data into the database
                        $stmt->execute(array(':name' => $agency_name, ':password' => $hashed_password, ':profile' => $path, ':dob' => $dob, ':gender' => $gender, ':phone' => $phone, ':email' => $agency_email, ':address' => $address, ':state' => $state, ':city' => $city, 'pin_code' => $pin, ':branch' => $branch, ':package' => $package, ':status' => 'Active', ':super_admin' => $id));

                    } else {

                        // Add the data into the database
                        $stmt->execute(array(':name' => $agency_name, ':password' => $hashed_password, ':profile' => $path, ':dob' => $dob, ':gender' => $gender, ':phone' => $phone, ':email' => $agency_email, ':company' => $company, ':address' => $address, ':state' => $state, ':city' => $city, 'pin_code' => $pin, ':branch' => $branch, ':package' => $package, ':status' => 'Active', ':super_admin' => $id));

                    }


                    // Get the last inserted ID
                    $agency_id = $db->lastInsertId();
                    
                    // Create SQL Insert Statement
                    $sql = "INSERT INTO documents (id_proof, id_document, agency_id) VALUES (:proof, :document, :id)";

                    $document_path = uploadDocument($random_no);

                    // var_dump($document_path);
                    // exit();

                    // Use PDO prepared to sanitize data
                    $stmt = $db->prepare($sql);

                    // Add the data into the database
                    $stmt->execute(array(':proof' => $id_proof, ':document' => $document_path, ':id' => $agency_id));

                    if ($stmt->rowCount() == 1) {

                        $msg = "<script>
                                swal({
                                title: \"Account Created!\",
                                text: \"New prime agency has been created.\",
                                type: 'success',
                                timer: 2000,
                                showConfirmButton: false });

                                setTimeout(function(){
                                    window.location.href = 'all-agency.php';
                                }, 1000);
                            </script>";

                    }
        
                } catch (PDOException $ex) {
        
                    $msg = flashMessage("An error occurred: " . $ex->getMessage());
        
                }


            } else {

                if(!$msg) {

                    if(count($form_errors) == 1) {
                        $msg = flashMessage("There was 1 error in the form <br>");
                    } else {
                        $msg = flashMessage("There were " . count($form_errors) . " errors in the form <br>");
                    }

                }

            }
    
    
        }
    /* ============================= ADD AGENCY ================================= */

    /* ============================= EDIT AGENCY ================================ */ 
        // Edit Agency Data
        if (isset($_GET['edit'])) {

            $id = $_GET['edit'];
            $update = true;
            
            // Create SQL Insert Statement
            $sql = "SELECT * FROM agency WHERE id = $id";
                                
            // Use PDO Prepared to sanitize data
            $stmt = $db->prepare($sql);

            $stmt->execute();

            $result = $stmt->fetchAll();

            if (!empty($result)) {

                foreach($result as $row) {

                    $agency_id = $row['id'];
                    $agency_name = $row['name'];
                    $dob = $row['dob'];
                    $gender = $row['gender'];
                    $phone = $row['phone'];
                    $address = $row['address'];
                    $state = $row['state'];
                    $city = $row['city'];
                    $pin = $row['pin_code'];
                    $company = $row['company'];
                    $agency_email = $row['email'];

                }

            }

        }
    /* ============================= EDIT AGENCY ================================ */
    
    /* ============================= UPDATE AGENCY ============================== */
        // Update Agency Data
        if (isset($_POST['update_agency'])) {

            $id = $_POST['agency_id'];
            $agency_name = $_POST['agency_name'];
            $dob = $_POST['dob'];
            $gender = $_POST['gender'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $state = $_POST['state'];
            $city = $_POST['city'];
            $pin = $_POST['pin'];
            $company = $_POST['company'];
            $agency_email = $_POST['agency_email'];

            if (empty($msg)) {

                try {

                    // Create SQL Insert Statement
                    $sql = "UPDATE agency SET name = :name, dob = :dob, gender = :gender, phone = :phone, address = :address, state = :state, city = :city, pin_code = :pin, company = :company, email = :email WHERE id = :id";

                    // Use PDO prepared to sanitize data
                    $stmt = $db->prepare($sql);

                    if (empty($company)) {

                        // Create SQL Insert Statement
                        $sql = "UPDATE agency SET name = :name, dob = :dob, gender = :gender, phone = :phone, address = :address, state = :state, city = :city, pin_code = :pin, email = :email WHERE id = :id";

                        // Use PDO prepared to sanitize data
                        $stmt = $db->prepare($sql);

                        // Add the data into the database
                        $stmt->execute(array(':name' => $agency_name, ':dob' => $dob, ':gender' => $gender, ':phone' => $phone, ':address' => $address, ':state' => $state, ':city' => $city, ':pin' => $pin, ':email' => $agency_email, ':id' => $id));

                    } else {

                        // Add the data into the database
                        $stmt->execute(array(':name' => $agency_name, ':dob' => $dob, ':gender' => $gender, ':phone' => $phone, ':address' => $address, ':state' => $state, ':city' => $city, ':pin' => $pin, ':company' => $company, ':email' => $agency_email, ':id' => $id));

                    }

                    if ($stmt->rowCount() == 1) {

                        $msg = "<script>
                                swal({
                                title: \"Updated!\",
                                text: \"Agency data has been updated.\",
                                type: 'success',
                                timer: 2000,
                                showConfirmButton: false });

                                setTimeout(function(){
                                    window.location.href = 'all-agency.php';
                                }, 1000);
                            </script>";

                    }
        
                } catch (PDOException $ex) {
        
                    $msg = flashMessage("An error occurred: " . $ex->getMessage());
        
                }


            } else {

                $msg = flashMessage("Sorry, something want wrong. Please try again.");

            }

        }
    /* ============================= UPDATE AGENCY ============================== */

    /* ============================= DELETE AGENCY ============================== */
        // Delete Agency Data
        if (isset($_GET['del'])) {

            $id = $_GET['del'];
            // Create SQL Insert Statement
            $sql = "DELETE FROM agency WHERE id = $id";
            
            // Use PDO Prepared to sanitize data
            $stmt = $db->prepare($sql);

            // Add the data into the database
            $stmt->execute();

            $msg = "<script>
                        swal({
                        title: \"Deleted!\",
                        text: \"One Agency data has been deleted.\",
                        type: 'success',
                        timer: 2000,
                        showConfirmButton: false });

                        setTimeout(function(){
                            window.location.href = 'all-agency.php';
                        }, 1000);
                    </script>";

        }
    /* ============================= DELETE AGENCY ============================== */

    /* ============================= UPDATE AGENCY PASSWORD ============================== */
        // Update Agency Password
        if (isset($_POST['reset_password'])) {

            $id = $_POST['agency_id'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            // ============ FORM VALIDATION =========================

                if(empty($password)) {
                    $password_error = "Password is required";
                }

                else if(empty($confirm_password)) {
                    $confirm_password_error = "Confirm password is required";
                }

                else if ($password != $confirm_password) {

					$msg = "<script>
							swal({
							title: \"Oops..\",
							text: \"Passwords does not match.\",
							type: 'error',
							confirmButtonText: \"Ok\" });
                    	</script>";
						
				}

            // ============ FORM VALIDATION =========================

            else if (empty($msg)) {

                // Secured user password
				$hashed_password = password_hash($password, PASSWORD_DEFAULT);

                try {

                    // Create SQL Insert Statement
                    $sql = "UPDATE agency SET password = :password WHERE id = :id";

                    // Use PDO prepared to sanitize data
                    $stmt = $db->prepare($sql);

                    // Add the data into the database
                    $stmt->execute(array(':password' => $hashed_password, ':id' => $id));

                    if ($stmt->rowCount() == 1) {

                        $msg = "<script>
                                swal({
                                title: \"Updated!\",
                                text: \"Agency password has been updated.\",
                                type: 'success',
                                timer: 3000,
                                showConfirmButton: false });

                                setTimeout(function(){
                                    window.location.href = 'all-agency.php';
                                }, 2000);
                            </script>";

                    }
        
                } catch (PDOException $ex) {
        
                    $msg = flashMessage("An error occurred: " . $ex->getMessage());
        
                }


            } else {

                $msg = flashMessage("Sorry, something want wrong. Please try again.");

            }

        }
    /* ============================= UPDATE AGENCY PASSWORD ============================== */

    /* ============================= BLOCK AGENCY ============================== */
        // Blocked Agency
        if (isset($_POST['block_btn'])) {

            $id = $_POST['user_id'];
            $block_remark = $_POST['block_remark'];

            if (empty($msg)) {

                try {

                    // Create SQL Insert Statement
                    $sql = "UPDATE agency SET block = :block, block_remark = :block_remark, status = :status WHERE id = :id";

                    // Use PDO prepared to sanitize data
                    $stmt = $db->prepare($sql);

                    // Add the data into the database
                    $stmt->execute(array(':block' => '1', ':block_remark' => $block_remark, ':status' => 'Blocked', ':id' => $id));

                    if ($stmt->rowCount() == 1) {

                        $msg = "<script>
                                swal({
                                title: \"Blocked!\",
                                text: \"Agency has been blocked.\",
                                type: 'success',
                                timer: 2000,
                                showConfirmButton: false });

                                setTimeout(function(){
                                    window.location.href = 'all-agency.php';
                                }, 1000);
                            </script>";

                    }
        
                } catch (PDOException $ex) {
        
                    $msg = flashMessage("An error occurred: " . $ex->getMessage());
        
                }


            } else {

                $msg = flashMessage("Sorry, something want wrong. Please try again.");

            }

        }
    /* ============================= BLOCK AGENCY ============================== */

    /* ============================= ACTIVATE AGENCY ============================== */
        // Activated Agency
        if (isset($_POST['activate_btn'])) {

            $id = $_POST['user_id'];
            $activate_remark = $_POST['activate_remark'];

            if (empty($msg)) {

                try {

                    // Create SQL Insert Statement
                    $sql = "UPDATE agency SET block = :block, block_remark = :block_remark, status = :status WHERE id = :id";

                    // Use PDO prepared to sanitize data
                    $stmt = $db->prepare($sql);

                    // Add the data into the database
                    $stmt->execute(array(':block' => '0', ':block_remark' => $activate_remark, ':status' => 'Active', ':id' => $id));

                    if ($stmt->rowCount() == 1) {

                        $msg = "<script>
                                swal({
                                title: \"Activated!\",
                                text: \"Agency has been activated.\",
                                type: 'success',
                                timer: 2000,
                                showConfirmButton: false });

                                setTimeout(function(){
                                    window.location.href = 'all-agency.php';
                                }, 1000);
                            </script>";

                    }
        
                } catch (PDOException $ex) {
        
                    $msg = flashMessage("An error occurred: " . $ex->getMessage());
        
                }


            } else {

                $msg = flashMessage("Sorry, something want wrong. Please try again.");

            }

        }
    /* ============================= ACTIVATE AGENCY ============================== */
