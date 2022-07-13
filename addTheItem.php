<?php
    include 'config.php';
    include 'db.php';

    session_start();
    if(!isset($_SESSION["user_id"])) {
        //echo 'no user id';
        header('Location: ' . URL . 'index.php');
    }

    $query = "INSERT INTO `dbShnkr22studWeb1`.`tbl_redding_shoppingList_210` (`item_name`, `user_id`) VALUES ('".$_POST["item"]."', '".$_SESSION["user_id"]."');";
    $result = mysqli_query($connection , $query);
    if(!$result){
        die("Query Failed (insert)  - could not add list to shopping list");
    }

    $lastId = mysqli_insert_id($connection);

    echo '{"itemName":"'.$_POST["item"].'",
             "userId":"'.$_SESSION["user_id"].'",
             "itemId":"'.$lastId.'"}';
 
 
