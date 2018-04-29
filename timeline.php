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
echo $user_img_200;
 ?>
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

        </style>
        <script>
          $('document').ready(function()
          {
            // alert("yea te document is ready");
            var changeImageLink = $('#changeImageLink');
            changeImageLink.click(function(e)
            {
              e.preventDefault();
              $('#changeImage').modal();
            })

        //////////////////

    var uploadbtn = $('#imageSubmit');
    var fileinput = $('#imageInput');
    var formsubmit = $('#imageinputSubmit');
    var loader = $('#loader');
    var output = $('#picFrame');
    var form = $('form');
    var success_note = $('#scnote');


    uploadbtn.click(function(e)
    {
      fileinput.click();
    })

    fileinput.change(function(e)
    {
      var value = $(this).val();
      if(value != '')
      {
        formsubmit.click();
      }
      else{
        e.preventDefault();
      }
    })

    formsubmit.click(function(e)
    {


      // output.html("what the fucking heck is uploading");
      form.ajaxForm({
        beforeSend: function()
        {
          $('#loader').show();
          $('#imageinputSubmit').attr('disabled','disabled');
        },
        success : function(result){
          output.html(result);
          loader.hide();
          form.resetForm();
          formsubmit.removeAttr('disabled');
          uploadbtn.hide();
          success_note.show();
        },
        error: function(errresult)
        {
        }
      })
    })

   var dudegreet = $('.telldude');
   dudegreet.click(function(e)
   {


     $.amaran({
           'theme'     :'user blue',
           'content'   :{
               img:'./social_img/developer.jpg',
               user:'Administrator',
               message:'Yo! dude u look cute, Your picture was uploaded successfully,'
           },
           'position'  :'top right',
           'outEffect' :'slideTop',
           'delay': 4000,
           'closeOnClick':true,
           'closeButton':true,
           'sticky': true,
       });
   })



        //////////////////
          })
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
<!-- ############################################################################ -->
   <a href="#changeImage" class="fa fa-camera" id="changeImageLink"></a>
<!-- #############################################################################-->
                <div id="profPictureContainer">
                       <img src="<?= $user_img_200 ?>" class="tImage" />
                </div> <!--enf of the profPictureContainer -->
                <div id="timelineName"><strong><?= $fullname?></strong></div>
            </div><!--end of the BannerContainel -->

            <div style="background-color:rgb(0,0,15);color:#fff;height:40px;padding:10px;
            font-weight: bold;font-size:20px;word-spacing: 5px">
            <center>
              { <a href="">Photos</a> | 
             <a href="">Friends </a> }
            </center>
            </div>


          <div class="container" id="tDashBoard">
            <div class="container pull-left" id="tsidePane">

                <div id="aboutPane">
                  <div id="aboutpaneHeader">
                    <center><span class="fa fa-history"></span>
                  <span class="white" style='font-weight: bold'> &nbsp;About</span></center>
                  </div>
                  <div id="aboutContents">

                   <div id="email">
                   <span class="fa fa-at"></span>&nbsp;<span class="white">&nbsp;Email : </span> 
                   <span class="white"><?=$fetchresult->email?></span>
                   </div>

    
                  
                    <br/>
                   <div id="matricno">
                     <span class="fa fa-graduation-cap"></span>&nbsp;<span class="white">&nbsp;Matric Number : </span>
                     <span class="white">
                     <?=$fetchresult->matric_no?>
                     </span>
                   </div>

                   <br/>
                   <div id="gender">
                     <span class='fa fa-female'></span>&nbsp;<span class="white">&nbsp; Gender : </span><span>
                       <?php
                         $g = $fetchresult->gender;
                         if($g == 1)
                          echo "<span class='white'>Male<span>";
                        else
                          echo "<span class='white'>Female</span>";
                       ?>
                     </span>   
                   </div>
                  <br/>
                   <div id="join_date">
                     <span class="fa fa-clock-o"></span>&nbsp;<span class="white">&nbsp;Joined : </span>
                     <span class="white"><?=$fetchresult->join_date?></span>
                   </div>
                  </div>
                </div><!--this is the aboutpane for the user -->

                <div id="friendsPane">
                  <div id="friendsHeader">
                  <center><span class="fa fa-group"></span><span class="white" style='font-weight: bold'>&nbsp;Pals</span></center>
                  </div>
                  <div id="topFriends">

                  <!--

                  #############################################
                  THERE MUST BE A LOOP BELOW THIS TO LOOP TOP 10 FRIENDS
                  -->
                    <?php
                       for ($i=0; $i < 12; $i++) {
                         # code...
                        echo "<div class='pull-left friendList'>
                           <img src='social_img/ava40.png' alt='pal' />
                        </div>";
                       }
                    ?>
                    <!-- <div class="pull-left friendList">what</div>  -->
                    <!--END OF A FRIENDLIST ITEM -->
                  </div><!--END OF THE TOPFRIENDS CONTANER -->
                </div> <!--end of the friends pane -->
            </div><!--end of the tsidePane -->
            <div class="container pull-right" id="tstatusPane">
                      <div class="updateContainer">
                    <div class="feedContainer media">

                    <div class="posterImageContainer">
                      <a href="" class="pull-left">
                         <img src="social_img/haxor.jpg" class="posterImage img-circle" />
                      </a>
                         &nbsp;
                         <span class="posterName">Alaran Moshood Abayomi &nbsp;</span>
                         <br/>
                         &nbsp;<span class="fa fa-clock-o statusTime"></span> 19hrs
                    </div><!--end of posterImageContainer -->
                    <div class="postedTextContainer">
                         what the cuking heck is not coding for the future of ur fffffffffffffffffff
                         what the cuking heck is not coding for the future of ur
                         what the cuking heck is n
                         what the cuking heck is not coding for the future of ur
                         <a href="">See more </a>
                     </div><!--end of postedTextContainer -->
                  <div class="postedMediaContainer" hideme="">
                    <img src="social_img/haxor.jpg" height="300px" width="100%"/>
                    <br/><br/>
                    <span> <button>Like </button> - </span>
                    <span> Comment - </span>
                    <span class="fa fa-thumbs-o-up statusLikeValue"> 42</span> &nbsp;
                    <span class="fa fa-comments"><a href=""> 56</a></span>
                  </div> <!--end of posted Media Content -->

                  <div class="previousComment" show="">
                  <hr/>
                  <div class="media">
                   <a class="pull-left cmter-img" href="">
                     <img class="img-circle" src="social_img/code.jpg" height="40px" width="40px" />
                   </a>
                   <div class="media-body">
                      <h4 class="media-heading cmter-name">Alaran Moshood Abayomie msks</h4>
                      <p class="cmter-text">
                      what the fucking heck is programmingwhatllskdkdlfkkllsk
                      jdjdlfkgkslkdldkgjglslldkfkgllskdd;g;sldkfjgjs;ldldldk
                      kdkdlfkgklsldkdkllllllllllllllllllllllllllldkdlfkfkdkdkdkdkdk
                      kddlfkfjgjsldlfpodooofglslidllfglsklkdlkfkflgslkskskksksksk
                      kdfldkflflgks;ldlkgsklklkajsjllkjfjlsiillsksilflakfkfkfkfkfkf
                      lllaksksldkfksllskdflallslkkfjajlslsklslskskskslkskkskskllsksk
                       </p>
                       <!-- <p><a href="">Like &nbsp;<span class="fa fa-thumbs-o-up"> 20</span></a> </p> -->
                       <p><button>Like</button>&nbsp;<span class="fa fa-thumbs-o-up"> 20</span> </p>
                   </div> <!--end of the comment element div -->
                  </div><!--end of media parent div -->

                   <div class="media">
                   <a class="pull-left cmter-img" href="">
                     <img class="img-circle" src="social_img/coder.jpg" height="40px" width="40px" />
                   </a>
                   <div class="media-body">
                      <h4 class="media-heading cmter-name">Alaran Moshood Abayomie msks</h4>
                      <p class="cmter-text">
                       what the fuck are you telling us wiahout paying the money
                       u dont need all those stuffs for now so get that
                       </p>
                       <p><a href="">Like &nbsp;<span class="fa fa-thumbs-o-up cmter-like"> 20</span></a> </p>
                   </div> <!--end of the comment element div -->
                  </div><!--end of media parent div -->


                  </div><!--end of previous Commment-->
                  <hr/>

                  <div class="addedComment input-group ">
                   <span class="input-group-addon commentImage">
                    <img src="social_img/haxor.jpg" class="img-circle" height="40px" width="40px"/>
                   </span>
                    <input type="text" name="" class="form-control commentInput" placeholder="comment..."/>
                    <span class="input-group-addon">
                       <button class="btn cbutton">
                         <span class="fa fa-upload"></span>
                       </button>
                    </span>
                  </div>  <!--end of addedComment -->

                    </div><!--end of the feedContainer -->
                </div><!--end of the updateContainer -->



            </div><!--end of the mad tstatusPane -->
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

    </body>
</html>
