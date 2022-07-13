<?php
    include 'db.php';
    include 'config.php';

    session_start();

    if(!isset($_SESSION["user_id"])) {
        //echo 'no user id';
        header('Location: ' . URL . 'index.php');
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>My Fridge</title>
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
                         <a class="nav-link" href="#"><img src="<?php echo $_SESSION["profile_pic"]?>" alt=""></a>
                     </li>
                 </ul>
         </div>
     </div>
     </nav>
     </header>
    
         <form action="phpFiles/addRecipe.php" method="get" class="form-floating container" enctype="multipart/form-data">
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
                            <div class="col-lg-3">
                                <input name="receipeName" type="text" class="form-control" id="floatingInputValue" placeholder="Reciepe Name" value="">
                      
                            </div>
                            <div class="col-lg-3">
                                <input name="preperationTime" type="text" class="form-control" id="floatingInputValue" placeholder="Preperation Time" value="">
                            </div>
                            <div class="col-lg-3">
                                <select name="categories" class="form-select" aria-label="Default select example">
                                    <option selected>Choose A Category</option>
                                    <option value="Vegan">Vegan</option>
                                    <option value="Dairy Free">Dairy Free</option>
                                    <option value="Gluten Free">Gluten Free</option>
                                  </select>
                            </div>
                            <div class="col-lg-3">
                                <input name="reciepeImg" type="file" class="form-control" id="floatingInputValue" placeholder="reciepe-img">
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
                        <textarea name="ingrediants" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
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
                      <textarea name="directions" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                      <label for="floatingTextarea2">Directions</label>
                    </div>
                  </div>
                </div>
              </div>
              <input type="hidden" name="userId" value="">
              <section class="container d-flex p-2 align-items-center justify-content-center">
                <input type="submit" value="Post Reciepe" class="btn btn-primary ">
              </section>
              
         </form>
     
</body>
</html>


<?php mysqli_close($connection);?>