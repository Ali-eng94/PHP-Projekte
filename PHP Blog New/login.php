<?php
session_start();
require "components/is_logged_in.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>Login</title>

    <link href="css/bootstrap.min.css"
          rel="stylesheet">

    <link href="css/simple-blog-template.css"
          rel="stylesheet">
</head>

<body>

<?php require "components/navbar.php"; ?>

<div class="container">

    <div class="row">

        <div class="col-lg-2"></div>

        <div class="col-lg-8 login">

            <h1>Login</h1>

            <form
                action="actions/login_action.php"
                method="POST"
                class="login-form">

                <div class="form-group">

                    <label for="email">
                        Email
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control"
                        value="<?php echo htmlspecialchars($_SESSION['email'] ?? ''); ?>"
                    >

                </div>

                <div class="form-group">

                    <label for="password">
                        Password
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control"
                    >

                </div>

                <button
                    type="submit"
                    class="btn btn-primary">

                    Log in

                </button>

                <p>
                    Don't have an account?
                    <a href="signup.php">
                        Sign Up Now
                    </a>
                </p>

            </form>

            <p style="color:red; margin-top:20px;">

                <?php

                if(isset($_GET['err'])){

                    switch($_GET['err']){

                        case 1:
                            echo "Missing Parameters";
                            break;

                        case 2:
                            echo "Wrong Email or Password";
                            break;

                        case 3:
                            echo "Failed to login. Contact admin";
                            break;
                    }

                    unset($_SESSION['email']);
                }

                ?>

            </p>

        </div>

        <div class="col-lg-2"></div>

    </div>

</div>

<?php require "components/footer.php"; ?>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>