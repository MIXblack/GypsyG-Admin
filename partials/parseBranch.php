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
    $branch_name = "";
    $pin = "";
    $state = "";
    $city = "";
	$id = 0;
    $update = false;
    
    // Error Variables
    $branch_name_error = "";
    $pin_error = "";

    /* ============================= ADD BRANCH ================================= */
        // Add Branch Data
        if (isset($_POST['add_branch'])) {

            /** 
                *  Process the form
            */

            // Collect form data and store in variables
            $branch_name = $_POST['branch_name'];
            $pin = $_POST['pin'];
            $id = $_POST['id'];
            $msg = '';

            // ============ FORM VALIDATION =========================

                if(empty($branch_name)) {
                    $branch_name_error = "Branch name is required";
                }

                else if(empty($pin)) {
                    $pin_error = "Pin Code is required";
                }
                
            // ============ FORM VALIDATION =========================
            
            // Check if error array is empty, if yes process form data and insert record
            else if (empty($msg)) {

                try {

                    // ================ PIN CODE ===================
                        $query = "SELECT * FROM pin_code WHERE pin = '$pin'";
                                            
                        // Use PDO Prepared to sanitize data
                        $pin_stmt = $db->prepare($query);

                        $pin_stmt->execute();

                        $pin_result = $pin_stmt->fetchAll();

                        if (!empty($pin_result)) {

                            foreach($pin_result as $row) {
                                $st = $row['state'];
                                $ct = $row['city'];
                            }

                        }

                        // Pin Detials
                        $state = $st;
                        $city = $ct;
                    // ================ PIN CODE ===================

                    // Create SQL Insert Statement
                    $sql = "INSERT INTO branch (name, pin, city, state) VALUES (:name, :pin, :city, :state)";

                    // Use PDO prepared to sanitize data
                    $stmt = $db->prepare($sql);

                    // Add the data into the database
                    $stmt->execute(array(':name' => $branch_name, ':pin' => $pin, ':city' => $city, ':state' => $state));

                    if ($stmt->rowCount() == 1) {

                        $msg = "<script>
                                swal({
                                title: \"Created!\",
                                text: \"Branch has been created.\",
                                type: 'success',
                                timer: 2000,
                                showConfirmButton: false });

                                setTimeout(function(){
                                    window.location.href = 'branch.php';
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
    /* ============================= ADD BRANCH ================================= */

    /* ============================= EDIT BRANCH ================================ */ 
        // Edit Branch Data
        if (isset($_GET['edit'])) {

            $id = $_GET['edit'];
            $update = true;
            
            // Create SQL Insert Statement
            $sql = "SELECT * FROM branch WHERE id = $id";
                                
            // Use PDO Prepared to sanitize data
            $stmt = $db->prepare($sql);

            $stmt->execute();

            $result = $stmt->fetchAll();

            if (!empty($result)) {

                foreach($result as $row) {

                    $id = $row['id'];
                    $branch_name = $row['name'];
                }

            }

        }
    /* ============================= EDIT BRANCH ================================ */
    
    /* ============================= UPDATE BRANCH ============================== */
        // Update Branch Data
        if (isset($_POST['update_branch'])) {

            $id = $_POST['id'];
            $branch_name = $_POST['branch_name'];
            

            if (empty($msg)) {

                try {

                    // Create SQL Insert Statement
                    $sql = "UPDATE branch SET name = :name WHERE id = :id";

                    // Use PDO prepared to sanitize data
                    $stmt = $db->prepare($sql);

                    // Add the data into the database
                    $stmt->execute(array(':name' => $branch_name, ':id' => $id));

                    if ($stmt->rowCount() == 1) {

                        $msg = "<script>
                                swal({
                                title: \"Updated!\",
                                text: \"Branch has been updated.\",
                                type: 'success',
                                timer: 2000,
                                showConfirmButton: false });

                                setTimeout(function(){
                                    window.location.href = 'branch.php';
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
    /* ============================= UPDATE BRANCH ============================== */

    /* ============================= DELETE BRANCH ============================== */
        // Delete Branch Data
        if (isset($_GET['del'])) {

            $id = $_GET['del'];
            // Create SQL Insert Statement
            $sql = "DELETE FROM branch WHERE id = $id";
            
            // Use PDO Prepared to sanitize data
            $stmt = $db->prepare($sql);

            // Add the data into the database
            $stmt->execute();

            $msg = "<script>
                        swal({
                        title: \"Deleted!\",
                        text: \"One Branch has been deleted.\",
                        type: 'success',
                        timer: 2000,
                        showConfirmButton: false });

                        setTimeout(function(){
                            window.location.href = 'branch.php';
                        }, 1000);
                    </script>";

        }
    /* ============================= DELETE BRANCH ============================== */
