<?
    include 'db.php';
    include 'config.php';

    session_start();

    if(!isset($_SESSION["user_id"])) {
        //echo 'no user id';
        header('Location: ' . URL . 'index.php');
    }
   
    $reciepeId = $_GET["reciepeId"];

    $query = "SELECT * FROM dbShnkr22studWeb1.tbl_redding_reciepes_210 WHERE reciepe_id =".$reciepeId."";
    $result = mysqli_query($connection , $query);
    $row = mysqli_fetch_assoc($result);

    if($row["user_id"]!=$_SESSION["user_id"]){
        header("HTTP/1.1 401 Unauthorized");
        exit;
    }

 

  ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>My Reciepe Edit</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-primary">
         <div class="container-fluid">
             <a class="navbar-brand" href="index.html">Redding</a>
                 <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                     <span class="navbar-toggler-icon"></span>
                 </button>
         <div class="collapse navbar-collapse" id="navbarNav">
                 <ul class="navbar-nav d-flex align-items-center">
                     <li class="nav-item">
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
         <div class="row d-flex justify-content-center">
            <h1 class=" col-3"> Edit Your Reciepe</h1>
         </div>
         
         <form action="" method="post" class="form-floating container" enctype="multipart/form-data" id ="updateReciepeForm">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                     Reciepe Details
                    </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body container">
                      <strong>Provide Key Information About Your Recipe.</strong> 
                      <section id="column" class="row">
                            <div class="col-lg-4">
                                <?php 
                                    echo '<input name="receipeName" type="text" class="form-control" id="floatingInputValue" placeholder="Reciepe Name" value="'.$row["reciepe_name"].'">';
                                ?>
                            </div>
                            <div class="col-lg-4">
                                <?php 
                                    echo '<input name="preperationTime" type="text" class="form-control" id="floatingInputValue" placeholder="Preperation Time" value="'.$row["prep_time"].'">';
                                ?>
                            </div>
                            <div class="col-lg-4">
                                <select name="categories" class="form-select" aria-label="Default select example">
                                    <option selected>Choose A Category</option>
                                    <option value="1">Vegan</option>
                                    <option value="2">Dairy Free</option>
                                    <option value="3">Gluten Free</option>
                                  </select>
                            </div>
                          
                            
                      </section>
                   
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      Select Ingrediants
                    </button>
                  </h2>
                  <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <strong>What Ingrediants Does Your Reciepe Include?.</strong> 
                      <div class="form-floating">
                        <textarea name="ingrediants" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px">
                        <?php  echo $row["ingrediants"]; ?>
                        </textarea>
                        <label for="floatingTextarea2">Ingrediants</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                      Directions
                    </button>
                  </h2>
                  <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <strong>Please Explain The Best Way To Make This </strong>
                      <textarea name="directions" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px">
                      <?php  echo $row["directions"]; ?>
                      </textarea>
                      <label for="floatingTextarea2">Directions</label>
                    </div>
                  </div>
                </div>
              </div>
              <?php 
              echo' <input type="hidden" name="reciepeId" value="'.$row["reciepe_id"].'">';
              ?>
              <section class="container d-flex  p-2 align-items-center justify-content-center row">
             
             <input type="submit" value="Update Reciepe" class="btn btn-primary ml-1 col-2" id="updateReciepe">
             <button type="submit" for="deleteReciepe" class="btn btn-outline-secondary col-1 mx-5" id="deleteReciepebtn">
                <i class="fa-solid fa-trash"></i>
             </button>
              </section>
         </form>
         <form action="" method="post" id = "deleteReciepe">
         <?php 
              echo' <input type="hidden" name="reciepe_id" value="'.$row["reciepe_id"].'">';
              ?>
         </form>
        
     
     <script src="scripts/updateReciepe.js"></script>
</body>
</html>


<?php mysqli_close($connection);?>