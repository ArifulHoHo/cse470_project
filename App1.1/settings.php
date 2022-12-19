<?php include "config.php";
session_start();
$accid = $_SESSION['user_id'];

$sql = "SELECT * FROM `users` WHERE AccID='$accid'";
$res = mysqli_query($db,  $sql);
$info = mysqli_fetch_assoc($res);

$ign = $info['IGN'];
$type = $info['user_type'];
$email = $info['email'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="homestyle.css">
    <link rel="stylesheet" href="settings.css">
    <title>Account settings</title>
</head>
<body>
    
    <img class="bg" src="img/home.png" alt="background">
    <div>
    <button class="back-btn"><a href="home.php">Back to Home</a></button>
    </div>
    
    <div class="container">
        <div class="dp-change">
            <div class="profile-pic">
                <img src="uploads/<?=$info['photo_url']?>">
            </div>
        </div>
    
    <div class="dp-change">
    <div class="field">
                <form action="settings.php" method="POST" enctype="multipart/form-data">
                    <input type="text" placeholder="<?php echo $ign ?>" readonly>
                    <input type="text" name="update-email" placeholder="<?php echo $email ?>">
                    <select name="update-profile-type">
                        <option value="Player" >Player</option>
                        <option value="Coach" >Coach</option>
                        
                    </select>
                    
                    
                    <input type="text" name="new-pass" placeholder="New Password">
                    <input type="text" name="confirm-pass" placeholder="Confirm Password">
                    <button id="btn-dp">Change profile image<input type="file" name="myimage" ></button>

                    <input type="submit" name="submit1" id="sbm" value="save">
                    
                </form>
    </div>
    </div>
    </div>
    <?php 
        if(isset($_POST['submit1'])){
            if(isset($_FILES['myimage'])){
                $img_name = $_FILES['myimage']['name'];
                $img_size = $_FILES['myimage']['size'];
                $tmp_name = $_FILES['myimage']['tmp_name'];
                $error = $_FILES['myimage']['error'];
                
                
           

                if($error === 0 ){
                    if ($img_size > 12500000) {
                        $em = "Sorry, your file is too large.";
                        header("Location: settings.php?error=$em");
                    }else{
                        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                        $img_ex_lc = strtolower($img_ex);

                        $allowed_exs = array("jpg", "jpeg", "png");
                        if (in_array($img_ex_lc, $allowed_exs)) {
                            $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                            $img_upload_path = 'uploads/'.$new_img_name;
                            move_uploaded_file($tmp_name, $img_upload_path);
            
                            //Insert into Database
                            $sql = "update users set photo_url = '$new_img_name' where AccID='$accid'";
                            
                            mysqli_query($db, $sql);
                            //header("Location: settings.php");
                        }else {
                            $em = "You can't upload files of this type";
                            header("Location: settings.php?error=$em");
                        }
                    }
                }
                
            }
            $new_email = $_POST['update-email'];
            if(strlen($new_email) > 0){
                $sql = "update users set email = '$new_email' where AccID='$accid'";
                mysqli_query($db, $sql);
            }
            $newpass = $_POST['new-pass'];
            $confirmpass = $_POST['confirm-pass'];
            
            if(strcmp($newpass,$confirmpass) == 0 && strlen($newpass) > 0){
                $newpass = md5($newpass);
                $sql = "update users set password = '$newpass' where AccID='$accid'";
                mysqli_query($db, $sql);
            }
            $update_user = $_POST['update-profile-type'];
            
            if(strcmp($update_user,'Coach') == 0 && strcmp($type,'Player')==0){
                
                $tag = $_SESSION['user'];
                $sql = "select curr_rank from players where AccId = '$tag'";
                $run = mysqli_query($valorant,$sql);
                
                $rank = mysqli_fetch_assoc($run)['curr_rank'];
                if(strcmp($rank,'Radiant') == 0){?>
                <div class="dp-change">
                    <div class="coach">
                        <form  method="post" enctype="multipart/form-data">
                            <input type="text" name ="exp" placeholder="Coaching experience(in years)" required >
                            <!-- <input type="text" name="desc" placeholder="Description" required > -->
                            <textarea name="desc"  cols="30" rows="10" placeholder="Your Description......."></textarea>
                            <input type="submit" name="submit" value="Confirm">
                        </form> 
                        </div>
                        </div>
<?php           }    
            } 
    }
                if(isset($_POST['submit'])){
                            
                            $exp = $_POST['exp'];
                            $desc = $_POST['desc'];

                            $mysql = "update users set coach_desc='$desc' where AccID='$accid'";
                            mysqli_query($db, $mysql);

                            $mysql = "update users set coach_exp_years='$exp' where AccID='$accid'";
                            mysqli_query($db, $mysql);

                            $mysql = "update users set user_type='Coach' where AccID='$accid'";
                            mysqli_query($db, $mysql);

                            
                }

                  
           
          
    ?>
    <div></div>
</body>
</html>