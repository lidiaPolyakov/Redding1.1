<?php
    include 'db.php';
    include 'config.php';

    session_start();

    if(!isset($_SESSION["user_id"])) {
        //echo 'no user id';
        header('Location: ' . URL . 'index.php');
    }
    $productId=$_GET["productId"];

    $query = "  SELECT * FROM dbShnkr22studWeb1.tbl_redding_products_210 AS p
                JOIN dbShnkr22studWeb1.tbl_redding_inventory_210   AS i
                ON p.product_id = i.product_id
                JOIN dbShnkr22studWeb1.tbl_users_210 AS u
                ON i.user_id = u.user_id
                WHERE p.product_id=".$productId.";";

    $result = mysqli_query($connection,$query);
    $row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Item</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="css/style.css">
</head>

<body id="main-object">
 

    <header>
        <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-primary">
         <div class="container-fluid">
             <a class="navbar-brand" href="index.html">Redding</a>
                 <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                     <span class="navbar-toggler-icon"></span>
                 </button>
         <div class="collapse navbar-collapse" id="navbarNav">
                 <ul class="navbar-nav d-flex align-items-center">
                     <li class="nav-item ">
                         <a class="nav-link active" aria-current="page" href="myFridge.php">My Fridge</a>
                     </li>
                     <li class="nav-item">
                          <a class="nav-link" href="smartHub.php">Smart Hub</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="reciepes.php">Reciepes</a>
                      </li>
                      <li class="nav-item">
                      <?php  echo ' <a class="nav-link" href="#"><img src="  images/'.$_SESSION["user_id"].'.png" alt=""></a>';?>
                     </li>
                 </ul>
         </div>
     </div>
     </nav>
     </header>


     <section class="container container-fluid">
        <div class="container">
            <section class="row">

                <section id="big-item" class="col-lg-4 col-md-10 border-right container">


          <?php 
               echo ' <section id="item-options" class="d-flex justify-content-around">
                     <h1 >'.$row["product_name"].'</h1>
                      <section>
                      <form action="" method="post" id="deleteMainProductForm">
                         <button id="deleteMainObject" for="deleteMainProduct" type="submit" class="btn btn-outline-primary">
                            <i class="fa-solid fa-trash-can"></i>
                            <input type="hidden" name="product_id" value="'.$row["product_id"].'">
                         </button> 
                        </form> 
                        </section> 
                    </section>
                    <section class="text-center" id="big-selected" >
                            <p> '.$row["exp_date"].'</p>
                    </section>
                    <section class="text-center"  id="big-selected">
                            <a href="#">
                                <img  id="big-pic" src=' .$row["img"]. ' alt="selected-item">
                            </a> <br> <input type="number" value= ' .$row["amount"].'  style="width:50px">
                    </section>' ;
            ?>
            
            </section>
                <section class="col-lg-8 col-md-12 border-right">
                    <div class="container">

                    <section class="row">
                        <section class="card">
                             <section class="card-wrapper">
                                <h1> <i class="fa-solid fa-lightbulb"></i> Smart Shopping Tips</h1>
                <section class="container-fluid">
                <?php 
             echo '       <h5>Status: '.$row["product_name"].'</h5>
                             <section class="row">
                                <section class="col-4">
                                    <p>You Now Have</p>
                                     <p> '.$_GET["amount"].'</p>
                                </section>
                                <section class="col-4">
                                     <i class="fa-solid fa-circle-arrow-right"></i>
                                </section>
                                <section class="col-4">
                                    <p>Days To Enjoy</p>
                                    <p>'.$_GET["days"].'</p>
                                </section>
                             </section>
                        </section>'
                ?>

                <a class="btn btn-outline-primary d-grid" href="smartHub.php">
                    Edit Shopping List
               </a>
               
                            </section>
                        </section>

                        </section>

                        <section class="row card">
                            <h1> <i class="fa-solid fa-lightbulb"></i> Did You Know?</h1>
                            <section class="main-item-card">
                                <p class="text-align-left" id="facts">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita autem veritatis tenetur earum, libero laudantium, corporis impedit suscipit omnis, delectus ex nostrum sit magni incidunt vel pariatur minus doloribus assumenda.
                                </p>
                            </section>
                        </section>

                        </section>
                    </div>
                </section>
            </section>
        </div>
    </section>


<?php mysqli_close($connection); ?>
<script src="scripts/mainObject.js"></script>
</body>

</html>