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
    $package_name = "";
    $amount = "";
    $package_for = "";
	$id = 0;
    $update = false;
    
    // Error Variables
    $package_name_error = "";
    $amount_error = "";
    $package_for_error = "";

    /* ============================= ADD AGENCY PACKAGE ================================= */
        // Add Package Data
        if (isset($_POST['add_agency_package'])) {

            /** 
                *  Process the form
            */

            // Collect form data and store in variables
            $package_name = $_POST['package_name'];
            $amount = $_POST['amount'];
            $package_for = $_POST['package_for'];
            $id = $_POST['id'];
            $msg = '';

            // ============ FORM VALIDATION =========================

                if(empty($package_name)) {
                    $package_name_error = "Package name is required";
                }

                else if(empty($amount)) {
                    $amount_error = "Package amount is required";
                }

                else if(empty($package_for)) {
                    $package_for_error = "Select Package for";
                }
                
            // ============ FORM VALIDATION =========================
            
            // Check if error array is empty, if yes process form data and insert record
            else if (empty($msg)) {

                try {

                    // Create SQL Insert Statement
                    $sql = "INSERT INTO agency_package (name, amount, package_for) VALUES (:name, :amount, :package_for)";

                    // Use PDO prepared to sanitize data
                    $stmt = $db->prepare($sql);

                    // Add the data into the database
                    $stmt->execute(array(':name' => $package_name, ':amount' => $amount, ':package_for' => $package_for));

                    if ($stmt->rowCount() == 1) {

                        $msg = "<script>
                                swal({
                                title: \"Created!\",
                                text: \"Package has been created.\",
                                type: 'success',
                                timer: 2000,
                                showConfirmButton: false });

                                setTimeout(function(){
                                    window.location.href = 'package-setup.php';
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
    /* ============================= ADD AGENCY PACKAGE ================================= */

    /* ============================= EDIT AGENCY PACKAGE ================================ */ 
        // Edit Package Data
        if (isset($_GET['edit'])) {

            $id = $_GET['edit'];
            $update = true;
            
            // Create SQL Insert Statement
            $sql = "SELECT * FROM agency_package WHERE id = $id";
                                
            // Use PDO Prepared to sanitize data
            $stmt = $db->prepare($sql);

            $stmt->execute();

            $result = $stmt->fetchAll();

            if (!empty($result)) {

                foreach($result as $row) {

                    $id = $row['id'];
                    $package_name = $row['name'];
                    $amount = $row['amount'];
                    $package_for = $row['package_for'];
                }

            }

        }
    /* ============================= EDIT AGENCY PACKAGE ================================ */
    
    /* ============================= UPDATE AGENCY PACKAGE ============================== */
        // Update Package Data
        if (isset($_POST['update_agency_package'])) {

            $package_name = $_POST['package_name'];
            $amount = $_POST['amount'];
            $id = $_POST['id'];
            $package_for = $_POST['package_for'];
            

            if (empty($msg)) {

                try {

                    // Create SQL Insert Statement
                    $sql = "UPDATE agency_package SET name = :name, amount = :amount, package_for = :package_for WHERE id = :id";

                    // Use PDO prepared to sanitize data
                    $stmt = $db->prepare($sql);

                    // Add the data into the database
                    $stmt->execute(array(':name' => $package_name, ':amount' => $amount, ':package_for' => $package_for, ':id' => $id));

                    if ($stmt->rowCount() == 1) {

                        $msg = "<script>
                                swal({
                                title: \"Updated!\",
                                text: \"Package has been updated.\",
                                type: 'success',
                                timer: 2000,
                                showConfirmButton: false });

                                setTimeout(function(){
                                    window.location.href = 'package-setup.php';
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
    /* ============================= UPDATE AGENCY PACKAGE ============================== */

    /* ============================= DELETE AGENCY PACKAGE ============================== */
        // Delete package Data
        if (isset($_GET['del'])) {

            $id = $_GET['del'];
            // Create SQL Insert Statement
            $sql = "DELETE FROM agency_package WHERE id = $id";
            
            // Use PDO Prepared to sanitize data
            $stmt = $db->prepare($sql);

            // Add the data into the database
            $stmt->execute();

            $msg = "<script>
                        swal({
                        title: \"Deleted!\",
                        text: \"One Package has been deleted.\",
                        type: 'success',
                        timer: 2000,
                        showConfirmButton: false });

                        setTimeout(function(){
                            window.location.href = 'package-setup.php';
                        }, 1000);
                    </script>";

        }
    /* ============================= DELETE AGENCY PACKAGE ============================== */
