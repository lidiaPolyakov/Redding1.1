<?php
   include 'config.php';
   include 'db.php';
   session_start();
   if(!isset($_SESSION["user_id"])) {
       //echo 'no user id';
       header('Location: ' . URL . 'index.php');
   }
   $prod_id = $_POST["item"];
   $user_id = $_SESSION["user_id"];
   
   $result = mysqli_query($connection , $query);
   $query ="DELETE FROM dbShnkr22studWeb1.tbl_redding_inventory_210 
            WHERE user_id =".$user_id." 
            AND product_id = ".$prod_id.";";

   if(!$result){
       die("Query Failed (insert)  - could not add list to shopping list");
   } 
  echo '{"itemName":"'.$prod_id.'"}';