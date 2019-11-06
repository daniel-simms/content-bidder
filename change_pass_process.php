<?php
//error_reporting(0);

$has_error = false;

if(isset($_POST['update'])) {
			
	if(empty($_POST['old_password'])) {
		$error_old_password= "Please enter old password";
		$has_error = true;
	} else {
		$old_password = filterUserInput($_POST['old_password']);
    }
    if(empty($_POST['new_password'])) {
		$error_new_password = "Please enter new password";
		$has_error = true;
	} 
    if(empty($_POST['confirm_password'])) {
		$error_confirm_password = "Please confirm password";
		$has_error = true;
	} else {
        if($_POST['new_password'] != $_POST['confirm_password']){
            echo $error_confirm = "Passwords do not match";
            $has_error = true;
        } else {
		    $new_password = filterUserInput($_POST['new_password']);
        }
	}

	if(!$has_error) {
		update_pass();
	}

}


function update_pass(){

    global $conn, $old_password, $new_password, $error_old_password, $error_new_password;
    $email = $_SESSION['email'];
	
	$sql =  "SELECT password FROM users where email='$email' and password=sha1('$old_password')";
    $result = mysqli_query($conn, $sql);

	if(mysqli_num_rows($result) > 0){
            $sql=  "UPDATE users SET password = sha1('$new_password') WHERE users.email = '$email'";
            $result = mysqli_query($conn, $sql);
            if(mysqli_affected_rows($conn)){
                header('Location: ?pass=updated');
            } else {
                if($old_password == $new_password){
                    $error_new_password = 'Passwords cannot be the same';
                } else {
                    header('Location: ?pass=error');
                }   
            }
		} else {
            $error_old_password = "Incorrect password";
        }
	
}
		
?>