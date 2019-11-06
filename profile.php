<?php require_once 'header.php' ?>
<?php require_once 'profile_process.php' ?>

    <?php 
        if(isset($_GET['update']) && ($_GET['update']=='success')){ 
            echo "<div class='notification success'>Profile update success!<span class='close'>x</span></div>";
        } else if(isset($_GET['update']) && ($_GET['update']=='error')){ 
            echo "<div class='notification errors'>Could not update, please try again!<span class='close'>x</span></div>";
        }
    ?>

    <div class="hero full-hero">
        <div class="hero-logo"><img src="img/CB-logo-white.png" alt="Content Bidder Logo"></div>
        <div class="hero-form">
            <h1>Profile <small> <a href="change_pass.php">Change Password</a></small></h1>

            <?php
                $user_id = $_SESSION['user_id'];
                $sql = "SELECT * FROM profiles where user_id='$user_id'";
                $result = mysqli_query($conn, $sql);

                if(mysqli_num_rows($result) > 0){
                    $result = mysqli_fetch_assoc($result);
                } else {
                    echo "errors";
                }
            ?>
            <form action="" method="post">

                <?php
                    $languages = array('English','Afar','Abkhazian','Afrikaans','Amharic','Arabic','Assamese','Aymara','Azerbaijani','Bashkir','Byelorussian','Bulgarian','Bihari','Bislama','Bengali/Bangla','Tibetan','Breton','Catalan','Corsican','Czech','Welsh','Danish','German','Bhutani','Greek','Esperanto','Spanish','Estonian','Basque','Persian','Finnish','Fiji','Faeroese','French','Frisian','Irish','Scots/Gaelic','Galician','Guarani','Gujarati','Hausa','Hindi','Croatian','Hungarian','Armenian','Interlingua','Interlingue','Inupiak','Indonesian','Icelandic','Italian','Hebrew','Japanese','Yiddish','Javanese','Georgian','Kazakh','Greenlandic','Cambodian','Kannada','Korean','Kashmiri','Kurdish','Kirghiz','Latin','Lingala','Laothian','Lithuanian','Latvian/Lettish','Malagasy','Maori','Macedonian','Malayalam','Mongolian','Moldavian','Marathi','Malay','Maltese','Burmese','Nauru','Nepali','Dutch','Norwegian','Occitan','(Afan)/Oromoor/Oriya','Punjabi','Polish','Pashto/Pushto','Portuguese','Quechua','Rhaeto-Romance','Kirundi','Romanian','Russian','Kinyarwanda','Sanskrit','Sindhi','Sangro','Serbo-Croatian','Singhalese','Slovak','Slovenian','Samoan','Shona','Somali','Albanian','Serbian','Siswati','Sesotho','Sundanese','Swedish','Swahili','Tamil','Tegulu','Tajik','Thai','Tigrinya','Turkmen','Tagalog','Setswana','Tonga','Turkish','Tsonga','Tatar','Twi','Ukrainian','Urdu','Uzbek','Vietnamese','Volapuk','Wolof','Xhosa','Yoruba','Chinese','Zulu');    
                    $specialities = array('Baby & Nursery', 'Clothing','Education','Food & Restaurants','Health & Beauty','Home & Garden','Jewellery & Watches','Sports & Leisure','Technology','Toys','Transport','Travel');  
                ?>

                <input type="text" placeholder="Username" name="username" id="uname" value="<?php if(isset($username)){echo $username;}else if(isset($result['username'])){echo $result['username'];}?>">
                <div class="error"><?php if(isset($error_username))echo $error_username?></div>

                <textarea placeholder="Bio" name="bio" id="bio"><?php if(isset($bio)){echo $bio;}else if(isset($result['bio'])){echo $result['bio'];}?></textarea>
                <div class="error"><?php if(isset($error_bio))echo $error_bio?></div>

                <input type="text" placeholder="Price p/w as Decimal" name="price" id="price" value="<?php if(isset($price)){echo $price;}else if(isset($result['price'])){echo $result['price'];}?>">
                <div class="error"><?php if(isset($error_price))echo $error_price?></div>

                 <select name="age" id="age">
                    <option value="">Age</option>
                    <?php for ($i=16; $i<=100; $i++) { ?>
                        <option value="<?php echo $i;?>" <?php if(isset($age)&&$age==$i){echo "selected";}else if(isset($result['age'])&&$result['age']==$i){echo "selected";}?>><?php echo $i;?></option>
                    <?php } ?>
                </select>
                <div class="error"><?php if(isset($error_age))echo $error_age?></div>
                

                 <select name="language" id="language">
                    <option value="">Language</option>
                    <?php foreach ($languages as $lang) { ?>
                        <option value="<?= $lang ?>" <?php if(isset($language)&&$language==$lang){echo "selected";}else if(isset($result['language'])&&$result['language']==$lang){echo "selected";}?>><?= $lang ?></option>
                    <?php } ?>
                </select>
                <div class="error"><?php if(isset($error_location))echo $error_location?></div>

                <select name="speciality" id="speciality">
                    <option value="">Speciality</option>
                    <?php foreach ($specialities as $special) { ?>
                        <option value="<?= $special ?>" <?php if(isset($speciality)&&$speciality==$special){echo "selected";}else if(isset($result['speciality'])&&$result['speciality']==$special){echo "selected";}?>><?= $special ?></option>
                    <?php } ?>
                </select>
                <div class="error"><?php if(isset($error_speciality))echo $error_speciality?></div>

                <label class="radio-button">Client
                    <input type="radio" name="role" id="client" value="1" <?php if(isset($role)&&$role=="1"){echo"checked";}else if(isset($result['role_id'])&&$result['role_id']==1){echo"checked";}?>>
                    <span class="checkmark"></span>
                </label>

                <label class="radio-button">Writter
                    <input type="radio" name="role" id="writter" value="2" <?php if(isset($role)&&$role=="2"){echo"checked";}else if(isset($result['role_id'])&&$result['role_id']==2){echo"checked";}?>>
                    <span class="checkmark"></span>
                </label>
                <div class="error"><?php if(isset($error_role))echo $error_role?></div>

                <input type="submit" value="Update" name="update" class="btn btn-blue">
            </form>
        </div>
    </div>

<?php require_once 'footer.php' ?>