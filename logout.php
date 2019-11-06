<?php
    if(isset($_GET['log']) && ($_GET['log']=='out')){

        $user_id = $_SESSION['user_id'];
        $sql = "SELECT * FROM profiles WHERE user_id = $user_id";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            $result = mysqli_fetch_assoc($result);
            if($result['profile_warning']=='true'){
                $sql=  "UPDATE profiles 
                    SET profile_warning = 'false'
                    WHERE profiles.user_id = '$user_id'";
                $result = mysqli_query($conn, $sql);
            }
        }
        session_destroy();
        header('location:index.php?logout=success');
    }
    echo "<li><a href='?log=out'>Logout</a></li>";
?>