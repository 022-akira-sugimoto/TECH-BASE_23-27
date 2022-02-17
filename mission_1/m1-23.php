<?php
$member = array("Ken","Alice","Judy","BOSS","Bob");
foreach($member as $greeting){
    if($greeting == "BOSS"){
        echo "Good morning ".$greeting."!<br>";
    }else{
        echo "Hi! ".$greeting."<br>";
    }
}
?>