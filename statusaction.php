<?php
session_start();
require('config.php');
require('functions.php');

//@param $status_row = the row where the status is going 
// to be inserted;
$status_row  = $_SESSION['imageid'];
$curdate = date("Y-m-d h:i:s a");


//****************************************************
//   this function is meant to update the status
//   when the status has got no status image included
//
//****************************************************

if(isset($_POST['task']) && $_POST['task'] == 'i') {

  
  $status_text = $_POST['status_text'];
  $userid = $_POST['userid'];
  
  $i_query = "INSERT INTO status(user_id, post_date, post_text)
      VALUES (:userid, :curdate, :status_text)";
  $i_handler = $con->prepare($i_query);
  $i_handler->execute(array(
  	':userid' => $userid,
  	':curdate' => $curdate,
  	':status_text' => $status_text,
  	));
}

//*****************************************************
// this functiion is meant to update the status 
// when the status includes an Image 
//****************************************************

if(isset($_POST['task']) && $_POST['task'] == 'u') {

	$userid = $_POST['userid'];
	$status_text = $_POST['status_text'];

	//@status_row & curdate are declared up
	$u_query = "UPDATE status SET post_text=:status_text, post_date=:curdate WHERE id=:status_row";
	$u_handler = $con->prepare($u_query);
	$u_handler->execute(array(
		':status_text' => $status_text,
		':curdate' => $curdate,
		':status_row' => $status_row));
}

//*****************************************************
// this function is meant for when a user likes the status
// 
//****************************************************

if(isset($_POST['task']) && $_POST['task'] == 'likestatus')

{
  // echo "yea i met that right";
  $status_id = $_POST['status_id'];
  $userid = $_POST['userid'];
  // echo $status_id . $userid ;

  $query = "INSERT INTO status_like(liker_id, status_id) VALUES
  (:liker_id,:status_id)";
  $handler = $con->prepare($query);
  $handler->execute(array(
    ':liker_id' =>$userid,
    ':status_id' => $status_id));
  
}
//*****************************************************
// this functiion is for when a user likes a certain comment
// on the page
//****************************************************

if(isset($_POST['task']) && $_POST['task'] == 'like_cmt'){

  $userid = $_POST['userid'];
  $comment_id = $_POST['cmt_id'];
  $status_id = $_POST['post_id'];
  
}



?>