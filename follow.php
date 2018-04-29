<?php

include_once('config.php');
include('functions.php');

if(isset($_POST['task']) && $_POST['task'] == 'follow'){

  $follower = $_POST['uid'];
  $to_follow  = $_POST['followid'];


//firstly check if they are not already added

$check_query = "SELECT * FROM friends WHERE adder_id=:adder
AND added_id=:added";

$check_handler = $con->prepare($check_query);
$check_handler->execute(array(':adder' => $follower, ':added' => $to_follow));

$row_count = $check_handler->rowCount();

if(!$row_count){
  // echo "yea not rowcount";
  //then proceed to add the guys to friend and make them follow each other
$follow_query = "INSERT INTO friends(adder_id, added_id)
VALUES(:follower, :to_follow)";
$follow_handler = $con->prepare($follow_query);

$follow_handler->execute(array(
  ':follower' => $follower,
  ':to_follow' => $to_follow
));
}
else{
  exit(); //dont do anything to that;
}


}

 ?>
