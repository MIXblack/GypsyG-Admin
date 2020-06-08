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


    /* ============================= ADD ADMIN ================================= */
        // Add Admin Data
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

                // Configure upload directory and allowed file types 
                $profile_dir = 'profiles'.DIRECTORY_SEPARATOR; 
                $document_dir = 'documents'.DIRECTORY_SEPARATOR; 
                $profile_types = array('jpg', 'png', 'jpeg', 'gif'); 
                $document_types = array('jpg', 'docx', 'doc', 'pdf', 'png', 'jpeg'); 
      
                // Define maxsize for files i.e 2MB 
                $maxsize = 2 * 1024 * 1024;  

                try {

                    // Checks if user sent an empty form  
                    if(!empty(array_filter($_FILES['agency_profile']['name'])) && !empty(array_filter($_FILES['id_document']['name']))) { 

                        $temp_file = $_FILES['agency_profile']['tmp_name']; 
                        $file_name = $_FILES['agency_profile']['name']; 
                        $file_size = $_FILES['agency_profile']['size']; 
                        $ext = pathinfo($file_name, PATHINFO_EXTENSION); 

                        // Set upload file path 
                        $path = $profile_dir.$random_no.$file_name; 

                        // Check file type is allowed or not 
                        if(in_array(strtolower($ext), $profile_types)) { 
            
                            // Verify file size - 2MB max  
                            if ($file_size > $maxsize) {       
                               
                                $agency_profile_error = "Image size must be within 2MB.";  
                            
                            } else if( move_uploaded_file($temp_file, $path)) { 

                                // Create SQL Insert Statement
                                $sql = "INSERT INTO agency (name, password, profile, dob, gender, phone, email, company, address, state, city, pin_code, branch, package, status, super_admin) VALUES (:name, :password, :profile, :dob, :gender, :phone, :email, :company, :address, :state, :city, :pin_code, :branch, :package, :status, :super_admin)";

                                // Use PDO prepared to sanitize data
                                $stmt = $db->prepare($sql);

                                if (empty($company)) {

                                    // Create SQL Insert Statement
                                    $sql = "INSERT INTO agency (name, password, profile, dob, gender, phone, email, address, state, city, pin_code, branch, package, status, super_admin) VALUES (:name, :password, :profile, :dob, :gender, :phone, :email, :address, :state, :city, :pin_code, :branch, :package, :status, :super_admin)";

                                    // Use PDO prepared to sanitize data
                                    $stmt = $db->prepare($sql);

                                    // Add the data into the database
                                    $stmt->execute(array(':name' => $agency_name, ':password' => $hashed_password, ':profile' => $path, ':dob' => $dob, ':gender' => $gender, ':phone' => $phone, ':email' => $agency_email, ':address' => $address, ':state' => $state, ':city' => $city, 'pin_code' => $pin, ':branch' => $branch, ':package' => $package, ':status' => 'Active', ':super_admin' => $id));

                                } else {

                                    // Add the data into the database
                                    $stmt->execute(array(':name' => $agency_name, ':password' => $hashed_password, ':profile' => $path, ':dob' => $dob, ':gender' => $gender, ':phone' => $phone, ':email' => $agency_email, ':company' => $company, ':address' => $address, ':state' => $state, ':city' => $city, 'pin_code' => $pin, ':branch' => $branch, ':package' => $package, ':status' => 'Active', ':super_admin' => $id));

                                }

                            } else {      

                                $agency_profile_error = "Error uploading {$file_name}";  

                            } 

                        } else { 
                            
                            // If file extention not valid 
                            $agency_profile_error = "Image format is not allowed."; 

                        }  

                        // Get the last inserted ID
                        $agency_id = $db->lastInsertId();

                        // Loop through each file in files[] array 
                        foreach ($_FILES['id_document']['tmp_name'] as $key => $value) { 

                            $temp_file2 = $_FILES['id_document']['tmp_name'][$key]; 
                            $file_name2 = $_FILES['id_document']['name'][$key]; 
                            $file_size2 = $_FILES['id_document']['size'][$key]; 
                            $ext2 = pathinfo($file_name2, PATHINFO_EXTENSION); 

                            // Set upload file path 
                            $path2 = $document_dir.$random_no.$file_name2; 
                            
                            // Check file type is allowed or not 
                            if(in_array(strtolower($ext2), $document_types)) { 

                                // Verify file size - 2MB max  
                                if ($file_size2 > $maxsize) {       
                                
                                    $id_proof_error = "Document size must be within 2MB.";  
                                
                                } else if( move_uploaded_file($temp_file2, $path2)) { 
                                    
                                    // Create SQL Insert Statement
                                    $sql = "INSERT INTO documents (id_proof, id_document, agency_id) VALUES (:proof, :document, :id)";

                                    // Use PDO prepared to sanitize data
                                    $stmt = $db->prepare($sql);

                                    // Add the data into the database
                                    $stmt->execute(array(':proof' => $id_proof, ':document' => $path2, ':id' => $agency_id));

                                } else {      

                                    $id_proof_error = "Error uploading {$file_name2}";  
    
                                } 

                            } else { 
                                
                                // If file extention not valid 
                                $id_proof_error = "Document format is not allowed."; 

                            } 

                        }

                        if ($stmt->rowCount() == 1) {

                            $msg = "<script>
                                    swal({
                                    title: \"Account Created!\",
                                    text: \"New prime agency has been created.\",
                                    type: 'success',
                                    timer: 3000,
                                    showConfirmButton: false });
    
                                    setTimeout(function(){
                                        window.location.href = 'all-agency.php';
                                    }, 2000);
                                </script>";
    
                        }

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
    /* ============================= ADD ADMIN ================================= */

    /* ============================= EDIT ADMIN ================================ */ 
        // Edit Admin Data
        if (isset($_GET['edit'])) {

            $id = $_GET['edit'];
            $update = true;
            
            // Create SQL Insert Statement
            $sql = "SELECT * FROM admins WHERE id = $id";
                                
            // Use PDO Prepared to sanitize data
            $stmt = $db->prepare($sql);

            $stmt->execute();

            $result = $stmt->fetchAll();

            if (!empty($result)) {

                foreach($result as $row) {

                    $admin_id = $row['id'];
                    $admin_username = $row['username'];
                    $type = $row['contract'];
                    $company_share = $row['share_one'];
                    $admin_share = $row['share_two'];

                }

            }

        }
    /* ============================= EDIT ADMIN ================================ */
    
    /* ============================= UPDATE ADMIN ============================== */
        // Update Admin Data
        if (isset($_POST['update_admin'])) {

            $id = $_POST['id'];
            $type = $_POST['type'];
            $company_share = $_POST['company_share'];
            $admin_share = $_POST['admin_share'];
            
            // ============ FORM VALIDATION =========================

                if(empty($type)) {
                    $type_error = "Contract type is required";
                }

            // ============ FORM VALIDATION =========================

            else if (empty($msg)) {

                try {

                    // Create SQL Insert Statement
                    $sql = "UPDATE admins SET contract = :contract WHERE id = :id";

                    // Use PDO prepared to sanitize data
                    $stmt = $db->prepare($sql);

                    if ($type === 'Sharing') {

                        // Create SQL Insert Statement
                        $sql = "UPDATE admins SET contract = :contract, share_one = :share_one, share_two = :share_two WHERE id = :id";

                        // Use PDO prepared to sanitize data
                        $stmt = $db->prepare($sql);

                        // Add the data into the database
                        $stmt->execute(array(':contract' => $type, ':share_one' => $company_share, ':share_two' => $admin_share, ':id' => $id));

                    } else {

                        // Add the data into the database
                        $stmt->execute(array(':contract' => $type, ':id' => $id));

                    }

                    if ($stmt->rowCount() == 1) {

                        $msg = "<script>
                                swal({
                                title: \"Updated!\",
                                text: \"Admin data has been created.\",
                                type: 'success',
                                timer: 3000,
                                showConfirmButton: false });

                                setTimeout(function(){
                                    window.location.href = 'all-admins.php';
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
    /* ============================= UPDATE ADMIN ============================== */

    /* ============================= DELETE ADMIN ============================== */
        // Delete Admin Data
        if (isset($_GET['del'])) {

            $id = $_GET['del'];
            // Create SQL Insert Statement
            $sql = "DELETE FROM admins WHERE id = $id";
            
            // Use PDO Prepared to sanitize data
            $stmt = $db->prepare($sql);

            // Add the data into the database
            $stmt->execute();

            $msg = "<script>
                        swal({
                        title: \"Deleted!\",
                        text: \"One Admin data has been deleted.\",
                        type: 'success',
                        timer: 3000,
                        showConfirmButton: false });

                        setTimeout(function(){
                            window.location.href = 'all-admins.php';
                        }, 2000);
                    </script>";

        }
    /* ============================= DELETE ADMIN ============================== */

    /* ============================= UPDATE ADMIN PASSWORD ============================== */
        // Update Admin Password
        if (isset($_POST['reset_password'])) {

            $id = $_POST['admin_id'];
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
                    $sql = "UPDATE admins SET password = :password WHERE id = :id";

                    // Use PDO prepared to sanitize data
                    $stmt = $db->prepare($sql);

                    // Add the data into the database
                    $stmt->execute(array(':password' => $hashed_password, ':id' => $id));

                    if ($stmt->rowCount() == 1) {

                        $msg = "<script>
                                swal({
                                title: \"Updated!\",
                                text: \"Admin password has been updated.\",
                                type: 'success',
                                timer: 3000,
                                showConfirmButton: false });

                                setTimeout(function(){
                                    window.location.href = 'all-admins.php';
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
    /* ============================= UPDATE ADMIN PASSWORD ============================== */

    /* ============================= BLOCK ADMIN ============================== */
        // Blocked Admin
        if (isset($_POST['block_btn'])) {

            $id = $_POST['id'];
            $block_remark = $_POST['block_remark'];

            if (empty($msg)) {

                try {

                    // Create SQL Insert Statement
                    $sql = "UPDATE admins SET block = :block, block_remark = :block_remark, status = :status WHERE id = :id";

                    // Use PDO prepared to sanitize data
                    $stmt = $db->prepare($sql);

                    // Add the data into the database
                    $stmt->execute(array(':block' => '1', ':block_remark' => $block_remark, ':status' => 'Blocked', ':id' => $id));

                    if ($stmt->rowCount() == 1) {

                        $msg = "<script>
                                swal({
                                title: \"Blocked!\",
                                text: \"Admin has been blocked.\",
                                type: 'success',
                                timer: 3000,
                                showConfirmButton: false });

                                setTimeout(function(){
                                    window.location.href = 'all-admins.php';
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
    /* ============================= BLOCK ADMIN ============================== */

    /* ============================= ACTIVATE ADMIN ============================== */
        // Activated Admin
        if (isset($_POST['activate_btn'])) {

            $id = $_POST['id'];
            $activate_remark = $_POST['activate_remark'];

            if (empty($msg)) {

                try {

                    // Create SQL Insert Statement
                    $sql = "UPDATE admins SET block = :block, block_remark = :block_remark, status = :status WHERE id = :id";

                    // Use PDO prepared to sanitize data
                    $stmt = $db->prepare($sql);

                    // Add the data into the database
                    $stmt->execute(array(':block' => '0', ':block_remark' => $activate_remark, ':status' => 'Active', ':id' => $id));

                    if ($stmt->rowCount() == 1) {

                        $msg = "<script>
                                swal({
                                title: \"Activated!\",
                                text: \"Admin has been activated.\",
                                type: 'success',
                                timer: 3000,
                                showConfirmButton: false });

                                setTimeout(function(){
                                    window.location.href = 'all-admins.php';
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
    /* ============================= ACTIVATE ADMIN ============================== */
