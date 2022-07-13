<?php
    include 'config.php';
    include 'db.php';

    session_start();
    if(!isset($_SESSION["user_id"])) {
        //echo 'no user id';
        header('Location: ' . URL . 'index.php');
    }

    $query = "DELETE FROM `dbShnkr22studWeb1`.`tbl_redding_shoppingList_210` WHERE item_id=".$_POST["item_id"].";";
    $result = mysqli_query($connection , $query);
    if(!$result){
        die("Query Failed - could not add list to shopping list"); 
    }

?>
<?php
  echo '{"itemId":"'.$_POST["item_id"].'",
    "userId":"'.$_SESSION["user_id"].'"}';
?>
<?php 
         mysqli_close($connection);
