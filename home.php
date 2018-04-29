<?php
session_start();
require_once("config.php");
require_once('functions.php');



if(!isset($_SESSION['userid']) && !isset($_SESSION['usermail'])){
  header("Location: index.php");
}

else{


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

}

?>

<!doctype html>
<html lang="en">
    <head>
        <title> Palsbook :: Home </title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="social-styles/css/bootstrap.css">
        <link rel="stylesheet" href="social-styles/css/bootstrap-glyphicons.css">
        <link rel="stylesheet" href="social-styles/css/styles.css">
        <link rel="stylesheet" href="social-styles/css/font-awesome.css">
        <link rel="stylesheet" href="social-styles/css/chat.css">
        <script type="text/javascript" src="social-styles/js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="social-styles/js/jquery.form.min.js"></script>
        <script type='text/javascript' src=social-styles/js/scroll.js></script>
        <script type='text/javascript' src=social-styles/js/chat.js></script>
          <script src="social-styles/js/bootstrap.js"></script>
        <script src="social-styles/js/script.js"></script>

        <script type="text/javascript">
        </script>
        <style type="text/css">
          textarea{
            resize:none;
            overflow:auto;
          }
          .time{
            color:#fff;
          }

        </style>
    </head>


    <body style="background-color:#16a085">
    
    <!--############################################################# -->

 <div class="chat_box">
    <div class="chat_head">Online <span id="onlineCount"></span>
      <span class="hide-chatbox"><a href="" id="hd-btn">X</a></span>
    </div>

    <div class="chat_body">
      <!-- <div class="user">Moshood Abayomi</div> -->
    </div>
  </div>

  <div class="msg_box" style="right:290px">

   <div class="msg_head">
   <span id="msg_name">Barack Obama</span>
   (<span id="msg_status">typing...</span>)

   <a href="" id="msg-btn">X</a></div><!--/.msg_head -->
   <div class="msg_body">
   </div><!--./msg_body -->
   <div class="msg_footer"><textarea class="msg_input" row=4 placeholder="enter message..."></textarea> </div>


 </div> <!--/.msg-box-->  




 


    <!--############################################################# -->


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
             <img src="social_img/logo.png" class="siteLogo" alt="site Logo" height="30" width="30">
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
                      <input type="text" class="form-control" placeholder="Search..."  id="searchInput">
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
                                    <a href="timeline.php"><span class="fa fa-dashboard"></span> Profile </a>
                                </li>

                                <li>
                                    <a href="settings.php"> <span class="glyphicon glyphicon-wrench"></span>
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
    <div id="loadfriendsContent">
 
      <?php

         load_possibe_followers($logged_userid, $con);
       ?>

</div><!-- the end of the loadfriendsContent Pane -->


    </div><!--end of the loadFriends panel -->


   <div class="pull-right" id="rightPane1">


       <!--inside the rightPane -->
       <div id="postBoard" class="pull-left">
          <!-- here is the poststate board  -->

          <div id="normalpane" class="pull-left">
            <!--  here is the normal pane

             - this is where am gonna code the normal div for social post -->

             <div id="profPane" class="pull-left">
             <!--coding the sidebar profile pane stuff -->
            <div class="media">
              <a class="pull-left">
                <img class="img-circle" src="<?php echo $profile_picture; ?>" height="80px" width="80px" />
              </a>
              <span class="myfa"><a href="profile.php?user=<?php echo $logged_userid; ?>"><?php echo $fullname; ?></a></span>

              <div id="userDetails" style="color:#fff" uid="<?=$logged_userid?>" uname="<?=$fullname?>"></div>

              <br/>
              <br/>
              <div class="profPaneLinks">
                  <br/>
              <br/>
              <br/>
              <hr/>
                  <br/>
                 <br/>
                 <div class="fa fa-envelope"><a class="myfa" href="message.php">&nbsp;&nbsp;&nbsp;&nbsp;Messages </a> </div>
                 <br/>
                 <div class="fa fa-file-photo-o"><a class="myfa" href="photos.php">&nbsp;&nbsp;&nbsp;&nbsp;Photos </a></div>
                 <br/>
                 <div class="fa fa-pencil"><a class="myfa" href="profile.php">&nbsp;&nbsp;&nbsp;&nbsp;Edit Profile </a></div>

                 <br/>
                 <div class="fa fa-group"><a class="myfa" href="#">&nbsp;&nbsp;&nbsp;Friends</a></div>




              </div><!--end of profpanelinks -->
            </div>
             </div><!--end of the profPane -->

             <div id="statusPane" class="pull-right">

               <!--putting the status stuff here  -->
                <div class="panel pane-success" id="statusContainer">
                   <div class="panel-heading panehead">
                     <span class="fa fa-edit "><p class="myfa"> &nbsp;Update Status</p> </span> &nbsp; |
                      &nbsp;<span class="fa fa-camera "> <p class="myfa">

                      <a href="" id="insertImage">Insert Image/Video</p></a> </span>

                    <form method="post" action="status.php" enctype="multipart/form-data">
                      <input type="file" name="statusImage" id="imgUpload" accept="image/*"/>
                      <input style="display:none"type="submit" id="imgSubmit"  />

                    </form>
                   </div>
                   <div class="panel-body" id="postBody">

                      <textarea id="statusInput" resize="none" placeholder="what's on  your mind" cols="60" rows="5"></textarea><!--end of the statusInput textarea -->
                      <br/><br/>
         <img src="social_img/loader_black.gif" style="display:none;" id="homeLoader" />

                      <div id="preImageContainer"></div>

                      <br/>

                      <button type="submit" class="btn btn-success" id="updatebtn" uid="<?php echo $user_id; ?>">
                          <span class="fa fa-paste"></span> Post
                      </button>



                   </div><!--end of the panel body -->

                </div>

                <div class="updateContainer">

<!-- *************************************************************************************************************** -->
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
               // $post_likes_count = $ans->like_count;
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
                    <span><a href="" class="liker" uid="'.$poster_id.'" stid="'.$post_id.'" >';
                     //@below : get the count of likes a status has
                      $like_result = get_status_likes($poster_id, $post_id, $con);
                      if($like_result > 0)
                      {
                        $lk_output = "Liked";
                      }
                      else
                      {
                        $lk_output = "Like";
                      }

                   echo $lk_output. '</a> - </span>
                    <span class="fa fa-thumbs-o-up statusLikeValue">&nbsp;'.get_status_like_count($post_id, $con).'</span>&nbsp;
                    <span><a href="" class="comment">Comment</a>- </span>
                    <span class="fa fa-comments" uid="'.$user_id.'"><a href=""> &nbsp;';

                    //@below = get the list of comments on a post;
                    $r = get_comment_count($post_id, $con);

                    echo "$r".'</a></span>&nbsp;<span><a href="" class="s_all">See All</a></span>
                  </div> <!--end of posted Media Content -->

       <!-- start of the comment box -->
                  <hr/>
            <div class="cmt_container">
                  <div class="previousComment">';
                  #
                  #this function was taken from functions.php
                  #
                  get_post_comments($post_id, $con);

                  echo '</div><!--end of previous Commment-->

            </div>
            <!--end of the cmt_container element -->
                <br/>
                  <div class="addedComment input-group ">
                   <span class="input-group-addon commentImage">
                    <img src="'.$this_user_img40.'" height="40px" width="40px" alt="some-img"/>
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
<!-- ******************************************************************************************************************************** -->


                </div><!--end  of the update containeer -->

             </div> <!--end of the status pane -->


           <br style="clear:both">
          </div>

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
       <!-- <div id="onlinePals" class="pull-right">
         <span class="label">Online </span>
         <hr/>

         <!--now coding the online div elements -->
         <!-- <div class="media onlineUser" >
           <a href="" class="onlinePelem">
             <img class="img-circle" src="social_img/haxor.jpg" height="40px" width="40px" />
           </a>
           <a href="#">
           <span class="onlineName">Alaran Moshood </span> -->
           <!-- <span class="fa fa-globe onlineLogo" id="onlineLogo"></span> -->
           <!-- </a>
         </div> -->
         <!--end of each element -->
       </div>

       <div style='clear:both'></div>


   </div>

   <div style="clear:both"></div>

  </div><!--end of page Conttet -->

<!--  -->
        <!-- All javascript goes down here -->

<script type="text/javascript" src="http://127.0.0.1:4444/socket.io/socket.io.js"></script>

<script type="text/javascript">

var clientsock = io.connect("http://127.0.0.1:4444");
var lusername = $('#userDetails').attr('uname'),
      luserid  = $('#userDetails').attr('uid');

  var udata  = {id: luserid , name: lusername};
  var html = "";

 clientsock.emit('new-user', udata, function(result)
 {
    if(result){
    }
    else{
      //the user has just been added to the chat network
      
    }
 })

clientsock.on('online-users', function(userslist){
  
  //now loop throught the array and form the user's online 

  var items = Object.keys(userslist); //[1, 2, 3, 4]
  var items_length = Object.keys(userslist).length; //4
 

 html = "";

  for(var i= 0; i<items_length; i++ ){
    
    if(userslist[items[i]] != lusername){
     
    //check if the user's name is not mine : remove
    html += "<div class='user' uid="+items[i]+"><span>" + userslist[items[i]] + "</span></div>";
    }
  }

  if(!items_length == 0){
    var nlist = items_length -1;
  } //control the number of online users by removing me

  $('.chat_body').html(''); //first clear  the chatbody
  $('.chat_body').html(html); //update the chatbody
  $('#onlineCount').html(" &nbsp;{ "+ nlist  + " }");
})





$(document).on('click', '.user', function(event){
      var username = $(this).html();
       $('.msg_box').show();
       $('#msg_name').html(username);
       var chat_reciever = $(this).attr('uid');
       $('.msg_input').attr('cid', chat_reciever);

       var previous_msg = "";




     var sender =  $('#userDetails').attr('uid');
     var receiver = $(this).attr('uid');

    var msg_data = {send: sender,recv: receiver};
    console.log(msg_data);

     clientsock.emit('update-msg',msg_data, function(msgResult){
     

      if(msgResult){
        
       var msg_items = (Object.keys(msgResult)); //[1, 2, 3,]
       var result_length = Object.keys(msgResult).length;

          for(var m=0; m<result_length; m++){
            // msghtml += callback[m]['id'];
            var msg_sender = msgResult[m]['sender'];
            var msg_word = msgResult[m]['message'];


            if(msg_sender == luserid){
             //am the sender 
             previous_msg += "<div class='msg_b'>"+msg_word+"</div>";
            }
            else{
            previous_msg += "<div class='msg_a'>"+msg_word+"</div>";
            }
          }
          $('.msg_body').html('');
          $('.msg_body').html(previous_msg);
          $('.msg_input').val('');
      
      }


      else{
        //callback is false here 

        alert("Sorry Error occured while getting previous messages");
      }

     } ) //end of the update-msg call 
      


    })


$('.msg_input').keydown(function(event){

  //wait for the enter key and then choose the sender and receiver variable 

   if(event.which == 13){
     
     var sender =  $('#userDetails').attr('uid');
     var receiver = $(this).attr('cid');
     var message = $(this).val();
    
    // if(message !=)
     var msg_data = {send: sender,recv: receiver, msg: message };

     clientsock.emit('new-message', msg_data, function(callback){
        
        var msghtml = "";

        if(callback == false){
          //u sent an empty messsage before;
          alert("sorry u sent an empty message");
        }
        else{
          
          var msg_items = (Object.keys(callback)); //[1, 2, 3,]
          var result_length = Object.keys(callback).length;

          for(var m=0; m<result_length; m++){
            // msghtml += callback[m]['id'];
            var msg_sender = callback[m]['sender'];
            var msg_word = callback[m]['message'];


            if(msg_sender == luserid){
             //am the sender 
             msghtml += "<div class='msg_b'>"+msg_word+"</div>";
            }
            else{
            msghtml += "<div class='msg_a'>"+msg_word+"</div>";
            }
          }
          $('.msg_body').html('');
          $('.msg_body').html(msghtml);
          $('.msg_input').val('');
          

        }
     });

    }
   }
)


  
</script>

    </body>
</html>
