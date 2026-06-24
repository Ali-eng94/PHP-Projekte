<?php

session_start();
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

/* -------- FORMAT DATE -------- */
$date = new DateTime($post['date_created']);

$formattedDate = $date->format(
    'F j, Y \a\t g:i A'
);

/* -------- CHECK OWNER -------- */
$isPostOwner =
isset($_SESSION['user_id'])
&&
$_SESSION['user_id']
==
$post['user_id'];

/* -------- PROFILE IMAGE -------- */
$profileImage =
!empty($post['user_profile'])
?
$post['user_profile']
:
'default.png';

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1">

    <title>
        <?php echo htmlspecialchars($post['subject']); ?>
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

<!-- NAVBAR -->
<?php require "components/navbar.php"; ?>

<!-- PAGE CONTENT -->
<div class="container">

    <div class="row">

        <div class="col-lg-12">

            <!-- TITLE -->
            <h1 class="post-title">
                <?php
                echo htmlspecialchars(
                    $post['subject']
                );
                ?>
            </h1>

            <hr>

            <!-- USER INFO -->
            <div
            style="
                display:flex;
                align-items:center;
                gap:15px;
                margin-bottom:20px;
            ">

                <!-- PROFILE IMAGE -->
                <img
                src="uploads/<?php
                echo htmlspecialchars(
                    $profileImage
                );
                ?>"
                alt="Profile"
                style="
                    width:80px;
                    height:80px;
                    border-radius:50%;
                    object-fit:cover;
                    border:2px solid #ddd;
                "
                >

                <!-- USER NAME -->
                <div>

                    <a
                    href="author.php?id=<?php
                    echo $post['user_id'];
                    ?>"
                    class="lead">

                        by
                        <?php
                        echo htmlspecialchars(
                            $post['user_name']
                        );
                        ?>

                    </a>

                    <p>

                        <span
                        class="
                        glyphicon
                        glyphicon-time">
                        </span>

                        Posted on
                        <?php
                        echo $formattedDate;
                        ?>

                    </p>

                </div>

            </div>

            <hr>

            <!-- POST CONTENT -->
            <p
            style="
                font-size:18px;
                line-height:1.8;
            ">

                <?php
                echo nl2br(
                    htmlspecialchars(
                        $post['content']
                    )
                );
                ?>

            </p>

            <hr>

            <!-- BUTTONS -->
            <?php

            if(
                isset($_SESSION['loggedIn'])
                &&
                $_SESSION['loggedIn']
                === true
            ){

                /* OWNER BUTTONS */
                if($isPostOwner){
                ?>

                    <a
                    class="btn btn-warning"
                    href="editpost.php?id=<?php
                    echo $post['post_id'];
                    ?>">
                        Edit
                    </a>

                    <a
                    class="btn btn-danger"
                    href="actions/delete_post_action.php?id=<?php
                    echo $post['post_id'];
                    ?>"
                    onclick="return confirm('Are you sure you want to delete this post?')">
                        Delete
                    </a>

                <?php
                }

                /* OTHER USERS */
                else{
                ?>

                    <a
                    class="btn btn-primary"
                    href="#">
                        Like
                    </a>

                <?php
                }
            }
            ?>

            <hr>

            <!-- COMMENT FORM -->
            <?php
            if(
                isset($_SESSION['loggedIn'])
                &&
                $_SESSION['loggedIn']
                === true
            ):
            ?>

            <div class="well">

                <h4>
                    Leave a Comment:
                </h4>

                <form
                method="POST"
                action="#">

                    <div class="form-group">

                        <textarea
                        class="form-control"
                        rows="4"
                        name="comment"
                        placeholder="Write your comment..."
                        required></textarea>

                    </div>

                    <button
                    type="submit"
                    class="btn btn-primary">

                        Submit

                    </button>

                </form>

            </div>

            <?php endif; ?>

        </div>

    </div>

</div>

<!-- FOOTER -->
<?php require "components/footer.php"; ?>

<!-- JS -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>