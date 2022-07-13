<?php
    include 'config.php';
    include 'db.php';
    session_start();
    $userId = $_SESSION["user_id"];
    if(!isset($userId)) {
        //echo 'no user id';
        header('Location: ' . URL . 'index.php');
    }
  
  
        $amount = $_POST["amount"];

        $prodId = $_POST["prodId"];
  
        $prodId=9;

    $query = "UPDATE  dbShnkr22studWeb1.tbl_redding_inventory_210 SET amount = ".$amount." WHERE product_id = ".$prodId." AND   user_id= ".$userId." ;";
    //echo $query;
    $result = mysqli_query($connection , $query);
    if(!$result){
        die("Query Failed - could not add list to shopping list"); 
    }
?>
<?php

   echo '{"itemId":"'.$amount.'",
          "userId":"'.$userId.'"}';
        //   $_POST = json_decode(file_get_contents("php://input"), true);
        // print_r($_POST);
?>
<?php 
         mysqli_close($connection);