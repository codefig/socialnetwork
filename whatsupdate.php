<?php
session_start();
include_once('config.php');

//this method is meant for updating statuses that include 
//images and other types of multimedia data
// god help me out with this coding ...
if(isset($_POST['task']) && $_POST['task'] == 'status'){
	
    $textinput = $_POST['text'];
    // echo $textinput;
	$user_id = 1;
	$row_id = $_SESSION['lastinsert'];


	$i_query = "UPDATE testbed SET post_text=:textinput WHERE userid=:userid AND id=:row_id";
	$hander = $con->prepare($i_query);
	$hander->execute(array(
		':textinput' => $textinput,
		':userid' => $user_id,
		':row_id' => $row_id));

}

//this function is meant for updating statuses 
//without image and media files
if(isset($_POST['task']) && $_POST['task'] == 'i')
{
	// echo "yea that was an emtpy image";
	$textinput = $_POST['text'];
	
	$userid = 1;
	$insertion = "INSERT INTO testbed (post_text, userid) VALUES(:textinput, :userid)";
	$hand = $con->prepare($insertion);
	$hand->execute(array(
		':textinput' => $textinput,
		':userid' => $userid));
	$r_id = $con->lastInsertId();
	echo $r_id;
}

//this function is meant for inserting comments into the database 
//what i need to acheive next is how to insert them back and call them into the status container
if(isset($_POST['task']) && $_POST['task'] == 'comment'){

    $user_id = 1;
	$post_id = $_POST['post_id'];
	$comment_text = $_POST['comment_text'];
    // echo $comment_text;
	$insert_comment_query = "INSERT INTO test_comment (commenter_id, post_id, comment_text) 
	VALUES (:user_id, :post_id, :comment_text)";

	$insert_cmt_handler = $con->prepare($insert_comment_query);
	$insert_cmt_handler->execute(array(
		':user_id' => $user_id,
		':post_id' => $post_id,
		':comment_text' => $comment_text));

	get_comments_list($post_id);
}

function get_comments_list($postid) {
	global $con;
	$g_cmt_query = "SELECT * FROM test_comment WHERE post_id=:post_id";
	$g_cmt_handler = $con->prepare($g_cmt_query);
	$g_cmt_handler->execute(array(
		':post_id' => $postid));
	while($g_ans = $g_cmt_handler->fetch(PDO::FETCH_OBJ)) {
		echo "<div><span>$g_ans->commenter_id</span><span>$g_ans->comment_text</span></div>";
	}
}


function get_status_likes($userid,$status_id, $con_mng){
	$query = "SELECT * FROM test_status_like WHERE 
	status_id=:st_id AND liker_id=:lk_id";
	$get_st_like_handler = $con_mng->prepare($query);
	$get_st_like_handler->execute(array(
		':st_id' => $status_id,
		':lk_id' => $userid));
	$row_count = $get_st_like_handler->rowCount();
    return $row_count;
}
?>