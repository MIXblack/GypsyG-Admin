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
    $state = "";
    $city = "";
    $pin = "";
	$id = 0;
    $update = false;
    
    // Error Variables
    $state_error = "";
    $city_error = "";
    $pin_error = "";

    /* ============================= ADD PIN CODE ================================= */
        // Add Pin Code Data
        if (isset($_POST['add_pin'])) {

            /** 
                *  Process the form
            */

            // Collect form data and store in variables
            $state = $_POST['state'];
            $city = $_POST['city'];
            $pin = $_POST['pin'];
            $id = $_POST['id'];
            $msg = '';

            $pin_code_pattern = '/^[1-9][0-9]{5}$/';

            // ============ FORM VALIDATION =========================

                if(empty($state)) {
                    $state_error = "State is required";
                }

                else if(empty($city)) {
                    $city_error = "City is required";
                }

                else if(empty($pin)) {
                    $pin_error = "Pin Code is required";
                }

                else if (checkDuplicatePinCode($pin, $db)) {

                    $msg = "<script>
                            swal({
                            title: \"Oops..\",
                            text: \"Pin Code is already created, please try another one.\",
                            type: 'error',
                            confirmButtonText: \"Ok\" });
                        </script>";
                        
                }

                else if(!preg_match($pin_code_pattern, $pin)){

					$msg = "<script>
							swal({
							title: \"Oops..\",
							text: \"Please use valid pin code.\",
							type: 'error',
							confirmButtonText: \"Ok\" });
                    	</script>";
						
				}
                
            // ============ FORM VALIDATION =========================
            
            // Check if error array is empty, if yes process form data and insert record
            else if (empty($msg)) {

                try {

                    // Create SQL Insert Statement
                    $sql = "INSERT INTO pin_code (state, city, pin) VALUES (:state, :city, :pin)";

                    // Use PDO prepared to sanitize data
                    $stmt = $db->prepare($sql);

                    // Add the data into the database
                    $stmt->execute(array(':state' => $state, ':city' => $city, ':pin' => $pin));

                    if ($stmt->rowCount() == 1) {

                        $msg = "<script>
                                swal({
                                title: \"Created!\",
                                text: \"Pin Code has been created.\",
                                type: 'success',
                                timer: 2000,
                                showConfirmButton: false });

                                setTimeout(function(){
                                    window.location.href = 'pin-code.php';
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
    /* ============================= ADD PIN CODE ================================= */

    /* ============================= EDIT PIN CODE ================================ */ 
        // Edit Pin Code Data
        if (isset($_GET['edit'])) {

            $id = $_GET['edit'];
            $update = true;
            
            // Create SQL Insert Statement
            $sql = "SELECT * FROM pin_code WHERE id = $id";
                                
            // Use PDO Prepared to sanitize data
            $stmt = $db->prepare($sql);

            $stmt->execute();

            $result = $stmt->fetchAll();

            if (!empty($result)) {

                foreach($result as $row) {

                    $id = $row['id'];
                    $state = $row['state'];
                    $city = $row['city'];
                    $pin = $row['pin'];
                }

            }

        }
    /* ============================= EDIT PIN CODE ================================ */
    
    /* ============================= UPDATE PIN CODE ============================== */
        // Update Pin Code Data
        if (isset($_POST['update_pin'])) {

            $id = $_POST['id'];
            $state = $_POST['state'];
            $city = $_POST['city'];
            $pin = $_POST['pin'];
            

            if (empty($msg)) {

                try {

                    // Create SQL Insert Statement
                    $sql = "UPDATE pin_code SET state = :state, city = :city, pin = :pin WHERE id = :id";

                    // Use PDO prepared to sanitize data
                    $stmt = $db->prepare($sql);

                    // Add the data into the database
                    $stmt->execute(array(':state' => $state, ':city' => $city, ':pin' => $pin, ':id' => $id));

                    if ($stmt->rowCount() == 1) {

                        $msg = "<script>
                                swal({
                                title: \"Updated!\",
                                text: \"Pin Code has been updated.\",
                                type: 'success',
                                timer: 2000,
                                showConfirmButton: false });

                                setTimeout(function(){
                                    window.location.href = 'pin-code.php';
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
    /* ============================= UPDATE PIN CODE ============================== */

    /* ============================= DELETE PIN CODE ============================== */
        // Delete Pin Code Data
        if (isset($_GET['del'])) {

            $id = $_GET['del'];
            // Create SQL Insert Statement
            $sql = "DELETE FROM pin_code WHERE id = $id";
            
            // Use PDO Prepared to sanitize data
            $stmt = $db->prepare($sql);

            // Add the data into the database
            $stmt->execute();

            $msg = "<script>
                        swal({
                        title: \"Deleted!\",
                        text: \"One Pin Code has been deleted.\",
                        type: 'success',
                        timer: 2000,
                        showConfirmButton: false });

                        setTimeout(function(){
                            window.location.href = 'pin-code.php';
                        }, 1000);
                    </script>";

        }
    /* ============================= DELETE PIN CODE ============================== */
