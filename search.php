<?php require_once 'header.php' ?>
<?php require_once 'search_process.php' ?>

    <?php
    if(isset($_SESSION['search_result_writers'])){
        $_SESSION['page'] = "writers";
    } else if(isset($_SESSION['search_result_jobs'])){
        $_SESSION['page'] = "jobs";
    }
    
    ?>

    <div class="content-container">

    <?php if(isset($_SESSION['page']) && $_SESSION['page'] == 'writers'){?>
        <div class="search">
            <div class="search-select">
                <div class="search-select-writers" style="background: #29ABE2; color: white;">Writers</div>
                <a href="jobs.php"><div class="search-select-jobs">Jobs</div></a>
            </div>
            <form method="get">
                <input type="text" class="search" name="search_writers" placeholder="Search">
                <input type="submit" class="submit" value="">
                <div class="search-icon"><i class="fa fa-search"></i></div>
            </form>
        </div>
        <div class="error"><center><?php if(isset($error_search)) echo $error_search;?></center></div>
    <?php } ?>

    <?php if(isset($_SESSION['page']) && $_SESSION['page'] == 'jobs'){?>
        <div class="search">
            <div class="search-select">
                <a href="writter.php"><div class="search-select-writers">Writers</div></a>
                <div class="search-select-jobs" style="background: #29ABE2; color: white;">Jobs</div>
            </div>
            <form method="get">
                <input type="text" class="search" name="search_jobs" placeholder="Search">
                <input type="submit" value="" class="submit">
                <div class="search-icon"><i class="fa fa-search"></i></div>
            </form>
        </div>
        <div class="error"><center><?php if(isset($error_search)) echo $error_search;?></center></div>  
    <?php } ?>

        

        <div class="content">
            <h1>Search</h1>
            <div class="clear"></div>
            <hr>
            <div class="profile-list">

                 <?php 
                 if(isset($_SESSION['search_result_writers'])){
                     
                    $results = $_SESSION['search_result_writers'];
                    foreach ($results as $result){
                        extract($result);
                ?>

                    <div class="profile">
                        <div class="profile-image">
                            <img src="img/<?php echo $profile_image; ?>" alt="">
                        </div>
                        <div class="profile-content">
                            <h3><?php echo $username; ?></h3>
                            <div class="stars">
                                <?php for ($x = 1; $x <= $stars; $x++) { ?>
                                    <span class="fa fa-star checked"></span>
                                <?php } ?>
                                <?php for ($x = 1; $x <= (5 - $stars); $x++) { ?>
                                    <span class="fa fa-star"></span>
                                <?php } ?>
                                
                            </div>
                            <p class="details"><strong><?php echo $age; ?></strong><?php echo $language." | ".$speciality; ?></p>
                            <p class="info"><?php echo $bio; ?></p>
                            <ul>
                                <li><strong>£<?php echo $price; ?></strong> p/w</li>
                                <li><strong><?php echo $collabs; ?></strong> Creations</li>
                            </ul>
                        </div>
                    </div>
                
                <?php } }?>

                <?php 
                 if(isset($_SESSION['search_result_jobs'])){
                     
                    $results = $_SESSION['search_result_jobs'];
                    foreach ($results as $result){
                        extract($result);
                ?>

                     <div class="profile">
                        <div class="profile-image">
                            <img src="img/<?php echo $profile_image; ?>" alt="">
                        </div>
                        <div class="profile-content">
                            <h3><?php echo $username; ?></h3>
                            <div class="stars">
                                <?php for ($x = 1; $x <= $stars; $x++) { ?>
                                    <span class="fa fa-star checked"></span>
                                <?php } ?>
                                <?php for ($x = 1; $x <= (5 - $stars); $x++) { ?>
                                    <span class="fa fa-star"></span>
                                <?php } ?>
                                
                            </div>
                            <p class="details"><?php echo $language." | ".$catagory ?></p>
                            <p class="info"><?php echo $description; ?></p>
                            <ul>
                                <li><strong>£<?php echo $price; ?></strong> p/w</li>
                                <li><strong><?php echo $collabs; ?></strong> Creations</li>
                            </ul>
                        </div>
                    </div>
                
                <?php } }?>
               <div class="clear"></div>                         

            </div>
        </div>
    </div>

<?php require_once 'footer.php' ?>