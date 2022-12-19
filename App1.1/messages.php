<?php include "home.php"?>
<?php

include "config.php";
$userid = $_SESSION['user_id'];
$sql = "select user_type from users where AccID='$userid'";
$res = mysqli_query($db,$sql);
$data = mysqli_fetch_assoc($res);
$user_type = $data['user_type'];
//echo $_SESSION['user_id'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <style>
        #table{
            
            padding-top: 15px;
            font-family: 'Albert Sans', sans-serif;
            border-collapse: collapse;
            width: 1170px;
            text-align: center;
            background-color: wheat;
            margin: 0 auto;
            
        }
        #table td, #table th {
            border: 1px solid #ddd;
            padding: 8px;
        }
        #table tr:hover {background-color: #ddd;}
        #table th {
            padding-top: 12px;
            padding-bottom: 12px;
            
            background-color: white;
            color: black;
        }
    </style>
</head>
<body>
    <table id="table">
        <tr>
        <?php if($user_type=='Player'){?>
            <th>Coach IGN</th>

        <?php }else{?>
            <th>Player IGN</th>
            <?php }?>
            <th>Meet date</th>
            <th>Meet time</th>
            <th>Meet-link</th>
        <?php //if($user_type=='Player'){?>
            <th>Cancel appointment?</th>

        <?php //}?>
        </tr>

        <?php 
            if($user_type=='Player'){
                $sql = "select * from messages where userID='$userid'";
                $res = mysqli_query($db,$sql);
                if(mysqli_num_rows($res) > 0){
                    while($info = mysqli_fetch_assoc($res)){ ?>
                    <?php $coachID = $info['coachID'] ?>
                        <?php $mysql = "select IGN from users where AccID='$coachID'" ;
                        $result = mysqli_query($db,$mysql);
                        
                        $data = mysqli_fetch_assoc($result);
                        $coachname = $data['IGN']?>
                        <tr>
                            <td><?php echo $coachname ?></td>
                            <td><?php echo $info['meetdate'] ?></td>
                            <td><?php echo $info['meettime'] ?></td>
                            <td><?php echo $info['meetlink'] ?></td>
                            <td>
                                <form method="POST" >
                                    <input type="Submit" id = "submit" name="Submit" value="Cancel session">
                                </form>
                            </td>
                        </tr>
  <?php            }
                }
                
            }else{
                $sql = "select * from messages where coachID='$userid'";
                $res = mysqli_query($db,$sql);
                if(mysqli_num_rows($res) > 0){
                    while($info = mysqli_fetch_assoc($res)){ ?>
                    <?php $coachID = $info['userID'] ?>
                        <?php $mysql = "select IGN from users where AccID='$coachID'" ;
                        $result = mysqli_query($db,$mysql);
                        
                        $data = mysqli_fetch_assoc($result);
                        $coachname = $data['IGN']?>
                        <tr>
                            <td><?php echo $coachname ?></td>
                            <td><?php echo $info['meetdate'] ?></td>
                            <td><?php echo $info['meettime'] ?></td>
                            <td><?php echo $info['meetlink'] ?></td>
                            <td>
                                <form method="POST" >
                                    <input type="Submit" id = "submit" name="Submit" value="Cancel session">
                                </form>
                            </td>
                        </tr>
  <?php            }
                }
            }
        ?>
    </table>
    <?php 
        if  (isset($_POST["Submit"])){
            // another button for reconfirming
            
            $mysql = "delete from messages where coachID='$coachID' and userID='$userid' ";
            $run = mysqli_query($db,$mysql);
            header("Location: messages.php?'coaching session cancelled'");
        }
    ?>
</body>
</html>