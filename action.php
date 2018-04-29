<?php
ob_start();
session_start();
include_once('resizer.php');
include_once('config.php');
include_once('functions.php');
/****************************************************************
#this happens if the user just clicks on signup
#from the index page and thus the defualt profile picture is
#been set with the avatar.png format picture
#
/****************************************************************/

if(isset($_POST['signup'])){

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $matricno = $_POST['matricno'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $join_date = date('Y-m-d');

#
#
    #  Index.php function ....signup process
    #  the list of default images to insert into the image table
    #  before they get updated by the next.php file upload function
    #
    $default_pic_200 = "./social_img/ava200.png";
    $default_pic_120 = "./social_img/ava120.png";
    $default_pic_80 = "./social_img/ava80.png";
    $default_pic_40 = "./social_img/ava40.png";

$signupquery = "INSERT INTO user(full_name, email, matric_no, password, gender, join_date, prof_pic)
     VALUES(:fname,:em,:matno,:pas,:gen,:join,:prof_pic )";

    $h = $con->prepare($signupquery);

    try{

    $h->execute(array(
        ':fname'=>$fullname,
        ':em' => $email,
        ':matno' => $matricno,
        ':pas' => $password,
        ':gen' => $gender,
        ':join' => $join_date,
        ':prof_pic' => $default_pic_200));

}
catch(Exception $e){

    print_r($e->getMessage());
}

  $numrow = $h->rowCount();
  $lastid = $con->lastInsertId();


  $_SESSION['userid'] = $lastid;
  $_SESSION['usermail'] = $email;
  $_SESSION['mat_no'] = $matricno;
  $_SESSION['fullname'] = $fullname;

#
#  then make some insert into the images tabel
#  witht the avatar.png image stuffs ;

$default_imagequery = "INSERT INTO images(userid, usermail, image200, image120,image80,image40) VALUES(:userid,
 :usermail,:image200, :image120, :image80, :image40)";
$default_insert_handler = $con->prepare($default_imagequery);
$default_insert_handler->execute(array(
    ':userid' => $lastid,
    ':usermail' => $email,
    ':image200' => $default_pic_200,
    ':image120' => $default_pic_120,
    ':image80' => $default_pic_80,
    ':image40' => $default_pic_40));

#if no Errors then the insertion has beeen completed



  header("Location: next.php");
}

/****************************************************
#
# the following happens when the user uses the upload
# feature on the next.php file and then the imagePreview stuff
#
#
/**************************************************/

if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_FILES['images']))
{

/**
 *  this is if the user wants to update 
 *  the profile picture using the normal 
 *  camera link, 
 */

    $userid = $_SESSION['userid'];
    $usermail = $_SESSION['usermail'];


    $filename = $_FILES['images']['name'];
    $filesize = $_FILES['images']['size'];
    $filetype = $_FILES['images']['type'];
    $tmp_loc = $_FILES['images']['tmp_name'];
    $ext = strtolower(pathinfo($_FILES['images']['name'], PATHINFO_EXTENSION));
    $error = $_FILES['images']['error'];
    $nfilename = rand(0,9999999999)."-".time();
    $dir = "./social_uploads/images/";


    /**
     * $targetfile = the normal file
     * $resized_file_200 = the file with 200 width and height
     */
    $target_file = $dir.$nfilename.".".$ext;
    $resized_file_200 = $dir.$nfilename."-200.".$ext;
    $resized_file_120 = $dir.$nfilename."-120.".$ext;
    $resized_file_80 = $dir.$nfilename."-80.".$ext;
    $resized_file_40 = $dir.$nfilename."-40.".$ext;


   //declaring variable for the 200 images

    $hmax200 = 200;
    $wmax200 = 200;
    $hmax120 = 120;
    $wmax120 = 120;
    $hmax80 = 80;
    $wmax80 = 80;
    $hmax40 = 40;
    $wmax40 = 40;

   //if the file doesn't exist in the temporary location then exit()
    if(!$tmp_loc){
        echo "Error: please select a file before clicking the upload..";
        exit();
    }
    //if the filename does not match the regular expression .jpg,.png.gif
    elseif (!preg_match("/\.(gif|jpg|png)$/i", $filename)) {
        echo "Invalid File ";
        unlink($tmp_loc);
        exit();
    }
    //if the fileupload encounter's an error
    elseif($error == 1){
        echo "Error: occured while processing file";
        unlink($tmp_loc);
        exit();
    }

    //then move the file to the destination
    if(!move_uploaded_file($tmp_loc, $target_file)){
        echo "File & Dir Upload Error: try again";
        unlink($tmp_loc);
        exit();
    }
    else{
      

      //then upload the fileename into the img_uploads table so as to reference as profile picture;

      $img_upload_query = 'INSERT INTO image_uploads(filename, userid) VALUES (:filename, :userid)';
      $img_upload_handler = $con->prepare($img_upload_query);
      $img_upload_handler->execute(array(
        ':filename' => $target_file,
        ':userid' => $userid
      ));
      $last_insert_id_upload = $con->lastInsertId();
      $row_count = $img_upload_handler->rowCount();
    }




//then do the resizing into the required sizes
resizer($target_file, $resized_file_200,$wmax200, $hmax200, $ext);
resizer($target_file, $resized_file_120,$wmax120, $hmax120, $ext);
resizer($target_file, $resized_file_80, $wmax80, $hmax80, $ext);
resizer($target_file, $resized_file_40, $wmax40, $hmax40, $ext);


//execute the insertion query for the insertion of the images
$imagequery = "UPDATE images SET image200=:image200, image120=:image120, image80=:image80, image40=:image40
 WHERE userid=:userid AND usermail=:usermail";

$image_handler = $con->prepare($imagequery);

$image_handler->execute(array(
    ':userid' => $userid,
    ':usermail' => $usermail,
    ':image200' => $resized_file_200,
    ':image120' => $resized_file_120,
    ':image80' => $resized_file_80,
    ':image40' => $resized_file_40));





//then get the id of the updated row in the database
$get_last_image_updateid = "SELECT * FROM images WHERE image200=:img200 AND userid=:uid";
$get_last_image_updateid_handler = $con->prepare($get_last_image_updateid);
$get_last_image_updateid_handler->execute(
    array(
        'img200' => $resized_file_200,
        'uid' => $_SESSION['userid']));
$q_result= $get_last_image_updateid_handler->fetch(PDO::FETCH_OBJ);
$image200_id = $q_result->id; //this contains the id of the updated_20 in the images table


// thenn update the profile picture image
// update it using the resized_file_80
$prof_pic_query = "UPDATE user SET prof_pic=:prof_pic WHERE id=:userid";
$prof_pic_handler = $con->prepare($prof_pic_query);
$prof_pic_handler->execute(array(
    ':prof_pic' => $resized_file_120,
    ':userid' => $userid));



// then update the image_upload table with an image-200 of the image
// so as to be shown in the photos pane 
$image_upload_200_query = "UPDATE image_uploads SET image_200_link=:resize_200, imageid=:imh_row_id  WHERE id=:last_insert_id_upload";
$image_upload_update_handler = $con->prepare($image_upload_200_query);
$image_upload_update_handler->execute(array(
    ':resize_200' => $resized_file_200,
    ':imh_row_id' => $image200_id,
    ':last_insert_id_upload' => $last_insert_id_upload));
$update_row_count = $image_upload_update_handler->rowcount();




echo "<center><img src='$resized_file_200' alt='rimage'></center>";
}




/**
 * function to help update the profile picture of a user 
 * using one of his previously uploaded pictures 
 */

if(isset($_POST['task']) && strtolower($_POST['task']) == 's_p_pics'){
   
   sleep(3);
   if(isset($_SESSION['userid']) && $_POST['img_id']) {
    //then perform the iamage update 
    $userid  = $_SESSION['userid'];
    $image_in_imgupload_id = $_POST['img_id'];

    
    /**
     * then fetch the image from the image_uploads table
     * using the id of the image poste d 
     *  
     */
  
  $get_item_query = "SELECT filename FROM image_uploads WHERE id=:id AND userid=:uid";
  $get_item_handler = $con->prepare($get_item_query);
  $get_item_handler->execute(array('id'=>$image_in_imgupload_id,'uid' => $userid));
  $get_item_rowcount = $get_item_handler->rowCount();
  if($get_item_rowcount)
  {
    //shows the items exist 
    $filename_result = $get_item_handler->fetch(PDO::FETCH_OBJ);
    $filename = $filename_result->filename;


    /**
     * then check if the various resize files of the file still
     * exist in the upload folder 
     *
     */
    $file_ext = ".jpg";
    $orig_file = $filename;
    $removedot = explode('.',$orig_file);
    $file_parent = $removedot[1];
    // echo $file_parent;

    $file_array = ['200', '120','80','40'];
    
    $err_array = [];
    $err_counter = 0;
    for($i=0; $i < count($file_array); $i++)
    {
        $file_test_name = ".".$file_parent . '-'. $file_array[$i] . $file_ext;
        if(!file_exists($file_test_name)){
            $err_counter += 1;
        }
    }//end of the foor loop
    

    /**
     * then check the lenght of the $err_counter 
     * to ascertain if there where some file no more there
     */

    if($err_counter){
        // echo "Unable to set the image as Profile Picture!";
        // exit();
    }
    else{

        /**
         * Generate the files with their resp filenames
         */

        $update_image_200 = "." . $file_parent . "-200.jpg";
        $update_image_120 = "." . $file_parent . "-120.jpg";
        $update_image_80 =  "." . $file_parent . "-80.jpg";
        $update_image_40 =  "." . $file_parent . "-40.jpg";


        $update_picture_query = "UPDATE images SET image200=:image200, image120=:image120, image80=:image80, image40=:image40
                                    WHERE userid=:userid AND usermail=:usermail";
        $update_picture_handler = $con->prepare($update_picture_query);
        $update_picture_handler->execute(array(
            ':image200' => $update_image_200,
            ':image120' => $update_image_120,
            ':image80' => $update_image_80,
            ':image40' => $update_image_40,
            ':userid' => $_SESSION['userid'],
            ':usermail' => $_SESSION['usermail']));

        $update_image_row_count = $update_picture_handler->rowCount();

        if(!$update_image_row_count){
            echo "Sorry this is your profile picture already";
            exit();
        }
       
        else{
            /**
             * then update the prof_pics column in the user table 
             */
            $prof_pic_query = "UPDATE user SET prof_pic=:prof_pic WHERE id=:userid";
            $prof_pic_handler = $con->prepare($prof_pic_query);
            $prof_pic_handler->execute(array(
                ':prof_pic' => $update_image_120,
                ':userid' => $_SESSION['userid']));
            $prof_pic_rowcount = $prof_pic_handler->rowCount();
            

        } //end of the upper else

    }//end of else
  }


}
}

// login function here

/**
 * @date : 10/20/2015
 *  @function : to update the user's matriculation number 
 *  @para : matric number 
 *  @task : update_ mat
 *  @return : "matriculation number updated successfully";
 */

if(isset($_POST['task']) && $_POST['task'] == 'update_mat'){

  $matno = $_POST['matno'];
  $update_mat_query = "UPDATE matno SET matric_no=:matric_no WHERE id=:userid AND email=:usermail";
  $update_mat_handler = $con->prepare($update_mat_query);
  $update_mat_handler->execute(array(
    ':matric_no' => $matno,
    ':userid' => $_SESSION['userid'],
    'usermail' => $_SESSION['usermail']));
  $mat_row_count = $update_mat_handler->rowCount();

  if($mat_row_count > 0) {
    echo "matricno updated successfully";
  }
  else{
    echo "update not successful";
  }

}

?>
