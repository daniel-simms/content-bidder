<?php require_once 'header.php' ?>
<?php require_once 'search_process.php' ?>

<?php

    // If no one is loggedd in set current page to writer
    if(!isset($_SESSION['email'])){
        $_SESSION['page'] = "writter";
    }

    // Toggle Appear offline for logged in writers
    if(isset($_GET['toggle']) && ($_GET['toggle']=='online')){

        // Selects the online column of the users currently logged in
        $sql = "SELECT online FROM profiles WHERE user_id = $user_id";
        $result = mysqli_query($conn, $sql);

        // Toggles True and False
        if(mysqli_num_rows($result) > 0){
            $result = mysqli_fetch_assoc($result);
            extract($result);
            if($online == "false"){
                $sql = "UPDATE profiles SET online = 'true' WHERE profiles.profile_id = $user_id";
                $result = mysqli_query($conn, $sql);
            } elseif($online == "true"){
                $sql = "UPDATE profiles SET online = 'false' WHERE profiles.profile_id = $user_id";
                $result = mysqli_query($conn, $sql);
            }
        }
    }

?>

<!-- Main Content -->
<div class="content-container">
    <!-- Search bar -->
    <div class="search">
        <!-- Search bar switcher -->
        <div class="search-select">
            <div class="search-select-writers" style="background: #29ABE2; color: white;">Writers</div>
            <a href="jobs.php"><div class="search-select-jobs">Jobs</div></a>
        </div>
        <!-- Search bar input-->
        <form method="get">
            <input type="text" class="search" name="search_writers" placeholder="Search">
            <input type="submit" class="submit" value="">
            <div class="search-icon"><i class="fa fa-search"></i></div>
        </form>
        
    </div>
    <!-- Search error message -->
    <div class="error"><center><?php if(isset($error_search)) echo $error_search;?></center></div>


    <div class="content">
        <h1>Writers</h1>
        <div class="clear"></div>
        <hr>
        <!-- If a writer is logged in, show their profile first -->
        <div class="profile-list">
            <?php 
                if($_SESSION['user_id'] > 0){
                    $profile = get_profile();
                    extract($profile);
                    if($role_id == "2"){
            ?>
                <!-- Logged in users profile -->        
                <div class="profile">
                    
                    <!-- Profile Image-->
                    <div class="profile-image">
                        <img src="img/<?php echo $profile_image; ?>" alt="">
                    </div>

                    <div class="profile-content">
                        <!-- Username and online toggle-->
                        <h3>
                            <?php echo $username; ?>
                            <!-- Toggle to appear online or offline -->
                            <small class="appear-offline">
                                <?php 
                                if($profile_complete == 'false'){
                                    echo "<a href='profile.php'>Complete profile to appear online</a>";
                                } else { ?>
                                    <a href="?toggle=online">
                                    <?php if($online == "true"){ echo "Appear Offline";}else{ echo "Appear Online";} ?>
                                    </a>
                               <?php } ?>

                            </small>
                        </h3>

                        <!-- Displays writers star ranking -->
                        <div class="stars">
                            <?php for ($x = 1; $x <= $stars; $x++) { ?>
                                <span class="fa fa-star checked"></span>
                            <?php } ?>
                            <?php for ($x = 1; $x <= (5 - $stars); $x++) { ?>
                                <span class="fa fa-star"></span>
                            <?php } ?>
                        </div>
                        <!-- Displays writers age, language, speciality, bio, price and collabs -->
                        <p class="details"><strong><?php echo $age; ?></strong><?php echo $language." | ".$speciality; ?></p>
                        <p class="info"><?php echo $bio; ?></p>
                        <ul>
                            <li><strong>£<?php echo $price; ?></strong> p/w</li>
                            <li><strong><?php echo $collabs; ?></strong> Creations</li>
                        </ul>
                    </div>
                    <!-- White over if the writer has appeared offline -->
                    <div class="profile-overlay" style="<?php if($online == "true") echo "display:none"; ?>"></div>
                </div>

            <?php } }
            
            // Display all writers apart from user logged in. [we do not want to repeat the profile above]
            $profiles = get_profiles();
            foreach ($profiles as $profile){
                extract($profile);
                // Only show if the users have selected to appear online
                if($online == "true" && $_SESSION['user_id'] != $user_id){
            ?>
                <!-- All users -->
                <div class="profile">
                    <!-- Profile Image -->
                    <div class="profile-image">
                        <img src="img/<?php echo $profile_image; ?>" alt="">
                    </div>

                    <div class="profile-content">
                        <!-- username -->
                        <h3><?php echo $username; ?></h3>
                        <!-- star rankings -->
                        <div class="stars">
                            <?php for ($x = 1; $x <= $stars; $x++) { ?>
                                <span class="fa fa-star checked"></span>
                            <?php } ?>
                            <?php for ($x = 1; $x <= (5 - $stars); $x++) { ?>
                                <span class="fa fa-star"></span>
                            <?php } ?>
                            
                        </div>
                        <!-- age, language, speciality, bio, price and collabs -->
                        <p class="details"><strong><?php echo $age; ?></strong><?php echo $language." | ".$speciality; ?></p>
                        <p class="info"><?php echo $bio; ?></p>
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