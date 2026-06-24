<?php
session_start();
require 'components/not_logged_in.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>New Post</title>

    <link href="css/bootstrap.min.css"
          rel="stylesheet">

    <link href="css/simple-blog-template.css"
          rel="stylesheet">
</head>

<body>

<?php require "components/navbar.php"; ?>

<div class="container">

    <div class="row">

        <div class="col-lg-12 newpost">

            <h1>New Post</h1>

            <form
                action="actions/newpost_action.php"
                method="POST"
                class="newpost-form">

                <div class="form-group">

                    <label for="subject">
                        Subject
                    </label>

                    <input
                        type="text"
                        id="subject"
                        name="subject"
                        class="form-control"
                        value="<?php echo htmlspecialchars($_SESSION['subject'] ?? ''); ?>"
                    >

                </div>

                <div class="form-group">

                    <label for="content">
                        Content
                    </label>

                    <textarea
                        rows="5"
                        id="content"
                        name="content"
                        class="form-control"><?php echo htmlspecialchars($_SESSION['content'] ?? ''); ?></textarea>

                </div>

                <button
                    type="submit"
                    class="btn btn-primary">

                    Post

                </button>

            </form>

            <p style="color:red; margin-top:20px;">

                <?php

                if(isset($_GET['err'])){

                    switch($_GET['err']){

                        case 1:
                            echo "Missing Parameters";
                            break;

                        case 0:
                            echo "Unable to Post. Contact Admin";
                            break;
                    }

                    unset($_SESSION['subject']);
                    unset($_SESSION['content']);
                }

                ?>

            </p>

        </div>

    </div>

</div>

<?php require "components/footer.php"; ?>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>