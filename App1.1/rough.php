<?php
$ranks = array("Iron 1"=>1,"Iron 2"=>2,"Iron 3"=>3,
            "Silver 1"=>5,"Silver 2"=>6,"Silver 3"=>7,"Gold 1"=> 9,
            "Gold 2"=> 10,"Gold 3"=> 11,"Platinum 1"=> 13,"Platinum 2"=> 14,
            "Platinum 3"=> 15, "Immortal 1"=>17, "Immortal 2"=>18,"Immortal 3"=>19, "Radiant"=>50);

$update_user = "Radiant"   ;        
if($ranks[$update_user] == $ranks['Radiant']){
    echo "yes"  ;
}
else{
    echo "nooo";
}
?>