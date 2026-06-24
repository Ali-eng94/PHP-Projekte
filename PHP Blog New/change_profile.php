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

    <meta
        name="description"
        content="Change Profile Picture">

    <title>
        Change Profile Picture
    </title>

    <!-- Bootstrap -->
    <link
        href="css/bootstrap.min.css"
        rel="stylesheet">

    <!-- Custom CSS -->
    <link
        href="css/simple-blog-template.css"
        rel="stylesheet">

</head>

<body>

<?php require "components/navbar.php"; ?>

<div class="container">

    <div class="row">

        <div class="col-lg-2"></div>

        <div class="col-lg-8 signup">

            <h1>
                Change Profile Picture
            </h1>

            <form
                action="actions/change_profile_action.php"
                method="POST"
                enctype="multipart/form-data"
                class="signup-form">

                <!-- PROFILE IMAGE -->
                <div class="form-group">

                    <label for="profile">
                        Select Image
                    </label>

                    <input
                        type="file"
                        id="profile"
                        name="profile"
                        class="form-control"
                        accept="image/*"
                        required
                    >

                </div>

                <button
                    type="submit"
                    class="btn btn-primary">

                    Upload Image

                </button>

            </form>

            <!-- ERROR MESSAGE -->
            <p
                style="
                    color:red;
                    margin-top:20px;
                ">

                <?php

                if(isset($_GET['err'])){

                    switch($_GET['err']){

                        case 1:
                            echo "Couldn't upload image";
                            break;

                        case 2:
                            echo "Unsupported file extention";
                            break;

                        case 3:
                            echo "Image size is too large";
                            break;

                        case 4:
                            echo "Unsupported file exten Only JPG, JPEG, PNG and GIF are allowed";
                            break;

                        case 0:
                            echo "Couldn't upload image";
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