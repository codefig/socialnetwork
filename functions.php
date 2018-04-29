<?php

/**
 * function to get the details of a certain
 * 
 */
function get_user_details($userid, $con_mng) {
	//@param $userid => id of the user
	//@param $con_mng => connection manager

	$get_query = "SELECT * FROM user WHERE id=:userid";
	$g_handler = $con_mng->prepare($get_query);
	$g_handler->execute(array(':userid' => $userid));

	$result = $g_handler->fetch(PDO::FETCH_OBJ);
	return $result;
}


/**
 * function to get the image40 for a user 
 */
function get_image_set($userid, $con_mng){

   $g_image = "SELECT image40 FROM images WHERE userid=:userid";
   $g_image_handler = $con_mng->prepare($g_image);
   $g_image_handler->execute(array(':userid' => $userid));
   $g_ans  = $g_image_handler->fetch(PDO::FETCH_OBJ);
   return $g_ans->image40;
}


/**
 * function to get the count  of commments 
 * on a certain post with postid
 */
function get_comment_count($post_id, $con_mng){
   $get_comment_query = "SELECT * FROM comments WHERE post_id=:post_id";
  $get_comment_handler = $con_mng->prepare($get_comment_query);
  $get_comment_handler->execute(array(
    ':post_id' => $post_id));
  $cmt_count = count($get_comment_handler->fetchAll());
  return $cmt_count;
}

/**
 * function to check if user has allready been added
 */
function check_if_user_added($adder_id, $added_id, $con_mng){
	$check_query = "SELECT * FROM friends WHERE adder_id=:adder
	AND added_id=:added";

	$check_handler = $con_mng->prepare($check_query);
	$check_handler->execute(array(':adder' => $adder_id, ':added' => $added_id));

	$row_count = $check_handler->rowCount();
	return $row_count;
}

/**
 * function to get the image_200 of a user 
 * to use as a placement where the image200 is 
 * needed
 */
function get_image_200($userid, $con_mng){
	$g_image_200 = "SELECT image200 FROM images WHERE userid=:userid";
	$g_image_handler = $con_mng->prepare($g_image_200);
	$g_image_handler->execute(array(':userid' => $userid));
	$result = $g_image_handler->fetch(PDO::FETCH_OBJ);
	return $result;
}




//############################################
#   this function is to get all comments
#   pertainting to a certain post
#  @param $post_id = the id of the post
#  @param $con_mng = the connection manager
##############################################

function get_post_comments($post_id, $con_mng) {

  $get_comment_query = "SELECT * FROM comments WHERE post_id=:post_id";
  $get_comment_handler = $con_mng->prepare($get_comment_query);
  $get_comment_handler->execute(array(
  	':post_id' => $post_id));
  // $comment_result = $get_comment_handler->fetchAll(PDO::FETCH_OBJ);
  // return $comment_result;
  while($cmt_result = $get_comment_handler->fetch(PDO::FETCH_OBJ))
  {
  	echo '<div class="media">
                   <a class="pull-left cmter-img" href="">
                     <img class="img-circle" src="'.get_image_set($cmt_result->commenter_id, $con_mng).'"
                     height="40px" width="40px" />
                   </a>
                   <div class="media-body">
                      <h4 class="media-heading cmter-name">';
                      //get the commenter details here
                      $r=get_user_details($cmt_result->commenter_id, $con_mng);

                      $cmter_name = $r->full_name;

                      echo "$cmter_name".'</h4>
                      <p class="cmter-text">'.$cmt_result->comment_text.'</p>
                       <p><a href="" cid="'.$cmt_result->id.'" pid="'.$post_id.'"
                        cmter="'.$cmt_result->commenter_id.'" class="like_cmt">
                        Like
                       </a>&nbsp;<span class="fa fa-thumbs-o-up"> 20</span> </p>
                   </div> <!--end of the comment element div -->
                  </div><!--end of media parent div -->
';
  }
}



function get_status_likes($userid, $status_id, $con_mng){

   /******************************************
   /@function = to check if a certain user has liked
   /            the post previously or not
   /
   /@params : userid, statusid, $con-mng
   /@return : the number of rows
   /****************************************/
  $query = "SELECT * FROM status_like WHERE
  status_id=:st_id AND liker_id=:lk_id";
  $get_st_like_handler = $con_mng->prepare($query);
  $get_st_like_handler->execute(array(
    ':st_id' => $status_id,
    ':lk_id' => $userid));
  $row_count = $get_st_like_handler->rowCount();
    return $row_count;

}
/**
 *  function to get all the number of likes on a certain status 
 * post 
 * @returs number rowcount of the rows 
 */
function get_status_like_count($statusid, $con_mng){
  /*********************************************************
  /@function : to get the number of likes for a certain post
  /@params : statusid -> the id of the status
  /@return : the rowcount of the rows
  /********************************************************/

  $query = "SELECT * FROM status_like WHERE status_id=:statusid";
  $handler = $con_mng->prepare($query);
  $handler->execute(array(':statusid' => $statusid));
  $status_likes_count = $handler->rowCount();
  return $status_likes_count;
}

/**
 * function to get all users 
 * @return rowcount of the users 
 */
function get_all_users($con_mng){
  $query = "SELECT * FROM user";
  $handler = $con_mng->query($query);
  $rowcount = $handler->rowCount();
  return $rowcount;
}

/**
 * function to list all msgs between a user and another user 
 */
function list_user_msg($me, $con_mng)
{
  $query = "SELECT * FROM user WHERE id <> :me ";
  // $handler = $con_mng->query($query);
	$handler = $con_mng->prepare($query);
	$handler->execute(array(':me' => $me));
  $rowcount = $handler->rowCount();
  while ($ans = $handler->fetch(PDO::FETCH_OBJ)) {
    # code...
     $user = get_user_details($ans->id, $con_mng);
   echo '
    <div class="msgItem">

          <img class="pull-left msgImage img50" src="'.get_image_set($ans->id, $con_mng).'"/>
          <span><a href="" class="msger" uid="'.$ans->id.'">'.$user->full_name.'</a></span> &nbsp;<span>9:06pm</span><br/>
          <span class="fa fa-share"></span>&nbsp;&nbsp;
          <a href="" class="lastmsglink"><span class="lastmsg">we need money for some damn stuffs and i can see </span></a>
       </div><!--end of the msgItem object div -->
    ';
  }
}

/**
 * function to load all followers of a certain user 
 * 
 */

function load_possibe_followers($userid, $con_mngr){
	//this is a function to load all posible followers

	$query = "SELECT * FROM user WHERE id <> :userid";  //get all user from the query where user not equal to  me;
	$handler = $con_mngr->prepare($query);
	$handler->execute(array(':userid' => $userid));
	$rowcount = $handler->rowCount();
	if($rowcount){
		while($someone = $handler->fetch(PDO::FETCH_OBJ)){
			$personid = $someone->id;
			$imageresult  = get_image_200($personid, $con_mngr); //get the user image 200
			$user_details = get_user_details($personid, $con_mngr); //get the user details
			$username = $user_details->full_name; //get the user fullname ;
			$image200  = $imageresult->image200; //get the image200 filter from image 200

		  //function to check if they are friends already;

			$f_result = check_if_user_added($userid, $personid, $con_mngr);


			if($f_result){
				$btnclass= "adf";
				$btntext = "followed";
				$spanclass = "fa-check-circle";
			}
			else{
				$btnclass= "addbtn";
				$btntext = "follow";
				$spanclass = "fa-user-plus";
			}

			echo '
			<div class="media userAdd">
       <a href="profile.php?user='.$personid.'">
         <img src="'.$image200.'"  class="userImageAdd"/>
      <span class="username"> &nbsp;'.$username.' </span>
       </a>

       &nbsp;
       <button class="btn btn-info '.$btnclass.' pull-right" uid="'.$personid.'" mid="'.$userid.'">
			 <span class="fa '.$spanclass.'"></span> &nbsp;'.$btntext.'</button>
      </div>';

		}
	}
}


//facebook.com/photos/user=3&imglink=133.jpg


/**
 * function to get all photos uploaded by a certain user
 * and post them on the myphotos page of the user
 */
function get_my_photos($userid,$con_mngr){
  $my_photos_query = "SELECT * FROM image_uploads WHERE userid=:thisuser ORDER BY id DESC";
  $get_my_photos_handler = $con_mngr->prepare($my_photos_query);
  $get_my_photos_handler->execute(array(':thisuser' => $userid));
  $rowcount = $get_my_photos_handler->rowCount();

  if($rowcount){
    while($result = $get_my_photos_handler->fetch(PDO::FETCH_OBJ)){
      // echo $result->image_200_link;
      //echo out all the image 
      echo '<div class="md-cont" >
          <div class="media " style="margin:10px;float:left">
            <div class="media-object" style="width:200;height:150">
              <img src="'.$result->image_200_link.'" alt="my_photos"  attr=""/>
            </div>
            <a href="" class="mk-profile" pid="'.$result->id.'"><span class="fa fa-instagram "></span></a>
             &nbsp;<a href="'.$result->filename.'"><span>view </span></a>
          </div>
      </div>';
    }
  }
}


/**
 * function to update a profile picture with one 
 * of the previously uploaded photos by the user 
 * 
 * @logic: 
 *       get the imageid for the image from image_uploads table 
 *       search and get the image_120 link in image table using the imageid
 *       update the user's profile picture and set it as the image120 
 */

function set_as_profile_image($userid, $con, $image_200_link){
  $query ="SELECT imageid FROM image_uploads WHERE image_200_link=:img200 AND userid=:uid";
  $sp_handler = $con->prepare($query);
  $sp_handler->execute(array(
    ':image_200_link' => $image_200_link,
    ':uid' => $userid));
  $rowcount = $sp_handler->rowCount();
  if(!$rowcount){
    trigger_error("Sorry Error! (functions::set_as_profile_image->imageid)");
  }
  else{
     $image_id = $result->id = $sp_handler->fetch(PDO::FETCH_OBJ);
     echo $image_id;
  }
}

function view_image(){

}
?>
