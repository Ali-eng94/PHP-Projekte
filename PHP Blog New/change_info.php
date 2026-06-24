<?php


require "connection.php";
require "components/not_logged_in.php";

$id = $_SESSION['user_id'];

/* -------- GET USER -------- */
$sql = "
SELECT id, name, email
FROM users
WHERE id = :id
";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(":id", $id);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$user){
    die("User not found");
}

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

            <h1>Edit Profile</h1>

            <form
                action="actions/edit_info_action.php"
                method="POST"
                class="signup-form">

                <!-- EMAIL -->
                <div class="form-group">

                    <label for="email">
                        Email
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control"
                        value="<?php echo htmlspecialchars($user['email']); ?>"
                        required
                    >

                </div>

                <!-- USERNAME -->
                <div class="form-group">

                    <label for="username">
                        Username
                    </label>

                    <input
                        type="text"
                        id="username"
                        name="name"
                        class="form-control"
                        value="<?php echo htmlspecialchars($user['name']); ?>"
                        required
                    >

                </div>

                <!-- PASSWORD -->
                <div class="form-group">

                    <label for="password">
                         Password
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control"
                        placeholder="Leave empty to keep password"
                    >

                </div>

                <button
                    type="submit"
                    class="btn btn-primary">

                    Save Changes

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
                            echo "Email is not valid";
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