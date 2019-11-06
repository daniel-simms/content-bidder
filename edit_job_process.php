<?php
//error_reporting(0);
$has_error = false;


/* ==================== */
/* Register Validation
/* ==================== */
if(isset($_POST['edit'])) {
    
    
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
        $error_job_language = "Please enter your job language";
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
   
    global $conn, $description, $price, $catagory, $job_language;
    $user_id = $_SESSION['user_id'];
    $job_id = $_SESSION['job_id'];
    
    $sql=  "UPDATE jobs 
            SET description = '$description',
                price = $price,
                catagory = '$catagory',
                language = '$job_language'
            WHERE jobs.job_id = '$job_id'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_affected_rows($conn)){
        header("Location: jobs.php?update=success");
    } else {
        header("Location: ?update=error");
    }
    
} 





?>