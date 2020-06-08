<?php 

    // error_reporting(0);

    // Include Session File
	include_once('resource/session.php');

    // Include Database Conncection Script File
	include_once('resource/database.php');

	// Include Utilities File
    include_once('resource/utilities.php');

    // Fetch User Details
    if ((isset($_SESSION['id']) || isset($_GET['user_identity'])) && !isset($_POST['Update_profile'])) {

        if(isset($_GET['user_identity'])) {

            $url_encoded_id = $_GET['user_identity'];
            $decode_id = base64_decode($url_encoded_id);
            $user_id_array = explode("encodeuserid", $decode_id);
            $id = $user_id_array[1];

        } else {
            $id = $_SESSION['id'];
        }

        $sql = "SELECT * FROM admins WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->execute(array(':id' => $id));

        while($row = $stmt->fetch()) {

            $email = $row['email'];
            $name = $row['name'];
            $username = $row['username'];
            $profile_picture = $row['avatar'];
            $date_joined = strftime("%b %d, %Y", strtotime($row['created_at']));

        }

        $encode_id = base64_encode("encodeuserid{$id}");

    } else if(isset($_POST['Update_profile'], $_POST['token'])) {

        // Validate the token
        if(validate_token($_POST['token'])) {

            /** 
             *  Process the form
            */
            
            // Initialize an array to store any error message from the form
            $form_errors = array();

            // Form validation
            // $required_fields = array('name');

            // Call the function to check empty field and merge the return data into form_error array
            // $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

            // Validate if file has a valid extension
            isset($_FILES['avatar']['name']) ? $avatar = $_FILES['avatar']['name'] : $avatar = null;

            if ($avatar != null) {

                $form_errors = array_merge($form_errors, isValidImage($avatar));

            }

            // Collect form data and store in variables
            $name = $_POST['name'];
            $hidden_id = $_POST['hidden_id'];

            $msg = false;

            if(empty($form_errors) && !$msg) {

                try {

                    $query = "SELECT avatar FROM admins WHERE id = :id";
                    $oldAvatarStatement = $db->prepare($query);
                    $oldAvatarStatement->execute([':id' => $hidden_id]);

                    if($rs = $oldAvatarStatement->fetch()) {

                        $oldAvatar = $rs['avatar'];

                    }

                    // Create SQL update statement
                    $sql = "UPDATE admins SET name = :name WHERE id = :id";

                    // Use PDO prepared to sanitize data
                    $stmt = $db->prepare($sql);

                    if($avatar != null) {

                        // Create SQL update statement
                        $sql = "UPDATE admins SET name = :name, avatar = :avatar WHERE id = :id";

                        $avatar_path = uploadAvatar($name);

                        if(!$avatar_path) {

                            $avatar_path = "uploads/default.png";

                        }

                        // Use PDO prepared to sanitize data
                        $stmt = $db->prepare($sql);

                        // Update the record in the database
                        $stmt->execute(array(':username' => $username, 'avatar' =>$avatar_path, ':id' => $hidden_id));

                        if(isset($oldAvatar)) {

                            unlink($oldAvatar);

                        }

                    } else {

                        
                        // Update the record in the database
                        $stmt->execute(array(':username' => $username, ':id' => $hidden_id));

                    }

                    // Check if one new row was created
                    if($stmt->rowCount() == 1) {

                        $msg = "<script>
                                    swal({
                                    title: \"Updated!\",
                                    text: \"$username, your password has been updated.\",
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
                                text: \"Nothing happened, You have not made any changes\",
                                type: 'error',
                                timer: 2000,
                                showConfirmButton: false });

                                setTimeout(function(){
                                    window.location.href = 'edit-profile.php';
                                }, 1000);
                            </script>";

                    }

                } catch (PDOException $ex) {
                    $msg = flashMessage("An error occurred in: " . $ex->getMessage());   
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
                            window.location.href = 'edit-profile.php';
                        }, 1000);
                    </script>";

        }

        

    }

