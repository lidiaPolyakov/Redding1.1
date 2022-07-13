<?php 
include "config.php"; 
include "db.php"; 
$reciepeId = $_GET["reciepeId"];
$query = "SELECT * FROM dbShnkr22studWeb1.tbl_redding_reciepes_210 WHERE reciepe_id = " .$reciepeId . ";";
$result = mysqli_query($connection,$query);

if($result){
 $row = mysqli_fetch_assoc($result);
}else{
    die("Could not load your product");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Reciepe</title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</head>
<body>

    <main>
        <div class="container  mx-auto">
            <div class="card mx-auto" style="width: 80%;">
                <img src="<?php echo $row["img_url"] ?>" class="card-img-top" alt="...">
                 <div class="card-body">
                        <h3 class="card-title"><?php echo $row["reciepe_name"] ?> <i class="fa-solid fa-utensils"></i></h3>
                        <p class="card-text"><strong> Ingrediants </strong>  <br> <?php echo $row["ingrediants"] ?></p>
                        <p class="card-text"><strong> Directions </strong> <br> <?php echo $row["directions"] ?></p>
                        <a href="reciepes.php" class="btn btn-primary">Back To Reciepes</a>
            </div>
</div>
        </div>
    </main>
</body>
</html>