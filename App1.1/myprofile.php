<?php include "home.php";?>
<?php include "config.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="myprofile.css">
  <title>Valorant Profile</title>
</head>
<body>
  <div class="clr"></div>
    <div class="container1">
      
        <h2>Game statistics</h2>
        <div class="user-profile">
            <?php 
                $TAG = $_SESSION['user'];
                $sql = "SELECT * FROM `users` WHERE IG_Tag='$TAG'";
                $res = mysqli_query($db,  $sql);
                $mysql = "SELECT * FROM `statistics` WHERE AccNo='$TAG'";
                $gameres = mysqli_query($valorant,  $mysql);
                $gameinfo = mysqli_fetch_assoc($gameres);
                if (mysqli_num_rows($res) > 0) {
                  $info = mysqli_fetch_assoc($res);
                  ?>
                  
                  <div class= "profile-pic">
                      <img src="uploads/<?=$info['photo_url']?>">
                  </div>
                  <div class="info">
                    
                    <h1><?php echo  $info['IGN'];echo "   #"; echo $info['IG_Tag'];  ?></h1>
                    <h3><?php echo "Matches Played: ",$gameinfo['Matches'],"   ",str_repeat('&nbsp;', 4)," Wins: ",$gameinfo['wins']?></h3>
                    <h3><?php echo "Win Percentage: ",$gameinfo['Win_percent'] ?></h3>
                    <h3><?php echo "Headshot Percentage: ",$gameinfo['HS_percent'] ?></h3>
                    <h3><?php echo "Damage per Round : ",$gameinfo['DPR'] ?></h3>
                    <h3><?php echo "Kill/Death ratio : ",$gameinfo['KDR'] ?></h3>
                    <h3><?php echo "Kill/Assist/Death: ",$gameinfo['KAD'] ?></h3>
                  </div>    
                <?php } ?>
            
        </div>
        
    </div>
</body>
</html>
