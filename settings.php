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
                            <span class="white">My Account</span><strong class='caret'></strong> </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="home.php"><span class="fa fa-home"></span><span class="white"> Home</span></a>
                                </li>

                              <li>
                                    <a href="timeline.php"><span class=" white glyphicon glyphicon-signal"></span><span class="white"> Timeline</span></a>
                                </li>

                                <li>
                                    <a href="friends.php"><span class=" white fa fa-users"> </span><span class="white"> Friends</span></a>
                                </li>

                                <li>
                                  <a href="message.php"><span class="fa fa-envelope"></span> 
                                  <span class="white"> Messages</span>
                                </li>

                                <li class="divider"></li>

                                <li>
                                    <a href="logout.php"><span class="white glyphicon glyphicon-off"></span><span class="white"> Logout</span></a>
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
    
 

      


    </div><!--end of the loadFriends panel -->
  

   <div class="pull-right" id="rightPane1">
       

       <!--inside the rightPane -->
       <div id="postBoard" class="pull-left">
          <!-- here is the poststate board  -->

          <div id="timelineBoard" class="pull-left">
          
            <div class="container" id="BannerContainer">
                <!-- this is the world we live in  -->

                <div id="profPictureContainer">
                      <img src="<?= $user_img_200 ?>" class="tImage" />
                </div> <!--enf of the profPictureContainer -->
              <div id="timelineName"><strong><?= $fullname?></strong></div>
            </div><!--end of the BannerContainel -->

          
          <div id="fDashBoard">
            <div id="fDashHeader"> 
              <div id="fDashHeaderHead" style="height:80%">
                <span class="fa fa-wrench fa-2x"></span> &nbsp;
                <span id="fDashHeadTalk">Settings</span>
              </div>
              <div id="fDashHeaderFoot"></div><!--end of the fDashHeaderfoot -->
            </div> <!--end of the fDashHeader-->

            <div id="fDashContainer"> 
             <!--here is where all the friends lies -->
             
             <div id="topicPane">
                 <div class="topics" id='mypass'>Password<a href='' id='editpass' class='ta pull-right'>Edit</a></div>
                 <div claass="topics" id="matricno">Matric No:<a href="" id="editmat" class="ta pull-right">Edit</a></div>

             </div>
             <div id="editPane">




               <div id="passpane">
                 <label>Old password</label>
                 <input type="text" name="oldpass" id="oldpass" class="form-control" />
                 <label>New Password </label>
                 <input type='text' name="password" id="npass" class="form-control">
                 <label>Confirm new password </label>
                 <input type="text" name="cpassword" id="cnpass" class="form-control">

                 <button class="btn settingbtn btn-success" id="updatepass"><span class="fa fa-save"></span>&nbsp; Save </button>
                 <!-- <button class="btn settingbtn btn-success" id="cancelpass"><span class="fa fa-times"></span>&nbsp; Cancel</button> -->
                 <span id="cpassout">
                   
                 </span>
               </div>

               <div id="matricpane">
                 <label>Matric no </label>
                 <input  id="matno" type="text" name="matno" class="form-control">
                 <button class="btn settingbtn btn-success" id="updatemat"><span class="fa fa-save"></span>&nbsp;Update</button>
                  <span id="materr" style="color:rgb(0,0,15)"></span>
               </div>

             </div>
             <div style="clear:both"></div>
            </div><!--end of the fDashContainer -->
           
          </div><!-- this is the end of the fDashBoard -->

          <div style="clear:both"></div><!-- this is the end of the clear div -->

          </div><!--end of the timeline board -->  
          <!--
          //////////////////////////////////////////////////////

                  end of the timelineBoard

        ////////////////////////////////////////////////////////
         -->

 \

       <!--online pals here -->

       <!--./#onlinePals -->

       <div style='clear:both'></div>


   </div>

   <div style="clear:both"></div>

  </div><!--end of page Conttet -->

<!--  -->
        <!-- All javascript goes down here -->
      

      <script>
       $(document).on('click', '#updatemat', function(e){
        var matinput = $('#matno');
        if(matinput.val().trim() == '')
          $('#materr').html("Sorry matriculation number cannot be empty!");
        else if (!matinput.val().trim().match(/^[0-9]+$/))
          $('#materr').html("Please specify a valid matriculation number! eg: 11003344");
        else{
          $.ajax({
            method : "POST", 
            url : 'action.php',
            data : {task : 'update_mat', matno: matinput.val().trim()},
            beforeSend: function(e){
               alert("are you sure to continue");
            }
            , 
            success : function(sucresult){
              console.log(sucresult);
            }

          })
        }
       })


      </script>
    </body>
</html>