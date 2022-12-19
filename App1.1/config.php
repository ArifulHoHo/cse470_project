<?php
    $db_user = "root";
    $db_pass = "";
    $db_name = "valorantcoachapp";

    $db = mysqli_connect("localhost", $db_user, $db_pass,$db_name);
    
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }


    $valorant = mysqli_connect("localhost","root","","gamevalorant");
?>