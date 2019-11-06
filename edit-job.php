<?php require_once 'header.php' ?>
<?php require_once 'edit_job_process.php' ?>

    <?php  
        if(isset($_GET['update']) && ($_GET['update']=='error')){ 
            echo "<div class='notification errors'>Could not update, please try again!<span class='close'>x</span></div>";
        }if(isset($_GET['job_id'])){
            $_SESSION['job_id'] = $_GET['job_id'];
        }
        if(isset($_SESSION['job_id'])){
            $job_id = $_SESSION['job_id'];
        }
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT * FROM jobs where job_id='$job_id'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0){
            $result = mysqli_fetch_assoc($result);
            if($result['user_id'] == $user_id || $permission_id == 1 ){ ?>
            <div class="hero full-hero">
                <div class="hero-logo"><img src="img/CB-logo-white.png" alt="Content Bidder Logo"></div>
                <div class="hero-form">
                    <h1>Edit Job <small> <a href="delete_job.php?job_id=<?= $job_id ?>">Delete Job</a></small></h1>
        
                    <form action="" method="post">
        
                        <?php
                            $languages = array('English','Afar','Abkhazian','Afrikaans','Amharic','Arabic','Assamese','Aymara','Azerbaijani','Bashkir','Byelorussian','Bulgarian','Bihari','Bislama','Bengali/Bangla','Tibetan','Breton','Catalan','Corsican','Czech','Welsh','Danish','German','Bhutani','Greek','Esperanto','Spanish','Estonian','Basque','Persian','Finnish','Fiji','Faeroese','French','Frisian','Irish','Scots/Gaelic','Galician','Guarani','Gujarati','Hausa','Hindi','Croatian','Hungarian','Armenian','Interlingua','Interlingue','Inupiak','Indonesian','Icelandic','Italian','Hebrew','Japanese','Yiddish','Javanese','Georgian','Kazakh','Greenlandic','Cambodian','Kannada','Korean','Kashmiri','Kurdish','Kirghiz','Latin','Lingala','Laothian','Lithuanian','Latvian/Lettish','Malagasy','Maori','Macedonian','Malayalam','Mongolian','Moldavian','Marathi','Malay','Maltese','Burmese','Nauru','Nepali','Dutch','Norwegian','Occitan','(Afan)/Oromoor/Oriya','Punjabi','Polish','Pashto/Pushto','Portuguese','Quechua','Rhaeto-Romance','Kirundi','Romanian','Russian','Kinyarwanda','Sanskrit','Sindhi','Sangro','Serbo-Croatian','Singhalese','Slovak','Slovenian','Samoan','Shona','Somali','Albanian','Serbian','Siswati','Sesotho','Sundanese','Swedish','Swahili','Tamil','Tegulu','Tajik','Thai','Tigrinya','Turkmen','Tagalog','Setswana','Tonga','Turkish','Tsonga','Tatar','Twi','Ukrainian','Urdu','Uzbek','Vietnamese','Volapuk','Wolof','Xhosa','Yoruba','Chinese','Zulu');    
                            $catagories = array('Baby & Nursery', 'Clothing','Education','Food & Restaurants','Health & Beauty','Home & Garden','Jewellery & Watches','Sports & Leisure','Technology','Toys','Transport','Travel');  
                        ?>
        
                        <textarea placeholder="Description" name="description" id="description"><?php if(isset($description)){ echo $description;}else if(isset($result['description'])){ echo $result['description']; }?></textarea>
                        <div class="error"><?php if(isset($error_description))echo $error_description?></div>
        
                        <input type="text" placeholder="Price p/w as Decimal" name="price" id="price" value="<?php if(isset($price)){echo $price;}else if(isset($result['price'])){ echo $result['price']; }?>">
                        <div class="error"><?php if(isset($error_price))echo $error_price?></div>
        
                         <select name="job_language" id="language">
                            <option value="">Language</option>
                            <?php foreach ($languages as $lang) { ?>
                                <option value="<?= $lang ?>" <?php if(isset($language)&&$language==$lang){echo "selected";}else if(isset($result['language'])&&$result['language']==$lang){ echo 'selected'; }?>><?= $lang ?></option>
                            <?php } ?>
                        </select>
                        <div class="error"><?php if(isset($error_job_language))echo $error_job_language?></div>
        
                        <select name="catagory" id="catagory">
                            <option value="">Catagory</option>
                            <?php foreach ($catagories as $cat) { ?>
                                <option value="<?= $cat ?>" <?php if(isset($catafory)&&$catagory==$cat){echo "selected";}else if(isset($result['catagory'])&&$result['catagory']==$cat){ echo 'selected'; }?>><?= $cat ?></option>
                            <?php } ?>
                        </select>
                        <div class="error"><?php if(isset($error_catagory))echo $error_catagory?></div>
                        
        
                        <input type="submit" value="Edit Job" name="edit" class="btn btn-blue">
                    </form>
                </div>
            </div>
                
            <?php } else { 

            header('Location: oops.php');

             } } ?>


<?php require_once 'footer.php' ?>