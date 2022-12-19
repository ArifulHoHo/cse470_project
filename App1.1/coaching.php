<?php include "home.php" ;
include "config.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="coachdisplay.css">
    <title>Coaching</title>
</head>
<body>
    <div class="clr"></div>
    <div class="container1">
    <?php 
        $user = $_SESSION['user_id'];
        $mysql = "SELECT * FROM `users` WHERE AccID='$user'";
        $res = mysqli_query($db,  $mysql);
        $info = mysqli_fetch_assoc($res);
       
        if($info['user_type'] == 'Coach'){
            //echo "i am a bloody coach";
            $mysql = "SELECT * FROM coaching where Coach_ID='$user'";
            $res = mysqli_query($db,  $mysql);
            while($info = mysqli_fetch_assoc($res)){
            

                $student = $info['user_ID']; 
                $date = $info['requestDate']; 
                $sql = "SELECT * FROM users where AccID = '$student'";
                $result = mysqli_query($db,  $sql);
                $info1 = mysqli_fetch_assoc($result);
    ?>
                <div class="coach">
                    <div class= "profile-pic">
                        <img src="uploads/<?=$info1['photo_url']?>">
                        <h3><?php echo 'Player: ', $info1['IGN']?></h3>
                        
                        <?php $player = $info1['IG_Tag'];?>
                        <a href="requesteduserprofile.php?player=<?php echo $player;?>">
                        <input type="submit" value="More"></a>
                                
                    </div>
                </div>

    <?php
            }
        }
    ?>
    </div>
</body>
</html>