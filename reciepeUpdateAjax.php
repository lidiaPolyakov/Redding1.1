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
    $reciepe_name     = mysqli_real_escape_string($connection,$_POST['receipeName']);
    $prep_time        = mysqli_real_escape_string($connection,$_POST['preperationTime']);
    $reciepe_category = mysqli_real_escape_string($connection,$_POST['categories']);
    $ingrediants      = mysqli_real_escape_string($connection,$_POST['ingrediants']);
    $directions       = mysqli_real_escape_string($connection,$_POST['directions']);
    $reciepe_id       = mysqli_real_escape_string($connection,$_POST['reciepeId']);
 
    $query = "UPDATE dbShnkr22studWeb1.tbl_redding_reciepes_210
              SET reciepe_name = '".$reciepe_name."', prep_time = '".$prep_time."', description = '".$directions."', category = '".$reciepe_category."', ingrediants = '".$ingrediants."' 
              WHERE (`reciepe_id` = '".$reciepe_id."');";
    //echo $query;
    $result = mysqli_query($connection , $query);
    if(!$result){
        die("Query Failed - could not add list to shopping list"); 
    }
?>
<?php

   echo '{"reciepe_name":"'.$reciepe_name.'"}';
          
        //   $_POST = json_decode(file_get_contents("php://input"), true);
        // print_r($_POST);
?>
<?php 
         mysqli_close($connection);