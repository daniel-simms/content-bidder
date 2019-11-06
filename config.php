<?php 
ob_start();
$error_reporting = 0;
/* ==================== */
/* Database Connect
/* ==================== */
require_once 'cred.php';
$serverName='localhost';
$userName=$_ENV['DB_USER'];
$password=$_ENV['DB_PASS'];
$dbName=$_ENV['DB_NAME'];
$conn = mysqli_connect($serverName, $userName, $password,$dbName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
date_default_timezone_set('UTC');
session_start();

DEFINE('WEBSITE_URL', "http://localhost/contentBidder");

/* ==================== */
/* Sanitise User Input
/* ==================== */
function filterUserInput($data) {
    $data = trim($data);
    $data = strip_tags($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


function get_profile() {

    global $conn, $email;

        $user_id = $_SESSION['user_id'];
        $sql = "SELECT * FROM profiles WHERE user_id = $user_id";
        $result = mysqli_query($conn,$sql);
    
        if(mysqli_num_rows($result) > 0){
            $profile  = mysqli_fetch_assoc($result) ;
            return $profile;
        } else {
            return false;
        }
    
} 

function get_profiles() {

    global $conn;
    $sql = "SELECT * FROM profiles";
    $result = mysqli_query($conn,$sql);
    $profiles = array();
    
    if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)) {
                    array_push($profiles,$row);
            }
        return $profiles;
    } else {
        return false;
    }
    
} 

function get_own_jobs() {

    global $conn;
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM jobs WHERE user_id = '$user_id'";
    $result = mysqli_query($conn,$sql);
    $jobs = array();
    
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)) {
                array_push($jobs,$row);
        }
        return $jobs;
    } else {
        return false;
    }
} 

function get_all_jobs() {

    global $conn;
    $sql = "SELECT * FROM jobs";
    $result = mysqli_query($conn,$sql);
    $jobs = array();
    
    if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)) {
                    array_push($jobs,$row);
            }
        return $jobs;
    } else {
        return false;
    }
    
} 
?>