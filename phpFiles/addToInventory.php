<?php 
include '../db.php';
include '../config.php';
session_start();

if(!isset($_SESSION["user_id"])) {
    //echo 'no user id';
    header('Location: ' . URL . 'index.php');
}
?>
<?php 
$user_id = $_SESSION["user_id"];
$product_name = mysqli_real_escape_string($connection,$_GET['product']);
$amount = mysqli_real_escape_string($connection,$_GET['amount']);
$expDate = mysqli_real_escape_string($connection,$_GET['date']);

$query ="SELECT * FROM `dbShnkr22studWeb1`.`tbl_redding_products_210` WHERE product_name LIKE UPPER('%".$product_name."%');";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);

if(!$result){
    die("1 Could not add ".$product_name."");
}
$insertQuery ="INSERT INTO `dbShnkr22studWeb1`.`tbl_redding_inventory_210` (`user_id`, `product_id`, `amount`, `exp_date`) VALUES ('".$user_id ."', '".$row["product_id"]."', '".$amount."', '".$expDate."');";
$insert = mysqli_query($connection,$insertQuery);
if(!$insert){
    die("2 Could not add ".$product_name."");
}

mysqli_close($connection);