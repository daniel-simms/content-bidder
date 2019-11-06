
 <?php include 'header.php';?>

<div id="left-content">
	<p> Nothing here yet...</p>
</div> <!--End of left-content-->

<div id="right-content">

<?php


  if (isset($_GET['email']) && filter_var(rawurldecode($_GET['email']), FILTER_VALIDATE_EMAIL)) {
	  
	  # rawurldecode — Decode URL-encoded strings, echo rawurldecode('s.chakraborty%40sae.edu'); // s.chakraborty@sae.edu
	  $email = rawurldecode($_GET['email']);
	  }

  if (isset($_GET['key']) && (strlen($_GET['key']) == 40)) {
		  $key = $_GET['key'];
	  }


  if (isset($email) && isset($key)) {
	  $sql = "SELECT * FROM users WHERE email = '$email' ";
	  $result = mysqli_query($conn, $sql) ;
	  $user_record = mysqli_fetch_assoc($result);

	  # Check if account is already activated or not
	  if($user_record['activation']==NULL){
		  $confirmation =  "Oops ! Your account seems already activated. Please click on the forgot password 
							   link on the login page to reset you password  or contact the system administrator.";
	  } else {
		  $sql = "SELECT * FROM users WHERE email = '$email' AND activation='$key'";
		  $result = mysqli_query($conn, $sql) ;
		  if(mysqli_num_rows($result) > 0){
			  
		  // Update the database to set the "activation" field to null
		  $sql = "UPDATE users SET activation =NULL WHERE email ='$email' AND activation='$key' LIMIT 1";
		  $result = mysqli_query($conn, $sql) ;
	  
			  if (mysqli_affected_rows($conn) == 1) {//if update query was successfull Print a customized message:
				  $confirmation = "Your account is now active. You may now <a href='index.php'>Log in</a>";
			  } 
				  
			  

		  } else {
			  # This means key or email does not match, i.e could be URL or Code Tampering (an unauthorized modification )
			  $confirmation = "Sorry No account found with given email or activation key!";
		  }
	  }

	  

  } else {
	  $confirmation = "Error Occured!";
  } 

  // Finally print the confirmation message.

  if(isset($confirmation)){ 
  echo "<div id='confirmation'>$confirmation </div>";
  }

?>
</div> <!--End of right-content-->

<?php include 'footer.php';?>
