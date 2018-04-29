<?php


try{

$con = new PDO('mysql:host=localhost;dbname=social','root','');
}
catch(PDOException $e){
  print_r($e->getMessage());
}



?>