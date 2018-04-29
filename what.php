<?php
// session_start();
require('whatsconfig.php');
?>
<!doctype html>
<html lang="en">
	<head>
		<script src="social-styles/js/jquery-1.9.1.min.js"></script>
		<script src="social-styles/js/jquery.form.min.js"></script>
		<script src="social-styles/js/whatjs.js"></script>
		<script>
         $('document').ready(function(e)
         {
         	$('#loadmore').click(function(e)
         	{
              var lastval = $('.final').attr('val');
           
             $.post('whatsconfig.php',
             	{
             		from : lastval,
             	} , function(data)
             { 
                 // alert(data);
                 $('.final').remove();
                 $(data).insertBefore('.entry');
             })


         	})
         })
		</script>
		<style type="text/css">
         body{
         	/*background-color:#1abc9c;*/
         	width:950px;
         	margin:0 auto;
         	margin-top:20px;
         }
         #statusPane{
         	border:2px solid #ccc;
         }
         #resultsPane{
           border:2px solid #ccc;
         	margin-top:20px;
         }
         .pcomments{
         	background-color:#1abc9c;
         }
         .cmt{
         	margin-top:5px;
         	background-color:#ccc;
         }
        .post{
        	background-color:#ccc;
        	margin-bottom:7px;
        }
        .insComment{
        	margin:5px;
        	background-color:#1abc9c;
        }
          .statusResult{
          	border:2px solid #ccc;
          	padding:5px;
          	margin:3px;
          }

		</style>
	</head>
	<body>
		<div id="docWrapper">
			<div id="statusPane">
				<label>Input Your Status </label>
				<input type="text" id="statusText"/>
			<form action="whatsaction.php" method="post" enctype="multipart/form-data">
				<input type="file" accept="image/*" id="statusImage" name="statusImage">
				<input type="submit" name="submit" id="imageSubmit" />
			</form>
				<div id="preImage">
				</div><!--end of the preimage div -->
				<input type="submit" name="upload" id="post" value="post" />
			</div><!--end of the statusPane -->

			<div id="resultsPane"> 


    <?php 

    

    echo $data;
   
   // echo $r_count;
    
//   while($ans = $g_handler->fetch(PDO::FETCH_OBJ)){

// /**************************************
// / only bring the status if they are not 
// /empty if(!empty($ans->post_text));

// /**************************************/
//   	// if(!empty($ans->post_text))  {

  	
//   echo 
// 				'<div class="statusResult">
// 					<div class="post">
// 					<span>Name : '. $ans->userid.' <span>
// 					<div class="postContent">'.

// 						$ans->post_text .' 
// 					</div>
// 					<div class="postimage"> ';

                    

//                     if(!$ans->post_image)
//                     {
//                     	echo "";
                     
//                     }
//                     else{
//                     	echo "<img src='$ans->post_image' />";
//                     }

                   
//                      echo '
// 					</div>
// 					 <span><a href="" class="liker" pstid="'.$ans->id.'" mid="'.$ans->userid.'">';

// 					 //the function to get the numer of likes for a certain status 
// 					 $like_result = get_status_likes($ans->userid,$ans->id, $con);
// 					 if($like_result > 0)
// 					 {
// 					 	$lk_output = "Liked";
// 					 }
// 					 else{
// 					 	$lk_output = "Like";
// 					 }
     
//          echo $lk_output. '</a></span>
// 					</div>
					
// 					<div class="pcomments">
// 						<div class="cmt">';
// 							get_comments_list($ans->id);
// 						echo '</div><!--end of the cmt class elements -->                     
// 					 </div><!--end of the pcomments-->   
// 				  <div class="insComment">
				    
// 				  	<input placeholder="input ur comment" type="text" class="cmtinput"/>
// 				  	<input type="submit" value="Add comment" class="add" rid='.$ans->id.'>
// 				  </div> <!-- end of the insComment div  -->
// 				</div><!--end of a statusREsult -->';
    
//   }
   



	?>


				
			</div>

			<div class="entry"></div>
			<button class="btn btn-primary" id="loadmore">Load more </button>
		</div>
	</body>
</html>