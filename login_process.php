<?php

// Login form validation
$has_error = false;

if(isset($_POST['login'])) {
	if(empty($_POST['email'])) {
		$error_email = "Please enter email";
		$has_error = true;
	} else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$error_email = "Please enter valid email.";
		$has_error = true;
	} else {
		$email = filterUserInput($_POST['email']);
	}

	if(empty($_POST['password'])) {
		$error_password= "Please enter password";
		$has_error = true;
	} else {
		$password = filterUserInput($_POST['password']);
	}

	if(!$has_error) {
		check_user();
	}

}

// Chekcs user against database
function check_user(){

	global $conn, $email, $password, $error_email;
	// look for user with the entered username and password from the form
	$sql =  "SELECT * FROM users where email='$email' and password=sha1('$password')";
	$result = mysqli_query($conn, $sql);


	if(mysqli_num_rows($result) > 0){
		$user_record  = mysqli_fetch_assoc($result) ;
		extract($user_record);
		// create super global varible with email and user id
		$_SESSION['email'] = $email;
		$_SESSION['user_id'] = $user_id;

		// is user hasnt activate email show error
		if($activation != NULL){
			header("Location: login.php?activation=error");
		} else {
			// if they are successfull take them to a page
			if(isset($_SESSION['page'])){
				$page = $_SESSION['page'];
				header("Location: $page.php?login=success");
			} else {
				header("Location: index.php") ;
			}
		}		
		} else {
			$error_email = "Invalid email or password!!";
		}
}
		
?>