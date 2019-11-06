<?php 
require_once 'header.php';

if(isset($_GET['job_id'])){
    $job_id = $_GET['job_id'];
    $sql = "DELETE FROM jobs WHERE jobs.job_id = $job_id";
    $result = mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn) > 0){
        header('Location: jobs.php') ;
    } else {
        echo 'not done';
    }
}


?>