<?php


require_once('config.php');
require_once('whatsupdate.php');



$getitemquery = "SELECT * FROM testbed ORDER BY id DESC";
$g_handler = $con->query($getitemquery);

// $ans  = $g_handler->fetchAll();
  // $ans =  $g_handler->fetch();
  // print_r($ans);

// $r_count = $g_handler->rowCount();


function get_comments($post_id){
	$get_comment_query = "SELECT * FROM test_comment WHERE post_id=:post_id";
	$get_comment_handler = $con->prepare($get_comment_query);
	$get_comment_handler->execute(array(
		':post_id' => $post_id));

}

class Feed {
   


   public function get_comments($post_id){

   	$get_comment_query = "SELECT * FROM test_comment WHERE post_id=:post_id";
	$get_comment_handler = $con->prepare($get_comment_query);
	$get_comment_handler->execute(array(
		':post_id' => $post_id));


   }



	public function query($from , $to){
		$con = new PDO('mysql:host=localhost;dbname=social','root', '');

		$query = "SELECT * FROM testbed where id>:from and id<:to";
		$handler  = $con->prepare($query);
		$handler->execute(array(':from' => $from, ':to'=> $to));
		$rowcount  = $handler->rowCount();

		// $handler = $con->query($query);
		
		$data = "";
        if($rowcount > 0)
        {


		while($ans = $handler->fetch(PDO::FETCH_OBJ))
		{
			$id = $ans->id;
             $data .=
				'<div class="statusResult">
					<div class="post">
					<span>Name : '. $ans->userid.' <span>
					<div class="postContent">'.

						$ans->post_text .' 
					</div>
					<div class="postimage"> ';

                    

                    if(!$ans->post_image)
                    {
                       	// echo "";
                       	$data .="";
                     
                    }
                    else{
                    	// echo "<img src='$ans->post_image' />";
                    	$data .="<img src='$ans->post_image' />";
                    }

                   
                     // echo '
                    $data .='
					</div>
					 <span><a href="" class="liker" pstid="'.$ans->id.'" mid="'.$ans->userid.'">';

					 //the function to get the numer of likes for a certain status 
					 $like_result = get_status_likes($ans->userid,$ans->id, $con);
					 if($like_result > 0)
					 {
					 	// $lk_output = "Liked";
					 	$data .= "Liked";
					 }
					 else{
					 	// $lk_output = "Like";
					 	$data .="Like";
					 }
     
         $data.= '</a></span>
					</div>
					
					<div class="pcomments">
						<div class="cmt">';
							get_comments_list($ans->id);
						echo '</div><!--end of the cmt class elements -->                     
					 </div><!--end of the pcomments-->   
				  <div class="insComment">
				    
				  	<input placeholder="input ur comment" type="text" class="cmtinput"/>
				  	<input type="submit" value="Add comment" class="add" rid='.$ans->id.'>
				  </div> <!-- end of the insComment div  -->
				</div><!--end of a statusREsult -->';
    
        }
         $data = $data .'<div class="final" val="'.$id.'"></div>';
         return $data;
		}

		else{
		 //end of the while loop
			echo "0";
		}

  } //end of the function 
   





	public function main()
	{   

		if(isset($_POST['from']))
		{
			$from = $_POST['from'];
			$to = $from + 10;

	    	$data = $this->query($from,$to);
	    	echo $data;
		}
		else
		{
			$data = $this->query(11, 15);
		   return $data;
		}
	}

	} //end of the fucking class ;



$obj = new Feed();
$data = $obj->main($con);
?>