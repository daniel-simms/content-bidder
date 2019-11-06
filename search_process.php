<?php
//error_reporting(0);
ob_start();

$has_error = false;

if(isset($_GET['search_writers'])) {
	
	if(empty($_GET['search_writers'])) {
		$error_search = "Please enter search";
		$has_error = true;
	} else {
		$search = filterUserInput($_GET['search_writers']);
	}
			
	if(!$has_error) {
		if($_SESSION['search_result_writers'] = search_writers()){
			header('Location: search.php');
		}
	}

} 

function search_writers(){
	$_SESSION['search_result_jobs'] = NULL;

	global $conn, $search, $error_search;

	$sql = "SELECT * FROM profiles 
			WHERE username like '%$search%'
			OR bio LIKE '%$search%'
			OR speciality LIKE '%$search%'";
	
	$result = mysqli_query($conn, $sql);
	$results = Array();
	
	if(mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_assoc($result)){
			array_push($results,$row);
		}
		return $results;
		} else {
			$error_search = "No matches";
		}
	
}


if(isset($_GET['search_jobs'])) {
	$_SESSION['search_result_writers'] = NULL;
	
	if(empty($_GET['search_jobs'])) {
		$error_search = "Please enter search";
		$has_error = true;
	} else {
		$search = filterUserInput($_GET['search_jobs']);
	}
			
	if(!$has_error) {
		if($_SESSION['search_result_jobs'] = search_jobs()){
			header('Location: search.php');
		}
	}

} 


function search_jobs(){

	global $conn, $search, $error_search;

	$sql = "SELECT * FROM jobs 
			WHERE username like '%$search%'
			OR description LIKE '%$search%'
			OR catagory LIKE '%$search%'";
	
	$result = mysqli_query($conn, $sql);
	$results = Array();
	
	if(mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_assoc($result)){
			array_push($results,$row);
		}
		return $results;
		} else {
			$error_search = "No matches";
		}
	
}
		
?>