<?php

require 'connection.php';
session_start();

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
WHERE p.deleted_at IS NULL
ORDER BY p.date_created DESC
";

$stmt = $pdo->query($sql);
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
        content="Ali Haji Blog">

    <title>
        Home - Ali Haji Blog
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

        <div class="col-md-12">

            <?php
            if(empty($posts)){
                echo "<h3>No Posts Found</h3>";
            }
            ?>

            <?php foreach($posts as $post): ?>

                <?php

                $date = new DateTime(
                    $post['date_created']
                );

                $formattedDate =
                $date->format(
                    'F j, Y \a\t g:i A'
                );

                $profileImage =
                !empty($post['user_profile'])
                ?
                $post['user_profile']
                :
                'default.png';

                ?>

                <!-- POST CARD -->
                <div
                style="
                    border:1px solid #ddd;
                    padding:20px;
                    margin-bottom:20px;
                    border-radius:10px;
                ">

                    <!-- USER INFO -->
                    <div
                    style="
                        display:flex;
                        align-items:center;
                        gap:15px;
                        margin-bottom:15px;
                    ">

                        <!-- PROFILE IMAGE -->
                        <img
                        src="uploads/<?php
                        echo htmlspecialchars(
                            $profileImage
                        );
                        ?>"
                        width="64"
                        height="64"
                        style="
                            border-radius:50%;
                            object-fit:cover;
                        "
                        >

                        <div>

                            <a
                            href="author.php?id=<?php
                            echo $post['user_id'];
                            ?>"
                            class="lead">

                                <?php
                                echo htmlspecialchars(
                                    $post['user_name']
                                );
                                ?>

                            </a>

                            <p>

                                <span
                                class="glyphicon glyphicon-time">
                                </span>

                                Posted on
                                <?php
                                echo $formattedDate;
                                ?>

                            </p>

                        </div>

                    </div>

                    <!-- TITLE -->
                    <h2 class="post-title">

                        <a
                        href="post.php?id=<?php
                        echo $post['post_id'];
                        ?>">

                            <?php
                            echo htmlspecialchars(
                                $post['subject']
                            );
                            ?>

                        </a>

                    </h2>

                    <!-- CONTENT -->
                    <p>

                        <?php
                        echo nl2br(
                            htmlspecialchars(
                                substr(
                                    $post['content'],
                                    0,
                                    200
                                )
                            )
                        );
                        ?>

                        ...

                    </p>

                    <!-- BUTTON -->
                    <a
                    class="btn btn-default"
                    href="post.php?id=<?php
                    echo $post['post_id'];
                    ?>">

                        Read More

                    </a>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

</div>

<!-- FOOTER -->
<?php require "components/footer.php"; ?>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>