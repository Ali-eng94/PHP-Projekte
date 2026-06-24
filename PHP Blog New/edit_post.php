<?php
session_start();

require 'components/not_logged_in.php';
require 'connection.php';

/* -------- CHECK POST ID -------- */
$id = $_GET['id'] ?? '';

if(empty($id)){
    die("Invalid Post ID");
}

/* -------- GET POST -------- */
$sql = "
SELECT 
    p.id AS post_id,
    p.subject,
    p.content,
    p.date_created,
    u.id AS user_id,
    u.name AS user_name,
    u.profile AS user_profile
FROM posts p
INNER JOIN users u
ON u.id = p.user_id
WHERE p.id = :id
AND p.deleted_at IS NULL
";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(":id", $id);
$stmt->execute();

$post = $stmt->fetch(PDO::FETCH_ASSOC);

/* -------- CHECK IF POST EXISTS -------- */
if(!$post){
    die("Post doesn't exist");
}

/* -------- CHECK OWNER -------- */
$isPostOwner =
isset($_SESSION['user_id'])
&&
$_SESSION['user_id']
==
$post['user_id'];

if(!$isPostOwner){
    die("Access Denied");
}

/* -------- FORMAT DATE -------- */
$date = new DateTime(
    $post['date_created']
);

$formattedDate =
$date->format(
    'F j, Y \a\t g:i A'
);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1">

    <title>Edit Post</title>

    <link
        href="css/bootstrap.min.css"
        rel="stylesheet">

    <link
        href="css/simple-blog-template.css"
        rel="stylesheet">
</head>

<body>

<?php require "components/navbar.php"; ?>

<div class="container">

    <div class="row">

        <div class="col-lg-12 newpost">

            <h1>Edit Post</h1>

            <form
                action="actions/editpost_action.php?id=<?php echo $post['post_id']; ?>"
                method="POST"
                class="newpost-form">

                <!-- Hidden Post ID -->
                <input
                    type="hidden"
                    name="post_id"
                    value="<?php echo $post['post_id']; ?>"
                >

                <!-- SUBJECT -->
                <div class="form-group">

                    <label for="subject">
                        Subject
                    </label>

                    <input
                        type="text"
                        id="subject"
                        name="subject"
                        class="form-control"
                        value="<?php echo htmlspecialchars($post['subject']); ?>"
                        required
                    >

                </div>

                <!-- CONTENT -->
                <div class="form-group">

                    <label for="content">
                        Content
                    </label>

                    <textarea
                        rows="5"
                        id="content"
                        name="content"
                        class="form-control"
                        required><?php echo htmlspecialchars($post['content']); ?></textarea>

                </div>
                
                <button
                    type="submit"
                    class="btn btn-primary">

                    Update Post

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
                            echo "Unable to Update Post";
                            break;
                    }

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