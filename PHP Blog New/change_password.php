<?php

require "components/not_logged_in.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1">

    <title>Edit Profile</title>

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css"
          rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/simple-blog-template.css"
          rel="stylesheet">
</head>

<body>

<?php require "components/navbar.php"; ?>

<div class="container">

    <div class="row">

        <div class="col-lg-2"></div>

        <div class="col-lg-8 signup">

            <h1>Change Password</h1>

        <form
            action="actions/change_password_action.php"
            method="POST"
        >

            <div class="form-group">
                <label>
                    Old Password
                </label>

                <input
                    type="password"
                    name="oldpass"
                    class="form-control"
                    required
                >
            </div>

            <div class="form-group">
                <label>
                    New Password
                </label>

                <input
                    type="password"
                    name="newpass"
                    class="form-control"
                    required
                >
            </div>

            <button
                type="submit"
                class="btn btn-primary"
            >
                Change Password
            </button>

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
                            echo "Old Password is Wrong";
                            break;

                        case 3:
                            echo "Password should be 8 characters Minium";
                            break;

                        case 4:
                            echo "Unable to Change Pass. Contact admin";
                            break;


                    }
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