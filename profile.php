<?php
session_start();
require_once('config.php');
require_once('functions.php');

$logged_userid = $_SESSION['userid'] ; //id of the currently loggedin user
$logged_usermail = $_SESSION['usermail']; //email of the currently loggedin user


$getquery = "SELECT * FROM user WHERE id=:userid AND email=:usermail";

$gethandler = $con->prepare($getquery);
$gethandler->execute(array(
  ':userid' => $logged_userid,
  ':usermail' => $logged_usermail));

$fetchresult = $gethandler->fetch(PDO::FETCH_OBJ);

//user_row_id 

$profile_picture = $fetchresult->prof_pic;
$fullname = $fetchresult->full_name;
$user_id = $fetchresult->id;

///////////////////////////////////////////////////////////////////////

if(isset($_GET['user']))
{
  $d_user = $_GET['user'];
  $d_user_query = "SELECT * FROM user WHERE id=:d_user";

  $user_handler = $con->prepare($d_user_query);
  $user_handler->execute(array(
    ':d_user' => $d_user));


  $numrow = $user_handler->rowCount();

  if($numrow > 0) {

    //fetch the user's name;
    //fetch the user's profile image ;
    //fetch the user's list of friends top 10;
    //fetch the user's about;
  $found_result = $user_handler->fetch(PDO::FETCH_OBJ);


//fetch some details abut the use viewed user 
//

  $users_name = $found_result->full_name;
  $department = $found_result->department;
  $email = $found_result->email;
  $matric_no = $found_result->matric_no;
  // $users_image = $found_result->prof_pic;


  //go and get the 200 image 
  $imagequery = "SELECT * FROM images WHERE userid=:userid";
  $imagehandler = $con->prepare($imagequery);
  $imagehandler->execute(array(
    ':userid' => $d_user));

  $imagerowcount = $imagehandler->rowCount();
  if($imagerowcount > 0)
  {
    $image_fetch_result = $imagehandler->fetch(PDO::FETCH_OBJ);
    $users_image = $image_fetch_result->image200;
  }
    
  }
  else{
    header("location: error.php");
  }

}
else{
  header("location: home.php");
}


?>


<!doctype html>
<html lang="en">
    <head>
        <title>Coding a Resp </title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="social-styles/css/bootstrap.css">
        <link rel="stylesheet" href="social-styles/css/bootstrap-glyphicons.css">
        <link rel="stylesheet" href="social-styles/css/styles.css">
        <link rel="stylesheet" href="social-styles/css/font-awesome.css">
        <script type="text/javascript" src="social-styles/js/jquery-1.9.1.min.js"></script>
          <script src="social-styles/js/bootstrap.js"></script>
        <script src="social-styles/js/script.js"></script>
        <script src="social-styles/js/domscript.js"></script>
    </head>

    <body>
      <div class="container" id="main">

        <div class="navbar navbar-fixed-top">
            <div class="container">
            
            <button class="navbar-toggle" data-target=".navbar-responsive-collapse"
            data-toggle="collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <!-- <span class="icon-bar"></span> -->
            </button>

             <a class="navbar-brand" href="/">
                <img src="images/logo.png"  alt="site Logo">
             </a>
           
            <div class="nav-collapse collapse navbar-responsive-collapse">
                    <ul class="nav navbar-nav">
                        <li class="">
                            <a href="#" class='fa fa-envelope'>
                              <span class="badge">23</span>
                            </a>
                        </li>

                        <li>
                          <a href="#" class="fa fa-globe">
                            <span class="badge">4</span>
                          </a>
                        </li>

                      <li>
                        <a href="" class="fa fa-user">
                          <span class="badge">41</span>
                        </a>
                      </li>

                    </ul>

                   <form class="navbar-form pull-left">
                      <input type="text" class="form-control" placeholder="<?php print_r($matric_no); ?>"  id="searchInput">
                      <button class="btn btn-default" type="submit">
                         <span class="glyphicon glyphicon-search"></span>
                       </button>

                    </form><!--end of navbar form -->

                    <ul class="nav navbar-nav pull-right">
                        <li class="dropdown">
                            <a href="" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span>
                            My Account<strong class='caret'></strong> </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="home.php"><span class="fa fa-home"></span> Home</a>
                                </li>

                                <li>
                                    <a href="settings.php"> <span class="fa fa-wrench"></span>
                                     Settings </a>
                                </li>

                                <li>
                               <a href="friends.php"><span class="fa fa-user"> </span> Friends</a>
                                </li>

                                <li>
                                  <a href="#"><span class="fa fa-envelope"></span> 
                                  Messages
                                </li>

                                <li class="divider"></li>

                                <li>
                                    <a href="logout.php"><span class="glyphicon glyphicon-off"></span> Logout</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                      
                </div><!--end of navbar collapse -->

            </div> <!--end of the container -->

        </div><!--end of the navbar div -->
        </div>
        <!-- </div> -->
<br/>
<br/>
<br/>

  <div class="pageContent">
    
    <div class="loadfriends pull-left" id="LeftPane1">
    <!-- this is the friend suggestinon pane -->
    <span class="label label-info">Friend Suggestions </span> |
     &nbsp;<button class="btn btn-info pull-right" id="loadMore">Load More </button>
    <hr/>
      <!--startig with the content -->

      <div class="media userAdd">
       <a href="">
         <img src="social_img/haxor.jpg"  class="userImageAdd"/>
       </a>
      <span class="username"> &nbsp; Adelanwa Omotolani </span>
       &nbsp;
       <button class="btn btn-info addbtn"><span class="fa fa-user-plus"></span> Add</button>
      </div>

      


    </div><!--end of the loadFriends panel -->
  

   <div class="pull-right" id="rightPane1">
       

       <!--inside the rightPane -->
       <div id="postBoard" class="pull-left">
          <!-- here is the poststate board  -->

          <div id="timelineBoard" class="pull-left">
          
            <div class="container" id="BannerContainer">
                <!-- this is the world we live in  -->

                <div id="profPictureContainer">
                       <!-- <img src="social_img/haxor.jpg" class="tImage" /> -->
                       <img src="<?php echo $users_image; ?>" class="tImage" />
                </div> <!--enf of the profPictureContainer -->
                <div id="timelineName"><strong><?php echo $users_name; ?></strong></div>

<!-- 
                <div class="profile-tab-pane" >
                  <strong>
                    <a href="photos.php">Photos </a>|
                    <a href=""> TimeLine </a> |
                    <a href=""> About </a> |
                    <a href="">Friends </a>
                  </strong>
                </div>
 -->            </div><!--end of the BannerContainel -->

          
          <div class="container" id="tDashBoard">
            <div class="container pull-left" id="tsidePane">
              
                <div id="aboutPane">
                  <div id="aboutpaneHeader"><span class="fa fa-history"></span> About</div>
                  <div id="aboutContents">
                   
                   <div id="email">
                   <span class="fa fa-at"></span>&nbsp;<span>&nbsp;Email : </span> <span> <?php echo $email; ?> </span>
                   </div>

                   <br/>
                   <div id="dept">
                <span class="fa fa-book"></span>&nbsp;<span>&nbsp;Department : </span><span><?php echo $department;?></span>
                   </div>
                    <br/>
                   <div id="matricno">
      <span class="fa fa-graduation-cap"></span>&nbsp;<span>&nbsp;Matric Number : </span><span><?php echo $matric_no;?>
                     </span>
                   </div>
                   
                   <br/>
                   <div id="matricno">
                     <span class="fa fa-info"></span>&nbsp;<span>&nbsp;Username : </span><span>zerocode
                     </span>
                   </div>

                  </div>
                </div><!--this is the aboutpane for the user -->

                <div id="friendsPane">
                  <div id="friendsHeader"><span class="fa fa-group"></span> Friends </div>
                  <div id="topFriends">
                  
                  <!--

                  #############################################
                  THERE MUST BE A LOOP BELOW THIS TO LOOP TOP 10 FRIENDS
                  -->
                    <?php
                       for ($i=0; $i < 12; $i++) { 
                         # code...
                        echo "<div class='pull-left friendList'>what</div>";
                       }
                    ?>
                    <!-- <div class="pull-left friendList">what</div>  -->
                    <!--END OF A FRIENDLIST ITEM -->
                  </div><!--END OF THE TOPFRIENDS CONTANER -->
                </div> <!--end of the friends pane -->

                


            </div><!--end of the tsidePane -->
            <div class="container pull-right" id="tstatusPane"> 
                    <?php
     
     $query = "SELECT * FROM status ORDER BY id DESC";
     $st_handler = $con->query($query);
     while ($ans = $st_handler->fetch(PDO::FETCH_OBJ)) {
      # code...
      #  fetch records from status table $and post the req fields;
      #

               $post_id = $ans->id;
               $poster_id = $ans->user_id;
               $post_time = $ans->post_date;
               $post_dataname = $ans->post_dataname;
               $post_text = $ans->post_text;
               $post_likes_count = $ans->like_count;
               $post_cmt_count = $ans->comment_count;

               #
               # @poster_details = array of details abt the poster
               # @this_user_img40  = img40 of the current logged usser
               # @functions = funct in functions.php file
               # @$con = > the connection driver used;


               $poster_details =  get_user_details($poster_id, $con);
               $poster_name = $poster_details->full_name;
               $poster_img_40 = get_image_set($poster_id, $con);
               $this_user_img40 = get_image_set($user_id, $con);
               // echo $poster_id;
              
              //remember if post_imag = null 
               //echo nothing out at the post-dataname
             
            
                echo     '<div class="feedContainer media">
                    <div class="posterImageContainer">
                      <a href="" class="pull-left">
                         <img src="'.$poster_img_40.'" class="posterImage img-circle" />
                      </a>
                         &nbsp;
                         <span class="posterName"><a href="profile.php?user='.$poster_id.'">'.$poster_name.'</a>&nbsp;</span>
                         <br/>
                         &nbsp;<span class="fa fa-clock-o"></span>&nbsp;<span class="time">'.$post_time.'</span>
                    </div><!--end of posterImageContainer -->
                    <div class="postedTextContainer">'.$post_text.'</div><!--end of postedTextContainer -->
                  <div class="postedMediaContainer">';

                 if(!$post_dataname){
                  echo "";
                 }
                 else{

                  echo '<img src="'.$post_dataname.'" class="postedMediaContent"/>';
                 }


                    echo '<br/><br/>
                    <span><a href="" class="like">Like</a> - </span> 
                    <span><a href="" class="comment">Comment</a>- </span>
                    <span class="fa fa-thumbs-o-up statusLikeValue">&nbsp;'.$post_likes_count.'</span> &nbsp;
                    <span class="fa fa-comments"><a href=""> &nbsp;';

                    $r = get_comment_count($post_id, $con);

                    echo "$r".'</a></span>
                  </div> <!--end of posted Media Content -->
       
       <!-- start of the comment box -->
                  <hr/>
                  <div class="previousComment">';
                  #
                  #this function was taken from functions.php
                  #
                  get_post_comments($post_id, $con);
                  
                  echo '</div><!--end of previous Commment-->
                   <hr/>
                  <div class="addedComment input-group ">
                   <span class="input-group-addon commentImage">
                    <img src="'.$this_user_img40.'" height="40px" width="40px"/>
                   </span>
                    <input type="text" name="" class="form-control commentInput" placeholder="comment..."/>
                    <span class="input-group-addon">
                       <button class="add btn cbutton" pid="'.$post_id.'" uid="'.$user_id.'">
                         <span class="fa fa-upload"></span>
                       </button>
                    </span>
                  </div>  <!--end of addedComment -->

                    </div><!--end of the feedContainer -->';
     }
    ?>


                
            </div>
            <!--end of the mad tstatusPane -->
          </div><!-- this is the end of the tDashBoard -->

          <div style="clear:both"></div><!-- this is the end of the clear div -->

          </div><!--end of the timeline board -->  
          <!--
          //////////////////////////////////////////////////////

                  end of the timelineBoard

        ////////////////////////////////////////////////////////
         -->

          <div id="recentAct" class="pull-right">
            <span class="label">Recent </span>
            <hr/>
            <!--start of the recentOn activitiy -->

            <div class="media recentOn">
               <a href="" class="pull-left">
                 <img class="img-circle" src="social_img/haxor.jpg" height="40px" width="40px" />
               </a>
               <span class="poster"><a href="">Alaran Moshood</a> </span>
               <span class="recentDeed">posted on  <a href="" class="postedItem">what the fucking heck</a></span>
            </div>


            <div class="media recentOn">
               <a href="" class="pull-left">
                 <img class="img-circle" src="social_img/haxor.jpg" height="40px" width="40px" />
               </a>
               <span class="poster"><a href="">Alaran Moshood</a> </span>
               <span class="recentDeed">posted on  <a href="" class="postedItem">Mallam </a></span>
            </div>


            <div class="media recentOn">
               <a href="" class="pull-left">
                 <img class="img-circle" src="social_img/haxor.jpg" height="40px" width="40px" />
               </a>
               <span class="poster"><a href="">Alaran Moshood</a> </span>
               <span class="recentDeed">posted on  <a href="" class="postedItem">Mallam </a></span>
            </div>


            <div class="media recentOn">
               <a href="" class="pull-left">
                 <img class="img-circle" src="social_img/haxor.jpg" height="40px" width="40px" />
               </a>
               <span class="poster"><a href="">Alaran Moshood</a> </span>
               <span class="recentDeed">posted on  <a href="" class="postedItem">Mallam </a></span>
            </div>


            <div class="media recentOn">
               <a href="" class="pull-left">
                 <img class="img-circle" src="social_img/haxor.jpg" height="40px" width="40px" />
               </a>
               <span class="poster"><a href="">Alaran Moshood</a> </span>
               <span class="recentDeed">posted on  <a href="" class="postedItem">Mallam </a></span>
            </div>
        
            <!--end of the recentOn element -->

          </div>
          <br style="clear:both">

       </div>

       <!--online pals here -->
       <div id="onlinePals" class="pull-right">

         <span class="label">Online </span>
         <hr/>
         
         <!--now coding the online div elements -->
         <div class="media onlineUser" >
           <a href="" class="onlinePelem">
             <img class="img-circle" src="social_img/haxor.jpg" height="40px" width="40px" />
           </a>
           
           <a href="#">
           <span class="fa fa-globe onlineLogo"></span>
           <span class="onlineName">Alaran Moshood </span>
           </a> 
         </div> 
         <!--end of each element -->



       </div>

       <div style='clear:both'></div>


   </div>

   <div style="clear:both"></div>

  </div><!--end of page Conttet -->

<!--  -->
        <!-- All javascript goes down here -->
      
    </body>
</html>