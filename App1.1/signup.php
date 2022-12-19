<?php 
    require_once('config.php')
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Valorant Coach</title>
    
    <link rel="stylesheet" href="css/signupstyle.css">
</head>
<body>
    <img class="bg" src="img/home.png" alt="background">
    <?php 
        if(isset($_POST['create']) && isset($_FILES['myimage'])){
            $name = $_POST['name'];
            $email  = $_POST['email'];
            $ign  = $_POST['ign'];
            $valorant_id  = $_POST['valorant_id'];
            $country  = $_POST['country'];
            $birth_date = $_POST['birth_date'];
            $user_password = md5($_POST['user_password']); //md5() is a function that produces a hash string for the password
            $user = $_POST['def_user'];
            //echo $name;

            $query 		= mysqli_query($valorant, "SELECT * FROM players WHERE  IGN='$ign' and AccId='$valorant_id'");
			$row		= mysqli_fetch_array($query);
			$num_row 	= mysqli_num_rows($query);
			
            
            $img_name = $_FILES['myimage']['name'];
            $img_size = $_FILES['myimage']['size'];
            $tmp_name = $_FILES['myimage']['tmp_name'];
            $error = $_FILES['myimage']['error'];
            echo $error;
            if($num_row == 0){
                $em = "IGN and Valorant account id do not exist!";
                header("Location: signup.php?error=$em");
            }

            elseif($error === 0 ){
                if ($img_size > 12500000) {
                    $em = "Sorry, your file is too large.";
                    header("Location: signup.php?error=$em");
                }else{
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_lc = strtolower($img_ex);

                    $allowed_exs = array("jpg", "jpeg", "png");
                    if (in_array($img_ex_lc, $allowed_exs)) {
                        $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                        $img_upload_path = 'uploads/'.$new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);
        
                        //Insert into Database
                        $sql = "INSERT INTO users(photo_url,Name,email,country,IGN,IG_Tag,password,user_type) 
                                VALUES('$new_img_name','$name','$email','$country','$ign','$valorant_id',
                                '$user_password','$user')";
                        mysqli_query($db, $sql);
                        header("Location: index.php");
                    }else {
                        $em = "You can't upload files of this type";
                        header("Location: signup.php?error=$em");
                    }
                }
            }
            else{
                $em = "unknown error occurred!";
                header("Location: signup.php?error=$em");
            }
        }
    ?>
    
    

    <div class="container">

        <div class="head">
            <h2>Sign up to ValorantCoach!</h2>
        </div>
       
        <form action="signup.php" method="post" enctype="multipart/form-data">
            <div class="field">
                <input type="text" name="name" required placeholder="Name">
            </div>

            <div class="field">
                <input type="email" name="email" required placeholder="Email Address">
            </div>
            <div class="field">
                <input type="text" name="ign" required placeholder="IGN">
            </div>
                        
            <div class="field">
                <input type="text" name="valorant_id" required placeholder="Valorant Account ID" pattern="[0-9]{4}">
            </div>
                        
            <div class="field">
                <input type="text" name="country" required placeholder="Country" pattern="[A-Z][A-Za-z]{3,}">
            </div>

            <div class="field">
                <input type="text" name="birth_date" required placeholder="Birth Date" onfocus="(this.type='date')">
            </div>

            <div class="field">
                <input type="password" name="user_password" required placeholder="Password" 
                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                title="Must contain at least one number and one uppercase and lowercase letter, 
                and at least 8 or more characters">
            </div>
            
            <div class="field">
                <button type="button" class="btn-warning">
                    Upload your Image (optional)
                    <input type="file" name="myimage" >
                </button>
            </div>
                
            <div class="radio">
                <input type="radio" id="coach" name="def_user" value="Coach">
                <label for="coach">Coach</label>
                <input type="radio" id="player" name="def_user" value="Player">
                <label for="player">Player</label>
            </div>

            <div class="btn">
                <input type="reset">
                <input type="submit" name="create" value="Sign Up">
                
            
            </div>
            
        </form>
    </div>
    <script src="index.js"></script>
    
</body>
</html>