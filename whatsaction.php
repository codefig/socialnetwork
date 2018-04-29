<?php
session_start();
include_once('config.php');
include_once('resizer.php');

// if($_SERVER['REQUEST_METHOD'] =='POST'){
if(isset($_FILES['statusImage'])){
	
	$userid = 1;
	$filename = $_FILES['statusImage']['name'];
	$tmp_name = $_FILES['statusImage']['tmp_name'];
	$ext = explode(".", $filename)[1];
	// echo $ext;
    $dir = "./templates/";
	$n_name = rand(0,99999);
	$new_file = $dir.$n_name.'.'.$ext;
	$new_file100 = $dir. $n_name . '-100.'. $ext;

	$r_width = 100;
	$r_height = 100;

	// echo $new_file . $new_file100;
	if(!move_uploaded_file($tmp_name, $new_file)){
		echo "Sorry file not uploaded successfully";
	}
	else{
		resizer($new_file, $new_file100, $r_width, $r_height, $ext);
		echo "<img src='$new_file100' alt='imgfile' />";

		$insert_query = "INSERT INTO testbed(post_image, userid) VALUES(:post_image, :userid)";
		$handler = $con->prepare($insert_query);
		$handler->execute(array(
			':post_image' => $new_file100,
			':userid' => $userid));
		$lastid = $con->lastInsertId();
		$_SESSION['lastinsert'] = $lastid;
        
	}

}

if(isset($_POST['task']) && $_POST['task'] == 'cmt_like')
{
	// echo "yea i saw that over there";
	$userid = $_POST['userid'];
	$status_id = $_POST['status_id'];
	// echo $userid ."what".$status_id;

	$query = "INSERT INTO test_status_like(liker_id, status_id) VALUES
	(:liker_id,:status_id)";
	$handler = $con->prepare($query);
	$handler->execute(array(
		'liker_id' =>$userid,
		'status_id' => $status_id));

}


?>