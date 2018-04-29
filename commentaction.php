<?php
//this file is meant to update the comment 
//for each status posted on home.php file 

require_once('config.php');
require_once('functions.php');

if(isset($_POST['task']) && $_POST['task'] == 'cmt'){
   $comment_text = $_POST['cmt_text'];
   $post_id = $_POST['post_id'];
   $commenter_id = $_POST['poster'];
   $comment_date_time = date('Y-m-d h:m:sa');

   // echo $commenter_id;
   $cmt_query = "INSERT INTO comments(commenter_id, post_id, comment_text, comment_date_time) 
   VALUES (:cmt_id, :post_id, :cmt_text, :cmt_dt)";

   $cmt_handler = $con->prepare($cmt_query);
   $cmt_handler->execute(array(
   	':cmt_id' => $commenter_id,
   	':post_id' => $post_id,
   	':cmt_text' => $comment_text,
   	':cmt_dt' => $comment_date_time));

   


   ##############################################
   #  @purpose : get comments for certain post
   #  @funct get_post_comments :: functions.php
   #
   ##############################################  
   get_post_comments($post_id, $con);



}

?>