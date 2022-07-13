<?php

    include 'db.php';
    include 'config.php';

    if(!empty($_POST["loginMail"])) {
        

        $query  = "SELECT * FROM tbl_users_210 WHERE email='" 
            . $_POST["loginMail"] 
            . "' and password = '"
            . $_POST["loginPassword"]
            ."'";

        $result = mysqli_query($connection , $query);
        $row    = mysqli_fetch_assoc($result);

        if(is_array($row)) {
            

            session_start();
            $_SESSION["user_id"]     = $row['user_id'];
            


            header('Location: '.URL.'smartHub.php');
        } else {
            echo 'Authentication failed !';
            $message = "Invalid username or password !";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome To Redding</title>
    <!-- JavaScript Bundle with Popper -->
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<link rel="stylesheet" href="css/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
</head>
<body>
<header>
    <nav class="navbar  sticky-top navbar-expand-lg navbar-light bg-primary">
        <div class="container-fluid">
             <a class="navbar-brand" href="#">Redding</a>
             <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
             </button>
        </div>
    </nav>
</header>




<div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card border-0 shadow rounded-3 my-5">
          <div class="card-body p-4 p-sm-5">

          <h1 class="ml6">
             <span class="text-wrapper">
                <span class="letters">Welcome Back to Redding.</span>
             </span>
         </h1>
         <h2>Please log in to continue</h2>
            <form method="post" action="#" class="mx-auto">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="loginMail" name="loginMail" aria-describedby="emailHelp">
   
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="loginPassword" name="loginPassword">
                </div>
                <div class="error-message">  <?php 
                    if(isset($message)){
                     echo $message;
                    }; 
                     ?> </div>
                    <button id="login-button" type="submit" class="btn btn-primary d-flex">
                   
                    Log-in
                    </button>
                </form>
          </div>
        </div>
      </div>
    </div>
  </div>




<?php 
    mysqli_close($connection);
    ?>

<script src="scripts/login.js"></script>
</body>
</html>