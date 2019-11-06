<?php
//error_reporting(0);
$has_error = false;


/* ==================== */
/* Register Validation
/* ==================== */
if(isset($_POST['register'])) {
    
    if(empty($_POST['firstname'])) {
        $error_firstName = "Please enter first name";
        $has_error = true;
    } else {
        $firstName = filterUserInput($_POST['firstname']);
    }
                
    if(empty($_POST['lastname'])) {
        $error_lastName = "Please enter last name";
        $has_error = true;
    
    } else {
        $lastName = filterUserInput($_POST['lastname']);
    }

    if(empty($_POST['email'])) {
        $error_email = "Please enter email";
        $has_error = true;
    } else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $error_email = "Please enter valid email.";
        $has_error = true;
        } else {
            $email = filterUserInput($_POST['email']);
            $sql =  "SELECT * FROM users where email='$email'";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){  
                $error_email = "Sorry This email already exists!";
                
            }
        }
    
    
    
    if(empty($_POST['password'])) {
        $error_password= "Please enter password";
        $has_error = true;
    } else {
        $password = filterUserInput($_POST['password']);
    }
    if(empty($_POST['confirm'])) {
        $error_confirm= "Please confirm password";
        $has_error = true;
    } elseif($_POST['confirm'] != $_POST['password']) {
        $error_confirm= "Passords do not match";
        $has_error = true;
    }

    if(empty($_POST['role'])) {
        $error_role = "Please select a role";
        $has_error = true;
    } else {
        $role = $_POST['role'];
    }

	if(!$has_error){
        insert_into_db();
    }
    
} 

/* ==================== */
/* Insert data into Databse
/* ==================== */
function insert_into_db(){
   
    global $conn, $firstName, $lastName, $password, $email, $role, $error_email;
    $sql=  "SELECT * FROM users where email='$email'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){  
        $error_email = "Sorry This email already exists!";
    } else {
        $activation = sha1(uniqid(rand(), true));
        $sql=  "INSERT INTO users (firstname, lastname, password, email, activation) values ('$firstName','$lastName', sha1('$password'), '$email',  '$activation')";
        $result = mysqli_query($conn, $sql);

        $sql=  "SELECT * FROM users where email='$email';";
        $result = mysqli_query($conn, $sql);
        
        if(mysqli_num_rows($result) > 0){
        
            $user_record = mysqli_fetch_assoc($result);
            extract($user_record);  
            // Random number between 1 and 5 to give the users a star rating [This is temporay until proper star ratings are implimented]
            $rand5 = rand(1,5);
            // Random number between 1 and 100 to give the users a collaboration number [ also temporary]
            $rand100 = rand(1,100);
            $sql=  "INSERT INTO profiles (user_id, role_id, stars, collabs) VALUES ('$user_id', '$role', '$rand5', '$rand100')";
            $result = mysqli_query($conn, $sql);
            
            if(send_email($email,$activation) == true){
                header("Location: login.php?reg=success");
            } else {
                header("Location: ?error=occured");
            }
        } else {
            header("Location: ?error=occured");
        }
    } 
    
} 


# Send the email.

function send_email($email,$activation){

    //	$message = "Your password reset link send to your e-mail address.";
    $to=$email;
    $subject="Registration Confirmation";
    $from = "admin@contentbuddy.com";
    $message="<center> <br> <img src='https://danielsimms.co.uk/contentBidder/img/CB-logo.png' alt='logo'width:100px;height:100px;'/><br><br>";
    $message .="Hi, $username,<br>"
    ."To activate your account, please click on this link:<br>"
    ."Once clicked, this one-time link will be expired!<br><br>"
    . "<a href='" . WEBSITE_URL . '/activate_account.php?email=' . urlencode($email) . "&key=$activation'>".WEBSITE_URL.'/activate_account.php?email='.urlencode($email) .'&key='.$activation."' style='background-color: #29ABE2; border-radius: 5px; color: white;padding: 10px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;margin: 4px 2px;cursor: pointer;'>Reset Password</a></center>\r\n ";
    
    
    $headers = "From: " . strip_tags($from) . "\r\n";
    $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    mail($to,$subject,$message,$headers);

    return true;
            
}




?>