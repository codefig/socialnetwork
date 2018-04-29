<?php
session_start();

$user = $_SESSION['userid'];

include('config.php');
include('functions.php');
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
       <!-- <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Lobster"> -->


        <script type="text/javascript" src="social-styles/js/jquery-1.9.1.min.js"></script>

          <script src="social-styles/js/bootstrap.js"></script>
        <script src="social-styles/js/script.js"></script>

        <style>
             /*body{
              font-family:'Lobster',serif;
              font-size:24px;
             }*/
        </style>
    </head>


    <body style="background-color:#16a085">
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
                      <input type="text" class="form-control" placeholder="Find Friends"  id="searchInput">
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
                                    <a href="#"><span class="glyphicon glyphicon-signal"></span> Profile </a>
                                </li>

                                <li>
                                    <a href="#"> <span class="glyphicon glyphicon-wrench"></span>
                                     Settings </a>
                                </li>

                                <li>
                                    <a href="#"><span class="glyphicon glyphicon-briefcase"> </span> Friends</a>
                                </li>

                                <li>
                                  <a href="#"><span class="fa fa-envelope"></span>
                                  Messages
                                </li>

                                <li class="divider"></li>

                                <li>
                                    <a href="#"><span class="glyphicon glyphicon-off"></span> Logout</a>
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

  <div id="msgContent">
    <!--start of the page content -->
   <div id="msgHeading"></div>
   <div id="msgRightPane" class="pull-right">
     <div id="msgUser">

       <div class="msgUserTab">
         <img src="social_img/haxor.jpg" class="pull-left img50"/>
         &nbsp;&nbsp;
         <span class="msgUserTabName"> Alaran Moshood Abayomi </span>
       </div><!--end of msgUserTab-->


         <!-- <hr/> -->
     </div><!--end fo msgUser -->

     <div id="userMsgContent">
           <!-- this is where the msg result is been put -->
     </div>


     <div id="typeMsg">
       <input type="text" name="" id="messageInput" class="form-control" placeholder="Enter Your Message..." />
       <button type="submit" class="btn btn-default" id="messageInputbtn">Send </button>
     </div> <!--end of typeMsg-->
   </div>
   <div id="msgLeftPane" class="pull-left">
     <div id="msgLeftPaneHead" uid="<?=$user?>"> <center>Inbox</center></div>
     <div id="msgLeftPaneSearch">
       <input type="text" id="msgSearch" class="form-control" placeholder="Search.. "/>
       <button type="submit" class="btn btn-default">
         <span class="fa fa-search"></span>
       </button>
     </div><!--end of the message left pane search div -->

     <!--this pane containes the user to search for -->
     <div id="msgFriends">
      <?php

        list_user_msg($user, $con);

      ?>
      

<!-- ############################################################# end of the container -->

     </div><!--end of the msgFriends pane -->

   </div><!--end of the msg left pane -->
   <div class="clear"></div>

  </div><!--end of page Conttet -->

<!--  -->
        <!-- All javascript goes down here -->

    </body>
</html>
