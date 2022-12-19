



<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="homestyle.css">
    <link rel="stylesheet" href="signupstyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Albert+Sans:ital,wght@0,200;0,500;0,700;1,400;1,500&display=swap" rel="stylesheet">
    <title>Home Page</title>
    
</head>
<body>
<?php
session_start();
include "config.php";
$userid = $_SESSION['user_id'];
$sql = "select user_type from users where AccID='$userid'";
$res = mysqli_query($db,$sql);
$data = mysqli_fetch_assoc($res);
$user_type = $data['user_type'];
//echo $_SESSION['user_id'];

?>
<img class="bg" src="img/home.png" alt="background">
    <!--nav bar er kaaj-->
    <nav>
            <div class="container">
                
                
                <div class="menu">
                    <ul>
                        <li><a href="home.php">Home</a></li>
                        <li><a href="myprofile.php">My Profile</a></li>                       
                        <li><a href="coachdisplay.php">Coaches</a></li>
                        <?php 
                        $x = 0;
                        if($user_type=='Coach'){ ?>
                            <li><a href="coaching.php">Requests</a></li>
        <?php           }?>
                        <li><a href="messages.php">Messages</a></li>
            
                        
                        <li><a href="settings.php">settings</a></li>
                        <li><a href="logout.php">Log Out</a></li>
                    </ul>
                </div>
            </div>
    </nav>
    
</body>
</html>