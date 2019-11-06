<?php
//error_reporting(0);

$has_error = false;

if(isset($_POST['send'])) {
			
	if(empty($_POST['email'])) {
		$error_email = "Please enter email";
		$has_error = true;
	}
	else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$error_email = "Please enter valid email.";
		$has_error = true;
	} else {
		$email = filterUserInput($_POST['email']);
	}

	if(!$has_error) {
        $result = update_db($email);
        print_r($result);
	}

}

function update_db($email) {
					

    global $conn;
            
                        
            $query = "SELECT * FROM users where email='$email' ";
            $result = mysqli_query($conn,$query);
            $record = mysqli_fetch_array($result);
        //	print_r(count($record));
                
            if(mysqli_affected_rows($conn) == 1) {	
                
                    if($record['activation']!=NULL){
                        header('Location: ?msg=activate');
                        return $msg;
                        } else {
                            $user_name = ucfirst($record['firstname'])." ".ucfirst($record['lastname']);
                            $user_id = $record['user_id'];
                            $encrypt = sha1(1290*3+$user_id);
                            
                            if($record['forgot_password_expired']=='true'){
                                $query = "UPDATE users SET forgot_password_expired='false' WHERE user_id ='$user_id'";
                                mysqli_query($conn,$query);
                                
                                if((mysqli_affected_rows($conn) == 1) ){
                                    
                                   if(send_email($conn, $email, $encrypt, $user_name,$user_id ) == true){
                                        header('Location: login.php?reset=success');
                                   }
                                        
                                }
                            } else {
                                if(send_email($conn, $email, $encrypt, $user_name,$user_id ) == true){
                                    header('Location: login.php?reset=success');
                                }
                            }
                            
                    }
            
            } else {
                header('Location: ?msg=email');
            }
            
    }
            
            
    
    function send_email($conn, $email, $encrypt, $user_name,$user_id){
        
            
        //	$message = "Your password reset link send to your e-mail address.";
            $to=$email;
            $subject="Password Reset";
            $from = "admin@contentbuddy.com";
            $message="<center> <br> <img src='https://danielsimms.co.uk/contentBidder/img/CB-logo.png' alt='logo'width:100px;height:100px;'/><br><br>";
            $message .="Hi, $user_name,<br>"
            ."You have requested for password reset.<b> This is a temporary link</b>, reset password by clicking the link. <br>"
            ."Once clicked, this one-time link will be expired!<br><br>"
            . "<a href='".WEBSITE_URL. "/reset_pass.php?encrypt=" . $encrypt."&user_id=".$user_id. "' style='background-color: #29ABE2; border-radius: 5px; color: white;padding: 10px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;margin: 4px 2px;cursor: pointer;'>Reset Password</a></center>\r\n ";
            
            
            $headers = "From: " . strip_tags($from) . "\r\n";
            $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    
            mail($to,$subject,$message,$headers);
        
            return true;
                                
                                    
    }
		
?>