<?php require_once 'header.php' ?>
<?php
    // If no one is logged in, set current page to index
    if(!isset($_SESSION['email'])){
        $_SESSION['page'] = "index";
    } 
    // NOTIFICATION: Logout Success
    if(isset($_GET['logout']) && ($_GET['logout']=='success')){
        echo "<div class='notification success'>Logout success!<span class='close'>x</span></div>";
    }
?>
    
<!-- Main Section -->
<div class="hero">
    <div class="hero-logo"><img src="img/CB-logo-white.png" alt="Content Bidder Logo"></div>
    <div class="hero-text">
        <h1>Content Bidder</h1>
        <h2>Bid til' your hearts... <span>content</span></h2>
    </div>
</div>

<!-- Call to action buttons -->
<div class="call-to-action">
    <a href="writter.php"><div class="btn" id="btn-write">I Need Content</div></a>
    <a href="jobs.php"><div class="btn" id="btn-need">I Write Content</div></a>
</div>

<?php require_once 'footer.php' ?>