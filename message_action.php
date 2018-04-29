<?php
include('config.php');
include('functions.php');

//*****************************************************
// this functiion is meant to update the status 
// when the status includes an Image 
//****************************************************



if(isset($_POST['task']) && $_POST['task'] == 'message'){
	// echo "yea the message was sent";
	$me = $_POST['sender'];
	$friend = $_POST['receiver'];

	// $me = 3;
	// $friend = 6;

    //gonna be using a UNION statement to co-join the records 
	if($me && $friend){
		// echo "yea the two is set";
	// $query1 = "SELECT * FROM messages WHERE sender=:me AND recv=:friend";


   $query = "SELECT * FROM messages WHERE sender=:me and recv=:friend 
   UNION ALL select * from messages where sender=:friend and recv=:me ORDER BY id";

   // $query = "SELECT * FROM messages WHERE sender=:me and recv=:friend";

	$handler = $con->prepare($query);
	$handler->execute(array(
		':me' => $me,
		':friend' => $friend));
	$rowcount = $handler->rowcount();
	// echo $rowcount;
	if($rowcount)
	{
      while($result = $handler->fetch(PDO::FETCH_OBJ)){
        
        $sender_image = get_image_set($result->sender, $con); //get the sender's image;
        $details = get_user_details($result->sender, $con); //get the details and filter the username;
        $user_fullname = $details->full_name; //the sender's fullname
        $message = $result->message;
        $time = $result->time;
      echo '
      <div class="userMsgItem well">
            <img  class="img50" src="'.$sender_image.'" />
            <span class="userMsgName">'.$user_fullname.'</span>&nbsp; <span>'.$result->time.'</span><br/>
            <p><span class="userMsgMessage">'.$message.'</span></p>
         </div>';

      }

	}

	}
	else{
		// exit();
		// echo "variables not set";
		echo "somthing is not right";
	}
	// echo $me. $friend;
}


if(isset($_POST['task']) && $_POST['task'] == 'i_msg')
{
	$sender = $_POST['sender'];
	$reciever = $_POST['receiver'];
	$msg_text = $_POST['msg'];
	if($sender && $reciever && $msg_text){
         $query = "INSERT INTO messages(sender, recv, message, time) VALUES (:sender, :recv, :message, NOW())";
         $handler = $con->prepare($query);
         $handler->execute(array(
         	':sender' => $sender,
         	':recv' => $reciever,
         	':message' => $msg_text));
         $row_count = $handler->rowCount();
         echo $row_count;
	}
	else{
		exit();
	}
}

?>