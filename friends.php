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
                                    <a href="#"><span class="fa fa-home"></span> Profile </a>
                                </li>

                                <li>
                                    <a href="#"> <span class="glyphicon glyphicon-wrench"></span>
                                     &nbsp;Settings </a>
                                </li>

                                <li>
                                    <a href="#"><span class="fa fa-user"> </span> Friends</a>
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
                       <img src="social_img/haxor.jpg" class="tImage" />
                </div> <!--enf of the profPictureContainer -->
                <div id="timelineName"><strong>Alaran Moshood Abayomi</strong></div>
            </div><!--end of the BannerContainel -->

          
          <div id="fDashBoard">
            <div id="fDashHeader"> 
              <div id="fDashHeaderHead" style="height:80%">
                <span class="fa fa-users fa-2x"></span> &nbsp;
                <span id="fDashHeadTalk">Friends</span>
              </div>
              <div id="fDashHeaderFoot"></div><!--end of the fDashHeaderfoot -->
            </div> <!--end of the fDashHeader-->

            <div id="fDashContainer"> 
             <!--here is where all the friends lies -->
             <div class="friends">
               <div class="friendsImageContainer pull-left">
                 <img src="social_img/haxor.jpg" class="tImage fr-image" />
              
               </div>
               <div class="friendsDetails pull-right">
                 <p class="friendsName"> Alaran Moshood  Abayomi</p>
                 <p class="ffriendscount">209 Friends</p>
               </div>
             </div><!--end of the friends div -->

             <div class="friends">
               <div class="friendsImageContainer pull-left">
                 <img src="social_img/haxor.jpg" class="tImage fr-image" />
              
               </div>
               <div class="friendsDetails pull-right">
                 <p class="friendsName"> Alaran Moshood  Abayomi</p>
                 <p class="ffriendscount">209 Friends</p>
               </div>
             </div><!--end of the friends div -->

             <div class="friends">
               <div class="friendsImageContainer pull-left">
                 <img src="social_img/haxor.jpg" class="tImage fr-image" />
              
               </div>
               <div class="friendsDetails pull-right">
                 <p class="friendsName"> Alaran Moshood  Abayomi</p>
                 <p class="ffriendscount">209 Friends</p>
               </div>
             </div><!--end of the friends div -->
            </div><!--end of the fDashContainer -->
           
          </div><!-- this is the end of the fDashBoard -->

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