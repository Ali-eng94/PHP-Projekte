<?php
session_start();
require "connection.php";

$user_id=$_GET["id"];

$sql="SELECT * from posts WHERE user_id = :user_id";
$stmt=$pdo->prepare($sql);
$stmt->bindParam(":user_id",$user_id,PDO::PARAM_INT);
$stmt->execute();
$posts=$stmt->fetchAll(PDO::FETCH_ASSOC);

$sql="SELECT * from users WHERE id = :user_id";
$stmt=$pdo->prepare($sql);
$stmt->bindParam(":user_id",$user_id,PDO::PARAM_INT);
$stmt->execute();
$user=$stmt->fetch(PDO::FETCH_ASSOC);



?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="This is demo page made for YouBee.ai's programming courses">
  <meta name="author" content="YouBee.ai">

  <title>Home - YouBee Blog Template</title>

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
      <!-- Page Title -->
      <div class="col-md-12">
        <a class="pull-left" href="#">
          <img class="media-object" src="http://placehold.it/64x64" alt="">
        </a>
        <div class="profile-head">
        <img class="media-object" src="<?= !empty(htmlspecialchars($user["profile"])) ?$user["profile"]:'imgs/default.png' ?>" width="64px" height="64px" alt="">
        <h2>Posts by <?=  $user["name"]  ?>  </h2>
          <br>
        </div>
        <h3>posts(<?= count($posts)  ?>)</h3>

      </div>




      <!-- Blog Entries Column -->
      <div class="col-md-12">

      <?php if(!empty($posts)): ?>
        <!-- First Blog Post -->
         <?php foreach($posts as $post): ?>


        <h2 class="post-title">
          <a href="post.html"><?= $post["subject"]  ?></a>
        </h2>
        <p><span class="glyphicon glyphicon-time"></span><?= $post["date_created"]  ?></p>
        <p><?= $post["content"]  ?></p>
        <a class="btn btn-default" href="post.html">Read More</a>

        <hr>


        <?php endforeach; ?>


        <?php else: ?>
          <p>no posts for this user</p>
          <?php endif; ?>

        

        <!-- Pager -->
        <ul class="pager">
          <li class="previous">
            <a href="#">Prev</a>
          </li>
          <li class="next">
            <a href="#">Next</a>
          </li>
        </ul>

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