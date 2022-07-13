<?php 

 include 'config.php';
 include 'db.php';
 session_start();
 $userId = $_SESSION["user_id"];
 if(!isset($userId)) {
     //echo 'no user id';
     header('Location: ' . URL . 'index.php');
 }
 $user_id = $_SESSION["user_id"];
 $reciepe_id       = mysqli_real_escape_string($connection,$_POST['reciepe_id']);
 $query = "DELETE FROM dbShnkr22studWeb1.tbl_redding_reciepes_210 WHERE reciepe_id=".$_POST["reciepe_id"].";";
 $result = mysqli_query($connection , $query);


 if(!$result){
     die("Query Failed - could not add list to shopping list"); 
 }

echo '{"reciepe_id":"'.$reciepe_id.'"}';
 

mysqli_close($connection);