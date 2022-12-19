<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="myprofile.css">
    <title>Document</title>
</head>
<body>
<?php
    $player=$_GET['player'];
    //echo $player;
    include "config.php";
    include "home.php";
?>   
<div class="clr"></div>

<div class="container1">
  
    <h2>Game statistics</h2>
    <div class="user-profile">
    
        <?php 
        
            $sql = "SELECT * FROM `users` WHERE IG_Tag='$player'";
            $res = mysqli_query($db,  $sql);
            $mysql = "SELECT * FROM statistics inner join players WHERE statistics.AccNo='$player' and statistics.AccNo=players.AccId";
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
                <h3><?php echo "Rank: ",$gameinfo['curr_rank'] ?></h3>
                <h3><?php echo "Matches Played: ",$gameinfo['Matches'],"   ",str_repeat('&nbsp;', 4)," Wins: ",$gameinfo['wins']?></h3>
                <h3><?php echo "Win Percentage: ",$gameinfo['Win_percent'] ?></h3>
                <h3><?php echo "Headshot Percentage: ",$gameinfo['HS_percent'] ?></h3>
                <h3><?php echo "Damage per Round : ",$gameinfo['DPR'] ?></h3>
                <h3><?php echo "Kill/Death ratio : ",$gameinfo['KDR'] ?></h3>
                <h3><?php echo "Kill/Assist/Death: ",$gameinfo['KAD'] ?></h3>
              </div>
              
              
              <div class="coach-form">
                <form action="" method="post">
                    <div class="field">
                    <input type="text" name="time" required placeholder="Starting time in UTC" onfocus="(this.type='time')" onblur="(this.type='text')">
                </div>
                <div class="field">
                    <input type="text" name="meet-link" required placeholder="meet-link">
                    </div>
                <div class="field">
                    <input type="text" name="meet_date" required placeholder="Meet Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                </div>
                
                <!--<a href="bookcoach.php?coach=<?php echo $coach;?>">-->
                        <input type="submit" value="Confirm coaching" name="submit"></a>
                    
                </div>

                </form>
              
            <?php } ?>
                <?php 
                    if(isset($_POST['submit'])){
                        
                        $time = $_POST['time'];
                        $meet_link  = $_POST['meet-link'];
                        $meet_date  = $_POST['meet_date'];
                        $userID = $_SESSION['user_id'];

                        $query = mysqli_query($db,"select AccID from users where IG_Tag = '$player'");
                        $row		= mysqli_fetch_assoc($query);
                        $requested = $row['AccID'];

                        $query = mysqli_query($db,"select * from messages where userID = '$requested' and coachID='$userID'");
                        $num_row 	= mysqli_num_rows($query);
                        if ($num_row == 0){
                        $query = mysqli_query($db,"insert into messages values ('$userID','$requested','$time','$meet_date','$meet_link')");
                        $query = mysqli_query($db,"delete from coaching where Coach_ID = '$userID' and user_ID='$requested'");
                        $em = "Coaching requested accepted";
                        header("Location: home.php?$em");
                        }
                        else{
                            $em = 'Unknown error';
                            header("Location: home.php?$em");
                        }
                    }
                
                ?>
    </div>
    <?php 

?>
    
</div>
</body>
</html>