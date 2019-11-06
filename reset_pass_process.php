
<?php

# Checking for Password Link Expiration 

if(isset($_GET['encrypt']) && isset($_GET['user_id'])){
	$encrypt  = $_GET['encrypt'];
	$user_id = $_GET['user_id'];	


$sql = "SELECT * FROM users WHERE user_id = '$user_id' AND sha1(1290*3+$user_id)='$encrypt' ";
$result = mysqli_query($conn, $sql) ;
$record = mysqli_fetch_array($result);

if(mysqli_num_rows($result) < 1){
	header('Location: ?msg=email');
}

if($record['forgot_password_expired']=='True'){
    header('Location: ?msg=link');
}
} else {
header("Location:index.php");
}

///////////////////////////////////////////////////////


if(isset($_POST['update'])){

	$has_error = false;
	
    if (empty($_POST['new_password'])){
                $error_new_password = "Please enter new password";
                $has_error = true;
            } else{
                $password = filterUserInput($_POST['new_password']);	
            }

    if (empty($_POST['confirm_password'])){
                $error_confirm_password = "Please confirm password";
                $has_error = true;
            } else{
                $confirm_password = filterUserInput($_POST['confirm_password']);	
            }
            
    if (isset($password) && isset($confirm_password)) { 
        if(!empty($password) && !empty($confirm_password)){
            if($password != $confirm_password){
                $error_confirm_password = "Password do not match!";
                $has_error = true;
            }
        }
    }


    if(!$has_error && isset($user_id) && isset($encrypt)){
        reset_password($user_id, $password, $encrypt);
    } 
} 


function reset_password($user_id, $password, $encrypt){
	global $conn;						
								
	
    $query = "SELECT * FROM users where user_id = '$user_id' AND sha1(1290*3+$user_id)='$encrypt'";
    $result = mysqli_query($conn,$query);
    $record = mysqli_fetch_array($result);
    
    if(count($record)>=1) {  

        if($record['forgot_password_expired']=='false'){

            $user_id = $record['user_id'];
            $query = "UPDATE users SET password=sha1('$password'),forgot_password_expired='true' WHERE user_id='$user_id' AND sha1(1290*3+$user_id)='$encrypt'";
            mysqli_query($conn,$query);
        
            if (mysqli_affected_rows($conn) == 1) {//if update query was successfull Print a customized message:
                header('Location: login.php?pass=changed');
            } else {
                header('Location: ?error=occured');
            }
        }

    }

}


?>


