<?php 
include "config.php";
session_start();
$user = $_SESSION['user'];

$userID = $_SESSION['user_id']; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="homestyle.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        $coachID= $_GET['coach'];
        //echo $coachID;
    ?>
    <img class="bg" src="img/home.png" alt="background">
    <div class="container1">
    <form method="POST">
            <div class="sub-menu-2">
                
                    <select name="Bank">
                        
                        <option value="Nexus Pay" >Nexus Pay</option>
                        <option value="City touch" >City touch</option>
                        <option value="Mastercard" >Mastercard</option>
                        <option value="Visa" >Visa</option>

                    </select>
                
                    <br><br>

                    <!--<input type="Submit" name="Submit" value="Submit">  -->    

            </div>
            <div class = "btn">
                    <h3>Click submit to agree to pay $80 for the coaching session</h3>
                    <input type="Submit" name="Submit" value="Submit">
            </div>
    </form>
    </div>
    <?php
                $n=9;
                function getName($n) {
                    $characters = '0123456789ABCDE';
                    $randomString = '';
                  
                    for ($i = 0; $i < $n; $i++) {
                        $index = rand(0, strlen($characters) - 1);
                        $randomString .= $characters[$index];
                    }
                  
                    return $randomString;
                }
                  
                
                //$t_id=getName($n);
                //echo "Transaction ID: $t_id  ";
                
            ?>
    <?php 
    if  (isset($_POST["Submit"])){
            $Bank=$_POST['Bank'];
            echo $Bank;
            while(True){
                $t_id=getName($n);
                break;

            }
            $sql = "insert into coaching (Coach_ID, user_ID,requestDate) values ('$coachID','$userID',curdate())";
            $res = mysqli_query($db,  $sql);

            $sql = "insert into payment values('$t_id','$Bank','80',curdate(),'$coachID','$userID')";
            $res = mysqli_query($db,  $sql);

            $em = "Coaching request successful";
            header("Location: home.php?$em");

   
    }
    ?>
</body>
</html>