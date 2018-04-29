<!doctype html>
<html lang="en">
    <head>
        <title>Coding a Resp </title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="social-styles/css/bootstrap.css">
        <link rel="stylesheet" href="social-styles/css/bootstrap-glyphicons.css">
        <link rel="stylesheet" href="social-styles/css/styles.css">
        <link rel="stylesheet" href="social-styles/css/font-awesome.css">
        <link rel="stylesheet" href="external.css">
        <script type="text/javascript" src="social-styles/js/jquery-1.9.1.min.js"></script>
          <script src="social-styles/js/bootstrap.js"></script>
        <script src="social-styles/js/script.js"></script>
        <script src="social-styles/js/domscript.js"></script>


  <!--=======================================================

     ABOUT TO ADD THE EXTERNAL JAVASCRIPT LIBRARY FROM THE OTHER 
     CHAT METHOD

  -->

   <script>
            //this function can remove a array element.
            Array.remove = function(array, from, to) {
                var rest = array.slice((to || from) + 1 || array.length);
                array.length = from < 0 ? array.length + from : from;
                return array.push.apply(array, rest);
            };
        
            //this variable represents the total number of popups can be displayed according to the viewport width
            var total_popups = 0;
            
            //arrays of popups ids
            var popups = [];
        
            //this is used to close a popup
            function close_popup(id)
            {
                for(var iii = 0; iii < popups.length; iii++)
                {
                    if(id == popups[iii])
                    {
                        Array.remove(popups, iii);
                        
                        document.getElementById(id).style.display = "none";
                        
                        calculate_popups();
                        
                        return;
                    }
                }   
            }
        
            //displays the popups. Displays based on the maximum number of popups that can be displayed on the current viewport width
            function display_popups()
            {
                var right = 220;
                
                var iii = 0;
                for(iii; iii < total_popups; iii++)
                {
                    if(popups[iii] != undefined)
                    {
                        var element = document.getElementById(popups[iii]);
                        element.style.right = right + "px";
                        right = right + 320;
                        element.style.display = "block";
                    }
                }
                
                for(var jjj = iii; jjj < popups.length; jjj++)
                {
                    var element = document.getElementById(popups[jjj]);
                    element.style.display = "none";
                }
            }
            
            //creates markup for a new popup. Adds the id to popups array.
            function register_popup(id, name)
            {
                
                for(var iii = 0; iii < popups.length; iii++)
                {   
                    //already registered. Bring it to front.
                    if(id == popups[iii])
                    {
                        Array.remove(popups, iii);
                    
                        popups.unshift(id);
                        
                        calculate_popups();
                        
                        
                        return;
                    }
                }               
                
                var element = '<div class="popup-box chat-popup" id="'+ id +'">';
                element = element + '<div class="popup-head">';
                element = element + '<div class="popup-head-left">'+ name +'</div>';
                element = element + '<div class="popup-head-right"><a href="javascript:close_popup(\''+ id +'\');">&#10005;</a></div>';
                element = element + '<div style="clear: both"></div></div><div class="popup-messages">w</div></div>';
                
                document.getElementsByTagName("body")[0].innerHTML = document.getElementsByTagName("body")[0].innerHTML + element;  
        
                popups.unshift(id);
                        
                calculate_popups();
                
            }
            
            //calculate the total number of popups suitable and then populate the toatal_popups variable.
            function calculate_popups()
            {
                var width = window.innerWidth;
                if(width < 540)
                {
                    total_popups = 0;
                }
                else
                {
                    width = width - 200;
                    //320 is width of a single popup box
                    total_popups = parseInt(width/320);
                }
                
                display_popups();
                
            }
            
            //recalculate when window is loaded and also when window is resized.
            window.addEventListener("resize", calculate_popups);
            window.addEventListener("load", calculate_popups);
            
        </script>



        <!--END OF THE EXTERNAL JAVASCRIPT LIBRARY -->


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

          <div id="normalpane" class="pull-left">
            <!--  here is the normal pane

             - this is where am gonna code the normal div for social post -->

             <div id="profPane" class="pull-left">
             <!--coding the sidebar profile pane stuff -->
            <div class="media">
              <a class="pull-left">
                <img class="img-circle" src="social_img/haxor.jpg" height="80px" width="80px" />
              </a>
              <span class="myfa"><a href="">Alaran Moshood abayomi</a></span>

              <br/>
              <div class="profPaneLinks">
                  <br/>
              <hr/>
                  <br/>
                 <br/>
                 <div class="fa fa-envelope"><a class="myfa" href="#">&nbsp;&nbsp;&nbsp;&nbsp;Messages </a> </div>
                 <br/>
                 <div class="fa fa-file-photo-o"><a class="myfa" href="#">&nbsp;&nbsp;&nbsp;&nbsp;Photos </a></div>
                 <br/>
                 <div class="fa fa-pencil"><a class="myfa" href="#">&nbsp;&nbsp;&nbsp;&nbsp;Edit Profile </a></div>
                 
                
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
                      &nbsp;<span class="fa fa-camera "> <p class="myfa">Insert Image</p> </span>
                   </div>
                   <div class="panel-body" id="postBody">

                      <!-- <textarea name="" id="statusInput">
                        
                      </textarea> -->
                      <input type="text" name="statusInput" class="form-control"
                      placeholder="what's on your mind ?" />
                      <br/>

                      <button type="submit" class="btn btn-success" id="updatebtn">
                          <span class="fa fa-paste"></span> Post 
                      </button>

                   </div><!--end of the panel body -->

                </div>

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
                </div>
                <!--end  of the update containeer -->




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
                </div>
                <!--end  of the update containeer -->

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
       <div id="onlinePals" class="pull-right">

         <span class="label">Online </span>
         <hr/>
         
         <!--now coding the online div elements -->
           
            <div class="sidebar-name">
                <!-- Pass username and display name to register popup -->
                <a href="javascript:register_popup('codefig', 'abayomi moshood');">
                    <img class="img-circle" src="social_img/haxor.jpg" height="40px" width="40px" 
                    />
           <span class="fa fa-globe onlineLogo"></span>
                <span>Hacker Mashal</span>
                </a>
            </div> <!--end of the sidebar element -->
          <!-- what the fuck is gonna be happending here -->



            <div class="sidebar-name">
                <!-- Pass username and display name to register popup -->
                <a href="javascript:register_popup('codefig', 'abayomi moshood');">
                    <img class="img-circle" src="social_img/haxor.jpg" height="40px" width="40px" 
                    />
           <span class="fa fa-globe onlineLogo"></span>
                <span>Mike Adenuga</span>
                </a>
            </div> <!--end of the sidebar element -->



            <div class="sidebar-name">
                <!-- Pass username and display name to register popup -->
                <a href="javascript:register_popup('f', 'abayd');">
                    <img class="img-circle" src="social_img/haxor.jpg" height="40px" width="40px" 
                    />
           <span class="fa fa-globe onlineLogo"></span>
                <span>Aliko Dangote</span>
                </a>
            </div> <!--end of the sidebar element -->



            <div class="sidebar-name">
                <!-- Pass username and display name to register popup -->
                <a href="javascript:register_popup('w', 'kman');">
                    <img class="img-circle" src="social_img/haxor.jpg" height="40px" width="40px" 
                    />
           <span class="fa fa-globe onlineLogo"></span>
                <span>president Buhari</span>
                </a>
            </div> <!--end of the sidebar element -->


            <div class="sidebar-name">
                <!-- Pass username and display name to register popup -->
                <a href="javascript:register_popup('alisom', 'walebama');">
                    <img class="img-circle" src="social_img/haxor.jpg" height="40px" width="40px" 
                    />
           <span class="fa fa-globe onlineLogo"></span>
                <span>Ifeanyi Ugochukwu</span>
                </a>
            </div> <!--end of the sidebar element -->


          

       </div> <!--end of the online pals element -->

       <div style='clear:both'></div>


   </div>

   <div style="clear:both"></div>

  </div><!--end of page Conttet -->

<!--  -->
        <!-- All javascript goes down here -->
      
    </body>
</html>