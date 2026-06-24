<?php

require '../connection.php';
session_start();

require '../components/not_logged_in.php';

/* -------- CHECK METHOD -------- */
if($_SERVER["REQUEST_METHOD"] !== "POST"){
    die("Wrong Method");
}

/* -------- GET DATA -------- */
$id = $_POST['post_id'] ?? '';

$subject = htmlspecialchars(
    trim($_POST["subject"] ?? '')
);

$content = htmlspecialchars(
    trim($_POST["content"] ?? '')
);

/* -------- CHECK EMPTY FIELDS -------- */
if(
    empty($id)
    ||
    empty($subject)
    ||
    empty($content)
){
    header(
        "Location: ../editpost.php?id=$id&err=1"
    );
    exit();
}

/* -------- GET POST OWNER -------- */
$sql = "
SELECT user_id
FROM posts
WHERE id = :id
AND p.deleted_at IS NULL
";

$stmt = $pdo->prepare($sql);

$stmt->bindParam(
    ":id",
    $id
);

$stmt->execute();

$post = $stmt->fetch(PDO::FETCH_ASSOC);

/* -------- CHECK IF POST EXISTS -------- */
if(!$post){
    die("Post does not exist");
}

/* -------- CHECK OWNER -------- */
if(
    $_SESSION['user_id']
    !=
    $post['user_id']
){
    die("Access Denied");
}

try {

    /* -------- UPDATE POST -------- */
    $sql = "
    UPDATE posts
    SET
        subject = :subject,
        content = :content
    WHERE id = :id
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(
        ":subject",
        $subject
    );

    $stmt->bindParam(
        ":content",
        $content
    );

    $stmt->bindParam(
        ":id",
        $id
    );

    $stmt->execute();

    header(
        "Location: ../post.php?id=$id"
    );
    exit();

}
catch(PDOException $e){

    die($e->getMessage());

}