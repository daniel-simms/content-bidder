<?php require_once 'header.php' ?>

    <?php if(!$_SESSION['email']){
        header("Location: login.php?access=denied");
    } ?>

    <div class="hero full-hero">
        <div class="hero-logo"><img src="img/CB-logo-white.png" alt="Content Bidder Logo"></div>
        <div class="hero-text">
            <h1>You are logged in</h1>
        </div>
    </div>

<?php require_once 'footer.php' ?>