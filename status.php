<?php
session_start();
require_once('config.php');
require_once('resizer.php');


/*******************************************
/ this file is meant for the ajax post request of the status image 
/ the image on the status page before the user clicks on the text input
/ this is triggerd by clicking the Insert Image/Video option on the home.php file
*/
if($_SERVER['REQUEST_METHOD']  == 'POST'){

	$storage_dir = './social_uploads/status_files/images/';

	if(isset($_FILES['statusImage'])){

		$tmp_loc = $_FILES['statusImage']['tmp_name'];
		$file_name = $_FILES['statusImage']['name'];
		$file_type = $_FILES['statusImage']['type'];
		$file_size = $_FILES['statusImage']['size'];
         
        $nfilename = rand(0,99999999999).'comment'.time();
		// $file_ext = explode(".", $file_name);
		// $ext = $file_ext[1];
		$ext = strtolower(pathinfo($_FILES['statusImage']['name'], PATHINFO_EXTENSION));
        
        /***********************************************
        /$ext = the file extension 
        /$nfilename = the new filename 
        /$tmp_loc = the tmeporary location from ur web server 
        /$storage_dri = the storaget location 
        /*********************************************/

        $original_file = $storage_dir.$nfilename.".".$ext;
		$status_image_100 = $storage_dir.$nfilename."-100.".$ext;
		$status_image_300  = $storage_dir.$nfilename."-300.".$ext;

      /***********************************************************
      /@param $r_width = required width for the image to be resized;
      /@param $r_height = required height for the image to be resized;
      /***********************************************************/
		$r_width = 150;
		$r_height = 150;

        /*********************************************
        / @param $ext_array = the array to keep the list of extensions 
        /********************************************/

		$ext_array = array('jpg','png','gif','jpeg');

		if(!in_array($ext,$ext_array )){
			
			echo "<span style='color:#fff'>Sorry invalid File</span>";
			exit();
		}
		else{
			if(!move_uploaded_file($tmp_loc, $original_file)){
				echo "<span style='color:#fff'>Sorry File Upload Dir Error!</span>";
				exit();
			}
			else{
			resizer($original_file, $status_image_100,$r_width,$r_height, $ext);
			resizer($original_file, $status_image_300,500, 300, $ext);
			
			
			$current_user = $_SESSION['userid'];
			$cur_date = date("Y-m-d h:i:s a");

			$status_image_query = "INSERT INTO status(user_id,post_dataname,post_date) VALUES(:user_id ,:post_dataname,:post_date)";
			$st_image_handler = $con->prepare($status_image_query);
			$st_image_handler->execute(array(
				':user_id' => $current_user,
				':post_dataname' => $status_image_300,
				':post_date' => $cur_date));

			$rowid = $con->lastInsertId();
			$_SESSION['imageid'] = $rowid;
			echo "<img src='$status_image_100' alt='stats' />";	
				
			}
		}
	}
}

?>