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
ORDER BY p.date_created DESC
";

$stmt = $pdo->query($sql);
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

/* CHECK LOGIN */
$isProfileOwner =
isset($_SESSION['loggedIn'])
&&
$_SESSION['loggedIn'] === true;

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1">

<title>Home - Ali Haji Template</title>

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

    <!-- CHANGE PROFILE BUTTON -->
    <?php if($isProfileOwner): ?>

        <div style="margin:20px 0;">

            <a
                href="change_profile.php"
                class="btn btn-success">

                Change Profile Picture

            </a>

        </div>

        <div style="margin:20px 0;">

            <a
                href="update_profile.php"
                class="btn btn-success">

                Update Profile

            </a>

        </div>

    <?php endif; ?>

    <div class="row">

        <div class="col-md-12">

            <?php foreach ($posts as $post): ?>

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

                <div
                style="
                    border:1px solid #ddd;
                    padding:20px;
                    margin-bottom:20px;
                    border-radius:10px;
                ">

                    <!-- USER -->
                    <div
                    style="
                        display:flex;
                        align-items:center;
                        gap:15px;
                        margin-bottom:15px;
                    ">

                        <img
                        src="uploads/<?php
                        echo htmlspecialchars(
                            $profileImage
                        );
                        ?>"
                        alt="Profile"
                        style="
                            width:70px;
                            height:70px;
                            border-radius:50%;
                            object-fit:cover;
                        ">

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
                                Posted on
                                <?php
                                echo $formattedDate;
                                ?>
                            </p>

                        </div>

                    </div>

                    <!-- POST TITLE -->
                    <h2>

                        <a href="post.php?id=<?php
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
                                $post['content']
                            )
                        );
                        ?>

                    </p>

                    <a
                    class="btn btn-default"
                    href="post.php?id=<?php
                    echo $post['post_id'];
                    ?>">
                        Read More
                    </a>

                    <a
                    class="btn btn-primary"
                    href="#">
                        Like
                    </a>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

</div>

<?php require "components/footer.php"; ?>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>