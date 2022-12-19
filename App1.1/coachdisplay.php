<?php 
include "home.php";
include('config.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="coachdisplay.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coaches</title>
</head>
<body>
<div class="clr"></div>
<div class="container1">

    <?php 
            
            $TAG = $_SESSION['user'];
            $sql = "SELECT * FROM `users` WHERE user_type = 'coach'";
            $res = mysqli_query($db,  $sql);
            if (mysqli_num_rows($res) > 0) {
                while($info = mysqli_fetch_assoc($res)){
                    ?>
                        <div class="coach">
                            <div class= "profile-pic">
                                <img src="uploads/<?=$info['photo_url']?>">
                                <h3><?php echo 'Coach: ', $info['IGN']?></h3>
                                <h3><?php echo 'Experience: ', $info['coach_exp_years'],' years'?></h3>
                                <?php $coach = $info['IG_Tag'];?>
                                <a href="coachprofile.php?coach=<?php echo $coach;?>">
                                <input id="submit" type="submit" value="More"></a>
                                
                            </div>
                        </div>
    <?php  } }?>
 </div>

        

</body>
</html>