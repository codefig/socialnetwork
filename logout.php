<?php
ob_start();
session_start();

if(!isset($_SESSION['userid'])){

	header("Location: index.php");
}

else{
	unset($_SESSION['userid']);
	unset($_SESSION['usermail']);
	unset($_SESSION['mat_no']);
	header("Location: index.php");
}

?>