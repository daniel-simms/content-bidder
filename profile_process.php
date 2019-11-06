<?php
//error_reporting(0);
$has_error = false;


/* ==================== */
/* Register Validation
/* ==================== */
if(isset($_POST['update'])) {
    
    if(empty($_POST['username'])) {
        $error_username = "Please enter username";
        $has_error = true;
    } else {
        $username = filterUserInput($_POST['username']);
    }

    if(empty($_POST['bio'])) {
        $error_bio = "Please enter a bio";
        $has_error = true;
    } else {
        $bio = filterUserInput($_POST['bio']);
    }

    if(empty($_POST['price'])) {
        $error_price = "Please enter your price";
        $has_error = true;
    } else {
        $price = $_POST['price'];
    }

    if(empty($_POST['age'])) {
        $error_age = "Please enter your age";
        $has_error = true;
    } else {
        $age = $_POST['age'];
    }

    if(empty($_POST['speciality'])) {
        $error_speciality = "Please enter your speciality";
        $has_error = true;
    } else {
        $speciality = $_POST['speciality'];
    }

    if(empty($_POST['language'])) {
        $error_language = "Please enter your language";
        $has_error = true;
    } else {
        $language = $_POST['language'];
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
   
    global $conn, $username, $bio, $price, $age, $speciality, $language, $role;
    $user_id = $_SESSION['user_id'];
    $sql=  "SELECT * FROM profiles where user_id='$user_id'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){  
        $sql=  "UPDATE profiles 
                SET username = '$username',
                    bio = '$bio',
                    price = $price,
                    age = $age,
                    speciality = '$speciality',
                    language = '$language',
                    role_id = $role,
                    profile_complete = 'true'
                WHERE profiles.user_id = '$user_id'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_affected_rows($conn)){
            header("Location: ?update=success");
        } else {
            header("Location: ?update=error");
        }
    } else {
        header("Location: ?error=occured");
    }
    
} 





?>