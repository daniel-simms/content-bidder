<?php
//error_reporting(0);
$has_error = false;


/* ==================== */
/* Register Validation
/* ==================== */
if(isset($_POST['add'])) {
    
    
    if(empty($_POST['description'])) {
        $error_description = "Please enter a description";
        $has_error = true;
    } else {
        $description = filterUserInput($_POST['description']);
    }

    if(empty($_POST['price'])) {
        $error_price = "Please enter your price";
        $has_error = true;
    } else {
        $price = $_POST['price'];
    }

    if(empty($_POST['catagory'])) {
        $error_catagory = "Please enter your catagory";
        $has_error = true;
    } else {
        $catagory = $_POST['catagory'];
    }

    if(empty($_POST['job_language'])) {
        $error_job_language = "Please enter your job_language";
        $has_error = true;
    } else {
        $job_language = $_POST['job_language'];
    }

	if(!$has_error){
         insert_into_db();
    }
    
} 

/* ==================== */
/* Insert data into Databse
/* ==================== */
function insert_into_db(){

    global $conn, $description, $job_language, $catagory, $price;
    $user_id = $_SESSION['user_id'];
    $sql=  "SELECT * FROM profiles where user_id='$user_id'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){  
        $result = mysqli_fetch_assoc($result);
        extract($result);

        $sql=  "INSERT INTO jobs(user_id, description, language, catagory, price, time_posted, username, stars, collabs)
        VALUES ( $user_id, '$description', '$job_language', '$catagory', $price, NOW(), '$username', $stars, $collabs);";
        $result = mysqli_query($conn, $sql);

        if(mysqli_affected_rows($conn) > 0){  
            header("Location: ?job=added");
        } else {
            header("Location: ?error=occured");
        }

    } else {
        header("Location: ?error=occured");
    }


   
    
    
    
} 





?>