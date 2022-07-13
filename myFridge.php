<?php
    include 'db.php';
    include 'config.php';

    session_start();

    if(!isset($_SESSION["user_id"])) {
        //echo 'no user id';
        header('Location: ' . URL . 'index.php');
    }

    $today = date_create(date("Y-m-d"));  

    $query = "  SELECT * FROM dbShnkr22studWeb1.tbl_redding_products_210 AS p
                JOIN dbShnkr22studWeb1.tbl_redding_inventory_210   AS i
                ON p.product_id = i.product_id
                JOIN dbShnkr22studWeb1.tbl_users_210 AS u
                ON i.user_id = u.user_id
                WHERE u.user_id=".$_SESSION["user_id"].";";
    $result = mysqli_query($connection,$query);
    $row = mysqli_fetch_assoc(($result));
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
<body id="myFridge">
    <header>
        <nav class="navbar  sticky-top navbar-expand-lg navbar-light bg-primary">
         <div class="container-fluid">
             <a class="navbar-brand" href="smartHub.php">Redding</a>
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
       <!-- main -->
    <main id="list-wrapper">
        <section class="container container-fluid">
                <section class="row">
                    <section id="big-item" class="col-lg-4 col-md-10 border-right">
                      <!-- dynamically inserted -->
                    

                    </section>


                    <section class="list-container col-lg-8 col-md-12 border-right">
                        <div class="container">
                            <section class="row">
                                <section class="col-9">                
                                </section>
                                <section class="col-1">                                   
                                </section>
                            </section>                
                            <section class="row">
                                <table class="table align-middle mb-0 bg-white">
                                    <!-- add buttons  -->
                                    <div class="add-buttons container">
                                        <div class="row row-cols-2 d-flex p-2 align-items-center justify-content-center ">
                                          
                                          <div class="make-hidden col d-flex justify-content-center col-md-3">
                                            <section class="add-item-btn">
                                                <img src="images/Milk.png" alt="">
                                                Add
                                            </section>
                                          </div>
                                          <div class="make-hidden col d-flex justify-content-center col-md-3">
                                            <section class="add-item-btn">
                                               <img src="images/Lemon.png" alt="">
                                               Add
                                          </section>
                                          </div>
                                          <div class="make-hidden col d-flex justify-content-center col-md-3">
                                            <section class="add-item-btn">
                                                <img src="images/Bread.png" alt="">
                                                Add
                                          </section>
                                          </div>
                                          <div class="make-hidden col d-flex justify-content-center col-md-3">
                                            <section class="add-item-btn btn btn-primary btn-outline-primary d-flex p-2 align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                               <i class="fa-solid fa-circle-plus align-middle"></i>  
                                          </section>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="container d-flex p-2 align-items-center justify-content-end">
                                        <div class="co-1"></div>
                                        <div class="col-11 ">
                                   
                                            <!-- <input id="search-bar" type="search" placeholder="Search..."> -->
                                        </div>
                                      </div>
                                      <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add New Item</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="addNewItem" action="phpFiles/addToInventory.php" method="get">
                                    <!-- Item input -->
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form1Example1">New Item</label>
                                        <input name="product" type="search" id="form1Example1" class="form-control" />
                                    </div>
                                    <!-- Amount input -->
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form1Example2">Amount</label>
                                        <input name="amount" type="number" id="form1Example2" class="form-control" />
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form1Example2">Purchase Date</label>
                                        <input name="date" type="date" id="form1Example2" class="form-control" />
                                    </div>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <input for="addNewItem" name="save" type="submit" class="btn btn-primary" value="Save Changes" />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                                <!-- ------------------ -->
                                    <div class="titles container  align-middle">
                                        <div class="row">
                                          <div class="col-3 d-flex justify-content-center"></div>
                                          <div class="col-2 d-flex justify-content-center">Item</div>
                                          <div class="col-2 d-flex justify-content-end">Ex. Date</div>
                                          <div class="col-3 d-flex justify-content-end">Days</div>
                                          <div class="col-1 d-flex justify-content-center"> Amount</div>
                                        </div>
                                      </div>
                                    <tbody id="ingrediant-list" class="align-middle">
                                       <!-- dynamically inserted -->
                                    
                                       <?php 
                                                class Product {
                                                         public function __construct($m_name, $m_img, $m_ex_date,$m_id,$m_days,$m_amount) {
                                                                $this->name = $m_name;
                                                                $this->img = $m_img;
                                                                $this->eDate = $m_ex_date;
                                                                $this->id = $m_id;
                                                                $this->daysLeft = $m_days;
                                                                $this->amount = $m_amount;
                                                        }
                                                }
                                                $productsArray = array();
                                            ?>
                                    
                                            <?php

                                            while($row = mysqli_fetch_assoc($result)){
                                                $name = $row["product_name"];
                                                $img = $row["img"];
                                                $ex_date = $row["exp_date"];
                                                $id = $row["product_id"];
                                                $amount=$row["amount"];
                                                //calaculating amount of days left 
                                                $thisDay = $today;
                                                $compareDay = date_create($ex_date);
                                                $daysLeft = date_diff($thisDay,$compareDay);
                                                // here needs to echo the products list if we would like to

                                                array_push($productsArray, new Product($name,$img,$ex_date,$id,$daysLeft->days,$amount));
                                                
                                             }
                                             
                                            $jsonArray = array();

                                            foreach ($productsArray as $key=>$value){
                                                array_push($jsonArray,json_encode($value));                                                               
                                            }

                                            file_put_contents('json/productList.json',json_encode($jsonArray));
                                            ?>
                                    </tbody>
                                </table>
                            </section>
                        </div>
                    </section>
                </section>
            
        </section>
    </main>
    <?php  mysqli_close($connection); ?>
    <script src="scripts/fridge.js">
    </script>
    
</body>

</html>