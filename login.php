<?php
session_start();
require "components/is_logged_in.php";

?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="This is demo page made for YouBee.ai's programming courses">
  <meta name="author" content="YouBee.ai">

  <title>Login - YouBee Blog Template</title>

  <!-- Bootstrap Core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="css/simple-blog-template.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <?php require "components/navbar.php" ; ?>



  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <div class="col-lg-2"></div>

      <!-- Login content  -->
      <div class="col-lg-8 login">

        <!-- Title -->
        <h1>Login</h1>

        <!-- Login form -->
        <form action="actions/login.php" method="POST" class="login-form">
          <div class="form-group">
            <label for="username">Email</label>
            <input type="email" id="email" name="email" class="form-control">
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control">
          </div>

          <button type="submit" class="btn btn-primary">Log in</button>
          <p>Don't have an account? <a href="signup.php">Sign Up Now</a></p>
         
           <?php

      if(isset($_GET["err"])){
        if($_GET["err"]==1){
          echo "missing fields";
        }
       else if($_GET["err"]==2){
          echo "wrong email address";
        }
        else if($_GET["err"]==3){
          echo "wrong password";
        }
        else if($_GET["err"]==0){
          echo "database error";
        }
      }

      
           ?>
        </form>
        <!-- /form -->
      </div>

      <div class="col-lg-2">
        
      </div>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
 
  <?php require "components/footer.php" ; ?>

  <!-- jQuery -->
  <script src="js/jquery.js"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="js/bootstrap.min.js"></script>



</body>

</html>