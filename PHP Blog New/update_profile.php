<?php
require "components/not_logged_in.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="This is demo page made for YouBee.ai's programming courses">
  <meta name="author" content="YouBee.ai">

  <title>About - Ali Haji Blog Template</title>

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

      <div class="col-lg-12">

        <!-- Title -->
        <h1>About</h1>

        <hr>
            <section style=" display:flex; margin:40px ;  gap:40px ;">
                <div style="margin:20px 0;">

                    <a
                        href="change_profile.php"
                        class="btn btn-success">

                        Change Profile Picture

                    </a>

                </div>

                <div style="margin:20px 0;">

                    <a
                        href="change_password.php"
                        class="btn btn-success">

                        Change Password

                    </a>

                </div>
                <div style="margin:20px 0;">

                    <a
                        href="change_info.php"
                        class="btn btn-success">

                        Change Information

                    </a>

                </div>
            </section>

        <hr>

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