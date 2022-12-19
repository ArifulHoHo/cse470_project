<?php 
$coachid=$_GET['coach'];
//echo $coachid;
include "home.php";
include "config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="clr"></div>
    <?php 
        $mysql = "select * from reviews where coachID = '$coachid'";
        $run = mysqli_query($db,$mysql);
        // $info = mysqli_fetch_assoc($run);
        if(mysqli_num_rows($run) == 0){ 
            ?>
            <h1 id="no-review">No reviews yet!</h1>
<?php   
        }else{
            while($info = mysqli_fetch_assoc($run)){
                $reviewerid = $info['playerID'];
                $info2 = mysqli_query($db,"select * from users where AccID='$reviewerid'");
                $info2 = mysqli_fetch_assoc($info2);
                $revierIGN = $info2['IGN'];
                $reviewertag = $info2['IG_Tag'];
                $review = $info['review'];
                $reviewdate = $info['date'];?>

                <div class="user-review">
                    <h3>Review by: <?php echo $revierIGN ,str_repeat('&nbsp;', 2),'#', $reviewertag,
                    str_repeat('&nbsp;', 10),"Date: ",$reviewdate?></h3>
                    <p><?php echo $review?></p>
                </div>
        <?php
            }
        }
    ?>
</body>
</html>