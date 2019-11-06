<?php require_once 'header.php' ?>
<?php require_once 'forgot_pass_process.php' ?>

    <?php
        // NOTIFATION: Registration success
        if(isset($_GET['msg']) && ($_GET['msg']=='activate')){ 
            echo "<div class='notification warning'>You need to activate your account first! <a href = 're_send_activation.php'>Resend verification</a><span class='close'>x</span></div>";
        } else if(isset($_GET['msg']) && ($_GET['msg']=='email')){ 
            echo "<div class='notification errors'>No such Email exists! <a href = 'register.php'>Register now!</a> <span class='close'>x</span></div>";
        }
    ?>

    <div class="hero full-hero">
        <div class="hero-logo"><img src="img/CB-logo-white.png" alt="Content Bidder Logo"></div>
        <div class="hero-form">
            <h1>Reset Password</h1>
            <form action="" method="post">

                <input type="text" placeholder="Email" name="email" id="email">
                <div class="error"><?php if(isset($error_email))echo $error_email?></div>

                <input type="submit" value="Send" name="send" class="btn btn-blue">
            </form>
        </div>
    </div>

<?php require_once 'footer.php' ?>