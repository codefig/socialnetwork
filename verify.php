<?php
session_start();

include_once('config.php');


if(isset($_POST['task']) && $_POST['task'] == 'login'){
   
   $usermail = $_POST['user'];
   $password  = $_POST['pass'];

   $login_query = "SELECT * FROM user WHERE email=:usermail AND password=:userpass";

   $login_handler = $con->prepare($login_query);

   $login_handler->execute(array(
   	':usermail' => $usermail,
   	':userpass' => $password));

   $login_row_count = $login_handler->rowCount();

   
   if($login_row_count > 0)
   {
   	 $user_result = $login_handler->fetch(PDO::FETCH_ASSOC);

   	 $user_row_id = $user_result['id'];

   	 echo 1;
   	 $_SESSION['usermail']  = $usermail;
   	 $_SESSION['userid'] = $user_row_id;
   }
   else{
   	echo "Sorry Invalid Login Details";
   }

}

?>