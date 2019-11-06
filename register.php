<?php require_once 'header.php' ?>
<?php require_once 'registration_process.php' ?>

    <div class="hero full-hero">
        <div class="hero-logo"><img src="img/CB-logo-white.png" alt="Content Bidder Logo"></div>
        <div class="hero-form">
            <h1>Register</h1>
            <form action="" method="post">
                <input type="text" placeholder="Firstname" name="firstname" id="fname" value="<?php if(isset($firstName))echo $firstName; ?>">
                    <div class="error"><?php if(isset($error_firstName))echo $error_firstName?></div>
                <input type="text" placeholder="Lastname" name="lastname" id="lname" value="<?php if(isset($firstName))echo $firstName; ?>">
                    <div class="error"><?php if(isset($error_lastName))echo $error_lastName?></div>
                <input type="text" placeholder="E-mail" name="email" id="email" value="<?php if(isset($email)) echo $email; ?>">
                    <div class="error"><?php if(isset($error_email))echo $error_email?></div>
                <input type="password" placeholder="Password" name="password" id="password">
                    <div class="error"><?php if(isset($error_password))echo $error_password?></div>
                <input type="password" placeholder="Confirm Password" name="confirm" id="confirm">
                    <div class="error"><?php if(isset($error_confirm))echo $error_confirm?></div>


                <label class="radio-button">Client
                    <input type="radio" name="role" id="client" value="1">
                    <span class="checkmark"></span>
                </label>

                <label class="radio-button">Writter
                    <input type="radio" name="role" id="writter" value="2">
                    <span class="checkmark"></span>
                </label>
                <div class="error"><?php if(isset($error_role))echo $error_role?></div> 

                <input type="submit" value="Register" name="register" class="btn btn-blue">
                <span><a href="login.php">Login</a></span>
            </form>
        </div>
    </div>

<?php require_once 'footer.php' ?>