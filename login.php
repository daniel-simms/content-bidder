<?php require_once 'header.php' ?>
<?php require_once 'login_process.php' ?>

    <?php 
        // NOTIFATION: Registration success
        if(isset($_GET['reg']) && ($_GET['reg']=='success')){ 
            echo "<div class='notification success'>Registration success! Please activate your E-mail to login.<span class='close'>x</span></div>";
         } 
         // NOTIFATION: Access denied
         else if(isset($_GET['access']) && ($_GET['access']=='denied')){ 
            echo "<div class='notification errors'>Please Login to view this page!<span class='close'>x</span></div>";
         }
         // NOTIFATION: Reset password success
         else if(isset($_GET['reset']) && ($_GET['reset']=='success')){ 
            echo "<div class='notification success'>Reset password Email sent <span class='close'>x</span></div>";
        } 
         // NOTIFATION: Activation error
         else if(isset($_GET['activation']) && ($_GET['activation']=='error')){ 
            echo "<div class='notification errors'>Please activate your e-mail!<span class='close'>x</span></div>";
         }
         // NOTIFATION: Activation error
         else if(isset($_GET['pass']) && ($_GET['pass']=='changed')){ 
            echo "<div class='notification success'>Password updated, please Login<span class='close'>x</span></div>";
         }
    ?>

    <!-- Login form -->
    <div class="hero full-hero">
        <div class="hero-logo"><img src="img/CB-logo-white.png" alt="Content Bidder Logo"></div>
        <div class="hero-form">
            <h1>Login</h1>
            <form action="" method="post">
                <input type="text" placeholder="E-Mail" name="email" id="email" value="<?php if(isset($email))echo $email;?>">
                    <div class="error"><?php if(isset($error_email)) echo $error_email;?></div>
                <input type="password" name="password" id="password" placeholder="Password">
                    <div class="error"><?php if(isset($error_password))echo $error_password;?></div>
                <input type="submit" value="Login" name="login" class="btn btn-blue">
                <span><a href="register.php">Register</a> | <a href="forgot_pass.php">Forgot Password</a></span>
            </form>
        </div>
    </div>


<?php require_once 'footer.php' ?>