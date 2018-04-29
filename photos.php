<?php

session_start();

include_once('config.php');
include_once('functions.php');

$logged_userid = $_SESSION['userid'] ; //id of the currently loggedin user
$logged_usermail = $_SESSION['usermail']; //email of the currently loggedin user

//get all user data like profile picture and the rest
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

//get the image200 of the user
$img_result = get_image_200($logged_userid, $con);
$user_img_200 = $img_result->image200;


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
          <script src="social-styles/js/jquery.form.min.js"></script>
        <script src="social-styles/js/script.js"></script>

        <style>
        .modal-dialog{
      position:absolute;
      z-index:1999;
      left:25%;
     
     }

     #imageinputSubmit{
       display:none;
     }
       
       .media{
        border:1px solid #fff;
        border-radius:2px;
       }
       .md-cont{
        /*margin-right:30px !important;*/
       }

        </style>
        <script>

function showModal(){
  // alert("yea ths is the show modal for u ");
  $('#pLoadBar').show();
  $('#pLoadBar').modal();
}

$(document).on('click', '.mk-profile', function(linkevent){
  linkevent.preventDefault();
  setTimeout(3000, showModal())
   $.ajax({
    method: "POST",
    url : 'action.php',
    data: {task :"s_p_pics",  img_id : $(this).attr('pid')},
    beforeSend:function()
           {

             setTimeout(3000, showModal())
             $('.modal-backdrop').css('opacity',0.9)

           },
    success: function(e)
             {
                $('#BannerContainer').load('photos.php #BannerContainer');
                $('#pLoadBar').hide();
             }
  })


})//end of the mkprofile function ;
        </script>
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
                <img src="social_img/logo.png"  alt="site Logo" height="30" width="30">
              
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
                      <input type="text" class="form-control" placeholder="Find Friends"  id="searchInput">
                      <button class="btn btn-default" type="submit">
                         <span class="glyphicon glyphicon-search"></span>
                       </button>

                    </form><!--end of navbar form -->

                    <ul class="nav navbar-nav pull-right">
                        <li class="dropdown">
                            <a href="home.php" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span>
                            My Account<strong class='caret'></strong> </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="home.php"><span class="fa fa-home"></span>&nbsp;Home</a>
                                </li>

                                <li>
                                    <a href="settings.php"> <span class="fa fa-wrench"></span>
                                     &nbsp;Settings </a>
                                </li>

                                <li>
                                    <a href="friends.php"><span class="fa fa-user"></span>&nbsp;Friends</a>
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
   <div class="pull-right" id="rightPane1">


       <!--inside the rightPane -->
       <div id="postBoard" class="pull-left">
          <!-- here is the poststate board  -->

          <div id="timelineBoard" class="pull-left">

            <div class="container" id="BannerContainer">

<!-- ############################################################################ -->

<!-- #############################################################################-->
                <div id="profPictureContainer">
                       <img src="<?= $user_img_200 ?>" class="tImage" />
                </div> <!--enf of the profPictureContainer -->
                <div id="timelineName"><strong><?= $fullname?></strong></div>
            </div><!--end of the BannerContainel -->

  
  <div class="container" id="tDashBoard" style="background-color:rgb(0,0,15);padding-right:0px;padding:5px;border-radius:4px">

<h4 style="color:#fff"><span class="fa fa-camera fa-1x"></span> Photos </h4> 
<!-- ############################ start of the image container -->


      <?php

    get_my_photos($_SESSION['userid'], $con);
    

?>
<!-- #######################################3  end of the profile picture container -->
      <!--end of the image elements -->


          </div><!-- this is the end of the tDashBoard -->

          <div style="clear:both"></div><!-- this is the end of the clear div -->

          </div><!--end of the timeline board -->
          <!--
          //////////////////////////////////////////////////////

                  end of the timelineBoard

        ////////////////////////////////////////////////////////
         -->

          <!-- <div id="recentAct" class="pull-right">
            

          </div> -->
          <br style="clear:both">

       </div>

       <!--online pals here -->
       <!-- <div id="onlinePals" class="pull-right"> -->
<!-- 
         <span class="label">Online </span>
         <hr/> -->

         <!--now coding the online div elements -->
         <!-- <div class="media onlineUser" >
           <a href="" class="onlinePelem">
             <img class="img-circle" src="social_img/haxor.jpg" height="40px" width="40px" />
           </a>

           <a href="#">
           <span class="fa fa-globe onlineLogo"></span>
           <span class="onlineName">Alaran Moshood </span>
           </a>
         </div> -->
         <!--end of each element -->
       <!-- </div> -->


       <div style='clear:both'></div>


   </div>

   <div style="clear:both"></div>

  </div><!--end of page Conttet -->

<!--  -->
        <!-- All javascript goes down here -->

<!-- ################## code for my upload image modal -->
<div class="modal fade" id="changeImage">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3>Change Profile Picture </h3>
        </div>

        <div class="modal-body">

          <center>
          <span id="loader" style="display:none"><img src="social_img/loader.gif" height="16" width="16"> Loading...</span>
          <div id="picFrame"></div><!--end of the #picframe -->
           <form class="form" method="post" action="action.php" enctype="multipart/form-data">
               <input type="file" id="imageInput" accept="image/*" name="images"/>
               <input type="submit" class=name="imageSubmit" id="imageinputSubmit" value="upload"/>
           </form>
               <button type="" class="btn btn-success" name="imageSubmit" id="imageSubmit">
                 Upload
               </button>
            <span style="display:none" id="scnote">Profile picture changed successfully!</span>
           </center>


        </div><!--end of the modal body -->

        <div class="modal-footer">
          <button class="btn btn-primary" data-dismiss="modal">Cancel</button>
          <a href="timeline.php" class="btn btn-success telldude">back</a>
        </div>
      </div>
    </div>
</div>



<div class="modal fade" id="pLoadBar">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        Updating your profile picture ...please wait!
      </div>
    </div>
  </div>
</div>
    </body>
</html>
