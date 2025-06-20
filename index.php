
<?php
session_start();
// require "components/not_logged_in.php";
require  "connection.php";

try{

$sql="
SELECT
       p.id as post_id,
       p.content as post_content,
       p.subject as post_subject,
       p.date_created as post_created,
       users.id as user_id,
       users.name as user_name,
       (SELECT COUNT(*) FROM post_likes WHERE post_id =p.id) as like_count

FROM posts p 
JOIN  users ON users.id = p.user_id
ORDER BY p.date_created DESC 

";
$stmt=$pdo->prepare($sql);
$stmt->execute();

$posts=$stmt->fetchAll(PDO::FETCH_ASSOC);
}
catch(PDOException $e){
  die($e->getMessage());
}

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

<?php require "components/navbar.php" ; ?>


  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Blog Entries Column -->
      <div class="col-md-12">
        <?php if(!empty($posts)):?>
          <?php foreach($posts as $post): ?>

        <h2 class="post-title">
          <a href="post.php"><?= $post["post_subject"]  ?></a>
        </h2>
        <a href="author.php?id=<?= $post["user_id"] ?>" class="lead">
          by <?= $post["user_name"]   ?>
        </a>
        <p><span class="glyphicon glyphicon-time"><?= $post["post_created"]  ?></span>  </p>
        <p><?= $post["post_content"]  ?></p>
        <a class="btn btn-default" href="post.php?id=<?= $post["post_id"] ?>">Read More</a>



        <button class="btn btn-default like-button" data-post-id="<?= $post["post_id"] ?>">
        👍 <span class="like-count"><?= $post["like_count"] ?> </span>
        </button>       
        
    
        
        <hr>

        <?php endforeach; ?>



  
<?php else :?>
  <p>no posts available </p>
  <?php endif; ?>
      

      </div>

    </div>
    <!-- /.row -->

  </div>
  <?php require "components/footer.php" ; ?>

 
  <!-- jQuery -->
  <script src="js/jquery.js"></script>
  <script src="js/like.js"></script>


  <!-- Bootstrap Core JavaScript -->
  <script src="js/bootstrap.min.js"></script>

  <script>
    

  </script>

</body>

</html>