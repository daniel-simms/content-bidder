<?php require_once 'header.php' ?>
<?php require_once 'search_process.php' ?>

<?php 
    if(!isset($_SESSION['email'])){
        $_SESSION['page'] = "jobs";
    } 
    if(isset($_GET['update']) && ($_GET['update']=='success')){ 
        echo "<div class='notification success'>Job edited!<span class='close'>x</span></div>";
    }
    $sql = "SELECT role_id FROM profiles WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($result);
    $role_id =  $result['role_id'];
?>

<!-- Main Content -->
<div class="content-container">
    <!-- Search bar -->
    <div class="search">
        <!-- Search bar switcher -->
        <div class="search-select">
            <a href="writter.php"><div class="search-select-writers">Writers</div></a>
            <div class="search-select-jobs" style="background: #29ABE2; color: white;">Jobs</div>
        </div>
        <!-- Search bar input-->
        <form method="get">
            <input type="text" class="search" name="search_jobs" placeholder="Search">
            <input type="submit" value="" class="submit">
            <div class="search-icon"><i class="fa fa-search"></i></div>
        </form>
    </div>
    <!-- Search error message -->
    <div class="error"><center><?php if(isset($error_search)) echo $error_search;?></center></div>  

    <div class="content">
        <h1>Jobs</h1>
        <!-- Show add job link if your a 'client [role_id = 1]' or an admin -->
        <?php if(isset($permission_id) && $permission_id == 1 || $role_id == 1 ){echo "<div class='add-job'><span>+</span> <a href='add-job.php'>Add Job</a></div>";}?>
        <div class="clear"></div>
        <hr>
        <div class="profile-list">
            <!-- Show your own jobs if your a 'client [role_id = 1]' -->
            <?php 
                if($role_id == 1){
                $jobs = get_own_jobs();
                foreach ($jobs as $job){
                    extract($job);
                    {
            ?>

                <div class="profile">
                    <!-- profile image -->
                    <div class="profile-image">
                        <img src="img/<?php echo $profile_image; ?>" alt="">
                    </div>
                    <div class="profile-content">
                        <!-- username and edit job links -->
                        <h3><?php echo $username; ?><small><a href="edit-job.php?job_id=<?= $job_id ?>">Edit Job</a></small></h3>
                        <!-- star ratings -->
                        <div class="stars">
                            <?php for ($x = 1; $x <= $stars; $x++) { ?>
                                <span class="fa fa-star checked"></span>
                            <?php } ?>
                            <?php for ($x = 1; $x <= (5 - $stars); $x++) { ?>
                                <span class="fa fa-star"></span>
                            <?php } ?>
                            
                        </div>
                        <!-- job details -->
                        <p class="details"><?php echo $language." | ".$catagory ?></p>
                        <p class="info"><?php echo $description; ?></p>
                        <ul>
                            <li><strong>£<?php echo $price; ?></strong> p/w</li>
                            <li><strong><?php echo $collabs; ?></strong> Creations</li>
                        </ul>
                    </div>
                </div>
            
            <?php  } } } ?>


                            
            <?php 

            // Show all jobs apart from user logged in as we already displayed them above
            $jobs = get_all_jobs();
            foreach ($jobs as $job){
                extract($job);
                if($_SESSION['user_id'] != $user_id){

            ?> 

                <div class="profile">
                    <!-- profile image -->
                    <div class="profile-image">
                        <img src="img/<?php echo $profile_image; ?>" alt="">
                    </div>
                    
                    <div class="profile-content">
                        <!-- display edit job links if admin is logged in -->
                        <h3><?php echo $username; if(isset($permission_id) && $permission_id == 1) echo "<small><a href='edit-job.php?job_id=$job_id'>Edit Job</a></small>"?></h3>
                        <!-- star ratings -->
                        <div class="stars">
                            <?php for ($x = 1; $x <= $stars; $x++) { ?>
                                <span class="fa fa-star checked"></span>
                            <?php } ?>
                            <?php for ($x = 1; $x <= (5 - $stars); $x++) { ?>
                                <span class="fa fa-star"></span>
                            <?php } ?>
                            
                        </div>
                        <!-- job details -->
                        <p class="details"><?php echo $language." | ".$catagory ?></p>
                        <p class="info"><?php echo $description; ?></p>
                        <ul>
                            <li><strong>£<?php echo $price; ?></strong> p/w</li>
                            <li><strong><?php echo $collabs; ?></strong> Creations</li>
                        </ul>
                    </div>
                </div>
            
            <?php  } } ?>
            <div class="clear"></div>                    
        </div>
    </div>
</div>

<?php require_once 'footer.php' ?>