<?php 
include '../db.php';
session_start();

if(!isset($_SESSION["user_id"])) {
    //echo 'no user id';
    header('Location: ' . URL . 'index.php');
}
?>
<?php 
$user_id = $_SESSION["user_id"];
$reciepe_name = mysqli_real_escape_string($connection,$_GET['receipeName']);
$prep_time = mysqli_real_escape_string($connection,$_GET['preperationTime']);
$reciepe_category = mysqli_real_escape_string($connection,$_GET['categories']);
$ingrediants = mysqli_real_escape_string($connection,$_GET['ingrediants']);
$directions = mysqli_real_escape_string($connection,$_GET['directions']);

// $filename = $_FILES["reciepeImg"]["name"];
// $tempname = $_FILES["reciepeImg"]["tmp_name"];
// $folder = "./images/" . $filename;

$query = 'INSERT INTO dbShnkr22studWeb1.tbl_redding_reciepes_210 (reciepe_name, prep_time, img_url, description, category, ingrediants,directions, user_id ) VALUES ("'.$reciepe_name.'" , "'.$prep_time.'", "imgUrl", "description", "'.$reciepe_category.'", "'.$ingrediants.'", "'.$directions.'" , "'.$user_id.'"); ';

$result = mysqli_query($connection, $query);

if(!$result){
    die("Could not add ".$reciepe_name."");
}




?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Save</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="card m-auto" style="width: 25rem; height:35rem;">
<div class="alert alert-success" role="alert">
 Great! Your Item Was Added!
</div>
  <div class="card-body">
    <h5 class="card-title"><?php echo $reciepe_name; ?></h5>
    <p class="card-text">Now check it in te reciepe feed<i class="fa-solid fa-circle-check"></i></i></p>
    <a href="reciepes.php" class="btn btn-primary">Reciepe Feed <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
  </div>
</div>

 <?php 
 
         mysqli_free_result($result);
 ?>
 
</body>
</html

<?php
mysqli_close($connection);
?>