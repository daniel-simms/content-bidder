<?php require_once 'config.php' ?>
<?php
    // If no one is logged in, set user_id to 0 [This is used so that people not logged in can still view the writers and job pages]
    if(!isset($_SESSION['email'])){
        $_SESSION['user_id'] = 0;
    } 
    // NOTIFICATION: login succes
    if(isset($_GET['login']) && ($_GET['login']=='success')){
        echo "<div class='notification success'>Login success!<span class='close'>x</span></div>";
    } 
    // NOTIFICATION: error occured
    if(isset($_GET['error']) && ($_GET['error']=='occured')){
        echo "<div class='notification errors'>An error occured!<span class='close'>x</span></div>";
    } 

    // Sets user_id throught the website
    $user_id = $_SESSION['user_id'];

    // Warns users when they first log in to update their profile and then toggles a columns in databse so that it doesn show again
    $sql = "SELECT * FROM profiles WHERE user_id = $user_id";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        $result = mysqli_fetch_assoc($result);
        if($result['profile_warning']=='false' && $result['profile_complete']=='false'){
            echo "<div class='notification stacked warning'>Please update your profile in the Profile page!<span class='close'>x</span></div>";
            $sql=  "UPDATE profiles 
                SET profile_warning = 'true'
                WHERE profiles.user_id = '$user_id'";
            $result = mysqli_query($conn, $sql);
        }
    }

    // Get the permission ID of the logged in user
    $sql = "SELECT permission_id FROM users WHERE user_id = $user_id";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        $result = mysqli_fetch_assoc($result);
            $permission_id = $result['permission_id'];
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/hamburgers.css">
	<link rel="stylesheet" href="css/style.css">
    <title>Content Bidder | Home</title>
</head>
<body>

<div class="header">
    <div class="header-logo">
        <a href="index.php"><img src="img/CB-logo.png" height="50" alt="Content Bidder Logo"></a>
    </div>
    <div class="header-nav">
        <button class="hamburger hamburger--collapse" type="button">
            <span class="hamburger-box">
            <span class="hamburger-inner"></span>
            </span>
        </button>
        <ul class="nav-hide">
            <li><a href="index.php">Home</a></li>
            <li><a href="writter.php">Writers</a></li>
            <li><a href="jobs.php">Jobs</a></li>
            <!-- if logged in, show profile and logout links -->
            <?php if(isset($_SESSION['email'])){
                echo "<li><a href='profile.php'>Profile</a></li>";
                include 'logout.php';
            } else { ?>
            <li><a href="login.php">Login/ Register</a></li>
            <?php } ?>
        </ul>
    </div>
</div>