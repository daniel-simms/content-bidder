<?php require_once 'header.php' ?>
<?php require_once 'reset_pass_process.php' ?>

    <?php
        if(isset($_GET['pass']) && ($_GET['pass']=='updated')){
            echo "<div class='notification success'>Password updated!<span class='close'>x</span></div>";
        } else if(isset($_GET['pass']) && ($_GET['pass']=='error')){
            echo "<div class='notification errors'>An error occured!<span class='close'>x</span></div>";
        } else if(isset($_GET['msg']) && ($_GET['msg']=='email')){ 
            echo "<div class='notification errors'>No such Email exists! <a href = 'register.php'>Register now!</a> <span class='close'>x</span></div>";
        } else if(isset($_GET['msg']) && ($_GET['msg']=='link')){ 
            echo "<div class='notification warning'>Link is already expired! <a href='forgot_password.php'>here</a>Resend Email!</a> <span class='close'>x</span></div>";
        } else if(isset($_GET['msg']) && ($_GET['msg']=='success')){ 
            echo "<div class='notification warning'>Link is already expired! <a href='forgot_password.php'>here</a>Resend Email!</a> <span class='close'>x</span></div>";
        } else if(isset($_GET['msg']) && ($_GET['msg']=='already')){ 
            echo "<div class='notification warning'>Link is already expired! <a href='forgot_password.php'>here</a>Resend Email!</a> <span class='close'>x</span></div>";
        }
    ?>

    <div class="hero full-hero">
        <div class="hero-logo"><img src="img/CB-logo-white.png" alt="Content Bidder Logo"></div>
        <div class="hero-form">
            <h1>Reset Password</h1>
            <form action="" method="post">

                <input type="password" placeholder="New Password" name="new_password" id="new_password">
                <div class="error"><?php if(isset($error_new_password))echo $error_new_password?></div>

                <input type="password" placeholder="Confirm New Password" name="confirm_password" id="confirm_password">
                <div class="error"><?php if(isset($error_confirm_password))echo $error_confirm_password?></div>


                <input type="submit" value="Update" name="update" class="btn btn-blue">
            </form>
        </div>
    </div>

<?php require_once 'footer.php' ?>