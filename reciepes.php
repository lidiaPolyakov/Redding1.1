<?php
    include 'db.php';
    include 'config.php';

    session_start();
     $USER_ID = $_SESSION["user_id"];
    if(!isset($USER_ID)) {
        //echo 'no user id';
        header('Location: ' . URL . 'index.php');
    }
?>
<?php
include "db.php"; 

$query = "SELECT * FROM tbl_redding_reciepes_210";
$result = mysqli_query($connection , $query);
if(!$result){
die("Query Failed - could not fetch reciepe data");
}



$query_preview = " SELECT * FROM tbl_redding_reciepes_210 WHERE reciepe_id =1";
$result_preview = mysqli_query($connection, $query_preview);
if(!$result_preview){
die("Query Failed Couldnt Load preview Content");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Reciepe Feed</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="css/style.css">

</head>

<body id="reciepes">

    <header>
       <nav class=" $navbar-info-hover-color navbar sticky-top navbar-expand-lg navbar-light bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html">Redding</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
        <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav d-flex align-items-center">
                    <li class="nav-item ">
                        <a class="nav-link " aria-current="page" href="myFridge.php">My Fridge</a>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link" href="smartHub.php">Smart Hub</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link active" href="reciepes.php">Reciepes</a>
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
          
            <div class="container">
                
                <section class="row">
                    
                    <section id="reciepe-preview" class="col-lg-4 col-md-10 border-right">
                    <?php  
                    $preview = mysqli_fetch_assoc($result_preview);
                    echo '
                     <section id="reciepe-card-wrapper"> <section id="reciepe-card"><img src='
                     . $preview["img_url"] .' alt=""> <section id="reciepe-details"><h1>'
                     . $preview["reciepe_name"] .'</h1> <p> '
                     . $preview["prep_time"] .'</p> </section><button class="btn btn-outline-primary reciepe-view-button" >View  </button></section> </section> <section id="reciepe-content"><h2> Ingrediants</h2><p>'
                     . $preview["description"] .' </p> </section> ' ;
                    ?>
                    </section>
                    <section class="col-lg-8 col-md-12 border-right">
                        <div class="container">
                            <section class="row">
                                <section class="col-10 ">
                                    <div class="dropdown d-grid gap-2" >
                                        <!-- dropdown -->
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="true">
                                      Categories
                                     </button>
                                        <ul class="dropdown-menu nav-fill" aria-labelledby="dropdownMenuButton1">
                                            <li><a class="dropdown-item" href="#">Vegeterian</a></li>
                                            <li><a class="dropdown-item" href="#">Vegan</a></li>
                                            <li><a class="dropdown-item" href="#">Lactose Free</a></li>
                                            <li><a class="dropdown-item"> Gluten Free</a></li>
                                        </ul>
                                    </div>

                                </section>
                                <section class="col-2 d-grid gap-4">
                                    <a href="addReciepe.php" class="btn btn-outline-primary d-flex p-2 justify-content-center">
                                        <i class="fa-solid fa-circle-plus"></i>
                                    </a>
                                </section>

                            </section>
                
                            <section class="row">
                                <table class="table  table-hover align-middle mb-0 bg-white">
                                    <tbody id="reciepe-dynamic-list">
                                            <?php 
                                                class Reciepe {
                                                         public function __construct($_name, $_prep_time, $_img,$_description,$_id,$_permission) {
                                                                $this->name = $_name;
                                                                $this->prep_time = $_prep_time;
                                                                $this->img = $_img;
                                                                $this->description = $_description;
                                                                $this->id = $_id;
                                                                $this->permission =$_permission;
                                                        }
                                                }
                                                $reciepesArray = array();
                                            ?>
                                       <!-- dynamically inserted -->
                                            <?php
                                            while($row = mysqli_fetch_assoc($result)){
                                                $name = $row["reciepe_name"];
                                                $prep_time =$row["prep_time"];
                                                $img = $row["img_url"];
                                                $description = $row["description"];
                                                $id = $row["reciepe_id"];
                                                $u_id = $row["user_id"];
                                                $editMode=0;

                                                if($u_id == $USER_ID){
                                                    $editMode = 1;
                                                }else{
                                                    $editMode = 0;
                                                }
                                                array_push($reciepesArray, new Reciepe($name,$prep_time,$img,$description,$id,$editMode) );
                                             }
                                            
                                            $jsonArray = array();
                                            foreach ($reciepesArray as $key=>$value){
                                                $val=json_encode($value);
                                                if($val){
                                                    array_push($jsonArray,$val);
                                                }
                                            }
                                            file_put_contents('json/reciepeList.json',json_encode($jsonArray));                                              
                                            ?>
                                    </tbody>
                                </table>
                            </section>
                        </div>
                    </section>
                </section>
            </div>
        </section>
       
    </main>
    <?php 
    mysqli_close($connection);
    ?>
    <script src="scripts/reciepes.js">
    </script>
</body>

</html>