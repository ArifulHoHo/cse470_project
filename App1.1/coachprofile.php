<?php 
include "home.php";
include "config.php";
$accid = $_SESSION['user_id'];

$sql = "SELECT * FROM `users` WHERE AccID='$accid'";
$res = mysqli_query($db,  $sql);
$info = mysqli_fetch_assoc($res);


$type = $info['user_type'];
//echo $type;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="coachprofile.css">
    <title>Coach</title>
</head>
<body>
<?php
    $coach=$_GET['coach'];
   // echo $coach;
    
    
?>
<div class="clr"></div>

    <div class="container1">
      
        <h2 id="header">Game statistics</h2>
        <div class="user-profile">
            <?php 
            
                $sql = "SELECT * FROM `users` WHERE IG_Tag='$coach'";
                $res = mysqli_query($db,  $sql);
                
                $mysql = "SELECT * FROM `statistics` WHERE AccNo='$coach'";
                $gameres = mysqli_query($valorant,  $mysql);
                $gameinfo = mysqli_fetch_assoc($gameres);
                if (mysqli_num_rows($res) > 0) {
                  $info = mysqli_fetch_assoc($res);
                  $coachid = $info['AccID'];
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
                  
                  <div class="coach-desc">
                    <h3><?php echo "Coaching experience: ",$info['coach_exp_years']," years";?></h3>
                    <p><?php echo "Description: ",$info['coach_desc'];?></p>
                  </div>
                  <div class="coach-btn">
                    <?php if(strcmp($type,'Coach') !=0 ) { ?>
                      <a href="bookcoach.php?coach=<?php echo $coach;?>"><input type="submit" value="Apply for coaching"></a>
                    <?php }?>
                  </div>
                <?php } ?>
            
        </div>
     
        
    </div>
    <div class="reviews">
        <a href="review.php?coach=<?php echo $coachid;?>"><input type="submit"  value="See reviews"></a>
        <h3>Leave a review for your coach!</h3>
        <form action="#" method="POST">
          <textarea name="review" id="review" cols="45" rows="10" minlength=10 maxlength=1000></textarea>
          <input type="submit" name="create" id = "create" value="Submit">
        </form>
    </div>
    <?php 
      if(isset($_POST['create'])){
        $review = $_POST['review'];
        $mysql = "insert into reviews values ('$coachid','$accid','$review',curdate())";
        mysqli_query($db,$mysql);
        header("Location: coachdisplay.php?review submitted succesfully");
      }
    ?>
</body>
</html>