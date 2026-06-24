<?php
session_start();
require "components/is_logged_in.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Signup Page">
    <meta name="author" content="YouBee.ai">

    <title>Sign up</title>

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/simple-blog-template.css" rel="stylesheet">
</head>

<body>

<?php require "components/navbar.php"; ?>

<div class="container">

    <div class="row">

        <div class="col-lg-2"></div>

        <div class="col-lg-8 signup">

            <h1>Sign up</h1>

            <form action="actions/register.php"
                  method="POST"
                  class="signup-form">

                <!-- EMAIL -->
                <div class="form-group">
                    <label for="email">Email</label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control"
                        value="<?php echo $_SESSION['register_email'] ?? ''; ?>"
                        required
                    >
                </div>

                <!-- USERNAME -->
                <div class="form-group">
                    <label for="username">Username</label>

                    <input
                        type="text"
                        id="username"
                        name="name"
                        class="form-control"
                        value="<?php echo $_SESSION['register_name'] ?? ''; ?>"
                        required
                    >
                </div>

                <!-- PASSWORD -->
                <div class="form-group">
                    <label for="password">Password</label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control"
                        required
                    >
                </div>

                <!-- CONFIRM PASSWORD -->
                <div class="form-group">
                    <label for="confirm_password">
                        Confirm Password
                    </label>

                    <input
                        type="password"
                        id="confirm_password"
                        name="confirm_password"
                        class="form-control"
                        required
                    >
                </div>

                <button type="submit"
                        class="btn btn-primary">
                    Sign up
                </button>

                <p>
                    Already have an account?
                    <a href="login.php">
                        Login
                    </a>
                </p>
            </form>

            <!-- ERROR MESSAGE -->
            <p style="color:red; margin-top:20px;">

                <?php
                if(isset($_GET['err'])){

                    switch($_GET['err']){

                        case 1:
                            echo "Missing Parameters";
                            break;

                        case 2:
                            echo "Email is not valid";
                            break;

                        case 3:
                            echo "Passwords do not match";
                            break;

                        case 4:
                            echo "Password must be at least 8 characters";
                            break;

                        case 5:
                            echo "Email already exists";
                            break;

                        default:
                            echo "Something went wrong";
                    }
                }

                  $_SESSION['email'] = "";
                  $_SESSION['name'] = "";
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