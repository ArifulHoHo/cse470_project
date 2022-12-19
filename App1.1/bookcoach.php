<?php 
include "config.php";
session_start();
$user = $_SESSION['user'];

$userID = $_SESSION['user_id'];


$coach=$_GET['coach'];
$sql = "select AccID from users where IG_Tag='$coach'";
$res = mysqli_query($db,  $sql);
$info = mysqli_fetch_assoc($res);
$coachID = $info['AccID'];
echo $coachID;
echo $userID;

$check = "select * from coaching where Coach_ID='$coachID' and user_ID='$userID'";
$mysql = mysqli_query($db,  $check);
if (mysqli_num_rows($mysql) == 0){
    
    
    //$sql = "insert into coaching (Coach_ID, user_ID,requestDate) values ('$coachID','$userID',curdate())";
    //$res = mysqli_query($db,  $sql);
    //$em = "Coaching request successful";
    header("Location: payment.php?coach=$coachID ");
}else{
    $em = "Coaching already requested from this coach";
    
    header("Location: home.php?error=$em");
}


?>